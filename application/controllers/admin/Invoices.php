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

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;



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
                $images = $_POST['image'];
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
                log_message('error','IMAGE'.json_encode($_POST));
                if(isset($_POST['id'])){
                    $clientInvoice = $this->updateClientInvoice($_POST);
                }else{
                    $clientInvoice = $this->saveClientInvoice($_POST);
                }

                if($_POST['submit_type'] == 'printo_faturen'){
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
                                <th style="width:8%;"> #</th>
                                <th style="width:10%;"> KODI</th>
                                <th style="width:47%;"> EMRI I PRODUKTIT</th>
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
                            <td style="width:8%;">' . ($i + 1) . '.</td>
                            <td style="width:10%;"> ' . ($codes[$i]) . '</td>
                            <td style="width:47%;"> ' . ($product_names[$i]) . '</td>
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
                    
                    redirect(base_url(). 'admin/invoices/created');
                }else{
                    $spreadsheet = new Spreadsheet();
                    $sheet = $spreadsheet->getActiveSheet();

                    // === HEADER INFO ===
                    $sheet->setCellValue('A1', 'FATURA:');
                    $sheet->setCellValue('B1', $adminName . '-' . $clientInvoice['id']);
                    $sheet->setCellValue('A2', 'KLIENTI:');
                    $sheet->setCellValue('B2', $client_name);
                    $sheet->setCellValue('A3', 'ADRESA:');
                    $sheet->setCellValue('B3', $address);
                    $sheet->setCellValue('A4', 'DATA:');
                    $sheet->setCellValue('B4', $date);

                    // Bold header labels
                    $sheet->getStyle('A1:A4')->getFont()->setBold(true);

                    // === TABLE HEADER ===
                    $headerRow = 6;
                    $sheet->fromArray(
                        ['#', 'KODI', 'EMRI I PRODUKTIT', 'SASIA', 'ÇMIMI', 'CMIMI TOTAL I PRODUKTIT'],
                        null,
                        "A{$headerRow}"
                    );

                    // Bold header row
                    $sheet->getStyle("A{$headerRow}:F{$headerRow}")->getFont()->setBold(true);

                    // === PRODUCT ROWS ===
                    $startRow = $headerRow + 1;
                    $total_sum = 0;

                    for ($i = 0; $i < count($product_names); $i++) {
                        $row = $startRow + $i;
                        $sheet->setCellValue("A$row", $i + 1);
                        $sheet->setCellValue("B$row", $codes[$i]);
                        $sheet->setCellValue("C$row", $product_names[$i]);
                        $sheet->setCellValue("D$row", $quantities[$i]);
                        $sheet->setCellValue("E$row", $prices[$i]);
                        if($images[$i] !== ''){

                            $this->imageUrl($startRow,$images[$i],$i,$sheet,$row);
                        }
                        $sheet->setCellValue("F$row", number_format($total_product_prices[$i], 2));
                        $total_sum += floatval($total_product_prices[$i]);
                    }

                    
                    // === TOTAL ROW ===
                    $totalRow = $startRow + count($product_names);
                    $sheet->mergeCells("A{$totalRow}:E{$totalRow}");
                    $sheet->setCellValue("A{$totalRow}", 'TOTALI');
                    $sheet->setCellValue("F{$totalRow}", number_format($total_sum, 2));
                    $sheet->getStyle("A{$totalRow}:F{$totalRow}")->applyFromArray([
                        'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
                        'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                        'font' => ['bold' => true],
                    ]);

                    // === PREPAYMENT & FINAL SUM ROWS ===
                    $nextRow = $totalRow + 1;

                    if ($prepayment > 0) {
                        // Prepayment row
                        $sheet->mergeCells("A{$nextRow}:E{$nextRow}");
                        $sheet->setCellValue("A{$nextRow}", 'PARAPAGESE');
                        $sheet->setCellValue("F{$nextRow}", number_format($prepayment, 2));
                        $sheet->getStyle("A{$nextRow}:F{$nextRow}")->applyFromArray([
                            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
                            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                            'font' => ['bold' => true],
                        ]);

                        $nextRow++;

                        // Final sum to pay row
                        $sheet->mergeCells("A{$nextRow}:E{$nextRow}");
                        $sheet->setCellValue("A{$nextRow}", 'SHUMA E MBETUR');
                        $sheet->setCellValue("F{$nextRow}", number_format($final_sum_to_pay, 2));
                        $sheet->getStyle("A{$nextRow}:F{$nextRow}")->applyFromArray([
                            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
                            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                            'font' => ['bold' => true],
                        ]);

                        $nextRow++;
                    }

                    // === COMMENT ROW (optional) ===
                    if (!empty($comment)) {
                        $cleanComment = htmlspecialchars_decode(strip_tags($comment));
                        $sheet->mergeCells("A{$nextRow}:F" . ($nextRow + 1));
                        $sheet->setCellValue("A{$nextRow}", "KOMENT: {$cleanComment}");
                        $sheet->getStyle("A{$nextRow}:F" . ($nextRow + 1))->applyFromArray([
                            'alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT, 'vertical' => Alignment::VERTICAL_TOP, 'wrapText' => true],
                            'font' => ['italic' => true],
                        ]);
                        $nextRow += 2;
                    }

                    // === TABLE BORDERS FOR PRODUCT ROWS ===
                    $lastProductRow = $totalRow - 1;
                    $sheet->getStyle("A{$headerRow}:F{$lastProductRow}")->applyFromArray([
                        'borders' => [
                            'allBorders' => ['borderStyle' => Border::BORDER_THIN],
                        ],
                        'alignment' => [
                            'horizontal' => Alignment::HORIZONTAL_CENTER,
                            'vertical' => Alignment::VERTICAL_CENTER
                        ],
                    ]);

                    // Autosize columns
                    foreach (['B', 'D', 'E', ] as $col) {
                        $sheet->getColumnDimension($col)->setAutoSize(true);
                    }
                    $sheet->getColumnDimension('A')->setWidth(5); // Adjust width as needed 
                    $sheet->getColumnDimension('C')->setWidth(30); // Adjust width as needed 
                    $sheet->getColumnDimension('F')->setWidth(12); // Adjust width as needed 
                    $sheet->getStyle('F')->getAlignment()->setWrapText(true); // Add this


                    // === OUTPUT TO BROWSER ===
                    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                    header('Content-Disposition: attachment;filename="fatura.xlsx"');
                    header('Cache-Control: max-age=0');

                    $writer = new Xlsx($spreadsheet);
                    $writer->save('php://output');

                    exit;
                }
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


    public function imageUrl($startRow, $image, $i, $sheet, $row) {
        $image = stripslashes($image);
        $row = $startRow + $i;
        
        if (strpos($image, 'localhost') !== false) {
            // Local server: convert to file path
            $localPath = str_replace('http://localhost', $_SERVER['DOCUMENT_ROOT'], $image);
            
            if (file_exists($localPath)) {
                $drawing = new Drawing();
                $drawing->setName('Product Image');
                $drawing->setDescription('Product Image');
                $drawing->setPath($localPath);
                $drawing->setHeight(35);
                $drawing->setCoordinates("G{$row}");
                $drawing->setOffsetX(20);
                $drawing->setWorksheet($sheet);
            
                $sheet->getRowDimension($row)->setRowHeight(30);
            } else {
                $sheet->setCellValue("G{$row}", 'Image not found');
            }
        }else{

        $baseImageUrl =  stripslashes(base_url().'optimum/products_images/');
        $image = str_replace($baseImageUrl,"", $image);
        // Construct the full URL for production
        $fullImageUrl = $baseImageUrl . $image;
    
    
        // Download image temporarily
        $tempDir = sys_get_temp_dir();
        $filename = uniqid() . '_' . $image;
        $localPath = $tempDir . '/' . $filename;
    
        // Try to fetch the image
        $imageContents = @file_get_contents($fullImageUrl);
        if ($imageContents !== false) {
            file_put_contents($localPath, $imageContents);
    
            $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
            $drawing->setName('Product Image');
            $drawing->setDescription('Product Image');
            $drawing->setPath($localPath);
            $drawing->setHeight(35);
            $drawing->setCoordinates("G{$row}");
            $drawing->setOffsetX(20);
            $drawing->setWorksheet($sheet);
            $sheet->getRowDimension($row)->setRowHeight(30);
        } else {
            // Handle missing image
            $sheet->setCellValue("G{$row}", 'Image not found');
            log_message('error', 'Image download failed: ' . $fullImageUrl);
        }
        
        
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
        $data['prepayment_price_invoice'] = $dataClientInvoice['prepayment_price_invoice'];
        $data['total_price_left_invoice'] = $dataClientInvoice['total_price_left_invoice'];
        

        foreach ($dataClientInvoice['product_name'] as $key => $value) {
            $newRowData[] = ['product_name' => $value,'code' => $dataClientInvoice['code'][$key],'quantity' => $dataClientInvoice['quantity'][$key],'price' => $dataClientInvoice['price'][$key],'total_product_price' => $dataClientInvoice['total_product_price'][$key],'image'=>$dataClientInvoice['image'][$key]];
        }

        $insertData = [
                'user_id' => $data['adminID'],
                'client_name' => $data['client_name'],
                'address' => $data['address'],
                'date' => $data['date'],
                'total_price_invoice' => $data['total_price_invoice'],
                'prepayment_price_invoice' => $data['prepayment_price_invoice'],
                'total_price_left_invoice' => $data['total_price_left_invoice'],
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
        $data['prepayment_price_invoice'] = $dataClientInvoice['prepayment_price_invoice'];
        $data['total_price_left_invoice'] = $dataClientInvoice['total_price_left_invoice'];

        foreach ($dataClientInvoice['product_name'] as $key => $value) {
            $newRowData[] = ['product_name' => $value,'code' => $dataClientInvoice['code'][$key],'quantity' => $dataClientInvoice['quantity'][$key],'price' => $dataClientInvoice['price'][$key],'total_product_price' => $dataClientInvoice['total_product_price'][$key],'image' => $dataClientInvoice['image'][$key]];
        }

        $updateData = [
                'user_id' => $data['adminID'],
                'client_name' => $data['client_name'],
                'address' => $data['address'],
                'date' => $data['date'],
                'total_price_invoice' => $data['total_price_invoice'],
                'prepayment_price_invoice' => $data['prepayment_price_invoice'],
                'total_price_left_invoice' => $data['total_price_left_invoice'],
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

    public function appendImageProduct(){
        $invoices = $this->db->select('*')->from('invoices')->get()->result_array();
        foreach ($invoices as $key => $value) {
            $row_data = json_decode($value['row_data'],1);
            $row_data_1 = []; 

                foreach ($row_data as $key => $value_1) {
                    $productImage = $this->db->select('image')->from('products')->where('code',$value_1['code'])->get()->row_array();
                    $row_data_1 []= ['product_name' => $value_1['product_name'],'code' => $value_1['code'],'quantity' => $value_1['quantity'],'price' => $value_1['price'],'total_product_price' => $value_1['total_product_price'],'image'=>isset($productImage['image']) ? $productImage['image'] : ''];
                }
                $this->common_model->edit_option(['row_data'=>json_encode($row_data_1)], $value['id'], 'invoices');
            }
    }

}