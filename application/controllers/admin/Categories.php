<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


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

class Categories extends CI_Controller
{

    public function __construct()
    {
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

    public function index()
    {
        if ($this->session->userdata('role') == 'admin') {
            $data = array();
            $category = $this->db->select()->from('category')->get()->result_array();
            $_SESSION['title_name'] = 'KATEGORIT';
            $data['category'] = $category;
            $data['page_title'] = 'Lista e kategorive';
            $data['main_content'] = $this->load->view('admin/category', $data, TRUE);
            $this->load->view('admin/index', $data);
        } else {
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
        }
    }

    public function add(){
        if ($this->session->userdata('role') == 'admin') {
            if (isset($_POST['name'])) {
                $lastIdOfCategory = $this->db->select('id')->from('category')->order_by('id', 'desc')->limit(1)->get()->row_array();
                $data = array(
                    'id' => $lastIdOfCategory['id']+1,
                    'name' => strtoupper($_POST['name']),
                    'created_at' => current_datetime()
                );
                $data = $this->security->xss_clean($data);
                $newProduct = $this->common_model->insert($data, 'category');
                if ($newProduct) {
                    $categories = $this->db->select()->from('category')->get()->result_array();
                    $_SESSION['category'] = $categories;
                    $this->session->set_flashdata('msg', 'Kategoria eshte ruajtur me sukses');
                } else {
                    $this->session->set_flashdata('error_msg', 'Ka ndodhur nje gabim ne sistem');
                }
                redirect(base_url(). 'admin/categories/add/');
            }
            $data['page_title'] = 'Shto Kategorin';
            $data['main_content'] = $this->load->view('admin/add-category', $data, TRUE);
            $this->load->view('admin/index', $data);
        } else {
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
        }
    }

    public function edit_category($category_id){
        if ($this->session->userdata('role') == 'admin') {
            if (isset($_POST['name'])) {
                $data = array('name' => strtoupper($_POST['name']));
                $data = $this->security->xss_clean($data);
                $this->common_model->edit_option($data, $_POST['id'], 'category');
                $this->session->set_flashdata('msg', 'Kategoria eshte ndryshuar me sukses');
                $categories = $this->db->select()->from('category')->get()->result_array();
                $_SESSION['category'] = $categories;
                redirect(base_url(). 'admin/categories/edit_category/' . $category_id);
            }
            $data = array();
            $category = $this->db->select()->from('category')->where('id', $category_id)->get()->row_array();
            $data['category'] = $category;
            $data['page_title'] = 'Ndrysho Kategorin';
            $data['main_content'] = $this->load->view('admin/edit-category', $data, TRUE);
            $this->load->view('admin/index', $data);
        } else {
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
        }
    }

    public function delete_category($category_id)
    {
        if ($this->session->userdata('role') == 'admin') {
            $this->common_model->delete($category_id, 'category');
            $categories = $this->db->select()->from('category')->get()->result_array();
            $_SESSION['category'] = $categories;
            redirect(base_url(). 'admin/categories');
        } else {
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
        }
    }
}
