<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_login_user();
        $this->load->model('common_model');
        $db = $this->load->database();
        $this->load->helper(array('form', 'url'));
    }

    public function get_product($id)
    {
        $data = array();
        $product = $this->db->select('products.id,products.name,products.image,products.code,products.price')->from('products')->where('id', $id)->get()->row_array();
        $data['product'] = $product;
        $data['page_title'] = 'Ndrysho Produktin';
        $data['main_content'] = $this->load->view('admin/edit-products', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function add($category_id)
    {
        // Vetem admin
        if ($this->session->userdata('role') != 'admin') {
            $data = [
                'heading' => 'Mesazhi',
                'message' => 'Nuk keni qasje ne kete faqe'
            ];

            $this->load->view('errors/html/error_404', $data);
            return;
        }

        $lastUsedCode = $this->db->select('code')->from('products')->where('category_id', $category_id)->order_by('id', 'DESC')->limit(1)->get()->row_array();

        if (!empty($lastUsedCode['code'])) {

            $codeNumber = substr($lastUsedCode['code'], strlen($category_id) + 1);
            $nextCode = $category_id . '-' . (((int)$codeNumber) + 1);
        } else {
            $nextCode = $category_id . '-1';
        }

        if (!isset($_POST['name']) || !isset($_POST['price'])) {
            $data = [
                'codeId' => $nextCode,
                'category_id' => $category_id,
                'page_title' => 'Shto Produktin'
            ];

            $data['main_content'] = $this->load->view('admin/add-products', $data, TRUE);
            $this->load->view('admin/index', $data);
            return;
        }


        $productData = [
            'name' => strtoupper(trim($this->input->post('name'))),
            'category_id' => $category_id,
            'price' => $this->input->post('price'),
            'code' => $nextCode,
            'created_at' => current_datetime()
        ];

        $productData = $this->security->xss_clean($productData);

        $newProduct = $this->common_model->insert($productData, 'products');

        if (!$newProduct) {
            $this->session->set_flashdata('error_msg',    'Ka ndodhur nje gabim gjate ruajtjes se produktit.');
            redirect(
                base_url() . 'admin/products/add/' . $category_id
            );
            return;
        }

        $productId = $this->db->insert_id();

        $shopName = trim((string)$this->input->post('shop_name'));
        $quantity = trim((string)$this->input->post('product_quantity'));
        $buyingPrice = trim((string)$this->input->post('product_buying_price'));
        $invoiceNumber = trim((string)$this->input->post('invoice_number'));

        $hasProductInformation = $shopName !== '' && $quantity !== '' && $buyingPrice !== '';

        if ($hasProductInformation) {
            $productInformationData = [
                'product_id' => $productId,
                'shop_name' => strtoupper($shopName),
                'product_quantity' => $quantity,
                'product_buying_price' => $buyingPrice,
                'invoice_number' => $invoiceNumber,
                'created_at' => current_datetime(),
                'updated_at' => current_datetime()
            ];

            $productInformationData = $this->security->xss_clean($productInformationData);
            $this->common_model->insert($productInformationData, 'product_information');
        }

        if (!isset($_FILES['product_image']) || empty($_FILES['product_image']['name'])) {
            $this->session->set_flashdata(
                'error_msg',
                'Produkti u ruajt, por nuk ka imazh. Ju lutem shtoni imazhin.'
            );
            redirect(
                base_url() . 'admin/products/get_product/' . $productId
            );
            return;
        }

        $uploadResult = $this->uploadImageOfNewProduct($category_id);

        if (!$uploadResult['status']) {

            $message = 'Produkti u ruajt me sukses, por imazhi nuk u ngarkua.';

            if (!empty($uploadResult['message'])) {
                $message .= ' ' . $uploadResult['message'];
            }

            $message .= ' Ju lutem rregulloni imazhin dhe provoni perseri.';

            $this->session->set_flashdata('error_msg', $message);

            redirect(
                base_url() . 'admin/products/get_product/' . $productId
            );

            return;
        }

        $imageData = [
            'image' => $uploadResult['image']
        ];

        $this->common_model->edit_option(
            $imageData,
            $productId,
            'products'
        );

        $this->queueProductImageIndex(
            $productId,
            $uploadResult['image']
        );

        $this->indexProductImageNow(
            $productId
        );


        $this->session->set_flashdata(
            'msg',
            'Produkti eshte ruajtur me sukses.'
        );

        redirect(
            base_url() . 'admin/dashboard/get_category/' . $category_id
        );
    }

    public function edit()
    {
        if ($this->session->userdata('role') == 'admin') {
            if (!empty($_POST)) {
                $product = $this->db->select('products.id,products.category_id,products.name,products.image,products.code,products.price')->from('products')->where('id', $_POST['id'])->get()->row_array();
                if (!empty($_FILES['product_image']['name'])) {
                    $uploadImageOfEditedProduct = $this->uploadImageOfEditedProduct($product);
                    if ($uploadImageOfEditedProduct['status']) {
                        $this->session->set_flashdata('msg', 'Informatat u ndryshuan me sukses');
                        $data = array(
                            'name' => strtoupper($_POST['name']),
                            'price' => $_POST['price'],
                            'image' => $uploadImageOfEditedProduct['image']
                        );
                    } else {
                        $this->session->set_flashdata('error_msg', $uploadImageOfEditedProduct['message']);
                        redirect(base_url() . 'admin/products/get_product/' . $_POST['id']);
                    }
                } else {
                    $data = array(
                        'name' => strtoupper($_POST['name']),
                        'price' => $_POST['price'],
                    );
                    $this->session->set_flashdata('msg', 'Informatat u ndryshuan me sukses');
                }
                $data = $this->security->xss_clean($data);
                $this->common_model->edit_option($data, $_POST['id'], 'products');
                if (!empty($data['image'])) {

                    $this->queueProductImageIndex(
                        $_POST['id'],
                        $data['image']
                    );

                    $this->indexProductImageNow(
                        $_POST['id']
                    );
                }
                redirect(base_url() . 'admin/products/get_product/' . $_POST['id']);
            } else {
                redirect(base_url() . 'admin/dashboard');
            }
        } else {
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
        }
    }

    public function delete_product($category_id, $product_id, $is_main_page = false)
    {
        if ($this->session->userdata('role') == 'admin') {
            $data = array('is_deleted' => 1);
            $data = $this->security->xss_clean($data);
            $this->common_model->edit_option($data, $product_id, 'products');

            if ($is_main_page) {
                redirect(base_url() . 'admin/dashboard');
            } else {
                redirect(base_url() . 'admin/dashboard/get_category' . '/' . $category_id);
            }
        } else {
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
        }
    }

    public function un_delete_product($category_id, $product_id, $is_main_page = false)
    {
        if ($this->session->userdata('role') == 'admin') {
            $data = array('is_deleted' => 0);
            $data = $this->security->xss_clean($data);
            $this->common_model->edit_option($data, $product_id, 'products');

            if ($is_main_page) {
                redirect(base_url() . 'admin/dashboard');
            } else {
                redirect(base_url() . 'admin/dashboard/get_category' . '/' . $category_id);
            }
        } else {
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
        }
    }


    private function uploadImageOfNewProduct($category_id)
    {
        $config['upload_path']          = 'optimum/products_images';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 1000;
        $config['max_width']            = 2048;
        $config['max_height']           = 1500;
        $config['file_name'] = $category_id . '-' . rand(100000, 2000000);

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('product_image')) {
            $error = array('error' => $this->upload->display_errors());
            $data['message'] = 'Imazhi nuk eshte futur ne sistem ' . $error['error'];
            $data['status'] = 0;
        } else {
            $data = array('upload_data' => $this->upload->data());
            $data['status'] = 1;
            $data['image'] = $data['upload_data']['file_name'];
        }
        return $data;
    }

    private function uploadImageOfEditedProduct($product)
    {
        $config['upload_path']          = 'optimum/products_images';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 1000;
        $config['max_width']            = 2048;
        $config['max_height']           = 1500;
        $config['file_name'] = $product['category_id'] . '-' . rand(100000, 2000000);

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('product_image')) {
            $error = array('error' => $this->upload->display_errors());
            $data['message'] = 'Imazhi nuk eshte futur ne sistem ' . $error['error'];
            $data['status'] = 0;
        } else {
            unlink('optimum/products_images/' . $product['image']);
            $data = array('upload_data' => $this->upload->data());
            $data['status'] = 1;
            $data['image'] = $data['upload_data']['file_name'];
        }
        return $data;
    }

    public function product_information($product_id)
    {
        $product_id = (int)$product_id;

        // Informata bazë të produktit
        $product = $this->db
            ->select('id, name, code')
            ->from('products')
            ->where('id', $product_id)
            ->get()
            ->row_array();

        if (!$product) {
            echo json_encode([
                'status' => false,
                'message' => 'Produkti nuk u gjet.'
            ]);
            return;
        }

        // Të gjitha blerjet e këtij produkti
        $purchases = $this->db
            ->select('
                id,
                shop_name,
                product_quantity,
                product_buying_price,
                invoice_number,
                created_at
            ')
            ->from('product_information')
            ->where('product_id', $product_id)
            ->order_by('created_at', 'DESC')
            ->get()
            ->result_array();
        echo json_encode([
            'status' => true,
            'data' => [
                'product_info' => $product,
                'purchases'   => $purchases
            ]
        ]);
    }


    public function add_product_information()
    {
        $product_id = (int)$this->input->post('product_id');

        $shop_name = trim($this->input->post('shop_name'));
        $product_quantity = trim($this->input->post('product_quantity'));
        $product_buying_price = trim($this->input->post('product_buying_price'));
        $invoice_number = trim($this->input->post('invoice_number'));

        if (
            !$product_id ||
            $shop_name == '' ||
            $product_quantity == '' ||
            $product_buying_price == ''
        ) {
            echo json_encode([
                'status' => false,
                'message' => 'Të gjitha fushat janë obligative.'
            ]);
            return;
        }

        $product = $this->db
            ->select('id')
            ->from('products')
            ->where('id', $product_id)
            ->get()
            ->row_array();

        if (!$product) {
            echo json_encode([
                'status' => false,
                'message' => 'Produkti nuk ekziston.'
            ]);
            return;
        }

        $data = [
            'product_id' => $product_id,
            'shop_name' => $shop_name,
            'product_quantity' => $product_quantity,
            'product_buying_price' => $product_buying_price,
            'invoice_number' => $invoice_number,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->db->insert('product_information', $data);

        echo json_encode([
            'status' => true,
            'message' => 'Porosia u shtua me sukses.',
            'id' => $this->db->insert_id()
        ]);
    }

    public function update_product_information()
    {
        $id = (int)$this->input->post('id');

        $shop_name = trim($this->input->post('shop_name'));
        $product_quantity = trim($this->input->post('product_quantity'));
        $product_buying_price = trim($this->input->post('product_buying_price'));
        $invoice_number = trim($this->input->post('invoice_number'));

        if (
            !$id ||
            $shop_name == '' ||
            $product_quantity == '' ||
            $product_buying_price == ''
        ) {
            echo json_encode([
                'status' => false,
                'message' => 'Të dhënat nuk janë valide.'
            ]);
            return;
        }

        $exists = $this->db
            ->select('id')
            ->from('product_information')
            ->where('id', $id)
            ->get()
            ->row_array();

        if (!$exists) {
            echo json_encode([
                'status' => false,
                'message' => 'Rreshti nuk ekziston.'
            ]);
            return;
        }

        $data = [
            'shop_name' => $shop_name,
            'product_quantity' => $product_quantity,
            'product_buying_price' => $product_buying_price,
            'invoice_number' => $invoice_number
        ];

        $this->db
            ->where('id', $id)
            ->update('product_information', $data);

        echo json_encode([
            'status' => true,
            'message' => 'Rreshti u përditësua me sukses.'
        ]);
    }

    public function delete_product_information()
    {
        $id = (int)$this->input->post('id');

        if (!$id) {
            echo json_encode([
                'status' => false,
                'message' => 'ID nuk është valide.'
            ]);
            return;
        }

        $exists = $this->db
            ->select('id')
            ->from('product_information')
            ->where('id', $id)
            ->get()
            ->row_array();

        if (!$exists) {
            echo json_encode([
                'status' => false,
                'message' => 'Rreshti nuk ekziston.'
            ]);
            return;
        }

        $this->db
            ->where('id', $id)
            ->delete('product_information');

        echo json_encode([
            'status' => true,
            'message' => 'Rreshti u fshi me sukses.'
        ]);
    }

    /*
|--------------------------------------------------------------------------
| IMAGE SEARCH - STATUS
|--------------------------------------------------------------------------
*/
    public function image_index_status()
    {
        if ($this->session->userdata('role') != 'admin') {
            return $this->output
                ->set_status_header(403)
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => false,
                    'message' => 'Nuk keni qasje.'
                ]));
        }

        $total = $this->db
            ->from('product_image_index')
            ->count_all_results();

        // indexed = 1 => OK
        $indexed = $this->db
            ->from('product_image_index')
            ->where('indexed', 1)
            ->count_all_results();

        // indexed = 0 => ende pa u procesuar
        $remaining = $this->db
            ->from('product_image_index')
            ->where('indexed', 0)
            ->count_all_results();

        // indexed = 2 => error permanent
        $failed = $this->db
            ->from('product_image_index')
            ->where('indexed', 2)
            ->count_all_results();

        $percentage = 0;

        if ($total > 0) {
            $percentage = round(
                (($indexed + $failed) / $total) * 100,
                2
            );
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'status' => true,
                'total' => $total,
                'indexed' => $indexed,
                'remaining' => $remaining,
                'failed' => $failed,
                'percentage' => $percentage
            ]));
    }

    /*
|--------------------------------------------------------------------------
| INDEX NEXT PRODUCT IMAGE
|--------------------------------------------------------------------------
*/
    public function index_next_product_image()
    {
        if ($this->session->userdata('role') != 'admin') {

            return $this->output
                ->set_status_header(403)
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => false,
                    'message' => 'Nuk keni qasje.'
                ]));
        }

        $this->load->library(
            'Product_image_search'
        );

        /*
     * Merr vetem nje produkt.
     *
     * Fillimisht dua ta testojme me NJE,
     * jo me 20 menjehere.
     */
        $row = $this->db
            ->select(
                '
            product_image_index.id AS index_id,
            product_image_index.product_id,
            product_image_index.image,
            products.name,
            products.code,
            products.category_id
            '
            )
            ->from('product_image_index')
            ->join(
                'products',
                'products.id = product_image_index.product_id'
            )
            ->where(
                'product_image_index.indexed',
                0
            )
            ->where(
                'products.is_deleted',
                0
            )
            ->order_by(
                'product_image_index.id',
                'ASC'
            )
            ->limit(1)
            ->get()
            ->row_array();


        if (!$row) {

            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => true,
                    'finished' => true,
                    'message' =>
                    'Nuk ka fotografi tjera per indeksim.'
                ]));
        }


        $imagePath =
            FCPATH .
            'optimum/products_images/' .
            $row['image'];


        /*
     * Kontrollo foton
     */
        if (
            !file_exists($imagePath) ||
            !is_file($imagePath)
        ) {

            $this->db
                ->where(
                    'id',
                    $row['index_id']
                )
                ->update(
                    'product_image_index',
                    [
                        'error_message' =>
                        'Fotoja nuk ekziston ne server.'
                    ]
                );

            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => false,
                    'product_id' =>
                    $row['product_id'],
                    'message' =>
                    'Fotoja nuk ekziston.'
                ]));
        }


        /*
     * Gemini embedding
     */
        $embeddingResult =
            $this->product_image_search
            ->createImageEmbedding(
                $imagePath
            );


        if (
            !$embeddingResult['status']
        ) {

            $errorMessage = isset(
                $embeddingResult['message']
            )
                ? $embeddingResult['message']
                : 'Gemini error';


            $this->db
                ->where(
                    'id',
                    $row['index_id']
                )
                ->update(
                    'product_image_index',
                    [
                        'error_message' =>
                        $errorMessage
                    ]
                );


            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => false,
                    'product_id' =>
                    $row['product_id'],
                    'message' =>
                    $errorMessage
                ]));
        }


        $embedding =
            $embeddingResult['embedding'];


        /*
     * Qdrant
     */
        $saveResult =
            $this->product_image_search
            ->saveProductVector(
                $row['product_id'],
                $embedding,
                [
                    'name' =>
                    $row['name'],

                    'code' =>
                    $row['code'],

                    'category_id' =>
                    $row['category_id'],

                    'image' =>
                    $row['image']
                ]
            );


        if (!$saveResult['status']) {

            $errorMessage = isset(
                $saveResult['message']
            )
                ? json_encode(
                    $saveResult['message']
                )
                : 'Qdrant error';


            $this->db
                ->where(
                    'id',
                    $row['index_id']
                )
                ->update(
                    'product_image_index',
                    [
                        'error_message' =>
                        $errorMessage
                    ]
                );


            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => false,
                    'product_id' =>
                    $row['product_id'],
                    'message' =>
                    $errorMessage
                ]));
        }


        /*
     * Mark indexed
     */
        $this->db
            ->where(
                'id',
                $row['index_id']
            )
            ->update(
                'product_image_index',
                [
                    'indexed' => 1,

                    'embedding_model' =>
                    'gemini-embedding-2',

                    'indexed_at' =>
                    date(
                        'Y-m-d H:i:s'
                    ),

                    'error_message' =>
                    null
                ]
            );


        return $this->output
            ->set_content_type(
                'application/json'
            )
            ->set_output(
                json_encode([
                    'status' => true,

                    'finished' => false,

                    'product_id' =>
                    $row['product_id'],

                    'code' =>
                    $row['code'],

                    'name' =>
                    $row['name'],

                    'image' =>
                    $row['image'],

                    'vector_size' =>
                    count($embedding)
                ])
            );
    }

    public function create_image_collection()
    {
        if ($this->session->userdata('role') != 'admin') {
            show_404();
            return;
        }

        $this->load->library('Product_image_search');

        $result = $this->product_image_search->createCollection(768);

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
    }

    public function image_index_manager()
    {
        if ($this->session->userdata('role') != 'admin') {
            show_404();
            return;
        }

        $data = array();

        $data['page_title'] = 'Indeksimi i Fotove';

        $data['main_content'] = $this->load->view(
            'admin/image-index-manager',
            $data,
            TRUE
        );

        $this->load->view('admin/index', $data);
    }

    public function index_product_batch()
    {
        if ($this->session->userdata('role') != 'admin') {
            return $this->output
                ->set_status_header(403)
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => false,
                    'message' => 'Nuk keni qasje.'
                ]));
        }

        $this->load->library('Product_image_search');

        /*
     * Per fillim: 5 foto per request.
     * Mund ta rrisim me vone ne 10 ose 20.
     */
        $batchSize = (int)$this->input->post('batch_size');

        if ($batchSize <= 0) {
            $batchSize = 5;
        }

        if ($batchSize > 20) {
            $batchSize = 20;
        }

        $rows = $this->db
            ->select('
            product_image_index.id AS index_id,
            product_image_index.product_id,
            product_image_index.image,
            products.name,
            products.code,
            products.category_id
        ')
            ->from('product_image_index')
            ->join(
                'products',
                'products.id = product_image_index.product_id'
            )
            ->where('product_image_index.indexed', 0)
            ->where('products.is_deleted', 0)
            ->order_by('product_image_index.id', 'ASC')
            ->limit($batchSize)
            ->get()
            ->result_array();

        if (empty($rows)) {

            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => true,
                    'finished' => true,
                    'processed' => 0,
                    'success_count' => 0,
                    'failed_count' => 0,
                    'message' => 'Indeksimi ka perfunduar.'
                ]));
        }

        $processed = 0;
        $successCount = 0;
        $failedCount = 0;

        $results = [];

        foreach ($rows as $row) {

            $processed++;

            $imagePath =
                FCPATH .
                'optimum/products_images/' .
                $row['image'];

            /*
        |--------------------------------------------------------------------------
        | FOTO NUK EKZISTON
        |--------------------------------------------------------------------------
        */
            if (
                !file_exists($imagePath) ||
                !is_file($imagePath)
            ) {

                $errorMessage =
                    'Fotoja nuk ekziston ne server.';

                $this->db
                    ->where('id', $row['index_id'])
                    ->update(
                        'product_image_index',
                        [
                            'indexed' => 2,
                            'error_message' => $errorMessage,
                            'indexed_at' => null
                        ]
                    );

                $failedCount++;

                $results[] = [
                    'product_id' => $row['product_id'],
                    'code' => $row['code'],
                    'status' => false,
                    'message' => $errorMessage
                ];

                continue;
            }

            /*
        |--------------------------------------------------------------------------
        | GEMINI
        |--------------------------------------------------------------------------
        */
            $embeddingResult =
                $this->product_image_search
                ->createImageEmbedding($imagePath);

            if (!$embeddingResult['status']) {

                $httpCode = isset(
                    $embeddingResult['http_code']
                )
                    ? (int)$embeddingResult['http_code']
                    : 0;

                /*
             * Rate limit ose problem i perkohshem.
             * MOS e shenojme produktin si failed.
             * E leme indexed = 0 qe ta provojme perseri.
             */
                if (
                    $httpCode == 429 ||
                    $httpCode == 500 ||
                    $httpCode == 502 ||
                    $httpCode == 503 ||
                    $httpCode == 504
                ) {

                    return $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode([
                            'status' => false,
                            'retryable' => true,
                            'http_code' => $httpCode,
                            'processed' => $processed - 1,
                            'success_count' => $successCount,
                            'failed_count' => $failedCount,
                            'message' =>
                            'Gemini eshte perkohesisht i zene ose eshte arritur limiti. Provohet perseri.',
                            'results' => $results
                        ]));
                }

                $errorMessage = isset(
                    $embeddingResult['message']
                )
                    ? (
                        is_array($embeddingResult['message'])
                        ? json_encode($embeddingResult['message'])
                        : $embeddingResult['message']
                    )
                    : 'Gemini error';

                $this->db
                    ->where('id', $row['index_id'])
                    ->update(
                        'product_image_index',
                        [
                            'indexed' => 2,
                            'error_message' => $errorMessage,
                            'indexed_at' => null
                        ]
                    );

                $failedCount++;

                $results[] = [
                    'product_id' => $row['product_id'],
                    'code' => $row['code'],
                    'status' => false,
                    'message' => $errorMessage
                ];

                continue;
            }

            $embedding =
                $embeddingResult['embedding'];

            /*
        |--------------------------------------------------------------------------
        | QDRANT
        |--------------------------------------------------------------------------
        */
            $saveResult =
                $this->product_image_search
                ->saveProductVector(
                    $row['product_id'],
                    $embedding,
                    [
                        'name' => $row['name'],
                        'code' => $row['code'],
                        'category_id' =>
                        $row['category_id'],
                        'image' => $row['image']
                    ]
                );

            if (!$saveResult['status']) {

                $httpCode = isset(
                    $saveResult['http_code']
                )
                    ? (int)$saveResult['http_code']
                    : 0;

                /*
             * Nese Qdrant ka problem te perkohshem,
             * mos e sheno si failed.
             */
                if (
                    $httpCode == 429 ||
                    $httpCode == 500 ||
                    $httpCode == 502 ||
                    $httpCode == 503 ||
                    $httpCode == 504
                ) {

                    return $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode([
                            'status' => false,
                            'retryable' => true,
                            'http_code' => $httpCode,
                            'processed' => $processed - 1,
                            'success_count' => $successCount,
                            'failed_count' => $failedCount,
                            'message' =>
                            'Problem i perkohshem me Qdrant.',
                            'results' => $results
                        ]));
                }

                $errorMessage = isset(
                    $saveResult['message']
                )
                    ? (
                        is_array($saveResult['message'])
                        ? json_encode($saveResult['message'])
                        : $saveResult['message']
                    )
                    : 'Qdrant error';

                $this->db
                    ->where('id', $row['index_id'])
                    ->update(
                        'product_image_index',
                        [
                            'indexed' => 2,
                            'error_message' => $errorMessage,
                            'indexed_at' => null
                        ]
                    );

                $failedCount++;

                $results[] = [
                    'product_id' => $row['product_id'],
                    'code' => $row['code'],
                    'status' => false,
                    'message' => $errorMessage
                ];

                continue;
            }

            /*
        |--------------------------------------------------------------------------
        | SUCCESS
        |--------------------------------------------------------------------------
        */
            $this->db
                ->where('id', $row['index_id'])
                ->update(
                    'product_image_index',
                    [
                        'indexed' => 1,
                        'embedding_model' =>
                        'gemini-embedding-2',
                        'indexed_at' =>
                        date('Y-m-d H:i:s'),
                        'error_message' => null
                    ]
                );

            $successCount++;

            $results[] = [
                'product_id' => $row['product_id'],
                'code' => $row['code'],
                'name' => $row['name'],
                'image' => $row['image'],
                'status' => true,
                'vector_size' => count($embedding)
            ];
        }

        /*
    |--------------------------------------------------------------------------
    | STATUS PAS BATCH-IT
    |--------------------------------------------------------------------------
    */
        $remaining = $this->db
            ->from('product_image_index')
            ->where('indexed', 0)
            ->count_all_results();

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'status' => true,
                'finished' => ($remaining == 0),
                'processed' => $processed,
                'success_count' => $successCount,
                'failed_count' => $failedCount,
                'remaining' => $remaining,
                'results' => $results
            ]));
    }

    public function retry_failed_image_index()
    {
        if ($this->session->userdata('role') != 'admin') {
            return $this->output
                ->set_status_header(403)
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => false,
                    'message' => 'Nuk keni qasje.'
                ]));
        }

        $this->db
            ->where('indexed', 2)
            ->update(
                'product_image_index',
                [
                    'indexed' => 0,
                    'error_message' => null,
                    'indexed_at' => null
                ]
            );

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'status' => true,
                'affected_rows' =>
                $this->db->affected_rows()
            ]));
    }

    public function create_category_qdrant_index()
    {
        if ($this->session->userdata('role') != 'admin') {
            show_404();
            return;
        }

        $this->load->library('Product_image_search');

        $result =
            $this->product_image_search
            ->createCategoryPayloadIndex();

        header('Content-Type: application/json');

        echo json_encode($result);
    }

    private function queueProductImageIndex($productId, $image)
    {
        $productId = (int)$productId;

        if ($productId <= 0 || empty($image)) {
            return false;
        }

        $existing = $this->db
            ->select('id')
            ->from('product_image_index')
            ->where('product_id', $productId)
            ->limit(1)
            ->get()
            ->row_array();

        $data = [
            'image' => $image,
            'indexed' => 0,
            'embedding_model' => null,
            'indexed_at' => null,
            'error_message' => null
        ];

        if ($existing) {

            $this->db
                ->where('product_id', $productId)
                ->update(
                    'product_image_index',
                    $data
                );
        } else {

            $data['product_id'] = $productId;

            $this->db->insert(
                'product_image_index',
                $data
            );
        }

        return true;
    }

    private function indexProductImageNow($productId)
    {
        $productId = (int)$productId;

        if ($productId <= 0) {
            return false;
        }

        $this->load->library('Product_image_search');

        $row = $this->db
            ->select('
            product_image_index.id AS index_id,
            product_image_index.product_id,
            product_image_index.image,
            products.name,
            products.code,
            products.category_id
        ')
            ->from('product_image_index')
            ->join(
                'products',
                'products.id = product_image_index.product_id'
            )
            ->where(
                'product_image_index.product_id',
                $productId
            )
            ->where(
                'products.is_deleted',
                0
            )
            ->limit(1)
            ->get()
            ->row_array();

        if (!$row) {
            return false;
        }

        $imagePath =
            FCPATH .
            'optimum/products_images/' .
            $row['image'];

        if (
            !file_exists($imagePath) ||
            !is_file($imagePath)
        ) {

            $this->db
                ->where('id', $row['index_id'])
                ->update(
                    'product_image_index',
                    [
                        'indexed' => 2,
                        'error_message' =>
                        'Fotoja nuk ekziston ne server.',
                        'indexed_at' => null
                    ]
                );

            return false;
        }

        // GEMINI
        $embeddingResult =
            $this->product_image_search
            ->createImageEmbedding($imagePath);

        if (
            !isset($embeddingResult['status']) ||
            !$embeddingResult['status']
        ) {

            $errorMessage =
                isset($embeddingResult['message'])
                ? (
                    is_array($embeddingResult['message'])
                    ? json_encode($embeddingResult['message'])
                    : $embeddingResult['message']
                )
                : 'Gemini error';

            // E leme indexed = 0
            // qe te provohet perseri nga batch-i
            $this->db
                ->where('id', $row['index_id'])
                ->update(
                    'product_image_index',
                    [
                        'indexed' => 0,
                        'error_message' => $errorMessage,
                        'indexed_at' => null
                    ]
                );

            return false;
        }

        $embedding =
            $embeddingResult['embedding'];

        // QDRANT
        $saveResult =
            $this->product_image_search
            ->saveProductVector(
                $row['product_id'],
                $embedding,
                [
                    'name' => $row['name'],
                    'code' => $row['code'],
                    'category_id' =>
                    $row['category_id'],
                    'image' => $row['image']
                ]
            );

        if (
            !isset($saveResult['status']) ||
            !$saveResult['status']
        ) {

            $errorMessage =
                isset($saveResult['message'])
                ? (
                    is_array($saveResult['message'])
                    ? json_encode($saveResult['message'])
                    : $saveResult['message']
                )
                : 'Qdrant error';

            // E leme 0 qe batch-i ta provoje perseri
            $this->db
                ->where('id', $row['index_id'])
                ->update(
                    'product_image_index',
                    [
                        'indexed' => 0,
                        'error_message' => $errorMessage,
                        'indexed_at' => null
                    ]
                );

            return false;
        }

        // SUCCESS
        $this->db
            ->where('id', $row['index_id'])
            ->update(
                'product_image_index',
                [
                    'indexed' => 1,
                    'embedding_model' =>
                    'gemini-embedding-2',
                    'indexed_at' =>
                    date('Y-m-d H:i:s'),
                    'error_message' => null
                ]
            );

        return true;
    }
}
