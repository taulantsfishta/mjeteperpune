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

    /****************Function login**********************************
     * @type            : Function
     * @function name   : index
     * @description     : This redirect to dashboard automatically 
     *                    
     *                       
     * @param           : null 
     * @return          : null 
     * ********************************************************** */

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
        if ($this->session->userdata('role') == 'admin') {
            $lastUsedCode = $this->db->select('code')->from('products')->where('category_id', $category_id)->order_by('id', 'desc')->limit(1)->get()->row_array();
            if (isset($lastUsedCode['code']) && ($lastUsedCode['code'] != null)) {
                $code = substr($lastUsedCode['code'], strlen($category_id) + 1, strlen($lastUsedCode['code']));
                $newCode = $code + 1;
                $nextCode = $category_id . '-' . $newCode;
            } else {
                $nextCode = $category_id . '-' . '1';
            }
            if (isset($_POST['name']) && isset($_POST['price']) && isset($_FILES['product_image']['name'])) {
                $uploadImageOfNewProduct = $this->uploadImageOfNewProduct($category_id);
                if ($uploadImageOfNewProduct['status']) {
                    $data = array(
                        'name' => strtoupper($_POST['name']),
                        'category_id' => $category_id,
                        'price' => $_POST['price'],
                        'code' => $nextCode,
                        'image' => $uploadImageOfNewProduct['image'],
                        'created_at' => current_datetime()

                    );
                    $data = $this->security->xss_clean($data);
                    $newProduct = $this->common_model->insert($data, 'products');
                    if ($newProduct) {
                        $this->session->set_flashdata('msg', 'Produkti eshte ruajtur me sukses');
                        redirect(base_url() .'admin/dashboard/get_category/' . $category_id);
                    } else {
                        $this->session->set_flashdata('error_msg', 'Ka ndodhur nje gabim ne sistem');
                        redirect(base_url() . 'admin/products/add/' . $category_id);
                    }
                } else {
                    $this->session->set_flashdata('error_msg', $uploadImageOfNewProduct['message']);
                    redirect(base_url().'admin/products/add/' . $category_id);
                }
            }
            $data = array();
            $data['codeId'] = $nextCode;
            $data['category_id'] = $category_id;
            $data['page_title'] = 'Shto Produktin';
            $data['main_content'] = $this->load->view('admin/add-products', $data, TRUE);
            $this->load->view('admin/index', $data);
        } else {
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
        }
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
                redirect(base_url() . 'admin/dashboard/get_category/' . $product['category_id'].'?updated_product_id='.$_POST['id']);
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

    public function delete_product($category_id,$product_id)
    {
        if ($this->session->userdata('role') == 'admin') {
            // $product = $this->db->select('products.image')->from('products')->where('id', $product_id)->get()->row_array();
            $data = array('is_deleted' => 1);
            $data = $this->security->xss_clean($data);
            $this->common_model->edit_option($data, $product_id, 'products');
            // unlink('optimum/products_images/' . $product['image']);
            // $this->common_model->delete($product_id, 'products');
            redirect(base_url(). 'admin/dashboard/get_category' . '/' . $category_id);
        } else {
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
        }
    }

    public function un_delete_product($category_id,$product_id)
    {
        if ($this->session->userdata('role') == 'admin') {
            // $product = $this->db->select('products.image')->from('products')->where('id', $product_id)->get()->row_array();
            $data = array('is_deleted' => 0);
            $data = $this->security->xss_clean($data);
            $this->common_model->edit_option($data, $product_id, 'products');
            // unlink('optimum/products_images/' . $product['image']);
            // $this->common_model->delete($product_id, 'products');
            redirect(base_url(). 'admin/dashboard/get_category' . '/' . $category_id);
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
}
