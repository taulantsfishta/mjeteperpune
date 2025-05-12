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
require_once 'vendor/autoload.php'; // Require the PhpSpreadsheet library
require_once('tcpdf/tcpdf.php');
use PhpOffice\PhpSpreadsheet\IOFactory;


class Printproduct extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        check_login_user();
        $db = $this->load->database();
        $this->load->model('common_model');
        $this->load->helper(array('form', 'url'));
    }
    
    public function index()
    {
        if ($this->session->userdata('role') == 'admin') {

            $data = array();
            $data['page_dimension'] = $this->db->select()->from('page_dimension')->order_by('id','DESC')->get()->result_array();
            $_SESSION['title_name'] = 'PRINTO';
            $data['page_title'] = 'PRINTO PRODUKTET';
            $data['main_content'] = $this->load->view('admin/print-product', $data, TRUE);
            $this->load->view('admin/index',$data);
        } else {
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
        }
    }

    public function print_product()
    {
        $labels = [];

        if (isset($_FILES['excel_file']) && $_FILES['excel_file']['error'] === UPLOAD_ERR_OK) {
            $file_extension = pathinfo($_FILES['excel_file']['name'], PATHINFO_EXTENSION);
            if ($file_extension == 'xlsx' || $file_extension == 'xls') {
                $file_tmp_name = $_FILES['excel_file']['tmp_name'];
    
                // Load the Excel file
                $spreadsheet = IOFactory::load($file_tmp_name);
    
                // Get the first worksheet
                $worksheet = $spreadsheet->getActiveSheet();
    
                // Initialize an empty array to store data
                $data = [];
    
                // Initialize flags to check if columns 'name' and 'code' exist
                $name_column_exists = false;
                $code_column_exists = false;
    
                // Iterate through each row starting from the second row (assuming the first row is header)
                foreach ($worksheet->getRowIterator(1) as $row) {
                    // Get the cell value of the code column (column A)
                    $code = $worksheet->getCellByColumnAndRow(1, $row->getRowIndex())->getValue();
                    // Get the cell value of the name column (column B)
                    $name = $worksheet->getCellByColumnAndRow(2, $row->getRowIndex())->getValue();
    
                    // Check if column names are 'name' and 'code'
                    if ($code == 'code' && $name == 'name') {
                        $code_column_exists = true;
                        $name_column_exists = true;
                        continue; // Skip the header row
                    }
    
                    if ($name_column_exists && $code_column_exists) {
                        $labels[] = array('code' => $code, 'name' => $name);
                    }
                }
    
                if (!$name_column_exists || !$code_column_exists) {
                    $this->session->set_flashdata('error_msg', "Kolonat 'name' dhe 'code' nuk gjenden ne fajllin Excel");
                    redirect(base_url('admin/printproduct'));
                }
    
                // Convert the data array to JSON
                $json_data = json_encode($data);
            } else {
                $this->session->set_flashdata('error_msg', 'Fajlli nuk eshte i tipit Excel');
                redirect(base_url('admin/printproduct'));
            }
        } else {
            $this->session->set_flashdata('error_msg', 'Ngarkimi i fajllit ka deshtuar');
            redirect(base_url('admin/printproduct'));
        }

        $getPageDimension = $this->db->select()->from('page_dimension')->where('id',$_POST['label_dimension'])->get()->row_array();

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->AddPage('L', array($getPageDimension['height'],$getPageDimension['width']));
        $pdf->SetFont('dejavusans');
        $pdf->SetAutoPageBreak(true, 0);

        $startX = 0.2; 
        $startY = 0; 

        $html2b = '';

        $html = "
            <table>
            <tbody>";
        foreach ($labels as $row => $label) {
            $styleCode=' style="font-size:'.$getPageDimension['font_size_code'].';text-align: right;"';
            $styleName=' style="font-size:'.$getPageDimension['font_size_name'].';text-align: left;"';
            $htmlCode = "<tr><td".$styleCode.">".$label['code']."</td></tr><tr><td></td></tr>";
            $htmlName = "<tr><td".$styleName.">".$label['name']."</td></tr>";

            $html2b .= $htmlCode;
            $html2b .= $htmlName;
        }

        $html3 = "</tbody>
            </table>";
        $pdf->writeHTMLCell($w=50, $h=0, $x='0', $y='10', $html.$html2b.$html3, $border=0, $ln=1, $fill=0, $reseth=false, $align='C', $autopadding=true);

        $pdf->Output('Labels', 'I');
    }

    public function page_dimension(){
        if ($this->session->userdata('role') == 'admin') {

            $data['page_dimension'] = $this->db->select()->from('page_dimension')->order_by('id','DESC')->get()->result_array();
            $_SESSION['title_name'] = 'DIMENSIONET E FLETES';
            $data['page_title'] = 'DIMENSIONET E FLETES';
            $data['main_content'] = $this->load->view('admin/page-dimension', $data, TRUE);
            $this->load->view('admin/index', $data);
        } else {
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
        }

    }

    public function add_page_dimension(){
        if ($this->session->userdata('role') == 'admin') {
            if (isset($_POST['width'])) {
                $data = array(
                    'width' => $_POST['width'],
                    'height' => $_POST['height'],
                    'font_size_code' => $_POST['font_size_code'],
                    'font_size_name' => $_POST['font_size_name'],
                    'created_at' => current_datetime()
                );
                $data = $this->security->xss_clean($data);
                $newPageDimension = $this->common_model->insert($data, 'page_dimension');
                if ($newPageDimension) {
                    $this->session->set_flashdata('msg', 'Dimensioni i fletes eshte ruajtur me sukses');
                } else {
                    $this->session->set_flashdata('error_msg', 'Ka ndodhur nje gabim ne sistem');
                }
                redirect(base_url(). 'admin/printproduct/add_page_dimension');
            }
            $data['page_title'] = 'Shto Dimensionin e Fletes';
            $data['main_content'] = $this->load->view('admin/add-page-dimension', $data, TRUE);
            $this->load->view('admin/index', $data);
        } else {
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
        }
    }

    public function edit_page_dimension($dimension_id){
        if ($this->session->userdata('role') == 'admin') {
            if (isset($_POST['width'])) {
                $data = array(
                    'id' => $_POST['id'],
                    'width' => $_POST['width'],
                    'height' => $_POST['height'],
                    'font_size_code' => $_POST['font_size_code'],
                    'font_size_name' => $_POST['font_size_name'],
                );
                $data = $this->security->xss_clean($data);
                $this->common_model->edit_option($data, $data['id'], 'page_dimension');
                $this->session->set_flashdata('msg', 'Dimensioni eshte ndryshuar me sukses');
                redirect(base_url(). 'admin/printproduct/edit_page_dimension/' . $_POST['id']);
            }
            $data = array();
            $dimension = $this->db->select()->from('page_dimension')->where('id', $dimension_id)->get()->row_array();
            $data['dimension'] = $dimension;
            $data['page_title'] = 'Ndrysho Dimensionin';
            $data['main_content'] = $this->load->view('admin/edit-page-dimension', $data, TRUE);
            $this->load->view('admin/index', $data);
        } else {
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
        }
    }

    public function delete_page_dimension($id){
        if ($this->session->userdata('role') == 'admin') {
            $this->common_model->delete($id, 'page_dimension');
            redirect(base_url(). 'admin/printproduct/page_dimension');
        } else {
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
        }
    }


    public function print_one_product($id){
        if ($this->session->userdata('role') == 'admin') {
            if (isset($_POST['id'])) {
                $getPageDimension = $this->db->select()->from('page_dimension')->where('id',$_POST['label_dimension'])->get()->row_array();

                $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
                $pdf->SetPrintHeader(false);
                $pdf->SetPrintFooter(false);
                $pdf->AddPage('L', array($getPageDimension['height'],$getPageDimension['width']));
                $pdf->SetFont('dejavusans');
                $pdf->SetAutoPageBreak(true, 0);

                $startX = 0.2; 
                $startY = 0; 

                $html2b = '';

                $html = "
                    <table>
                    <tbody>";
                    $styleCode=' style="font-size:'.$getPageDimension['font_size_code'].';text-align: right;"';
                    $styleName=' style="font-size:'.$getPageDimension['font_size_name'].';text-align: left;"';
                    $htmlCode = "<tr><td".$styleCode.">".$_POST['code']."</td></tr><tr><td></td></tr>";
                    $htmlName = "<tr><td".$styleName.">".$_POST['name']."</td></tr>";

                    $html2b .= $htmlCode;
                    $html2b .= $htmlName;

                $html3 = "</tbody>
                    </table>";
                $pdf->writeHTMLCell($w=50, $h=0, $x='0', $y='10', $html.$html2b.$html3, $border=0, $ln=1, $fill=0, $reseth=false, $align='C', $autopadding=true);

                $pdf->Output('Produkti:'.$_POST['id'], 'I');

            }
            $data['product'] = $this->db->select()->from('products')->where('id',$id)->get()->row_array();
            $data['page_dimension'] = $this->db->select()->from('page_dimension')->order_by('id','DESC')->get()->result_array();
            $data['page_title'] = 'Printo Produktin';
            $data['main_content'] = $this->load->view('admin/print-one-product', $data, TRUE);
            $this->load->view('admin/index', $data);
        } else {
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
        }
    }

    public function print_selected_products(){
        $data = array();
        if ($this->session->userdata('role') == 'admin') {
            if(isset($_GET['products'])){
                $data['products'] = explode(',',$_GET['products']);
                $data['page_dimension'] = $this->db->select()->from('page_dimension')->order_by('id','DESC')->get()->result_array();
                $data['page_title'] = 'Printo Produktin';
                $data['main_content'] = $this->load->view('admin/print-selected-products', $data, TRUE);
                $this->load->view('admin/index', $data);
            }else if(isset($_POST['label_dimension'])){  
                $getPageDimension = $this->db->select()->from('page_dimension')->where('id',$_POST['label_dimension'])->get()->row_array();

                $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
                $pdf->SetPrintHeader(false);
                $pdf->SetPrintFooter(false);
                $pdf->AddPage('L', array($getPageDimension['height'],$getPageDimension['width']));
                $pdf->SetFont('dejavusans');
                $pdf->SetAutoPageBreak(true, 0);

                $startX = 0.2; 
                $startY = 0; 

                $html2b = '';
                
                // foreach (json_decode($_POST['products'],1) as $key => $value) {
                //     $labels = $this->db->select('name,code')->from('products')->where_in('id',$value)->get()->result_array();
                // }
                $labels = $this->db->select('name,code')->from('products')->where_in('id',json_decode($_POST['products'],1))->get()->result_array();

                log_message('error','newLabel'.json_encode($labels));

                $html = "
                    <table>
                    <tbody>";
                foreach ($labels as $row => $label) {
                    $styleCode=' style="font-size:'.$getPageDimension['font_size_code'].';text-align: right;"';
                    $styleName=' style="font-size:'.$getPageDimension['font_size_name'].';text-align: left;"';
                    $htmlCode = "<tr><td".$styleCode.">".$label['code']."</td></tr><tr><td></td></tr>";
                    $htmlName = "<tr><td".$styleName.">".$label['name']."</td></tr>";

                    $html2b .= $htmlCode;
                    $html2b .= $htmlName;
                }

                $html3 = "</tbody>
                    </table>";
                $pdf->writeHTMLCell($w=50, $h=0, $x='0', $y='10', $html.$html2b.$html3, $border=0, $ln=1, $fill=0, $reseth=false, $align='C', $autopadding=true);

                $pdf->Output('Labels', 'I');
            }
        } else {
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
        }
    }

    
}
?>
