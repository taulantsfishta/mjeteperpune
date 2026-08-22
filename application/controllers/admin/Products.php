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

            $codeNumber = substr($lastUsedCode['code'],strlen($category_id) + 1);
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

            $data['main_content'] = $this->load->view('admin/add-products',$data,TRUE);
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

        $newProduct = $this->common_model->insert($productData,'products');

        if (!$newProduct) {$this->session->set_flashdata(    'error_msg',    'Ka ndodhur nje gabim gjate ruajtjes se produktit.');
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

            $productInformationData =$this->security->xss_clean(    $productInformationData);
            $this->common_model->insert($productInformationData,'product_information');
        }

        if ( !isset($_FILES['product_image']) || empty($_FILES['product_image']['name'])) {
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

            $this->session->set_flashdata( 'error_msg', $message);

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
                        redirect(base_url(). 'admin/products/get_product/' . $_POST['id']);
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
                redirect(base_url(). 'admin/products/get_product/' . $_POST['id']);
            } else {
                redirect(base_url(). 'admin/dashboard');
            }
        } else {
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
        }
    }

    public function delete_product($category_id,$product_id,$is_main_page = false)
    {
        if ($this->session->userdata('role') == 'admin') {
            $data = array('is_deleted' => 1);
            $data = $this->security->xss_clean($data);
            $this->common_model->edit_option($data, $product_id, 'products');

            if($is_main_page){
                redirect(base_url(). 'admin/dashboard');
            }else{
                redirect(base_url(). 'admin/dashboard/get_category' . '/' . $category_id);
            }
        } else {
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
        }
    }

    public function un_delete_product($category_id,$product_id,$is_main_page = false)
    {
        if ($this->session->userdata('role') == 'admin') {
            $data = array('is_deleted' => 0);
            $data = $this->security->xss_clean($data);
            $this->common_model->edit_option($data, $product_id, 'products');

            if($is_main_page){
                redirect(base_url(). 'admin/dashboard');
            }else{
                redirect(base_url(). 'admin/dashboard/get_category' . '/' . $category_id);
            }
        } else {
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
        }
    }


    private function uploadImageOfNewProduct($category_id){
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
        log_message('error','purchases: '.json_encode($purchases));
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
    
}
