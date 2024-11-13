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

//LOCATION : application - controller - Auth.php

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->library('user_agent');
    }


    public function index()
    {
        $data = array();
        $data['page'] = 'Auth';
        $this->load->view('admin/login', $data);
    }



    /****************Function login**********************************
     * @type            : Function
     * @function name   : log
     * @description     : Authenticatte when uset try lo login. 
     *                    if autheticated redirected to logged in user dashboard.
     *                    Also set some session date for logged in user.   
     * @param           : null 
     * @return          : null 
     * ********************************************************** */
    public function log()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {  // Check if the request is POST
            $query = $this->login_model->validate_user();

            if ($query) {
                $data = array();
                foreach ($query as $row) {
                    $data = array(
                        'id' => $row->id,
                        'name' => $row->first_name,
                        'role' => $row->role,
                        'view_category' => json_decode($row->view_category, 1),
                        'price_status' => $row->price_status,
                        'is_login' => TRUE,
                        'category' => '',
                        'title_name' => 'TË GJITHA PRODUKTET',
                    );

                    // Set the session data
                    $this->session->set_userdata($data);

                    if ($this->agent->is_browser()) {
                        $agent = $this->agent->browser() . ' ' . $this->agent->version();
                    } elseif ($this->agent->is_robot()) {
                        $agent = $this->agent->robot();
                    } elseif ($this->agent->is_mobile()) {
                        $agent = $this->agent->mobile();
                    } else {
                        $agent = 'Unidentified User Agent';
                    }

                    $login_history = [
                        'username' => $row->first_name,
                        'device_type' => $this->agent->platform() . '  ' . $agent,
                        'created_at' => current_datetime()
                    ];
                    $this->login_model->insert($login_history, 'login_history');
                }

                // Redirect to dashboard on successful login (PRG pattern)
                redirect(base_url() . 'admin/dashboard');
            } else {
                    $this->session->set_flashdata('login_error', 'TE DHENAT NUK JANE TE SAKTA!');
                    redirect(base_url('auth'));
            }
        } else {
            // Ensure session timeout redirects to login
            if (!$this->session->userdata('is_login')) {
                redirect(base_url('auth'));
            }
        }
    }  
   


    /*     * ***************Function logout**********************************
     * @type            : Function
     * @function name   : logout
     * @description     : Log Out the logged in user and redirected to Login page  
     * @param           : null 
     * @return          : null 
     * ********************************************************** */

    function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('auth'), 'refresh');
    }
}
