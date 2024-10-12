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
            $products = $this->db->select('products.id,products.name,products.image,products.code,products.price')->from('products')->limit(10)->order_by('RAND()')->get()->result_array();
            $categories =$this->db->select()->from('category')->get()->result_array();
        } else {
            $products = $this->db->select('products.id,products.name,products.image,products.code,products.price')->from('products')->where_in('category_id', $view_category)->limit(10)->order_by('RAND()')->get()->result_array();
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
        if(in_array($id, $this->session->userdata('view_category')) || (in_array(0, $this->session->userdata('view_category')))){
            // if(){

            // }
            $products = $this->db->select('products.id,products.name,products.image,products.code,products.price')->from('products')->where('category_id', $id)->get()->result_array();
            $category = $this->db->select()->from('category')->where('id', $id)->get()->row_array();
            $_SESSION['title_name'] = $category['name'];
            $data['products'] = $products;
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
    }

    public function search_products()
    {
        $data = array();
        $view_category = $this->session->userdata('view_category');
        if($_GET['query'] == ''){
            if ($view_category[0] == 0) {
                $products = $this->db->select('products.id,products.name,products.image,products.code,products.price')->from('products')->order_by('RAND()')->limit(10)->get()->result_array();
            } else {
                $products = $this->db->select('products.id,products.name,products.image,products.code,products.price')->from('products')->where_in('category_id', $view_category)->order_by('RAND()')->limit(10)->get()->result_array();
            }
        }else{
            if ($view_category[0] == 0) {
                if (preg_match('/^[0-9\-]+$/', $_GET['query'])) {
                    $products = $this->db->select('products.id,products.name,products.image,products.code,products.price')->from('products')->group_start()->where('code', $_GET['query'])->group_end()->get()->result_array();
                }else{
                    $products = $this->db->select('products.id,products.name,products.image,products.code,products.price')->from('products')->group_start()->like('name', $_GET['query'])->group_end()->get()->result_array();
                }
            } else {
                if (preg_match('/^[0-9\-]+$/', $_GET['query'])) {
                    $products = $this->db->select('products.id,products.name,products.image,products.code,products.price')->from('products')->where_in('category_id', $view_category)->group_start()->where('code', $_GET['query'])->group_end()->get()->result_array();
                } else {
                    $products = $this->db->select('products.id,products.name,products.image,products.code,products.price')->from('products')->where_in('category_id', $view_category)->group_start()->like('name', $_GET['query'])->group_end()->get()->result_array();
                }
            }
        }
        $data['products'] = $products;
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function search_products_by_category($id)
    {
        $data = array();
        if ($_GET['query'] == '') {
            $products = $this->db->select('products.id,products.name,products.image,products.code,products.price')->from('products')->where('category_id', $id)->get()->result_array();
        } else {
                if (preg_match('/^[0-9\-]+$/', $_GET['query'])) {
                    $products = $this->db->select('products.id,products.name,products.image,products.code,products.price')->from('products')->where('category_id', $id)->group_start()->where('code', $_GET['query'])->group_end()->get()->result_array();
                } else {
                    $products = $this->db->select('products.id,products.name,products.image,products.code,products.price')->from('products')->where('category_id', $id)->group_start()->like('name', $_GET['query'])->group_end()->get()->result_array();
                }
        }
        $data['products'] = $products;
        $data['category_id'] = $id;
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}