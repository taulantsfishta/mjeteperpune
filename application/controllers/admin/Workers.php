<?php

use GPBMetadata\Google\Type\Datetime;

 if (!defined('BASEPATH')) exit('No direct script access allowed');

class Workers extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_login_user();
        $this->load->model('common_model');
        $this->load->model('login_model');
        $this->load->model('worker_salary_model');
    }


    public function index()
    {
        if ($this->session->userdata('role') == 'admin') {
            $data = array();
            $_SESSION['title_name'] = 'LISTA E PUNËTORËVE';
            $data['page_title'] = 'Punëtorët';
            $workers = $this->db->select()->from('workers')->order_by('id','DESC')->get()->result_array();
            $current_month = (int) date('m');
            $current_year  = (int) date('Y');

            foreach ($workers as &$worker) {

                $salary_data = $this->worker_salary_model
                    ->refresh_worker_month_details(
                        $worker['id'],
                        $current_month,
                        $current_year
                    );

                if ($salary_data && isset($salary_data['salary_summary'])) {

                    $worker['final_salary_for_month'] =
                        $salary_data['salary_summary']['remaining_salary'];

                } else {

                    $worker['final_salary_for_month'] =
                        $worker['base_salary'];
                }
            }
            $data['workers']= $workers;
            $data['main_content'] = $this->load->view('admin/workers', $data, TRUE);
            $this->load->view('admin/index', $data);
        }else{
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
        }
    }

    public function add_worker()
    {
        if ($this->session->userdata('role') == 'admin') {
            if ($_POST) {
                if ( (!empty($_POST['worker_name'])) && (!empty($_POST['base_salary']))) {
                    $data = array(
                        'workers_name' => $this->input->post('worker_name'),
                        'base_salary' => $this->input->post('base_salary'),
                        'created_at' => current_datetime(),
                        'updated_at' => current_datetime()
                    );
                    $data = $this->security->xss_clean($data);
                    $result = $this->db->insert('workers', $data);
                    if ($result) {
                        $this->session->set_flashdata('success_msg', 'Punëtori u shtua me sukses');
                        redirect(base_url('admin/workers/worker_detail/' . $this->db->insert_id()));
                    } else {
                        $this->session->set_flashdata('error_msg', 'Ka ndodhur një gabim gjatë shtimit të punëtorit');
                        redirect(base_url('admin/workers/add_worker'));
                    }
                } else {
                    $this->session->set_flashdata('error_msg', 'Ploteso te gjitha te dhenat');
                    redirect(base_url('admin/workers/add_worker'));
                }
                
            }else {
                $data = array();
                $_SESSION['title_name'] = 'SHTO PUNËTORIN';
                $data['page_title'] = 'Shto Punëtorin';
                $data['main_content'] = $this->load->view('admin/add-worker', $data, TRUE);
                $this->load->view('admin/index', $data);
            } 
        }else{
                $data = array();
                $data['heading'] = 'Mesazhi';
                $data['message'] = "Nuk keni qasje ne kete faqe";
                $this->load->view('errors/html/error_404', $data);
            }
    }

    public function edit_worker($id)
    {
        if ($this->session->userdata('role') == 'admin') {
            $worker =  $this->db->select()->from('workers')->where('id', $id)->get()->row_array();

            if ($_POST) {
                if ( (!empty($_POST['worker_name'])) && (!empty($_POST['base_salary']))) {
                    $data = array(
                        'workers_name' => $this->input->post('worker_name'),
                        'base_salary' => $this->input->post('base_salary'),
                        'updated_at' => current_datetime()
                    );
                    $data = $this->security->xss_clean($data);
                    $this->db->where('id', $id);
                    $result = $this->db->update('workers', $data);
                    if ($result) {
                        $this->session->set_flashdata('success_msg', 'Punëtori u përditësua me sukses');
                        redirect(base_url('admin/workers/worker_detail/' . $id));
                    } else {
                        $this->session->set_flashdata('error_msg', 'Ka ndodhur një gabim gjatë përditësimit të punëtorit');
                        redirect(base_url('admin/workers/edit_worker/' . $id));
                    }
                } else {
                    $this->session->set_flashdata('error_msg', 'Ploteso te gjitha te dhenat');
                    redirect(base_url('admin/workers/edit_worker/' . $id));
                }
            }else{
                $data = array();
                $_SESSION['title_name'] = 'PËRDITËSO PUNËTORIN';
                $data['page_title'] = 'Përditëso Punëtorin';
                $data['worker'] = $worker;
                $data['main_content'] = $this->load->view('admin/edit-worker', $data, TRUE);
                $this->load->view('admin/index', $data);
            }
        }else{
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
        }
    }

    public function delete_worker($id)
    {
        if ($this->session->userdata('role') == 'admin') {
            $this->db->where('id', $id);
            $result = $this->db->delete('workers');
            if ($result) {
                $this->session->set_flashdata('success_msg', 'Punëtori u fshi me sukses');
                redirect(base_url('admin/workers'));
            } else {
                $this->session->set_flashdata('error_msg', 'Ka ndodhur një gabim gjatë fshirjes së punëtorit');
                redirect(base_url('admin/workers'));
            }
        }else{
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
        }
    }

    public function worker_detail($id)
    {
        if ($this->session->userdata('role') != 'admin') {
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
            return;
        }

        $selected_month = (int) $this->input->get('month');
        $selected_year  = (int) $this->input->get('year');

        log_message('error', "Selected month: $selected_month, Selected year: $selected_year");
        if (empty($selected_month) || $selected_month < 1 || $selected_month > 12) {
            $selected_month = (int) date('m');
        }

        if (empty($selected_year) || $selected_year < 2000 || $selected_year > 2100) {
            $selected_year = (int) date('Y');
        }

        $worker_details = $this->worker_salary_model->refresh_worker_month_details($id, $selected_month, $selected_year);

        if (!$worker_details) {
            $this->session->set_flashdata('error_msg', 'Punëtori nuk u gjet');
            redirect(base_url('admin/workers'));
            return;
        }

        $data = array();
        $_SESSION['title_name'] = 'DETAJET E PUNËTORIT';
        $data['page_title'] = 'Detajet e Punëtorit';

        $data['worker'] = $worker_details['worker'];
        $data['salary_month_row'] = $worker_details['salary_month_row'];
        $data['salary_summary'] = $worker_details['salary_summary'];
        $data['absences'] = $worker_details['absences'];
        $data['loans'] = $worker_details['loans'];
        $data['payments'] = $worker_details['payments'];

        $data['installment_loans'] = $worker_details['installment_loans'];
        $data['monthly_loans_total'] = $worker_details['monthly_loans_total'];
        $data['total_installment_loans'] = $worker_details['total_installment_loans'];

        $data['selected_month'] = $selected_month;
        $data['selected_year'] = $selected_year;

        $data['main_content'] = $this->load->view('admin/worker-details', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function add_loan($worker_id)
    {
        if ($this->session->userdata('role') != 'admin') {
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
            return;
        }

        $worker = $this->worker_salary_model->get_worker($worker_id);

        $selected_month = (int) $this->input->get('month');
        $selected_year  = (int) $this->input->get('year');

        if ($_POST) {
            $selected_month = (int) $this->input->post('salary_month');
            $selected_year  = (int) $this->input->post('salary_year');
        }

        if (empty($selected_month) || $selected_month < 1 || $selected_month > 12) {
            $selected_month = (int) date('m');
        }

        if (empty($selected_year) || $selected_year < 2000 || $selected_year > 2100) {
            $selected_year = (int) date('Y');
        }

        $salary_month_row = $this->worker_salary_model->get_or_create_salary_month($worker_id, $selected_month, $selected_year);

        if ($salary_month_row && $salary_month_row['status'] == 'closed') {
            $this->session->set_flashdata('error_msg', 'Muaji është i mbyllur. Hapeni muajin për të bërë ndryshime.');
            redirect(base_url('admin/workers/worker_detail/' . $worker_id . '?month=' . $selected_month . '&year=' . $selected_year));
            return;
        }

        if (!$worker) {
            $this->session->set_flashdata('error_msg', 'Punëtori nuk u gjet');
            redirect(base_url('admin/workers'));
            return;
        }

        if ($_POST) {
            $salary_month = (int) $this->input->post('salary_month');
            $salary_year  = (int) $this->input->post('salary_year');
            $amount       = trim($this->input->post('amount'));
            $note         = trim($this->input->post('note'));

            if (empty($salary_month) || $salary_month < 1 || $salary_month > 12) {
                $salary_month = (int) date('m');
            }

            if (empty($salary_year) || $salary_year < 2000 || $salary_year > 2100) {
                $salary_year = (int) date('Y');
            }

            if ($amount === '' || !is_numeric($amount) || (float)$amount <= 0) {
                $this->session->set_flashdata('error_msg', 'Shuma e huazimit duhet të jetë më e madhe se 0');
                redirect(base_url('admin/workers/add_loan/' . $worker_id . '?month=' . $salary_month . '&year=' . $salary_year));
                return;
            }

            $result = $this->worker_salary_model->add_loan(
                $worker_id,
                $salary_month,
                $salary_year,
                $amount,
                $note
            );

            if ($result) {
                $this->session->set_flashdata('success_msg', 'Huazimi u shtua me sukses');
            } else {
                $this->session->set_flashdata('error_msg', 'Ka ndodhur një gabim gjatë ruajtjes së huazimit');
            }

            redirect(base_url('admin/workers/worker_detail/' . $worker_id . '?month=' . $salary_month . '&year=' . $salary_year));
            return;
        }

        $selected_month = (int) $this->input->get('month');
        $selected_year  = (int) $this->input->get('year');

        if (empty($selected_month) || $selected_month < 1 || $selected_month > 12) {
            $selected_month = (int) date('m');
        }

        if (empty($selected_year) || $selected_year < 2000 || $selected_year > 2100) {
            $selected_year = (int) date('Y');
        }

        $data = array();
        $_SESSION['title_name'] = 'SHTO HUAZIM';
        $data['page_title'] = 'Shto Huazim';
        $data['worker'] = $worker;
        $data['selected_month'] = $selected_month;
        $data['selected_year'] = $selected_year;

        $data['main_content'] = $this->load->view('admin/add-loan', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function add_payment($worker_id)
    {
        if ($this->session->userdata('role') != 'admin') {
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
            return;
        }

        $worker = $this->worker_salary_model->get_worker($worker_id);

        $selected_month = (int) $this->input->get('month');
        $selected_year  = (int) $this->input->get('year');

        if ($_POST) {
            $selected_month = (int) $this->input->post('salary_month');
            $selected_year  = (int) $this->input->post('salary_year');
        }

        if (empty($selected_month) || $selected_month < 1 || $selected_month > 12) {
            $selected_month = (int) date('m');
        }

        if (empty($selected_year) || $selected_year < 2000 || $selected_year > 2100) {
            $selected_year = (int) date('Y');
        }

        $salary_month_row = $this->worker_salary_model->get_or_create_salary_month($worker_id, $selected_month, $selected_year);

        if ($salary_month_row && $salary_month_row['status'] == 'closed') {
            $this->session->set_flashdata('error_msg', 'Muaji është i mbyllur. Hapeni muajin për të bërë ndryshime.');
            redirect(base_url('admin/workers/worker_detail/' . $worker_id . '?month=' . $selected_month . '&year=' . $selected_year));
            return;
        }

        if (!$worker) {
            $this->session->set_flashdata('error_msg', 'Punëtori nuk u gjet');
            redirect(base_url('admin/workers'));
            return;
        }

        if ($_POST) {
            $salary_month = (int) $this->input->post('salary_month');
            $salary_year  = (int) $this->input->post('salary_year');
            $amount       = trim($this->input->post('amount'));
            $created_at = trim($this->input->post('created_at'));
            $note         = trim($this->input->post('note'));

            if (empty($salary_month) || $salary_month < 1 || $salary_month > 12) {
                $salary_month = (int) date('m');
            }

            if (empty($salary_year) || $salary_year < 2000 || $salary_year > 2100) {
                $salary_year = (int) date('Y');
            }

            if ($amount === '' || !is_numeric($amount) || (float)$amount <= 0) {
                $this->session->set_flashdata('error_msg', 'Shuma e pagesës duhet të jetë më e madhe se 0');
                redirect(base_url('admin/workers/add_payment/' . $worker_id . '?month=' . $salary_month . '&year=' . $salary_year));
                return;
            }

            if (empty($created_at)) {
                $this->session->set_flashdata('error_msg', 'Data e pagesës është e detyrueshme');
                redirect(base_url('admin/workers/add_payment/' . $worker_id . '?month=' . $salary_month . '&year=' . $salary_year));
                return;
            }

            $result = $this->worker_salary_model->add_payment(
                $worker_id,
                $salary_month,
                $salary_year,
                $amount,
                $created_at,
                $note
            );

            if ($result) {
                $this->session->set_flashdata('success_msg', 'Pagesa u shtua me sukses');
            } else {
                $this->session->set_flashdata('error_msg', 'Ka ndodhur një gabim gjatë ruajtjes së pagesës');
            }

            redirect(base_url('admin/workers/worker_detail/' . $worker_id . '?month=' . $salary_month . '&year=' . $salary_year));
            return;
        }

        $selected_month = (int) $this->input->get('month');
        $selected_year  = (int) $this->input->get('year');

        if (empty($selected_month) || $selected_month < 1 || $selected_month > 12) {
            $selected_month = (int) date('m');
        }

        if (empty($selected_year) || $selected_year < 2000 || $selected_year > 2100) {
            $selected_year = (int) date('Y');
        }

        $data = array();
        $_SESSION['title_name'] = 'SHTO PAGESË';
        $data['page_title'] = 'Shto Pagesë';
        $data['worker'] = $worker;
        $data['selected_month'] = $selected_month;
        $data['selected_year'] = $selected_year;

        $data['main_content'] = $this->load->view('admin/add-payment', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function add_installment_loan($worker_id)
    {
        if ($this->session->userdata('role') != 'admin') {
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
            return;
        }

        $worker = $this->worker_salary_model->get_worker($worker_id);

        $selected_month = (int) $this->input->get('month');
        $selected_year  = (int) $this->input->get('year');

        if ($_POST) {
            $selected_month = (int) $this->input->post('salary_month');
            $selected_year  = (int) $this->input->post('salary_year');
        }

        if (empty($selected_month) || $selected_month < 1 || $selected_month > 12) {
            $selected_month = (int) date('m');
        }

        if (empty($selected_year) || $selected_year < 2000 || $selected_year > 2100) {
            $selected_year = (int) date('Y');
        }

        $salary_month_row = $this->worker_salary_model->get_or_create_salary_month($worker_id, $selected_month, $selected_year);

        if ($salary_month_row && $salary_month_row['status'] == 'closed') {
            $this->session->set_flashdata('error_msg', 'Muaji është i mbyllur. Hapeni muajin për të bërë ndryshime.');
            redirect(base_url('admin/workers/worker_detail/' . $worker_id . '?month=' . $selected_month . '&year=' . $selected_year));
            return;
        }

        if (!$worker) {
            $this->session->set_flashdata('error_msg', 'Punëtori nuk u gjet');
            redirect(base_url('admin/workers'));
            return;
        }

        if ($_POST) {
            $total_amount   = trim($this->input->post('total_amount'));
            $monthly_amount = trim($this->input->post('monthly_amount'));
            $start_month    = (int) $this->input->post('start_month');
            $start_year     = (int) $this->input->post('start_year');
            $note           = trim($this->input->post('note'));

            if ($total_amount === '' || !is_numeric($total_amount) || (float)$total_amount <= 0) {
                $this->session->set_flashdata('error_msg', 'Shuma totale duhet të jetë më e madhe se 0');
                redirect(base_url('admin/workers/add_installment_loan/' . $worker_id));
                return;
            }

            if ($monthly_amount === '' || !is_numeric($monthly_amount) || (float)$monthly_amount <= 0) {
                $this->session->set_flashdata('error_msg', 'Kësti mujor duhet të jetë më i madh se 0');
                redirect(base_url('admin/workers/add_installment_loan/' . $worker_id));
                return;
            }

            if (empty($start_month) || $start_month < 1 || $start_month > 12) {
                $start_month = (int) date('m');
            }

            if (empty($start_year) || $start_year < 2000 || $start_year > 2100) {
                $start_year = (int) date('Y');
            }

            $result = $this->worker_salary_model->add_installment_loan(
                $worker_id,
                $total_amount,
                $monthly_amount,
                $start_month,
                $start_year,
                $note
            );

            if ($result) {
                $this->session->set_flashdata('success_msg', 'Huazimi me këste u shtua me sukses');
            } else {
                $this->session->set_flashdata('error_msg', 'Ka ndodhur një gabim gjatë ruajtjes së huazimit me këste');
            }

            redirect(base_url('admin/workers/worker_detail/' . $worker_id . '?month=' . $start_month . '&year=' . $start_year));
            return;
        }

        $selected_month = (int) $this->input->get('month');
        $selected_year  = (int) $this->input->get('year');

        if (empty($selected_month) || $selected_month < 1 || $selected_month > 12) {
            $selected_month = (int) date('m');
        }

        if (empty($selected_year) || $selected_year < 2000 || $selected_year > 2100) {
            $selected_year = (int) date('Y');
        }

        $data = array();
        $_SESSION['title_name'] = 'SHTO HUAZIM ME KËSTE';
        $data['page_title'] = 'Shto Huazim me Këste';
        $data['worker'] = $worker;
        $data['selected_month'] = $selected_month;
        $data['selected_year'] = $selected_year;

        $data['main_content'] = $this->load->view('admin/add-installment-loan', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function close_month($worker_id)
    {
        if ($this->session->userdata('role') != 'admin') {
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
            return;
        }

        $month = (int) $this->input->get('month');
        $year  = (int) $this->input->get('year');

        if (empty($month) || $month < 1 || $month > 12) {
            $month = (int) date('m');
        }

        if (empty($year) || $year < 2000 || $year > 2100) {
            $year = (int) date('Y');
        }

        $salary_month_row = $this->worker_salary_model->get_salary_month_row($worker_id, $month, $year);

        if (!$salary_month_row) {
            // krijoje muajin nëse s’ekziston ende
            $salary_month_row = $this->worker_salary_model->get_or_create_salary_month($worker_id, $month, $year);
        }

        if (!$salary_month_row) {
            $this->session->set_flashdata('error_msg', 'Muaji nuk u gjet');
            redirect(base_url('admin/workers'));
            return;
        }

        if ($salary_month_row['status'] == 'closed') {
            $this->session->set_flashdata('error_msg', 'Muaji është tashmë i mbyllur');
            redirect(base_url('admin/workers/worker_detail/' . $worker_id . '?month=' . $month . '&year=' . $year));
            return;
        }

        // rifresko llogaritjen para mbylljes
        $worker_details = $this->worker_salary_model->refresh_worker_month_details($worker_id, $month, $year);

        if (!$worker_details) {
            $this->session->set_flashdata('error_msg', 'Ka ndodhur një gabim gjatë rifreskimit të muajit');
            redirect(base_url('admin/workers/worker_detail/' . $worker_id . '?month=' . $month . '&year=' . $year));
            return;
        }

        $result = $this->worker_salary_model->close_salary_month($worker_id, $month, $year);

        if ($result) {
            $this->session->set_flashdata('success_msg', 'Muaji u mbyll me sukses');
        } else {
            $this->session->set_flashdata('error_msg', 'Ka ndodhur një gabim gjatë mbylljes së muajit');
        }

        redirect(base_url('admin/workers/worker_detail/' . $worker_id . '?month=' . $month . '&year=' . $year));
    }

    public function reopen_month($worker_id)
    {
        if ($this->session->userdata('role') != 'admin') {
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
            return;
        }

        $month = (int) $this->input->get('month');
        $year  = (int) $this->input->get('year');

        if (empty($month) || $month < 1 || $month > 12) {
            $month = (int) date('m');
        }

        if (empty($year) || $year < 2000 || $year > 2100) {
            $year = (int) date('Y');
        }

        $salary_month_row = $this->worker_salary_model->get_salary_month_row($worker_id, $month, $year);

        if (!$salary_month_row) {
            $this->session->set_flashdata('error_msg', 'Muaji nuk u gjet');
            redirect(base_url('admin/workers'));
            return;
        }

        if ($salary_month_row['status'] == 'open') {
            $this->session->set_flashdata('error_msg', 'Muaji është tashmë i hapur');
            redirect(base_url('admin/workers/worker_detail/' . $worker_id . '?month=' . $month . '&year=' . $year));
            return;
        }

        $result = $this->worker_salary_model->reopen_salary_month($worker_id, $month, $year);

        if ($result) {
            $this->session->set_flashdata('success_msg', 'Muaji u hap me sukses');
        } else {
            $this->session->set_flashdata('error_msg', 'Ka ndodhur një gabim gjatë hapjes së muajit');
        }

        redirect(base_url('admin/workers/worker_detail/' . $worker_id . '?month=' . $month . '&year=' . $year));
    }

    public function add_absence($worker_id)
    {
        if ($this->session->userdata('role') != 'admin') {
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
            return;
        }

        $worker = $this->worker_salary_model->get_worker($worker_id);

        if (!$worker) {
            $this->session->set_flashdata('error_msg', 'Punëtori nuk u gjet');
            redirect(base_url('admin/workers'));
            return;
        }

        $selected_month = (int) $this->input->get('month');
        $selected_year  = (int) $this->input->get('year');

        if ($_POST) {
            $selected_month = (int) $this->input->post('salary_month');
            $selected_year  = (int) $this->input->post('salary_year');
        }

        if (empty($selected_month) || $selected_month < 1 || $selected_month > 12) {
            $selected_month = (int) date('m');
        }

        if (empty($selected_year) || $selected_year < 2000 || $selected_year > 2100) {
            $selected_year = (int) date('Y');
        }

        $salary_month_row = $this->worker_salary_model->get_or_create_salary_month($worker_id, $selected_month, $selected_year);

        if ($salary_month_row && $salary_month_row['status'] == 'closed') {
            $this->session->set_flashdata('error_msg', 'Muaji është i mbyllur. Hapeni muajin për të bërë ndryshime.');
            redirect(base_url('admin/workers/worker_detail/' . $worker_id . '?month=' . $selected_month . '&year=' . $selected_year));
            return;
        }

        if ($_POST) {
            $salary_month = (int) $this->input->post('salary_month');
            $salary_year  = (int) $this->input->post('salary_year');
            $created_at = trim($this->input->post('created_at'));
            $absence_type = trim($this->input->post('absence_type'));
            $absence_value = trim($this->input->post('absence_value'));
            $note         = trim($this->input->post('note'));

            if (empty($salary_month) || $salary_month < 1 || $salary_month > 12) {
                $salary_month = (int) date('m');
            }

            if (empty($salary_year) || $salary_year < 2000 || $salary_year > 2100) {
                $salary_year = (int) date('Y');
            }

            if (empty($created_at)) {
                $this->session->set_flashdata('error_msg', 'Data e mungesës është e detyrueshme');
                redirect(base_url('admin/workers/add_absence/' . $worker_id . '?month=' . $salary_month . '&year=' . $salary_year));
                return;
            }

            if ($absence_type !== 'day' && $absence_type !== 'hour') {
                $this->session->set_flashdata('error_msg', 'Lloji i mungesës nuk është valid');
                redirect(base_url('admin/workers/add_absence/' . $worker_id . '?month=' . $salary_month . '&year=' . $salary_year));
                return;
            }

            if ($absence_value === '' || !is_numeric($absence_value) || (float)$absence_value <= 0) {
                $this->session->set_flashdata('error_msg', 'Vlera e mungesës duhet të jetë më e madhe se 0');
                redirect(base_url('admin/workers/add_absence/' . $worker_id . '?month=' . $salary_month . '&year=' . $salary_year));
                return;
            }

            // kontrollo që data i përket muajit/vitit të zgjedhur
            $absence_month = (int) date('m', strtotime($created_at));
            $absence_year  = (int) date('Y', strtotime($created_at));

            if ($absence_month != $salary_month || $absence_year != $salary_year) {
                $this->session->set_flashdata('error_msg', 'Data e mungesës duhet t’i përkasë muajit dhe vitit të zgjedhur');
                redirect(base_url('admin/workers/add_absence/' . $worker_id . '?month=' . $salary_month . '&year=' . $salary_year));
                return;
            }

            $result = $this->worker_salary_model->add_absence(
                $worker_id,
                $created_at,
                $absence_type,
                $absence_value,
                $note
            );

            if ($result) {
                $this->session->set_flashdata('success_msg', 'Mungesa u shtua me sukses');
            } else {
                $this->session->set_flashdata('error_msg', 'Ka ndodhur një gabim gjatë ruajtjes së mungesës');
            }

            redirect(base_url('admin/workers/worker_detail/' . $worker_id . '?month=' . $salary_month . '&year=' . $salary_year));
            return;
        }

        $data = array();
        $_SESSION['title_name'] = 'SHTO MUNGESË';
        $data['page_title'] = 'Shto Mungesë';
        $data['worker'] = $worker;
        $data['selected_month'] = $selected_month;
        $data['selected_year'] = $selected_year;

        $data['main_content'] = $this->load->view('admin/add-absence', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


    public function delete_absence($worker_id, $absence_id)
    {
        if ($this->session->userdata('role') != 'admin') {
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
            return;
        }

        $absence = $this->worker_salary_model->get_absence_by_id($absence_id);

        if (!$absence || (int)$absence['worker_id'] !== (int)$worker_id) {
            $this->session->set_flashdata('error_msg', 'Mungesa nuk u gjet');
            redirect(base_url('admin/workers'));
            return;
        }

        $month = (int) date('m', strtotime($absence['created_at']));
        $year  = (int) date('Y', strtotime($absence['created_at']));

        $salary_month_row = $this->worker_salary_model->get_or_create_salary_month($worker_id, $month, $year);

        if ($salary_month_row && $salary_month_row['status'] == 'closed') {
            $this->session->set_flashdata('error_msg', 'Muaji është i mbyllur. Hapeni muajin për të bërë ndryshime.');
            redirect(base_url('admin/workers/worker_detail/' . $worker_id . '?month=' . $month . '&year=' . $year));
            return;
        }

        $result = $this->worker_salary_model->delete_absence($absence_id);

        if ($result) {
            $this->session->set_flashdata('success_msg', 'Mungesa u fshi me sukses');
        } else {
            $this->session->set_flashdata('error_msg', 'Ka ndodhur një gabim gjatë fshirjes së mungesës');
        }

        redirect(base_url('admin/workers/worker_detail/' . $worker_id . '?month=' . $month . '&year=' . $year));
    }

    public function delete_loan($worker_id, $loan_id)
    {
        if ($this->session->userdata('role') != 'admin') {
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
            return;
        }

        $loan = $this->worker_salary_model->get_loan_by_id($loan_id);
        if (!$loan || (int)$loan['worker_id'] !== (int)$worker_id) {
            $this->session->set_flashdata('error_msg', 'Huazimi nuk u gjet');
            redirect(base_url('admin/workers'));
            return;
        }

        // Muaji/viti i huazimit
        $month = (int) date('m', strtotime($loan['created_at']));
        $year  = (int) date('Y', strtotime($loan['created_at']));

        // Kontrollo statusin e muajit
        $salary_month_row = $this->worker_salary_model->get_or_create_salary_month($worker_id, $month, $year);

        if ($salary_month_row && $salary_month_row['status'] == 'closed') {
            $this->session->set_flashdata('error_msg', 'Muaji është i mbyllur. Hapeni muajin për të bërë ndryshime.');
            redirect(base_url('admin/workers/worker_detail/' . $worker_id . '?month=' . $month . '&year=' . $year));
            return;
        }

        $result = $this->worker_salary_model->delete_loan($loan_id);

        if ($result) {
            $this->session->set_flashdata('success_msg', 'Huazimi u fshi me sukses');
        } else {
            $this->session->set_flashdata('error_msg', 'Ka ndodhur një gabim gjatë fshirjes së huazimit');
        }

        redirect(base_url('admin/workers/worker_detail/' . $worker_id . '?month=' . $month . '&year=' . $year));
    }

    public function delete_payment($worker_id, $payment_id)
    {
        if ($this->session->userdata('role') != 'admin') {
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
            return;
        }

        $payment = $this->worker_salary_model->get_payment_by_id($payment_id);

        if (!$payment || (int)$payment['worker_id'] !== (int)$worker_id) {
            $this->session->set_flashdata('error_msg', 'Pagesa nuk u gjet');
            redirect(base_url('admin/workers'));
            return;
        }

        $month = (int) date('m', strtotime($payment['created_at']));
        $year  = (int) date('Y', strtotime($payment['created_at']));

        $salary_month_row = $this->worker_salary_model->get_or_create_salary_month($worker_id, $month, $year);

        if ($salary_month_row && $salary_month_row['status'] == 'closed') {
            $this->session->set_flashdata('error_msg', 'Muaji është i mbyllur. Hapeni muajin për të bërë ndryshime.');
            redirect(base_url('admin/workers/worker_detail/' . $worker_id . '?month=' . $month . '&year=' . $year));
            return;
        }

        $result = $this->worker_salary_model->delete_payment($payment_id);

        if ($result) {
            $this->session->set_flashdata('success_msg', 'Pagesa u fshi me sukses');
        } else {
            $this->session->set_flashdata('error_msg', 'Ka ndodhur një gabim gjatë fshirjes së pagesës');
        }

        redirect(base_url('admin/workers/worker_detail/' . $worker_id . '?month=' . $month . '&year=' . $year));
    }

    public function delete_installment_loan($worker_id, $installment_loan_id)
    {
        if ($this->session->userdata('role') != 'admin') {
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
            return;
        }

        $installment_loan = $this->worker_salary_model->get_installment_loan_by_id($installment_loan_id);

        if (!$installment_loan || (int)$installment_loan['worker_id'] !== (int)$worker_id) {
            $this->session->set_flashdata('error_msg', 'Huazimi me këste nuk u gjet');
            redirect(base_url('admin/workers'));
            return;
        }

        $month = (int) $this->input->get('month');
        $year  = (int) $this->input->get('year');

        if (empty($month) || $month < 1 || $month > 12) {
            $month = (int) date('m');
        }

        if (empty($year) || $year < 2000 || $year > 2100) {
            $year = (int) date('Y');
        }

        $salary_month_row = $this->worker_salary_model->get_or_create_salary_month($worker_id, $month, $year);

        if ($salary_month_row && $salary_month_row['status'] == 'closed') {
            $this->session->set_flashdata('error_msg', 'Muaji është i mbyllur. Hapeni muajin për të bërë ndryshime.');
            redirect(base_url('admin/workers/worker_detail/' . $worker_id . '?month=' . $month . '&year=' . $year));
            return;
        }

        $result = $this->worker_salary_model->delete_installment_loan($installment_loan_id);

        if ($result) {
            $this->session->set_flashdata('success_msg', 'Huazimi me këste u fshi me sukses');
        } else {
            $this->session->set_flashdata('error_msg', 'Ka ndodhur një gabim gjatë fshirjes së huazimit me këste');
        }

        redirect(base_url('admin/workers/worker_detail/' . $worker_id . '?month=' . $month . '&year=' . $year));
    }

    public function monthly_salary_report()
    {
        if ($this->session->userdata('role') != 'admin') {
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
            return;
        }

        $selected_month = (int) $this->input->get('month');
        $selected_year  = (int) $this->input->get('year');

        if (empty($selected_month) || $selected_month < 1 || $selected_month > 12) {
            $selected_month = (int) date('m');
        }

        if (empty($selected_year) || $selected_year < 2000 || $selected_year > 2100) {
            $selected_year = (int) date('Y');
        }

        $report = $this->worker_salary_model->get_monthly_salary_report($selected_month, $selected_year);

        $data = array();
        $_SESSION['title_name'] = 'RAPORTI MUJOR I PAGAVE';
        $data['page_title'] = 'Raporti Mujor i Pagave';
        $data['selected_month'] = $selected_month;
        $data['selected_year'] = $selected_year;
        $data['report_rows'] = $report['rows'];
        $data['grand_total'] = $report['grand_total'];

        $data['main_content'] = $this->load->view('admin/monthly-salary-report', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function print_worker_salary_report($worker_id)
    {
        if ($this->session->userdata('role') != 'admin') {
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
            return;
        }

        $selected_month = (int) $this->input->get('month');
        $selected_year  = (int) $this->input->get('year');

        if (empty($selected_month) || $selected_month < 1 || $selected_month > 12) {
            $selected_month = (int) date('m');
        }

        if (empty($selected_year) || $selected_year < 2000 || $selected_year > 2100) {
            $selected_year = (int) date('Y');
        }

        $worker_details = $this->worker_salary_model->refresh_worker_month_details($worker_id, $selected_month, $selected_year);

        if (!$worker_details) {
            $this->session->set_flashdata('error_msg', 'Punëtori nuk u gjet');
            redirect(base_url('admin/workers'));
            return;
        }

        $data = array();
        $data['worker'] = $worker_details['worker'];
        $data['salary_month_row'] = $worker_details['salary_month_row'];
        $data['salary_summary'] = $worker_details['salary_summary'];
        $data['absences'] = $worker_details['absences'];
        $data['loans'] = $worker_details['loans'];
        $data['installment_loans'] = $worker_details['installment_loans'];
        $data['payments'] = $worker_details['payments'];
        $data['monthly_loans_total'] = $worker_details['monthly_loans_total'];
        $data['total_installment_loans'] = $worker_details['total_installment_loans'];

        $data['selected_month'] = $selected_month;
        $data['selected_year'] = $selected_year;

        $this->load->view('admin/print-worker-salary-report', $data);
    }

    public function edit_absence($worker_id, $absence_id)
    {
        if ($this->session->userdata('role') != 'admin') {
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
            return;
        }

        $worker = $this->worker_salary_model->get_worker($worker_id);
        $absence = $this->worker_salary_model->get_absence_by_id($absence_id);

        if (!$worker || !$absence || (int)$absence['worker_id'] !== (int)$worker_id) {
            $this->session->set_flashdata('error_msg', 'Mungesa nuk u gjet');
            redirect(base_url('admin/workers'));
            return;
        }

        $original_month = (int) date('m', strtotime($absence['created_at']));
        $original_year  = (int) date('Y', strtotime($absence['created_at']));

        $salary_month_row = $this->worker_salary_model->get_or_create_salary_month($worker_id, $original_month, $original_year);

        if ($salary_month_row && $salary_month_row['status'] == 'closed') {
            $this->session->set_flashdata('error_msg', 'Muaji është i mbyllur. Hapeni muajin për të bërë ndryshime.');
            redirect(base_url('admin/workers/worker_detail/' . $worker_id . '?month=' . $original_month . '&year=' . $original_year));
            return;
        }

        if ($_POST) {
            $created_at  = trim($this->input->post('created_at'));
            $absence_type  = trim($this->input->post('absence_type'));
            $absence_value = trim($this->input->post('absence_value'));
            $note          = trim($this->input->post('note'));

            if (empty($created_at)) {
                $this->session->set_flashdata('error_msg', 'Data e mungesës është e detyrueshme');
                redirect(base_url('admin/workers/edit_absence/' . $worker_id . '/' . $absence_id));
                return;
            }

            if ($absence_type !== 'day' && $absence_type !== 'hour') {
                $this->session->set_flashdata('error_msg', 'Lloji i mungesës nuk është valid');
                redirect(base_url('admin/workers/edit_absence/' . $worker_id . '/' . $absence_id));
                return;
            }

            if ($absence_value === '' || !is_numeric($absence_value) || (float)$absence_value <= 0) {
                $this->session->set_flashdata('error_msg', 'Vlera e mungesës duhet të jetë më e madhe se 0');
                redirect(base_url('admin/workers/edit_absence/' . $worker_id . '/' . $absence_id));
                return;
            }

            $new_month = (int) date('m', strtotime($created_at));
            $new_year  = (int) date('Y', strtotime($created_at));

            $new_salary_month_row = $this->worker_salary_model->get_or_create_salary_month($worker_id, $new_month, $new_year);

            if ($new_salary_month_row && $new_salary_month_row['status'] == 'closed') {
                $this->session->set_flashdata('error_msg', 'Muaji i ri është i mbyllur. Hapeni muajin për të bërë ndryshime.');
                redirect(base_url('admin/workers/worker_detail/' . $worker_id . '?month=' . $new_month . '&year=' . $new_year));
                return;
            }

            $result = $this->worker_salary_model->update_absence(
                $absence_id,
                $created_at,
                $absence_type,
                $absence_value,
                $note
            );

            if ($result) {
                $this->session->set_flashdata('success_msg', 'Mungesa u përditësua me sukses');
            } else {
                $this->session->set_flashdata('error_msg', 'Ka ndodhur një gabim gjatë përditësimit të mungesës');
            }

            redirect(base_url('admin/workers/worker_detail/' . $worker_id . '?month=' . $new_month . '&year=' . $new_year));
            return;
        }

        $absence_value = 0;
        if (!empty($absence['absence_type']) && $absence['absence_type'] === 'hour') {
            $absence_value = (float) $absence['hours'];
        } else {
            $absence_value = (float) $absence['days'];
        }

        $data = array();
        $_SESSION['title_name'] = 'PËRDITËSO MUNGESËN';
        $data['page_title'] = 'Përditëso Mungesën';
        $data['worker'] = $worker;
        $data['absence'] = $absence;
        $data['absence_value'] = $absence_value;

        $data['main_content'] = $this->load->view('admin/edit-absence', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function edit_loan($worker_id, $loan_id)
    {
        if ($this->session->userdata('role') != 'admin') {
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
            return;
        }

        $worker = $this->worker_salary_model->get_worker($worker_id);
        $loan = $this->worker_salary_model->get_loan_by_id($loan_id);

        if (!$worker || !$loan || (int)$loan['worker_id'] !== (int)$worker_id) {
            $this->session->set_flashdata('error_msg', 'Huazimi nuk u gjet');
            redirect(base_url('admin/workers'));
            return;
        }

        $original_month = (int) date('m', strtotime($loan['created_at']));
        $original_year  = (int) date('Y', strtotime($loan['created_at']));
        $salary_month_row = $this->worker_salary_model->get_or_create_salary_month($worker_id, $original_month, $original_year);

        if ($salary_month_row && $salary_month_row['status'] == 'closed') {
            $this->session->set_flashdata('error_msg', 'Muaji është i mbyllur. Hapeni muajin për të bërë ndryshime.');
            redirect(base_url('admin/workers/worker_detail/' . $worker_id . '?month=' . $original_month . '&year=' . $original_year));
            return;
        }

        if ($_POST) {
            $created_at = trim($this->input->post('created_at'));
            $amount    = trim($this->input->post('amount'));
            $note      = trim($this->input->post('note'));

            if (empty($created_at)) {
                $this->session->set_flashdata('error_msg', 'Data e huazimit është e detyrueshme');
                redirect(base_url('admin/workers/edit_loan/' . $worker_id . '/' . $loan_id));
                return;
            }

            if ($amount === '' || !is_numeric($amount) || (float)$amount <= 0) {
                $this->session->set_flashdata('error_msg', 'Shuma e huazimit duhet të jetë më e madhe se 0');
                redirect(base_url('admin/workers/edit_loan/' . $worker_id . '/' . $loan_id));
                return;
            }

            $new_month = (int) date('m', strtotime($created_at));
            $new_year  = (int) date('Y', strtotime($created_at));

            $new_salary_month_row = $this->worker_salary_model->get_or_create_salary_month($worker_id, $new_month, $new_year);

            if ($new_salary_month_row && $new_salary_month_row['status'] == 'closed') {
                $this->session->set_flashdata('error_msg', 'Muaji i ri është i mbyllur. Hapeni muajin për të bërë ndryshime.');
                redirect(base_url('admin/workers/worker_detail/' . $worker_id . '?month=' . $new_month . '&year=' . $new_year));
                return;
            }

            $result = $this->worker_salary_model->update_loan(
                $loan_id,
                $created_at,
                $amount,
                $note
            );

            if ($result) {
                $this->session->set_flashdata('success_msg', 'Huazimi u përditësua me sukses');
            } else {
                $this->session->set_flashdata('error_msg', 'Ka ndodhur një gabim gjatë përditësimit të huazimit');
            }

            redirect(base_url('admin/workers/worker_detail/' . $worker_id . '?month=' . $new_month . '&year=' . $new_year));
            return;
        }

        $data = array();
        $_SESSION['title_name'] = 'PËRDITËSO HUAZIMIN';
        $data['page_title'] = 'Përditëso Huazimin';
        $data['worker'] = $worker;
        $data['loan'] = $loan;

        $data['main_content'] = $this->load->view('admin/edit-loan', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


    public function edit_payment($worker_id, $payment_id)
    {
        if ($this->session->userdata('role') != 'admin') {
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
            return;
        }

        $worker = $this->worker_salary_model->get_worker($worker_id);
        $payment = $this->worker_salary_model->get_payment_by_id($payment_id);

        if (!$worker || !$payment || (int)$payment['worker_id'] !== (int)$worker_id) {
            $this->session->set_flashdata('error_msg', 'Pagesa nuk u gjet');
            redirect(base_url('admin/workers'));
            return;
        }

        $original_month = (int) date('m', strtotime($payment['created_at']));
        $original_year  = (int) date('Y', strtotime($payment['created_at']));

        $salary_month_row = $this->worker_salary_model->get_or_create_salary_month($worker_id, $original_month, $original_year);

        if ($salary_month_row && $salary_month_row['status'] == 'closed') {
            $this->session->set_flashdata('error_msg', 'Muaji është i mbyllur. Hapeni muajin për të bërë ndryshime.');
            redirect(base_url('admin/workers/worker_detail/' . $worker_id . '?month=' . $original_month . '&year=' . $original_year));
            return;
        }

        if ($_POST) {
            $created_at = trim($this->input->post('created_at'));
            $amount       = trim($this->input->post('amount'));
            $note         = trim($this->input->post('note'));

            if (empty($created_at)) {
                $this->session->set_flashdata('error_msg', 'Data e pagesës është e detyrueshme');
                redirect(base_url('admin/workers/edit_payment/' . $worker_id . '/' . $payment_id));
                return;
            }

            if ($amount === '' || !is_numeric($amount) || (float)$amount <= 0) {
                $this->session->set_flashdata('error_msg', 'Shuma e pagesës duhet të jetë më e madhe se 0');
                redirect(base_url('admin/workers/edit_payment/' . $worker_id . '/' . $payment_id));
                return;
            }

            $new_month = (int) date('m', strtotime($created_at));
            $new_year  = (int) date('Y', strtotime($created_at));

            $new_salary_month_row = $this->worker_salary_model->get_or_create_salary_month($worker_id, $new_month, $new_year);

            if ($new_salary_month_row && $new_salary_month_row['status'] == 'closed') {
                $this->session->set_flashdata('error_msg', 'Muaji i ri është i mbyllur. Hapeni muajin për të bërë ndryshime.');
                redirect(base_url('admin/workers/worker_detail/' . $worker_id . '?month=' . $new_month . '&year=' . $new_year));
                return;
            }

            $result = $this->worker_salary_model->update_payment(
                $payment_id,
                $created_at,
                $amount,
                $note
            );

            if ($result) {
                $this->session->set_flashdata('success_msg', 'Pagesa u përditësua me sukses');
            } else {
                $this->session->set_flashdata('error_msg', 'Ka ndodhur një gabim gjatë përditësimit të pagesës');
            }

            redirect(base_url('admin/workers/worker_detail/' . $worker_id . '?month=' . $new_month . '&year=' . $new_year));
            return;
        }

        $data = array();
        $_SESSION['title_name'] = 'PËRDITËSO PAGESËN';
        $data['page_title'] = 'Përditëso Pagesën';
        $data['worker'] = $worker;
        $data['payment'] = $payment;

        $data['main_content'] = $this->load->view('admin/edit-payment', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function edit_installment_loan($worker_id, $loan_id)
    {
        if ($this->session->userdata('role') != 'admin') {
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
            return;
        }

        $worker = $this->worker_salary_model->get_worker($worker_id);

        $loan = $this->worker_salary_model->get_installment_loan_by_id($loan_id);

        if (!$worker || !$loan || (int)$loan['worker_id'] !== (int)$worker_id) {
            $this->session->set_flashdata('error_msg', 'Huazimi me këste nuk u gjet');
            redirect(base_url('admin/workers'));
            return;
        }

        $current_month = (int) date('m');
        $current_year  = (int) date('Y');

        $salary_month_row = $this->worker_salary_model
            ->get_or_create_salary_month($worker_id, $current_month, $current_year);

        if ($salary_month_row && $salary_month_row['status'] == 'closed') {
            $this->session->set_flashdata(
                'error_msg',
                'Muaji aktual është i mbyllur. Hapeni muajin për të bërë ndryshime.'
            );

            redirect(base_url('admin/workers/worker_detail/' . $worker_id));
            return;
        }

        if ($_POST) {

            $total_amount   = trim($this->input->post('total_amount'));
            $monthly_amount = trim($this->input->post('monthly_amount'));
            $start_month    = (int) trim($this->input->post('start_month'));
            $start_year     = (int) trim($this->input->post('start_year'));
            $note           = trim($this->input->post('note'));

            if (!is_numeric($total_amount) || (float)$total_amount <= 0) {
                $this->session->set_flashdata(
                    'error_msg',
                    'Shuma totale duhet të jetë më e madhe se 0'
                );

                redirect(current_url());
                return;
            }

            if (!is_numeric($monthly_amount) || (float)$monthly_amount <= 0) {
                $this->session->set_flashdata(
                    'error_msg',
                    'Kësti mujor duhet të jetë më i madh se 0'
                );

                redirect(current_url());
                return;
            }

            if ($start_month < 1 || $start_month > 12) {
                $this->session->set_flashdata(
                    'error_msg',
                    'Muaji fillestar nuk është valid'
                );

                redirect(current_url());
                return;
            }

            if ($start_year < 2000 || $start_year > 2100) {
                $this->session->set_flashdata(
                    'error_msg',
                    'Viti fillestar nuk është valid'
                );

                redirect(current_url());
                return;
            }

            $result = $this->worker_salary_model->update_installment_loan(
                $loan_id,
                $total_amount,
                $monthly_amount,
                $start_month,
                $start_year,
                $note
            );

            if ($result) {

                // rifresko muajin aktual
                $this->worker_salary_model->refresh_worker_month_details(
                    $worker_id,
                    $current_month,
                    $current_year
                );

                $this->session->set_flashdata(
                    'success_msg',
                    'Huazimi me këste u përditësua me sukses'
                );

            } else {

                $this->session->set_flashdata(
                    'error_msg',
                    'Ka ndodhur një gabim gjatë përditësimit'
                );
            }

            redirect(base_url('admin/workers/worker_detail/' . $worker_id));

            return;
        }

        $data = array();

        $_SESSION['title_name'] = 'PËRDITËSO HUAZIMIN ME KËSTE';

        $data['page_title'] = 'Përditëso Huazimin me Këste';
        $data['worker'] = $worker;
        $data['loan'] = $loan;

        $data['main_content'] = $this->load->view(
            'admin/edit-installment-loan',
            $data,
            TRUE
        );

        $this->load->view('admin/index', $data);
    }
}
