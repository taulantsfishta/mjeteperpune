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

class Employee extends CI_Controller {

	public function __construct(){
        parent::__construct();
        check_login_user();
        $this->load->model('common_model');
        $db = $this->load->database();

    }

    public function index(){
        if ($this->session->userdata('role') == 'admin') {
            $data['page_title'] = 'Shto Punëtorin';
            $data['main_content'] = $this->load->view('admin/employee', $data, TRUE);
            $this->load->view('admin/index', $data);
        }
    }

    public function add(){
        if ($this->session->userdata('role') == 'admin') {
            $insertData = [
                'name' => strtoupper($_POST['name']),
                'salary' => $_POST['salary'],
                'created_at' => current_datetime()
            ];
            $newEmployee = $this->common_model->insert($insertData, 'employee');
        }

        if ($newEmployee) {
            $this->session->set_flashdata('msg', 'Punetori eshte ruajtur me sukses');
            $employee_details = $this->employeeDetails($newEmployee,$_POST);
            if(!$employee_details){
                $this->session->set_flashdata('error_msg', 'Ka ndodhur nje gabim ne sistem');
            }
            $insertEmployeeLoanDetails = $this->insertEmployeeLoanDetails($newEmployee);
            if(!$insertEmployeeLoanDetails){
                $this->session->set_flashdata('error_msg', 'Ka ndodhur nje gabim ne sistem');
            }
        } else {
            $this->session->set_flashdata('error_msg', 'Ka ndodhur nje gabim ne sistem');
        }
        $data['page_title'] = 'Shto Punëtorin';
        $data['main_content'] = $this->load->view('admin/employee', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function created(){
        if ($this->session->userdata('role') == 'admin') {
            $data['page_title'] = 'Lista E Punëtorëve';
            $data ['employeeList'] = $this->db->select('employee.id,employee.name,employee.salary,employee.created_at,employee_details.month_year')->from('employee')->join('employee_details', 'employee_details.employee_id = employee.id', 'left')->get()->result_array();
            $data['main_content'] = $this->load->view('admin/employees_list', $data, TRUE);
            $this->load->view('admin/index', $data);
        }
    }

    public function get_employee_details() {
        if ($this->session->userdata('role') == 'admin') {
            $data['employeeDetails'] = $this->db->select('employee.id,employee.name,employee.salary,employee.created_at,employee_details.month_year,employee_details.salary_to_this_day,employee_details.daily_paid_per_month,employee_details.salary_after_loan')->from('employee')->join('employee_details','employee_details.employee_id = employee.id', 'left')->where('employee.id',$_GET['id'])->get()->result_array();
            $data['employeeName'] = 'DETAJET PER' . ' '.$data['employeeDetails'][0]['name'];
            echo json_encode($data);  
            return;
        } else {
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
        }
    }

    public function get_employee_loan_details() {
        if ($this->session->userdata('role') == 'admin') {
            $data['employeeLoanDetails'] = $this->db->select('employee.id,employee.name,employee.salary,employee.created_at,employee_details.month_year,employee_details.salary_to_this_day,employee_details.daily_paid_per_month,employee_loan.loan_amount,employee_loan.months,employee_loan.remaining_amount,employee_loan.monthly_deduction,employee_loan.prepayment_loan,employee_loan.created_at,employee_loan.id as loan_id')->from('employee')->join('employee_details','employee_details.employee_id = employee.id', 'left')->join('employee_loan','employee_loan.employee_id = employee.id', 'left')->where('employee.id',$_GET['id'])->order_by('employee_loan.id','DESC')->get()->result_array();
            $data['employeeName'] = 'DETAJET E HUAS PER' . ' '.$data['employeeLoanDetails'][0]['name'];
            echo json_encode($data);  
            return;
        } else {
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
        }
    }
    

    public function delete_employee($employee_id){
        if ($this->session->userdata('role') == 'admin') {
            $this->common_model->delete($employee_id, 'employee');
            redirect(base_url(). 'admin/employee/created');
        } else {
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
        }
    }

    public function employeeDetails($employee_id,$employeeDataInput){
        $number_of_days_per_month = $this->get_number_of_days_per_month($employeeDataInput['month_year']);
        $daily_paid_per_month = $employeeDataInput['salary']/ $number_of_days_per_month;
        $salary_to_this_day = $daily_paid_per_month *  (date('d', strtotime($employeeDataInput['month_year']))-1);

        $insertData = [
            'employee_id' => $employee_id,
            'daily_paid_per_month' => $daily_paid_per_month,
            'month_year' => $employeeDataInput['month_year'],
            'salary_to_this_day' => $salary_to_this_day,
            'salary_after_loan' => $employeeDataInput['salary'],
            'created_at' => current_datetime()
        ];
        return $this->common_model->insert($insertData, 'employee_details');
    }

    public function insertEmployeeLoanDetails($employee_id){
        $insertData = [
            'employee_id' => $employee_id,
            'loan_amount' => 0,
            'months' => 0,
            'remaining_amount' => 0,
            'monthly_deduction' => 0,
            'prepayment_loan' => 0,
            'created_at' => current_datetime()
        ];
        return $this->common_model->insert($insertData, 'employee_loan');
    }

    public function get_number_of_days_per_month($date){
        $year = date('Y', strtotime($date));
        $month = date('m', strtotime($date));
    
        // Get the number of days in the selected month
        return cal_days_in_month(CAL_GREGORIAN, $month, $year);
    }

    public function add_loan_employee($id){
        $loan_amount = $_POST['loan_amount'];
        $months = $_POST['months'];
        $monthly_deduction = $loan_amount / $months;
        $remaning_amount = $loan_amount;

        $get_employee_data =  $this->db->select('employee.id,employee.name,employee.salary,employee.created_at,employee_details.month_year,employee_details.salary_to_this_day,employee_details.daily_paid_per_month,employee_loan.loan_amount,employee_loan.months,employee_loan.remaining_amount,employee_loan.monthly_deduction,employee_loan.prepayment_loan,employee_loan.created_at,employee_loan.id as loan_id')->from('employee')->join('employee_details','employee_details.employee_id = employee.id', 'left')->join('employee_loan','employee_loan.employee_id = employee.id', 'left')->where('employee.id',$id)->order_by('employee_loan.id','DESC')->get()->result_array();
        $updateEmployeeLoanData = ['loan_amount'=> $loan_amount,'months'=> $months,'remaining_amount'=> $remaning_amount,'monthly_deduction'=> $monthly_deduction,'created_at'=> current_datetime()];

        $this->db->set($updateEmployeeLoanData)
                ->where('employee_id',$id)
                ->update('employee_loan');

       $salary_after_loan = ($get_employee_data[0]['salary'])-($monthly_deduction);

       $number_of_days_per_month = $this->get_number_of_days_per_month($employeeDataInput['month_year']);
       $daily_paid_per_month = ($get_employee_data[0]['salary']-$monthly_deduction)/ $number_of_days_per_month;
       $salary_to_this_day = ($daily_paid_per_month) * ((date('d', strtotime($get_employee_data[0]['month_year']))-1));
       $updateEmployeeSalaryAfterLoan = ['daily_paid_per_month'=> $daily_paid_per_month,'salary_after_loan'=>$salary_after_loan,'salary_to_this_day'=>$salary_to_this_day,'created_at'=>current_datetime()];

       $this->db->set($updateEmployeeSalaryAfterLoan)
                ->where('employee_id',$id)
                ->update('employee_details');
        
       redirect(base_url() . 'admin/employee/created');
    }
}