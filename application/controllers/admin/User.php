<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_login_user();
        $this->load->model('common_model');
        $this->load->model('login_model');
    }


    public function index()
    {
        if ($this->session->userdata('role') == 'admin') {
        $data = array();
        $_SESSION['title_name'] = 'PËRDORUES I RI';
        $data['page_title'] = 'Perdoruesi';
        $data['power'] = $this->common_model->get_all_power('user_power');
        $data['category'] = $this->common_model->get_all_category('category');
        $data['main_content'] = $this->load->view('admin/user/add', $data, TRUE);
        $this->load->view('admin/index', $data);
        }else{
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
        }
    }

    //-- add new user by admin
    public function add()
    {
        if ($this->session->userdata('role') == 'admin') {
            if ($_POST) {
                if ((!empty($_POST['role'])) && (!empty($_POST['first_name'])) && (!empty($_POST['password']))) {
                    $priceStatus = 1;
                    if ($_POST['role'] == 'user') {
                        if ((empty($_POST['role_action']))) {
                            $this->session->set_flashdata('error_msg', 'Ploteso te gjitha te dhenat');
                            redirect(base_url('admin/user'));
                        }
                        $priceStatus = isset($_POST['price_status']) ? 1 : 0;
                    }
                    //-- check duplicate username
                    $username = $this->common_model->check_username($_POST['first_name']);

                    if (empty($username)) {
                        $data = array(
                            'first_name' => $_POST['first_name'],
                            'password' => $this->safe_b64encode($_POST['password']),
                            'view_category' => $_POST['role'] == 'admin' ? json_encode(["0"]) : json_encode($_POST['role_action']),
                            'status' => 1,
                            'price_status' => $priceStatus,
                            'role' => $_POST['role'],
                            'created_at' => current_datetime()
                        );

                        $data = $this->security->xss_clean($data);
                        $user_id = $this->common_model->insert($data, 'user');

                        $this->session->set_flashdata('msg', 'User added Successfully');
                        redirect(base_url('admin/user/all_user_list'));
                    } else {
                        $this->session->set_flashdata('error_msg', 'Emri i perdoruesit egziston, provo tjeter emer');
                        redirect(base_url('admin/user'));
                    }
                } else {
                    $this->session->set_flashdata('error_msg', 'Ploteso te gjitha te dhenat');
                    redirect(base_url('admin/user'));
                }
            } else {
                $this->session->set_flashdata('error_msg', 'Te dhenat mungojne');
                redirect(base_url('admin/user'));
            }
        }else{
                $data = array();
                $data['heading'] = 'Mesazhi';
                $data['message'] = "Nuk keni qasje ne kete faqe";
                $this->load->view('errors/html/error_404', $data);
            }
    }

    public function all_user_list()
    {
        if ($this->session->userdata('role') == 'admin') {
        $_SESSION['title_name'] = 'LISTA E TË GJITHË PËRDORUESVE';
        $data['page_title'] = 'Te gjithe perdoruesit e regjistruar';
        $data['users'] = $this->common_model->get_all_user();
        $data['count'] = $this->common_model->get_user_total();
        $data['main_content'] = $this->load->view('admin/user/users', $data, TRUE);
        $this->load->view('admin/index', $data);
        }else{
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
        }
    }

    //-- update users info
    public function update($id)
    {
        if ($this->session->userdata('role') == 'admin') {
            if ($_POST) {
                $priceStatus = 1;
                if ($_POST['role'] == 'user') {
                    if ((empty($_POST['role_action']))) {
                        $this->session->set_flashdata('error_msg', 'Ploteso te gjitha te dhenat');
                        redirect(base_url('admin/user'));
                    }
                    $priceStatus = isset($_POST['price_status']) ? 1 : 0;
                }
                //-- check duplicate username

                $data = array(
                    'password' => $this->safe_b64encode($_POST['password']),
                    'view_category' => $_POST['role'] == 'admin' ? json_encode(["0"]) : json_encode($_POST['role_action']),
                    'price_status' => $priceStatus,
                    'role' => $_POST['role'],
                    'created_at' => current_datetime()
                );

                $data = $this->security->xss_clean($data);

                $this->common_model->edit_option($data, $id, 'user');
                $this->session->set_flashdata('msg', 'Information Updated Successfully');
                redirect(base_url('admin/user/all_user_list'));
        }

            $data['user'] = $this->common_model->get_single_user_info($id);
            $data['user']->password = $this->safe_b64decode($data['user']->password);
            $data['view_category'] = json_decode($data['user']->view_category, 1);
            $data['user_role'] = $this->common_model->get_user_role($id);
            $data['power'] = $this->common_model->select('user_power');
            $data['category'] = $this->common_model->get_all_category('category');
            // $data['country'] = $this->common_model->select('country');
            $data['main_content'] = $this->load->view('admin/user/edit_user', $data, TRUE);
            $data['page_title'] = 'Ndrysho informatat';
            $this->load->view('admin/index', $data);
        } else {
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
        }
    }


    //-- active user
    public function active($id)
    {
        $data = array(
            'status' => 1
        );
        $data = $this->security->xss_clean($data);
        $this->common_model->update($data, $id, 'user');
        $this->session->set_flashdata('msg', 'User active Successfully');
        redirect(base_url('admin/user/all_user_list'));
    }

    //-- deactive user
    public function deactive($id)
    {
        $data = array(
            'status' => 0
        );
        $data = $this->security->xss_clean($data);
        $this->common_model->update($data, $id, 'user');
        $this->session->set_flashdata('msg', 'User deactive Successfully');
        redirect(base_url('admin/user/all_user_list'));
    }

    //-- delete user
    public function delete($id)
    {
        $this->common_model->delete($id, 'user');
        $this->session->set_flashdata('msg', 'User deleted Successfully');
        redirect(base_url('admin/user/all_user_list'));
    }


    public function power()
    {
        $data['page_title'] = 'Cakto rolin e userit';
        $data['powers'] = $this->common_model->get_all_power('user_power');
        $data['main_content'] = $this->load->view('admin/user/user_power', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    //-- add user power
    public function add_power()
    {
        if (isset($_POST)) {
            $data = array(
                'name' => $_POST['name'],
                'power_id' => $_POST['power_id']
            );
            $data = $this->security->xss_clean($data);

            //-- check duplicate power id
            $power = $this->common_model->check_exist_power($_POST['power_id']);
            if (empty($power)) {
                $user_id = $this->common_model->insert($data, 'user_power');
                $this->session->set_flashdata('msg', 'Power added Successfully');
            } else {
                $this->session->set_flashdata('error_msg', 'Power id already exist, try another one');
            }
            redirect(base_url('admin/user/power'));
        }
    }

    //--update user power
    public function update_power()
    {
        if (isset($_POST)) {
            $data = array(
                'name' => $_POST['name']
            );
            $data = $this->security->xss_clean($data);

            $this->session->set_flashdata('msg', 'Power updated Successfully');
            $user_id = $this->common_model->edit_option($data, $_POST['id'], 'user_power');
            redirect(base_url('admin/user/power'));
        }
    }

    public function delete_power($id)
    {
        $this->common_model->delete($id, 'user_power');
        $this->session->set_flashdata('msg', 'Power deleted Successfully');
        redirect(base_url('admin/user/power'));
    }

    public  function safe_b64encode($string)
    {
        $data = base64_encode($string);
        $data = str_replace(array('+', '/', '='), array('-', '_', ''), $data);
        return $data;
    }

    public function safe_b64decode($string)
    {
        $data = str_replace(array('-', '_'), array('+', '/'), $string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }

    public function login_history(){
        if ($this->session->userdata('role') == 'admin') {
        $data = array();
        $_SESSION['title_name'] = "HISTORIKU I PËRDORUESVE";
        $data['page_title'] = 'Historiku I Perdoruesve';
        $data['login_history'] = $this->db->select()->from('login_history')->order_by('id','DESC')->get()->result_array();
        $data['main_content'] = $this->load->view('admin/login-history', $data, TRUE);
        $this->load->view('admin/index', $data);
        }else{
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
        }

    }
}
