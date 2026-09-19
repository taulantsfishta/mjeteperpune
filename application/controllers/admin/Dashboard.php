<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


// *************************************************************************
// *                                                                       *
// * Optimum LinkupComputers                              *
// * Copyright (c) Optimum LinkupComputers. All Rights Reserved                     *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * Email: info@optimumlinkupsoftware.com                                 *
// * Website: https://optimumlinkup.com.ng								   *
// * 		  https://optimumlinkupsoftware.com							   *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * This software is furnished under a license and may be used and copied *
// * only  in  accordance  with  the  terms  of such  license and with the *
// * inclusion of the above copyright notice.                              *
// *                                                                       *
// *************************************************************************

//LOCATION : application - controller - Dashboard.php

class Dashboard extends CI_Controller {

	public function __construct(){
        parent::__construct();
        check_login_user();
        $this->load->model('common_model');
        $db = $this->load->database();

    }

    /****************Function login**********************************
     * @type            : Function
     * @function name   : index
     * @description     : This redirect to dashboard automatically 
     *                    
     *                       
     * @param           : null 
     * @return          : null 
     * ********************************************************** */
	 
    public function index(){
        $data = array();
        $view_category = $this->session->userdata('view_category');
        if ($view_category[0] == 0) {
            $products = $this->db->select('products.id,products.name,products.category_id,products.image,products.code,products.price,products.is_deleted')->from('products')->where('is_deleted',0)->limit(10)->order_by('id','DESC')->get()->result_array();
            $categories =$this->db->select()->from('category')->get()->result_array();
        } else {
            $products = $this->db->select('products.id,products.name,,products.category_id,products.image,products.code,products.price,products.is_deleted')->from('products')->where_in('category_id', $view_category)->limit(10)->where('is_deleted',0)->order_by('id','DESC')->get()->result_array();
            $categories = $this->db->select()->from('category')->where_in('id',$view_category)->get()->result_array();
        }

        $_SESSION['category'] = $categories;
        $_SESSION['title_name'] = 'TË GJITHA PRODUKTET';
        $data['products'] = $products;
        $data['page_title'] = 'TË GJITHA PRODUKTET';
        $data['count'] = $this->common_model->get_user_total();
        $data['main_content'] = $this->load->view('admin/home', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function get_category($id){
        $data = array();
        $category = $this->db->select()->from('category')->where('id', $id)->get()->row_array();
        if($category !=null || $category !=''){
            if(in_array($id, $this->session->userdata('view_category')) || (in_array(0, $this->session->userdata('view_category')))){
                $products = $this->db->select('products.id,products.name,products.image,products.code,products.price,products.is_deleted')->from('products')->where('category_id', $id)->where('is_deleted',0)->limit(20)->get()->result_array();
                $total_row_products = $this->db->from('products')->where('category_id', $id)->count_all_results();
                $_SESSION['title_name'] = $category['name'];
                if ($this->session->userdata('name') == 'Genci') {
                    foreach ($products as &$product) {
                        $product['price'] = round($product['price'] * 1.15, 1);
                    }
                }
                $data['products'] = $products;
                $data['total_row_products'] =$total_row_products;
                $data['category'] = $category;
                $data['page_title'] = $category['name'];
                $data['count'] = $this->common_model->get_user_total();
                $data['main_content'] = $this->load->view('admin/products', $data, TRUE);
                $this->load->view('admin/index', $data);
            }else{
                $data['heading'] = 'Mesazhi';
                $data['message'] = "Nuk keni qasje ne kete faqe";
                $this->load->view('errors/html/error_404', $data);
            }
        }else{
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk egziston kjo kategori";
            $this->load->view('errors/html/error_404', $data);
        }
    }

    public function get_products_with_limit($id,$offset){
        $data = array();
        if(in_array($id, $this->session->userdata('view_category')) || (in_array(0, $this->session->userdata('view_category')))){
            $category = $this->db->select()->from('category')->where('id', $id)->get()->row_array();
            $limit = 20; // Number of products to load per request
            $products = $this->db->select('products.id,products.name,products.image,products.code,products.price,products.is_deleted')->from('products')->where('category_id', $id)->where('is_deleted',0)->limit($limit,$offset)->get()->result_array();
            if ($this->session->userdata('name') == 'Genci') {
                foreach ($products as &$product) {
                    $product['price'] = round($product['price'] * 1.15, 1);
                }
            }
            $_SESSION['title_name'] = $category['name'];
            $data['products'] = $products;
            $data['category_id'] = $id;
            header('Content-Type: application/json');
            echo json_encode($data);
        }else{
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
        }
    }

    public function search_products()
    {
        $data = array();
        $view_category = $this->session->userdata('view_category');
        $limit = 20;
        if($_GET['query'] == ''){
            if ($view_category[0] == 0) {
                $products = $this->db->select('products.id,products.name,products.image,products.category_id,products.code,products.price,products.is_deleted')->from('products')->where('is_deleted',0)->order_by('id','DESC')->limit(10)->get()->result_array();
            } else {
                $products = $this->db->select('products.id,products.name,products.image,products.category_id,products.code,products.price,products.is_deleted')->from('products')->where_in('category_id', $view_category)->where('is_deleted',0)->order_by('id','DESC')->limit(10)->get()->result_array();
            }
        }else{
            if ($view_category[0] == 0) {
                if (preg_match('/^[0-9\-]+$/', $_GET['query'])) {
                    $products = $this->db->select('products.id,products.name,products.image,products.category_id,products.code,products.price,products.is_deleted')->from('products')->group_start()->where('code', $_GET['query'])->where('is_deleted',0)->limit($limit,$_GET['offset'])->order_by('category_id','ASC')->order_by('id','ASC')->group_end()->get()->result_array();
                    $productsAll = $this->db->select('products.id,products.name,products.image,products.category_id,products.code,products.price,products.is_deleted')->from('products')->group_start()->where('code', $_GET['query'])->where('is_deleted',0)->group_end()->get()->result_array();
                }elseif (strpos($_GET['query'], '%') !== false) {
                    $query = trim($_GET['query']);
                    $query = str_replace('%', '.*', $query); // Convert % to SQL regex wildcard

                    $products = $this->db->select('products.id,products.name,products.image,products.category_id,products.code,products.price,products.is_deleted')->from('products')->group_start()->where('name REGEXP', $query)->where('is_deleted',0)->limit($limit,$_GET['offset'])->order_by('category_id','ASC')->order_by('id','ASC')->group_end()->get()->result_array();
                    $productsAll = $this->db->select('products.id,products.name,products.image,products.category_id,products.code,products.price,products.is_deleted')->from('products')->group_start()->where('name REGEXP', $query)->where('is_deleted',0)->group_end()->get()->result_array();
                }elseif (strpos($_GET['query'], '$') !== false) {
                    $query = trim($_GET['query']);
                    $query = str_replace('$', '', $query); // Convert % to SQL regex wildcard

                    $products = $this->db->select('products.id,products.name,products.image,products.category_id,products.code,products.price,products.is_deleted')->from('products')->group_start()->where('price', $query)->where('is_deleted',0)->limit($limit,$_GET['offset'])->order_by('category_id','ASC')->order_by('id','ASC')->group_end()->get()->result_array();
                    $productsAll = $this->db->select('products.id,products.name,products.image,products.category_id,products.code,products.price,products.is_deleted')->from('products')->group_start()->where('price', $query)->where('is_deleted',0)->group_end()->get()->result_array();
                }else{
                    if(strpos($_GET['query'], "DELETE") !== false){
                        $products = $this->db->select('products.id,products.name,products.image,products.category_id,products.code,products.price,products.is_deleted')->from('products')->group_start()->where('is_deleted',1)->order_by('category_id','ASC')->limit($limit,$_GET['offset'])->order_by('id','ASC')->group_end()->get()->result_array();
                        $productsAll = $this->db->select('products.id,products.name,products.image,products.category_id,products.code,products.price,products.is_deleted')->from('products')->group_start()->where('is_deleted',1)->group_end()->get()->result_array();
                    }else{
                        $products = $this->db->select('products.id,products.name,products.image,products.category_id,products.code,products.price,products.is_deleted')->from('products')->group_start()->where('is_deleted',0)->like('name', $_GET['query'])->limit($limit,$_GET['offset'])->order_by('category_id','ASC')->order_by('id','ASC')->group_end()->get()->result_array();
                        $productsAll = $this->db->select('products.id,products.name,products.image,products.category_id,products.code,products.price,products.is_deleted')->from('products')->group_start()->where('is_deleted',0)->like('name', $_GET['query'])->group_end()->get()->result_array();
                    }
                }
            } else {
                if (preg_match('/^[0-9\-]+$/', $_GET['query'])) {
                    $products = $this->db->select('products.id,products.name,products.image,products.category_id,products.code,products.price,products.is_deleted')->from('products')->where_in('category_id', $view_category)->group_start()->where('code', $_GET['query'])->where('is_deleted',0)->limit($limit,$_GET['offset'])->order_by('category_id','ASC')->order_by('id','ASC')->group_end()->get()->result_array();
                    $productsAll = $this->db->select('products.id,products.name,products.image,products.category_id,products.code,products.price,products.is_deleted')->from('products')->where_in('category_id', $view_category)->group_start()->where('code', $_GET['query'])->where('is_deleted',0)->group_end()->get()->result_array();
                }elseif (strpos($_GET['query'], '%') !== false) {
                    $query = trim($_GET['query']);
                    $query = str_replace('%', '.*', $query); // Convert % to SQL regex wildcard
                    $products = $this->db->select('products.id,products.name,products.image,products.category_id,products.code,products.price,products.is_deleted')->from('products')->where_in('category_id', $view_category)->group_start()->where('name REGEXP', $query)->where('is_deleted',0)->limit($limit,$_GET['offset'])->order_by('category_id','ASC')->order_by('id','ASC')->group_end()->get()->result_array();
                    $productsAll = $this->db->select('products.id,products.name,products.image,products.category_id,products.code,products.price,products.is_deleted')->from('products')->where_in('category_id', $view_category)->group_start()->where('name REGEXP', $query)->where('is_deleted',0)->group_end()->get()->result_array();
                }elseif (strpos($_GET['query'], '$') !== false) {
                    $query = trim($_GET['query']);
                    $query = str_replace('$', '', $query); // Convert % to SQL regex wildcard

                    $products = $this->db->select('products.id,products.name,products.image,products.category_id,products.code,products.price,products.is_deleted')->from('products')->where_in('category_id', $view_category)->group_start()->where('price', $query)->where('is_deleted',0)->limit($limit,$_GET['offset'])->order_by('category_id','ASC')->order_by('id','ASC')->group_end()->get()->result_array();
                    $productsAll = $this->db->select('products.id,products.name,products.image,products.category_id,products.code,products.price,products.is_deleted')->from('products')->where_in('category_id', $view_category)->group_start()->where('price', $query)->where('is_deleted',0)->group_end()->get()->result_array();
                } else {
                    if(strpos($_GET['query'], "DELETE") !== false){
                        $products = $this->db->select('products.id,products.name,products.image,products.category_id,products.code,products.price,products.is_deleted')->from('products')->where_in('category_id', $view_category)->group_start()->where('is_deleted',1)->limit($limit,$_GET['offset'])->order_by('category_id','ASC')->order_by('id','ASC')->group_end()->get()->result_array();
                        $productsAll = $this->db->select('products.id,products.name,products.image,products.category_id,products.code,products.price,products.is_deleted')->from('products')->where_in('category_id', $view_category)->group_start()->where('is_deleted',1)->group_end()->get()->result_array();
                    }else{
                        $products = $this->db->select('products.id,products.name,products.image,products.category_id,products.code,products.price,products.is_deleted')->from('products')->where_in('category_id', $view_category)->group_start()->where('is_deleted',0)->like('name', $_GET['query'])->limit($limit,$_GET['offset'])->order_by('category_id','ASC')->order_by('id','ASC')->group_end()->get()->result_array();
                        $productsAll = $this->db->select('products.id,products.name,products.image,products.category_id,products.code,products.price,products.is_deleted')->from('products')->where_in('category_id', $view_category)->group_start()->where('is_deleted',0)->like('name', $_GET['query'])->group_end()->get()->result_array();
                    }
                }
            }
        }
        
        $data['products'] = $products;
        $data['productsAll'] = $productsAll;
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function search_products_by_category($id)
    {
        $data = array();
        $limit = 20;
        if ($_GET['query'] == '') {
            $products = $this->db->select('products.id,products.name,products.image,products.code,products.price,products.is_deleted')->from('products')->where('category_id', $id)->get()->result_array();
        } else {
                if (preg_match('/^[0-9\-]+$/', $_GET['query'])) {
                    $products = $this->db->select('products.id,products.name,products.image,products.code,products.price,products.is_deleted')->from('products')->where('category_id', $id)->where('is_deleted',0)->group_start()->where('code', $_GET['query'])->limit($limit,$_GET['offset'])->group_end()->get()->result_array();
                    $productsAll = $this->db->select('products.id,products.name,products.image,products.code,products.price,products.is_deleted')->from('products')->where('category_id', $id)->where('is_deleted',0)->group_start()->where('code', $_GET['query'])->group_end()->get()->result_array();
                }elseif (strpos($_GET['query'], '%') !== false) {
                    $query = trim($_GET['query']);
                    $query = str_replace('%', '.*', $query);
                    $products = $this->db->select('products.id,products.name,products.image,products.code,products.price,products.is_deleted')->from('products')->where('category_id', $id)->where('is_deleted',0)->group_start()->where('name REGEXP', $query)->limit($limit,$_GET['offset'])->group_end()->get()->result_array();
                    $productsAll = $this->db->select('products.id,products.name,products.image,products.code,products.price,products.is_deleted')->from('products')->where('category_id', $id)->group_start()->where('name REGEXP', $query)->where('is_deleted',0)->group_end()->get()->result_array();
                }elseif (strpos($_GET['query'], '$') !== false) {
                    $query = trim($_GET['query']);
                    $query = str_replace('$', '', $query);

                    $products = $this->db->select('products.id,products.name,products.image,products.code,products.price,products.is_deleted')->from('products')->where('category_id', $id)->group_start()->where('price', $query)->where('is_deleted',0)->limit($limit,$_GET['offset'])->group_end()->get()->result_array();
                    $productsAll = $this->db->select('products.id,products.name,products.image,products.code,products.price,products.is_deleted')->from('products')->where('category_id', $id)->group_start()->where('price', $query)->where('is_deleted',0)->group_end()->get()->result_array();
                }else {
                    if(strpos($_GET['query'], "DELETE") !== false){
                        $products = $this->db->select('products.id,products.name,products.image,products.code,products.price,products.is_deleted')->from('products')->where('category_id', $id)->group_start()->where('is_deleted',1)->limit($limit,$_GET['offset'])->group_end()->get()->result_array();
                        $productsAll = $this->db->select('products.id,products.name,products.image,products.code,products.price,products.is_deleted')->from('products')->where('category_id', $id)->group_start()->where('is_deleted',1)->group_end()->get()->result_array();
                    }else{
                        $products = $this->db->select('products.id,products.name,products.image,products.code,products.price,products.is_deleted')->from('products')->where('category_id', $id)->group_start()->where('is_deleted',0)->like('name', $_GET['query'])->limit($limit,$_GET['offset'])->group_end()->get()->result_array();
                        $productsAll = $this->db->select('products.id,products.name,products.image,products.code,products.price,products.is_deleted')->from('products')->where('category_id', $id)->group_start()->where('is_deleted',0)->like('name', $_GET['query'])->group_end()->get()->result_array();
                    }
                }
        }

        
        $data['products'] = $products;
        $data['category_id'] = $id;
        $data['productsAll'] = $productsAll;
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    /*
    * VENDOSI KETO METODA BRENDA class Dashboard extends CI_Controller
    * MOS e shto <?php perseri nese po i kopjon direkt brenda controller-it ekzistues.
    */

    private function cart_access_allowed()
    {
        return in_array($this->session->userdata('role'), ['admin', 'sales']);
    }

    private function cart_json($data, $statusCode = 200)
    {
        return $this->output
            ->set_status_header($statusCode)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($data));
    }

    public function get_cart()
    {
        if (!$this->cart_access_allowed()) {
            return $this->cart_json(['status' => false, 'message' => 'Nuk keni qasje.'], 403);
        }

        $cart = $this->session->userdata('shopping_cart');
        if (!is_array($cart)) $cart = [];

        return $this->cart_json([
            'status' => true,
            'cart'   => array_values($cart)
        ]);
    }

    public function add_to_cart()
    {
        if (!$this->cart_access_allowed()) {
            return $this->cart_json(['status' => false, 'message' => 'Nuk keni qasje.'], 403);
        }

        $productId = (int) $this->input->post('product_id');
        $quantity  = (float) $this->input->post('quantity');
        $price     = (float) $this->input->post('price');

        if ($productId <= 0 || $quantity <= 0 || $price < 0) {
            return $this->cart_json(['status' => false, 'message' => 'Të dhënat nuk janë valide.'], 422);
        }

        $product = $this->db
            ->select('id, code, name, price')
            ->from('products')
            ->where('id', $productId)
            ->limit(1)
            ->get()
            ->row_array();

        if (!$product) {
            return $this->cart_json(['status' => false, 'message' => 'Produkti nuk u gjet.'], 404);
        }

        $cart = $this->session->userdata('shopping_cart');
        if (!is_array($cart)) $cart = [];

        $found = false;
        foreach ($cart as &$item) {
            if ((string) $item['id'] === (string) $productId) {
                $item['quantity'] = (float) $item['quantity'] + $quantity;
                $item['price'] = $price;
                $found = true;
                break;
            }
        }
        unset($item);

        if (!$found) {
            $cart[] = [
                'id'       => (int) $product['id'],
                'code'     => $product['code'],
                'name'     => $product['name'],
                'quantity' => $quantity,
                'price'    => $price
            ];
        }

        $cart = array_values($cart);
        $this->session->set_userdata('shopping_cart', $cart);

        return $this->cart_json(['status' => true, 'cart' => $cart]);
    }

    public function update_cart_product()
    {
        if (!$this->cart_access_allowed()) {
            return $this->cart_json(['status' => false, 'message' => 'Nuk keni qasje.'], 403);
        }

        $productId = (int) $this->input->post('product_id');
        $quantity  = (float) $this->input->post('quantity');
        $price     = (float) $this->input->post('price');

        if ($productId <= 0 || $quantity <= 0 || $price < 0) {
            return $this->cart_json(['status' => false, 'message' => 'Të dhënat nuk janë valide.'], 422);
        }

        $cart = $this->session->userdata('shopping_cart');
        if (!is_array($cart)) $cart = [];

        $found = false;
        foreach ($cart as &$item) {
            if ((string) $item['id'] === (string) $productId) {
                $item['quantity'] = $quantity;
                $item['price'] = $price;
                $found = true;
                break;
            }
        }
        unset($item);

        if (!$found) {
            return $this->cart_json(['status' => false, 'message' => 'Produkti nuk ekziston në shportë.'], 404);
        }

        $cart = array_values($cart);
        $this->session->set_userdata('shopping_cart', $cart);

        return $this->cart_json(['status' => true, 'cart' => $cart]);
    }

    public function delete_cart_product()
    {
        if (!$this->cart_access_allowed()) {
            return $this->cart_json(['status' => false, 'message' => 'Nuk keni qasje.'], 403);
        }

        $productId = (int) $this->input->post('product_id');
        if ($productId <= 0) {
            return $this->cart_json(['status' => false, 'message' => 'Produkti nuk është valid.'], 422);
        }

        $cart = $this->session->userdata('shopping_cart');
        if (!is_array($cart)) $cart = [];

        $cart = array_values(array_filter($cart, function ($item) use ($productId) {
            return (string) $item['id'] !== (string) $productId;
        }));

        $this->session->set_userdata('shopping_cart', $cart);

        return $this->cart_json(['status' => true, 'cart' => $cart]);
    }

    public function clear_cart()
    {
        if (!$this->cart_access_allowed()) {
            return $this->cart_json(['status' => false, 'message' => 'Nuk keni qasje.'], 403);
        }

        $this->session->unset_userdata('shopping_cart');

        return $this->cart_json(['status' => true, 'cart' => []]);
    }

}