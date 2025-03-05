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
require_once 'vendor/autoload.php'; // Require the PhpSpreadsheet library
require_once('tcpdf/tcpdf.php');
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;


class Invoices extends CI_Controller {

	public function __construct(){
        parent::__construct();
        check_login_user();
        $this->load->model('common_model');
        $db = $this->load->database();

    }
	 
     public function index(){
        if ($this->session->userdata('role') == 'admin') {
            $data = array();
            $_SESSION['title_name'] = 'KRIJO FATUREN';
            $data['page_title'] = 'KRIJO FATUREN';
    
            if (isset($_GET['product_name'])) {
                $searchTerm = $_GET['product_name'];
                if($searchTerm == ''){
                    $products =[];
                    $data['products'] = $products;
                    echo json_encode($data);
                    return;
                }
                if (preg_match('/^[0-9\-]+$/', $searchTerm)) {
                    $products = $this->db->select('products.id,products.name,products.code,products.price,products.image')
                        ->from('products')
                        ->group_start()
                        ->where('code', $searchTerm)
                        ->group_end()
                        ->get()
                        ->result_array();
                } else {
                    if (strpos($searchTerm, '%') !== false) {
                        $removeChar = str_replace('%','',$searchTerm);
                        $products = $this->db->select('products.id,products.name,products.code,products.price,products.image')->from('products')->group_start()->like('name', $removeChar)->group_end()->get()->result_array();
                    } else {
                        $products = $this->db->select('products.id,products.name,products.code,products.price,products.image')->from('products')->like('name', $searchTerm,'after')->get()->result_array();
                    }
                }
                $data['products'] = $products;
                echo json_encode($data);
                return;
            }
    
            $data['main_content'] = $this->load->view('admin/add-invoice', $data, TRUE);
            $this->load->view('admin/index', $data);
        } else {
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
        }
    }

    public function sheet_invoice(){
        if ($this->session->userdata('role') == 'admin') {
            // Validate POST data existence
            if (isset($_POST['date'], $_POST['product_name'], $_POST['code'], $_POST['quantity'], $_POST['price'], $_POST['total_product_price'], $_POST['total_price_invoice'])) {
                // Get form data
                $client_name = $_POST['client_name'];
                $address = $_POST['address'];
                $date = $_POST['date'];
                $comment = isset($_POST['comment']) ? $_POST['comment'] : '';
                $product_names = $_POST['product_name'];
                $codes = $_POST['code'];
                $quantities = $_POST['quantity'];
                $prices = $_POST['price'];
                $total_product_prices = $_POST['total_product_price'];
                $total_sum = $_POST['total_price_invoice'];
                $prepayment = $_POST['prepayment_price_invoice'] != '' ? number_format($_POST['prepayment_price_invoice'],2, '.', '') : '0.00';
                $final_sum_to_pay = $_POST['total_price_left_invoice'] != '' ? number_format($_POST['total_price_left_invoice'],2, '.', '') : '0.00';

                $_POST['adminID'] = $this->session->userdata('id');
                if($this->session->userdata('name') == 'Admin'){
                    $adminName = 'FK';
                }else if($this->session->userdata('name') == 'Adminpz'){
                    $adminName = 'TR';
                }
                
                // Create new PDF document
                $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
                $drawing = new Drawing();

                // Set document information
                $pdf->SetCreator(PDF_CREATOR);
                $pdf->SetAuthor('MJETEPERPUNE');
                $pdf->SetTitle('FATURA');
                $pdf->SetSubject('FATURA');
                $pdf->SetKeywords('FATURA, PDF, Example');
        
                // Set default header data
        
                // Set header and footer fonts
                $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
                $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        
                // Set default monospaced font
                $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        
                // Set margins
                $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
                $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
                $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        
                // Set auto page breaks
                $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        
                // Set image scale factor
                $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        
                // Set font
                $pdf->SetFont('dejavusans', '', 10);
        
                // Add a page
                $pdf->AddPage();
                
                if(isset($_POST['id'])){
                    $clientInvoice = $this->updateClientInvoice($_POST);
                }else{
                    $clientInvoice = $this->saveClientInvoice($_POST);
                }

                // Set some content to display
                $html = '
                <h1>FATURA: '.$adminName.'-'.$clientInvoice['id'].'</h1>
                <p><strong>KLIENTI:</strong> ' . strtoupper(($client_name)) . '</p>
                <p><strong>ADRESA:</strong> ' . strtoupper(($address)) . '</p>
                <p><strong>DATA:</strong> ' . htmlspecialchars($date) . '</p>
                ';
        
                $html .= '
                        <style>
                            table {
                                width: 100%;
                            }
                            th, td {
                                border: 1px solid black;
                                line-height: 30px;                   
                            th {
                                background-color: #f2f2f2;
                            }

                            .comment{
                                
                            }
                            .total_sum{
                                font-size:14px;
                            }
                        </style>
                <table >
                    <thead>
                        <tr style="height:100%;">
                            <th style="width:5%;"> #</th>
                            <th style="width:10%;"> KODI</th>
                            <th style="width:50%;"> EMRI I PRODUKTIT</th>
                            <th style="width:10%;"> SASIA</th>
                            <th style="width:10%;"> ÇMIMI</th>
                            <th style="width:15%;"> CMIMI TOTAL I PRODUKTIT</th>
                        </tr>
                    </thead>
                    <tbody style="border-right:none;">
                ';

                // Add table rows with data
                $rowCount = count($product_names);
                for ($i = 0; $i < $rowCount; $i++) {
                    $html .= '
                    <tr style="height:100%;">
                        <td style="width:5%;">' . ($i + 1) . '.</td>
                        <td style="width:10%;"> ' . ($codes[$i]) . '</td>
                        <td style="width:50%;"> ' . ($product_names[$i]) . '</td>
                        <td style="width:10%;"> ' . ($quantities[$i]) . '</td>
                        <td style="width:10%;"> ' . ($prices[$i]) . '</td>
                        <td style="width:15%;"> ' . ($total_product_prices[$i]) . '</td>
                    </tr>
                    ';
                }
        
                // Close the table and add total sum row
                $html .= '
                </tbody>
                <br/>
                <tfoot>
                    <tr class="total_sum">
                        <td colspan="5">TOTALI</td>
                        <td><b> ' . htmlspecialchars($total_sum) . '</b></td>
                    </tr>
                <tfoot>
                ';
                if($prepayment>0){
                $html .= '
                    <tfoot>
                    <tr class="total_sum">
                        <td colspan="5">PARAPAGESE</td>
                    <td><b> ' . htmlspecialchars($prepayment) . '</b></td>
                    </tr>
                    </tfoot>
                    <tfoot>
                    <tr class="total_sum">
                        <td colspan="5">SHUMA E MBETUR</td>
                        <td><b> ' . htmlspecialchars($final_sum_to_pay) . '</b></td>
                    </tr>
                    </tfoot>';
                }

                // $html .= '</tfoot>';

                if (!empty($comment)) {
                    $comment = nl2br(htmlspecialchars($comment, ENT_QUOTES, 'UTF-8'));
                $html .= '
                        <p>Koment: </p><br><span class="comment">' . $comment . '<hr></span>';
                }

                $html .= '
                            </table>';

                // Output the HTML content
                $pdf->writeHTML($html, true, false, true, false, '');
        
                // Close and output PDF document
                $pdf->Output('FATURA_'.$clientInvoice['id'].'.pdf', 'I');
                
                exit;
            } else {
                // Handle missing POST data or other validation issues
                echo 'Error: Missing or invalid POST data.';
            }
        } else {
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
        }
    }

    private function saveClientInvoice($dataClientInvoice=[]){
        $data = [];
        $newRowData = [];
        $data['client_name'] = strtoupper($dataClientInvoice['client_name']);
        $data['address'] = strtoupper($dataClientInvoice['address']);
        $data['date'] = $dataClientInvoice['date'];
        $data['comment'] = $dataClientInvoice['comment'];
        $data['total_price_invoice'] = $dataClientInvoice['total_price_invoice'];
        $data['adminID'] = $dataClientInvoice['adminID'];

        foreach ($dataClientInvoice['product_name'] as $key => $value) {
            $newRowData[] = ['product_name' => $value,'code' => $dataClientInvoice['code'][$key],'quantity' => $dataClientInvoice['quantity'][$key],'price' => $dataClientInvoice['price'][$key],'total_product_price' => $dataClientInvoice['total_product_price'][$key]];
        }

        $insertData = [
                'user_id' => $data['adminID'],
                'client_name' => $data['client_name'],
                'address' => $data['address'],
                'date' => $data['date'],
                'total_price_invoice' => $data['total_price_invoice'],
                'row_data' => json_encode($newRowData),
                'comment' => $data['comment'],
                'created_at' => current_datetime(),
        ];
        $this->common_model->insert($insertData, 'invoices');
        $lastIdOfInvoice = $this->db->select('id')->from('invoices')->order_by('id', 'desc')->limit(1)->get()->row_array();
        return $lastIdOfInvoice;
    }

    private function updateClientInvoice($dataClientInvoice=[]){
        $data = [];
        $newRowData = [];
        $data['client_name'] = strtoupper($dataClientInvoice['client_name']);
        $data['address'] = strtoupper($dataClientInvoice['address']);
        $data['date'] = $dataClientInvoice['date'];
        $data['total_price_invoice'] = $dataClientInvoice['total_price_invoice'];
        $data['comment'] = $dataClientInvoice['comment'];
        $data['adminID'] = $dataClientInvoice['adminID'];


        foreach ($dataClientInvoice['product_name'] as $key => $value) {
            $newRowData[] = ['product_name' => $value,'code' => $dataClientInvoice['code'][$key],'quantity' => $dataClientInvoice['quantity'][$key],'price' => $dataClientInvoice['price'][$key],'total_product_price' => $dataClientInvoice['total_product_price'][$key]];
        }

        $updateData = [
                'user_id' => $data['adminID'],
                'client_name' => $data['client_name'],
                'address' => $data['address'],
                'date' => $data['date'],
                'total_price_invoice' => $data['total_price_invoice'],
                'row_data' => json_encode($newRowData),
                'comment' => $data['comment'],
                'created_at' => current_datetime(),
        ];
        $data = $this->security->xss_clean($data);
        $this->common_model->edit_option($updateData, $dataClientInvoice['id'], 'invoices');
        return ['id' => $dataClientInvoice['id']];
    }

    public function created(){
        if ($this->session->userdata('role') == 'admin') {
            $_SESSION['title_name'] = 'FATURAT E KRIJUARA';
            $data['page_title'] = 'FATURAT E KRIJUARA';
            $invoicesCreated = $this->db->select('*')->from('invoices')->where('user_id',$this->session->userdata('id'))->order_by('created_at', 'desc')->get()->result_array();
            if($this->session->userdata('name') == 'Admin'){
                $adminName = 'FK';
            }else if($this->session->userdata('name') == 'Adminpz'){
                $adminName = 'TR';
            }
            $data['adminName'] = $adminName;
            $data['invoicesCreated'] = $invoicesCreated;
            $data['main_content'] = $this->load->view('admin/invoices', $data, TRUE);
            $this->load->view('admin/index', $data);
        } else {
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
        }
    }

    public function get_invoice_data(){
        if ($this->session->userdata('role') == 'admin') {
                $data = array();
                $_SESSION['title_name'] = 'FATURA';
                $data['page_title'] = 'FATURA';
                $invoiceData = $this->db->select('*')->from('invoices')->where('id', $_GET['id'])->get()->row_array();  
                echo json_encode($invoiceData);  
                return;
        } else {
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
        }
    }

    
    public function delete_invoice($invoiceId)
    {
        if ($this->session->userdata('role') == 'admin') {
            $this->common_model->delete($invoiceId, 'invoices');
            $categories = $this->db->select()->from('invoices')->get()->result_array();
            $_SESSION['invoices'] = $categories;
            redirect(base_url(). 'admin/invoices/created');
        } else {
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
        }
    }

}