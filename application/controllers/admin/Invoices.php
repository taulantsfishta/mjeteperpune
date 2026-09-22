<?php if (! defined('BASEPATH')) exit('No direct script access allowed');


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



class Invoices extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_login_user();
        $this->load->model('common_model');
        $db = $this->load->database();
    }

    public function index()
    {
        if (in_array($this->session->userdata('role'), ['admin', 'sales'])) {

            $data = array();

            $_SESSION['title_name'] = 'KRIJO FATUREN';
            $data['page_title'] = 'KRIJO FATUREN';


            // =====================================================
            // KËRKIMI I PRODUKTEVE
            // =====================================================
            if (isset($_GET['product_name'])) {

                $searchTerm = trim($_GET['product_name']);

                if ($searchTerm === '') {
                    echo json_encode(['products' => []]);
                    return;
                }


                // 1) CODE ONLY
                if (preg_match('/^[0-9\-]+$/', $searchTerm)) {

                    $products = $this->db
                        ->select('products.id,products.name,products.code,products.price,products.image')
                        ->from('products')
                        ->where('code', $searchTerm)
                        ->where('is_deleted', 0)
                        ->get()
                        ->result_array();
                }

                // 2) WILDCARD
                else if (
                    strpos($searchTerm, '%') !== false ||
                    strpos($searchTerm, '_') !== false
                ) {

                    $like = $searchTerm;

                    if ($like[0] !== '%') {
                        $like = '%' . $like;
                    }

                    if (substr($like, -1) !== '%') {
                        $like = $like . '%';
                    }


                    $products = $this->db
                        ->select('products.id,products.name,products.code,products.price,products.image')
                        ->from('products')
                        ->where(
                            "name LIKE " . $this->db->escape($like),
                            null,
                            false
                        )
                        ->where('is_deleted', 0)
                        ->order_by('category_id', 'ASC')
                        ->get()
                        ->result_array();
                }

                // 3) TEXT
                else {

                    $term = $searchTerm;

                    $regex =
                        '[[:<:]]' .
                        preg_quote($term, '/') .
                        '[[:>:]]';

                    $likePrefix = $term . '%';


                    $products = $this->db
                        ->select('products.id,products.name,products.code,products.price,products.image')
                        ->from('products')
                        ->group_start()
                        ->like('name', $term, 'after')
                        ->or_where(
                            "name REGEXP " .
                                $this->db->escape($regex),
                            null,
                            false
                        )
                        ->group_end()
                        ->where('is_deleted', 0)
                        ->order_by(
                            "(name LIKE " .
                                $this->db->escape($likePrefix) .
                                ") DESC",
                            null,
                            false
                        )
                        ->order_by(
                            "(name REGEXP " .
                                $this->db->escape($regex) .
                                ") DESC",
                            null,
                            false
                        )
                        ->order_by('category_id', 'ASC')
                        ->get()
                        ->result_array();
                }


                echo json_encode([
                    'products' => $products
                ]);

                return;
            }


            // =====================================================
            // PRODUKTET QË VIJNË NGA SHPORTA
            // =====================================================

            $data['cart_products'] = [];


            if ($this->input->get('from_cart') == '1') {

                $cart = $this->session->userdata('shopping_cart');


                if (is_array($cart) && !empty($cart)) {

                    foreach ($cart as $item) {

                        $productId = isset($item['id'])
                            ? $item['id']
                            : null;


                        // Merre fotografinë nga DB
                        $product = null;

                        if ($productId) {

                            $product = $this->db
                                ->select('image')
                                ->from('products')
                                ->where('id', $productId)
                                ->get()
                                ->row_array();
                        }


                        $quantity =
                            isset($item['quantity'])
                            ? (float)$item['quantity']
                            : 0;


                        $price =
                            isset($item['price'])
                            ? (float)$item['price']
                            : 0;


                        $data['cart_products'][] = [

                            'id' => $productId,

                            'name' =>
                            isset($item['name'])
                                ? $item['name']
                                : '',

                            'code' =>
                            isset($item['code'])
                                ? $item['code']
                                : '',

                            'quantity' => $quantity,

                            'price' => $price,

                            'total' =>
                            $quantity * $price,

                            'image' =>
                            isset($product['image'])
                                ? $product['image']
                                : ''

                        ];
                    }
                }


                // =================================================
                // SHPORTA KA MBËRRITUR TE FATURA
                // TANI MUND TA FSHIJMË NGA SESSION
                // =================================================

                $this->session->unset_userdata(
                    'shopping_cart'
                );
            }


            // =====================================================
            // LOAD VIEW
            // =====================================================

            $data['main_content'] =
                $this->load->view(
                    'admin/add-invoice',
                    $data,
                    TRUE
                );


            $this->load->view(
                'admin/index',
                $data
            );
        } else {

            $data = array();

            $data['heading'] = 'Mesazhi';

            $data['message'] =
                'Nuk keni qasje ne kete faqe';


            $this->load->view(
                'errors/html/error_404',
                $data
            );
        }
    }

    public function sheet_invoice()
    {
        if (in_array($this->session->userdata('role'), ['admin', 'sales'])) {
            // Validate POST data existence
            if (isset($_POST['date'], $_POST['product_name'], $_POST['code'], $_POST['quantity'], $_POST['price'], $_POST['total_product_price'], $_POST['total_price_invoice'])) {
                // Get form data
                $client_name = $_POST['client_name'];
                $address = $_POST['address'];
                $date = $_POST['date'];
                $comment = isset($_POST['comment']) ? $_POST['comment'] : '';
                $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
                $product_names = $_POST['product_name'];
                $codes = $_POST['code'];
                $quantities = $_POST['quantity'];
                $prices = $_POST['price'];
                $images = $_POST['image'];
                $total_product_prices = $_POST['total_product_price'];
                $total_sum = $_POST['total_price_invoice'];
                $prepayment = $_POST['prepayment_price_invoice'] != '' ? number_format($_POST['prepayment_price_invoice'], 2, '.', '') : '0.00';
                $final_sum_to_pay = $_POST['total_price_left_invoice'] != '' ? number_format($_POST['total_price_left_invoice'], 2, '.', '') : '0.00';

                $_POST['adminID'] = $this->session->userdata('id');
                $adminName = $this->session->userdata('prefix_user');
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
                $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
                $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

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

                if (isset($_POST['id'])) {
                    $clientInvoice = $this->updateClientInvoice($_POST);
                } else {
                    $clientInvoice = $this->saveClientInvoice($_POST);
                }


                if ($_POST['submit_type'] == 'printo_faturen') {

                    $invoiceId = $clientInvoice['id'];

                    // pastro output-in nëse ka diçka
                    if (ob_get_length()) {
                        ob_end_clean();
                    }

                    $printUrl = base_url('admin/invoices/print_pdf?id=' . $invoiceId);

                    echo '<!DOCTYPE html>
                    <html>
                    <head>
                        <meta charset="utf-8">
                        <title>Printo Faturen</title>
                        <style>
                            html, body {
                                margin:0;
                                padding:0;
                                height:100%;
                            }
                            iframe {
                                width:100%;
                                height:100%;
                                border:none;
                            }
                        </style>
                    </head>
                    <body>
                        <iframe id="pdfFrame" src="' . htmlspecialchars($printUrl, ENT_QUOTES, "UTF-8") . '"></iframe>

                        <script>
                            const iframe = document.getElementById("pdfFrame");
                            iframe.addEventListener("load", function() {
                                try {
                                    iframe.contentWindow.focus();
                                    iframe.contentWindow.print();
                                } catch (e) {
                                    console.error(e);
                                }
                            });
                        </script>
                    </body>
                    </html>';

                    exit;
                } else if ($_POST['submit_type'] == 'printo_faturen_excel') {
                    $spreadsheet = new Spreadsheet();
                    $sheet = $spreadsheet->getActiveSheet();

                    $sheet->setCellValue('A1', 'FATURA:');
                    $sheet->setCellValue('B1', $adminName . '-' . $clientInvoice['id']);

                    $sheet->setCellValue('A2', 'KLIENTI:');
                    $sheet->setCellValue('B2', $client_name);

                    $sheet->setCellValue('A3', 'ADRESA:');
                    $sheet->setCellValue('B3', $address);

                    $sheet->setCellValue('A4', 'TELEFONI:');
                    $sheet->setCellValue('B4', $phone);

                    $sheet->setCellValue('A5', 'DATA:');
                    $sheet->setCellValue('B5', $date);

                    $sheet->getStyle('A1:A5')->getFont()->setBold(true);

                    $headerRow = 7;
                    $sheet->fromArray(
                        ['#', 'KODI', 'EMRI I PRODUKTIT', 'SASIA', 'ÇMIMI', 'TOTALI'],
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
                        $sheet->setCellValue("C$row", strtoupper($product_names[$i]));
                        $sheet->setCellValue("D$row", $quantities[$i]);
                        $sheet->setCellValue("E$row", $prices[$i]);
                        if ($images[$i] !== '') {

                            $this->imageUrl($startRow, $images[$i], $i, $sheet, $row);
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
                        $sheet->setCellValue("A{$nextRow}", 'PARAPAGESË');
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
                    foreach (['B', 'D', 'E',] as $col) {
                        $sheet->getColumnDimension($col)->setAutoSize(true);
                    }
                    $sheet->getColumnDimension('A')->setWidth(5); // Adjust width as needed 
                    $sheet->getColumnDimension('C')->setWidth(30); // Adjust width as needed 
                    $sheet->getColumnDimension('F')->setWidth(12); // Adjust width as needed 
                    $sheet->getStyle('F')->getAlignment()->setWrapText(true); // Add this


                    // === OUTPUT TO BROWSER ===
                    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                    header('Content-Disposition: attachment;filename="' . $client_name . '-' . 'FATURA-' . $clientInvoice['id'] . '.xlsx"');
                    header('Cache-Control: max-age=0');

                    $writer = new Xlsx($spreadsheet);
                    $writer->save('php://output');

                    exit;
                } else if ($_POST['submit_type'] == 'ruaj_faturen') {
                    $clientData = $this->db->select('*')->from('invoices')->where('id', $clientInvoice['id'])->order_by('id', 'desc')->limit(1)->get()->row_array();
                    exit(json_encode($clientData));
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


    public function imageUrl($startRow, $image, $i, $sheet, $row)
    {
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
        } else {

            $baseImageUrl =  stripslashes(base_url() . 'optimum/products_images/');
            $image = str_replace($baseImageUrl, "", $image);
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
            }
        }
    }



    private function saveClientInvoice($dataClientInvoice = [])
    {
        $data = [];
        $newRowData = [];
        $data['client_name'] = strtoupper($dataClientInvoice['client_name']);
        $data['address'] = strtoupper($dataClientInvoice['address']);
        $data['phone'] = isset($dataClientInvoice['phone']) ? trim($dataClientInvoice['phone']) : '';
        $data['date'] = $dataClientInvoice['date'];
        $data['comment'] = $dataClientInvoice['comment'];
        $data['total_price_invoice'] = $dataClientInvoice['total_price_invoice'];
        $data['adminID'] = $dataClientInvoice['adminID'];
        $data['prepayment_price_invoice'] = $dataClientInvoice['prepayment_price_invoice'];
        $data['total_price_left_invoice'] = $dataClientInvoice['total_price_left_invoice'];
        $data['total_product_price'] = $dataClientInvoice['total_product_price'];

        foreach ($dataClientInvoice['product_name'] as $key => $value) {
            $newRowData[] = ['product_name' => strtoupper($value), 'code' => $dataClientInvoice['code'][$key], 'quantity' => $dataClientInvoice['quantity'][$key], 'price' => $dataClientInvoice['price'][$key], 'total_product_price' => $dataClientInvoice['total_product_price'][$key], 'image' => $dataClientInvoice['image'][$key]];
        }

        $insertData = [
            'user_id' => $data['adminID'],
            'client_name' => $data['client_name'],
            'address' => $data['address'],
            'phone' => $data['phone'],
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

    private function updateClientInvoice($dataClientInvoice = [])
    {
        $data = [];
        $newRowData = [];
        $data['client_name'] = strtoupper($dataClientInvoice['client_name']);
        $data['address'] = strtoupper($dataClientInvoice['address']);
        $data['phone'] = isset($dataClientInvoice['phone']) ? trim($dataClientInvoice['phone']) : '';
        $data['date'] = $dataClientInvoice['date'];
        $data['total_price_invoice'] = $dataClientInvoice['total_price_invoice'];
        $data['comment'] = $dataClientInvoice['comment'];
        $data['adminID'] = $dataClientInvoice['adminID'];
        $data['prepayment_price_invoice'] = $dataClientInvoice['prepayment_price_invoice'];
        $data['total_price_left_invoice'] = $dataClientInvoice['total_price_left_invoice'];

        foreach ($dataClientInvoice['product_name'] as $key => $value) {
            $newRowData[] = ['product_name' => strtoupper($value), 'code' => $dataClientInvoice['code'][$key], 'quantity' => $dataClientInvoice['quantity'][$key], 'price' => $dataClientInvoice['price'][$key], 'total_product_price' => $dataClientInvoice['total_product_price'][$key], 'image' => $dataClientInvoice['image'][$key]];
        }

        $updateData = [
            'user_id' => $data['adminID'],
            'client_name' => $data['client_name'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'date' => $data['date'],
            'total_price_invoice' => $data['total_price_invoice'],
            'prepayment_price_invoice' => $data['prepayment_price_invoice'],
            'total_price_left_invoice' => $data['total_price_left_invoice'],
            'row_data' => json_encode($newRowData),
            'comment' => $data['comment'],
            'created_at' => current_datetime(),
        ];
        $data = $this->security->xss_clean($data);
        $original = $this->db->where('id', (int)$dataClientInvoice['id'])->get('invoices')->row_array();
        if (!$original || (int)$original['user_id'] !== (int)$this->session->userdata('id')) {
            show_error('Nuk keni qasje për të ndryshuar këtë faturë.', 403);
            return [];
        }
        $updateData['user_id'] = $original['user_id'];
        $this->common_model->edit_option($updateData, $dataClientInvoice['id'], 'invoices');
        return ['id' => $dataClientInvoice['id']];
    }

    private function attach_invoice_debt_status($invoices)
    {
        if (!$invoices) return $invoices;
        $ids = array_map('intval', array_column($invoices, 'id'));
        $linked = [];
        if ($this->db->field_exists('invoice_id', 'debt_transactions')) {
            $rows = $this->db->select('invoice_id')->where_in('invoice_id', $ids)
                ->where('type', 'debt')->get('debt_transactions')->result_array();
            foreach ($rows as $row) $linked[(int)$row['invoice_id']] = true;
        }
        // Për instalimet e vjetra pa kolonën invoice_id, përdor shënuesin e saktë.
        $rows = $this->db->select('description')->where('type', 'debt')
            ->like('description', 'FATURA_ID:', 'after')->get('debt_transactions')->result_array();
        foreach ($rows as $row) {
            if (preg_match('/^FATURA_ID:(\d+)(?!\d)/', (string)$row['description'], $m)) {
                $linked[(int)$m[1]] = true;
            }
        }
        foreach ($invoices as &$invoice) {
            $invoice['is_debt'] = isset($linked[(int)$invoice['id']]) ? 1 : 0;
        }
        unset($invoice);
        return $invoices;
    }

    // Filtri i faturave sipas përdoruesit: vetëm administratori mund të zgjedhë admin/sales.
    private function invoice_selected_user()
    {
        $ownId = (int) $this->session->userdata('id');
        if ($this->session->userdata('role') !== 'admin') return $ownId;
        $requested = (int) $this->input->get('invoice_user_id');
        if ($requested <= 0 || $requested === $ownId) return $ownId;
        $table = 'user';
        $account = $this->db->select('id')->where('id', $requested)
            ->where_in('role', ['admin', 'sales'])->get($table)->row_array();
        return $account ? $requested : $ownId;
    }

    private function invoice_user_options()
    {
        // Emri i përdoruesit ruhet në user.first_name.
        return $this->db->select('id, first_name AS display_name')
            ->from('user')
            ->where_in('role', ['admin', 'sales'])
            ->order_by('first_name', 'ASC')
            ->get()->result_array();
    }

    public function created()
    {
        if (in_array($this->session->userdata('role'), ['admin', 'sales'])) {
            $_SESSION['title_name'] = 'FATURAT E KRIJUARA';
            $data['page_title'] = 'FATURAT E KRIJUARA';
            $selectedUserId = $this->invoice_selected_user();
            $invoicesCreated = $this->db->select('*')->from('invoices')->where('user_id', $selectedUserId)->order_by('created_at', 'desc')->get()->result_array();
            $data['invoiceSelectedUserId'] = $selectedUserId;
            $data['invoiceOwnUserId'] = (int) $this->session->userdata('id');
            $data['invoiceUserOptions'] = $this->session->userdata('role') === 'admin' ? $this->invoice_user_options() : [];
            $data['invoiceIsAdmin'] = $this->session->userdata('role') === 'admin';

            $data['adminName'] = $this->session->userdata('prefix_user');
            $data['invoicesCreated'] = $this->attach_invoice_debt_status($invoicesCreated);
            $data['main_content'] = $this->load->view('admin/invoices', $data, TRUE);
            $this->load->view('admin/index', $data);
        } else {
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
        }
    }

    public function get_invoice_data()
    {
        if (in_array($this->session->userdata('role'), ['admin', 'sales'])) {
            $data = array();
            $_SESSION['title_name'] = 'FATURA';
            $data['page_title'] = 'FATURA';
            $query = $this->db->select('*')->from('invoices')->where('id', (int)$this->input->get('id'));
            if ($this->session->userdata('role') !== 'admin') $query->where('user_id', (int)$this->session->userdata('id'));
            $invoiceData = $query->get()->row_array();
            echo json_encode($invoiceData);
            return;
        } else {
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
        }
    }


    public function get_invoices()
    {
        if (in_array($this->session->userdata('role'), ['admin', 'sales'])) {
            $data = array();
            $invoiceData = $this->db->select('*')->from('invoices')->where('user_id', $this->invoice_selected_user())->order_by('created_at', 'desc')->get()->result_array();
            echo json_encode($this->attach_invoice_debt_status($invoiceData));
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
        if (in_array($this->session->userdata('role'), ['admin', 'sales'])) {
            $invoiceToDelete = $this->db->where('id', (int)$invoiceId)->get('invoices')->row_array();
            if (!$invoiceToDelete || ($this->session->userdata('role') !== 'admin' && (int)$invoiceToDelete['user_id'] !== (int)$this->session->userdata('id'))) {
                show_404();
                return;
            }
            $this->common_model->delete($invoiceId, 'invoices');
            $categories = $this->db->select()->from('invoices')->get()->result_array();
            $_SESSION['invoices'] = $categories;
            redirect(base_url() . 'admin/invoices/created');
        } else {
            $data = array();
            $data['heading'] = 'Mesazhi';
            $data['message'] = "Nuk keni qasje ne kete faqe";
            $this->load->view('errors/html/error_404', $data);
        }
    }

    public function appendImageProduct()
    {
        $invoices = $this->db->select('*')->from('invoices')->get()->result_array();
        foreach ($invoices as $key => $value) {
            $row_data = json_decode($value['row_data'], 1);
            $row_data_1 = [];

            foreach ($row_data as $key => $value_1) {
                $productImage = $this->db->select('image')->from('products')->where('code', $value_1['code'])->get()->row_array();
                $row_data_1[] = ['product_name' => $value_1['product_name'], 'code' => $value_1['code'], 'quantity' => $value_1['quantity'], 'price' => $value_1['price'], 'total_product_price' => $value_1['total_product_price'], 'image' => isset($productImage['image']) ? $productImage['image'] : ''];
            }
            $this->common_model->edit_option(['row_data' => json_encode($row_data_1)], $value['id'], 'invoices');
        }
    }


    public function print_pdf()
    {
        if (in_array($this->session->userdata('role'), ['user'])) {
            show_404();
        }

        $id = $this->input->get('id');
        if (!$id) {
            show_404();
        }

        $invoice = $this->db->select('*')
            ->from('invoices')
            ->where('id', $id)
            ->get()
            ->row_array();

        if (!$invoice || ($this->session->userdata('role') !== 'admin' && (int)$invoice['user_id'] !== (int)$this->session->userdata('id'))) {
            show_404();
            return;
        }

        // dekodo rreshtat
        $rows = json_decode($invoice['row_data'], true) ?: [];

        // emrat nga DB
        $client_name = $invoice['client_name'];
        $address     = $invoice['address'];
        $phone     = $invoice['phone'];
        $date        = $invoice['date'];
        $comment     = $invoice['comment'];
        $phone       = isset($invoice['phone']) ? $invoice['phone'] : '';
        $total_sum   = $invoice['total_price_invoice'];
        $prepayment  = $invoice['prepayment_price_invoice'];
        $final_sum_to_pay = $invoice['total_price_left_invoice'];

        // admin short code
        $adminName = $this->session->userdata('prefix_user');

        // TCPDF setup (njësoj si tek sheet_invoice më herët)
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('MJETEPERPUNE');
        $pdf->SetTitle('FATURA');
        $pdf->SetSubject('FATURA');
        $pdf->SetKeywords('FATURA, PDF');

        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->SetFont('dejavusans', '', 8);

        $pdf->AddPage();

        $html = '
                <h1>FATURA: ' . $adminName . '-' . $invoice['id'] . '</h1>
                <p><strong>KLIENTI:</strong> ' . strtoupper($client_name) . '</p>
                <p><strong>ADRESA:</strong> ' . strtoupper($address) . '</p>';

        if (!empty($phone)) {
            $html .= '<p><strong>TELEFONI:</strong> ' . htmlspecialchars($phone, ENT_QUOTES, 'UTF-8') . '</p>';
        }

        $html .= '
                <p><strong>DATA:</strong> ' . htmlspecialchars($date) . '</p>
                <style>
                    .invoice-products {
                        width: 100%;
                        font-size: 12px;
                    }
                    .invoice-products th, .invoice-products td {
                        border: 1px solid black;
                        font-size: 12px;
                        line-height: 1.15;
                    }
                    .invoice-products th {
                        background-color: #f2f2f2;
                        font-weight: bold;
                    }
                    .invoice-products .total_sum td {
                        font-size: 9px;
                        font-weight: bold;
                    }
                </style>
                <table class="invoice-products" cellpadding="2" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width:8%;"> #</th>
                            <th style="width:10%;"> KODI</th>
                            <th style="width:47%;"> EMRI I PRODUKTIT</th>
                            <th style="width:10%;"> SASIA</th>
                            <th style="width:10%;"> ÇMIMI</th>
                            <th style="width:15%;"> TOTALI</th>
                        </tr>
                    </thead>
                    <tbody style="border-right:none;">
            ';

        foreach ($rows as $i => $r) {
            $html .= '
                    <tr>
                        <td style="width:8%;">' . ($i + 1) . '.</td>
                        <td style="width:10%;"> ' . ($r['code']) . '</td>
                        <td style="width:47%;"> ' . strtoupper($r['product_name']) . '</td>
                        <td style="width:10%;"> ' . ($r['quantity']) . '</td>
                        <td style="width:10%;"> ' . ($r['price']) . '</td>
                        <td style="width:15%;"> ' . ($r['total_product_price']) . '</td>
                    </tr>
                ';
        }

        $html .= '
                </tbody>
                <tfoot>
                    <tr class="total_sum">
                        <td colspan="5">TOTALI</td>
                        <td><b> ' . htmlspecialchars($total_sum) . '</b></td>
                    </tr>
                </tfoot>
            ';

        if ($prepayment > 0) {
            $html .= '
                <tfoot>
                    <tr class="total_sum">
                        <td colspan="5">PARAPAGESË</td>
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

        if (!empty($comment)) {
            $commentClean = nl2br(htmlspecialchars($comment, ENT_QUOTES, 'UTF-8'));
            $html .= '
                    <p>Koment: </p><br><span class="comment">' . $commentClean . '<hr></span>';
        }

        $html .= '</table>';

        $pdf->writeHTML($html, true, false, true, false, '');

        // Jep PDF direkt, pa ruajtje ne disk
        $pdf->Output($client_name . '-FATURA-' . $invoice['id'] . '.pdf', 'I');
    }

    public function print_product_invoice($productId)
    {
        if (in_array($this->session->userdata('role'), ['admin', 'sales'])) {
            $product = $this->db->select('id, name, code, price, image')->from('products')->where('id', $productId)->get()->row_array();
            if (!$product) {
                show_404();
            }

            $products['client_name'] = 'QYTETAR';
            $products['address'] = 'KOSOVE';
            $products['phone'] = '';
            $products['date'] = current_datetime();
            $products['comment'] = '';
            $products['product_name'][] = $product['name'];
            $products['code'][] = $product['code'];
            $products['quantity'][] = '1';
            $products['price'][] = $product['price'];
            $products['image'][]   = $product['image'];
            $products['total_product_price'][] = $product['price'];
            $products['total_sum'] = $product['price'];
            $products['prepayment'] = '0.00';
            $products['final_sum_to_pay'] = '0.00';
            $products['total_price_invoice'] = $product['price'];

            $products['prepayment_price_invoice'] = $products['prepayment_price_invoice'] != '' ? number_format($products['prepayment_price_invoice'], 2, '.', '') : '0.00';
            $products['total_price_left_invoice'] = $products['total_price_left_invoice'] != '' ? number_format($products['total_price_left_invoice'], 2, '.', '') : '0.00';

            $products['adminID'] = $this->session->userdata('id');

            $adminName = $this->session->userdata('prefix_user');
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
            $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

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

            $clientInvoice = $this->saveClientInvoice($products);

            $invoiceId = $clientInvoice['id'];

            // pastro output-in nëse ka diçka
            if (ob_get_length()) {
                ob_end_clean();
            }

            $printUrl = base_url('admin/invoices/print_pdf?id=' . $invoiceId);

            echo '<!DOCTYPE html>
                <html>
                <head>
                    <meta charset="utf-8">
                    <title>Printo Faturen</title>
                    <style>
                        html, body {
                            margin:0;
                            padding:0;
                            height:100%;
                        }
                        iframe {
                            width:100%;
                            height:100%;
                            border:none;
                        }
                    </style>
                </head>
                <body>
                    <iframe id="pdfFrame" src="' . htmlspecialchars($printUrl, ENT_QUOTES, "UTF-8") . '"></iframe>

                    <script>
                        const iframe = document.getElementById("pdfFrame");
                        iframe.addEventListener("load", function() {
                            try {
                                iframe.contentWindow.focus();
                                iframe.contentWindow.print();
                            } catch (e) {
                                console.error(e);
                            }
                        });
                    </script>
                </body>
                </html>';

            exit;
        }
    }

    public function debt_invoices()
    {
        if ($this->session->userdata('role') != 'admin') {

            $data['heading'] = 'Mesazhi';
            $data['message'] = 'Nuk keni qasje ne kete faqe';

            $this->load->view(
                'errors/html/error_404',
                $data
            );

            return;
        }


        $_SESSION['title_name'] = 'DETYRIMET E KLIENTEVE';


        /*
        * SEARCH
        */
        $search = trim(
            $this->input->get('search', true)
        );


        $this->db->select("
            debt_clients.*,

            COALESCE(
                SUM(
                    CASE

                        WHEN debt_transactions.type = 'debt'
                        THEN debt_transactions.amount

                        WHEN debt_transactions.type = 'payment'
                        THEN -debt_transactions.amount

                        ELSE 0

                    END
                ),
                0
            ) AS total_debt
        ");


        $this->db->from('debt_clients');


        $this->db->join(
            'debt_transactions',
            'debt_transactions.client_id = debt_clients.id',
            'left'
        );


        /*
        * Kërko sipas emrit ose adresës
        */
        if ($search != '') {

            $this->db->group_start();

            $this->db->like(
                'debt_clients.name',
                $search
            );

            $this->db->or_like(
                'debt_clients.address',
                $search
            );

            $this->db->group_end();
        }


        $this->db->group_by(
            'debt_clients.id'
        );


        $this->db->order_by(
            'debt_clients.name',
            'ASC'
        );


        $data['clients'] = $this->db
            ->get()
            ->result_array();


        $data['search'] = $search;

        $data['page_title'] =
            'LISTA E KLIENTEVE';


        $data['main_content'] =
            $this->load->view(
                'admin/debt-invoices',
                $data,
                TRUE
            );


        $this->load->view(
            'admin/index',
            $data
        );
    }

    public function add_debt_client()
    {
        if ($this->session->userdata('role') != 'admin') {
            show_404();
            return;
        }

        if ($this->input->post()) {

            $name = trim($this->input->post('name'));
            $address = trim($this->input->post('address'));
            $phone = trim($this->input->post('phone'));
            $initialDebt = (float) $this->input->post('initial_debt');

            if ($name == '') {
                $this->session->set_flashdata(
                    'error',
                    'Emri i klientit është i obligueshëm.'
                );

                redirect('admin/invoices/add_debt_client');
                return;
            }

            $clientData = [
                'name' => strtoupper($name),
                'address' => $address ?: null,
                'phone' => $phone ?: null
            ];

            $this->db->insert('debt_clients', $clientData);

            $clientId = $this->db->insert_id();

            if ($initialDebt > 0) {

                $this->db->insert('debt_transactions', [
                    'client_id' => $clientId,
                    'type' => 'debt',
                    'amount' => $initialDebt,
                    'description' => 'Detyrim fillestar'
                ]);
            }

            redirect('admin/invoices/debt_client/' . $clientId);
            return;
        }

        $data['page_title'] = 'SHTO KLIENT';

        $data['main_content'] = $this->load->view(
            'admin/add-debt-client',
            $data,
            TRUE
        );

        $this->load->view('admin/index', $data);
    }

    public function debt_client($clientId)
    {
        if ($this->session->userdata('role') != 'admin') {
            show_404();
            return;
        }

        // Klienti
        $client = $this->db
            ->where('id', $clientId)
            ->get('debt_clients')
            ->row_array();

        if (!$client) {
            show_404();
            return;
        }

        // Merr vetëm 10 transaksionet e para
        $transactions = $this->db
            ->where('client_id', $clientId)
            ->order_by('id', 'DESC')
            ->limit(10)
            ->get('debt_transactions')
            ->result_array();

        // Numri total i transaksioneve
        $totalTransactions = $this->db
            ->where('client_id', $clientId)
            ->count_all_results('debt_transactions');

        // Llogarit detyrimin total nga TË GJITHA transaksionet
        $this->db->select("
            COALESCE(
                SUM(
                    CASE
                        WHEN type = 'debt'
                        THEN amount

                        WHEN type = 'payment'
                        THEN -amount

                        ELSE 0
                    END
                ),
                0
            ) AS total
        ");

        $total = $this->db
            ->where('client_id', $clientId)
            ->get('debt_transactions')
            ->row_array();

        // Data për view
        $data['client'] = $client;
        $data['transactions'] = $transactions;
        $data['total_debt'] = $total['total'];
        $data['total_transactions'] = $totalTransactions;
        $data['per_page'] = 10;

        $data['page_title'] = $client['name'];

        $data['main_content'] = $this->load->view(
            'admin/debt-client-details',
            $data,
            TRUE
        );

        $this->load->view(
            'admin/index',
            $data
        );
    }

    public function add_debt_transaction($clientId)
    {
        if ($this->session->userdata('role') != 'admin') {
            show_404();
            return;
        }

        $type = $this->input->post('type');

        $amount = (float) $this->input->post('amount');

        $description = trim(
            $this->input->post('description')
        );


        if (
            !in_array($type, ['debt', 'payment']) ||
            $amount <= 0
        ) {

            $this->session->set_flashdata(
                'error',
                'Të dhënat nuk janë valide.'
            );

            redirect(
                'admin/invoices/debt_client/' . $clientId
            );

            return;
        }


        $this->db->insert(
            'debt_transactions',
            [
                'client_id' => $clientId,
                'type' => $type,
                'amount' => $amount,
                'description' => $description ?: null
            ]
        );


        redirect(
            'admin/invoices/debt_client/' . $clientId
        );
    }

    public function delete_debt_client($clientId)
    {
        if ($this->session->userdata('role') != 'admin') {
            show_404();
            return;
        }

        $this->db
            ->where('id', $clientId)
            ->delete('debt_clients');

        redirect('admin/invoices/debt_invoices');
    }

    public function search_debt_clients()
    {
        if ($this->session->userdata('role') != 'admin') {
            show_404();
            return;
        }


        $search = trim(
            $this->input->get('search', true)
        );


        $this->db->select("
            debt_clients.*,

            COALESCE(
                SUM(
                    CASE

                        WHEN debt_transactions.type = 'debt'
                        THEN debt_transactions.amount

                        WHEN debt_transactions.type = 'payment'
                        THEN -debt_transactions.amount

                        ELSE 0

                    END
                ),
                0
            ) AS total_debt
        ");


        $this->db->from('debt_clients');


        $this->db->join(
            'debt_transactions',
            'debt_transactions.client_id = debt_clients.id',
            'left'
        );


        if ($search != '') {

            $this->db->group_start();

            // Kërko sipas emrit
            $this->db->like(
                'debt_clients.name',
                $search
            );

            // Kërko sipas adresës
            $this->db->or_like(
                'debt_clients.address',
                $search
            );

            // Kërko sipas numrit të telefonit
            $this->db->or_like(
                'debt_clients.phone',
                $search
            );

            $this->db->group_end();
        }


        $this->db->group_by(
            'debt_clients.id'
        );


        $this->db->order_by(
            'debt_clients.name',
            'ASC'
        );


        $clients = $this->db
            ->get()
            ->result_array();


        if (!empty($clients)) {

            foreach ($clients as $client) {

?>

                <tr
                    class="clickable-row"
                    data-href="<?php echo base_url(
                                    'admin/invoices/debt_client/' . $client['id']
                                ); ?>"
                    style="cursor:pointer;">

                    <td data-label="ID">

                        <?php echo $client['id']; ?>

                    </td>


                    <td data-label="Emri i Klientit">

                        <span class="client-name">

                            <?php echo htmlspecialchars(
                                $client['name'],
                                ENT_QUOTES,
                                'UTF-8'
                            ); ?>

                        </span>

                    </td>


                    <td data-label="Detyrimi Total">

                        <span class="debt-amount">

                            <?php echo number_format(
                                (float)$client['total_debt'],
                                2,
                                '.',
                                ','
                            ); ?> €

                        </span>

                    </td>

                </tr>

            <?php
            }
        } else {

            ?>

            <tr>

                <td
                    colspan="3"
                    class="text-center"
                    style="padding:30px;">

                    Nuk u gjet asnjë klient.

                </td>

            </tr>

<?php
        }
    }

    public function print_debt_pdf($clientId)
    {
        if ($this->session->userdata('role') != 'admin') {

            $data = array();

            $data['heading'] = 'Mesazhi';

            $data['message'] =
                'Nuk keni qasje ne kete faqe';

            $this->load->view(
                'errors/html/error_404',
                $data
            );

            return;
        }


        /*
        * KLIENTI
        */
        $client = $this->db
            ->where('id', $clientId)
            ->get('debt_clients')
            ->row_array();


        if (!$client) {

            show_404();

            return;
        }


        /*
        * TRANSAKSIONET
        *
        * ASC sepse në PDF historia lexohet
        * nga transaksioni më i vjetër tek më i riu.
        */
        $transactions = $this->db
            ->where('client_id', $clientId)
            ->order_by('id', 'ASC')
            ->get('debt_transactions')
            ->result_array();


        /*
        * LLOGARIT DETYRIMI AKTUAL
        */
        $this->db->select("
            COALESCE(
                SUM(
                    CASE

                        WHEN type = 'debt'
                        THEN amount

                        WHEN type = 'payment'
                        THEN -amount

                        ELSE 0

                    END
                ),
                0
            ) AS total
        ");


        $totalData = $this->db
            ->where('client_id', $clientId)
            ->get('debt_transactions')
            ->row_array();


        $totalDebt = (float) $totalData['total'];


        /*
        * TCPDF
        */
        $pdf = new TCPDF(
            PDF_PAGE_ORIENTATION,
            PDF_UNIT,
            PDF_PAGE_FORMAT,
            true,
            'UTF-8',
            false
        );


        /*
        * DOCUMENT INFO
        */
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetAuthor('MJETEPERPUNE');

        $pdf->SetTitle(
            'HISTORIA E DETYRIMIT - ' . $client['name']
        );

        $pdf->SetSubject(
            'HISTORIA E DETYRIMIT'
        );


        /*
        * HEADER / FOOTER
        */
        $pdf->setHeaderFont(
            array(
                PDF_FONT_NAME_MAIN,
                '',
                PDF_FONT_SIZE_MAIN
            )
        );


        $pdf->setFooterFont(
            array(
                PDF_FONT_NAME_DATA,
                '',
                PDF_FONT_SIZE_DATA
            )
        );


        /*
        * FONT
        */
        $pdf->SetDefaultMonospacedFont(
            PDF_FONT_MONOSPACED
        );


        /*
        * MARGINS
        */
        $pdf->SetMargins(
            PDF_MARGIN_LEFT,
            PDF_MARGIN_TOP,
            PDF_MARGIN_RIGHT
        );


        $pdf->SetHeaderMargin(
            PDF_MARGIN_HEADER
        );


        $pdf->SetFooterMargin(
            PDF_MARGIN_FOOTER
        );


        /*
        * PAGE BREAK
        */
        $pdf->SetAutoPageBreak(
            TRUE,
            PDF_MARGIN_BOTTOM
        );


        /*
        * IMAGE SCALE
        */
        $pdf->setImageScale(
            PDF_IMAGE_SCALE_RATIO
        );


        /*
        * FONT QË MBËSHTET Ë / Ç
        */
        $pdf->SetFont(
            'dejavusans',
            '',
            10
        );


        /*
        * ADD PAGE
        */
        $pdf->AddPage();


        /*
        * ESCAPE CLIENT DATA
        */
        $clientName = htmlspecialchars(
            $client['name'],
            ENT_QUOTES,
            'UTF-8'
        );


        $address = !empty($client['address'])
            ? htmlspecialchars(
                $client['address'],
                ENT_QUOTES,
                'UTF-8'
            )
            : '-';


        $phone = !empty($client['phone'])
            ? htmlspecialchars(
                $client['phone'],
                ENT_QUOTES,
                'UTF-8'
            )
            : '-';


        /*
        * HTML
        */
        $html = '

            <h2 style="text-align:center;">
                HISTORIA E DETYRIMIT
            </h2>

            <br>

            <table cellpadding="5">

                <tr>
                    <td width="20%">
                        <strong>KLIENTI:</strong>
                    </td>

                    <td width="80%">
                        ' . $clientName . '
                    </td>
                </tr>

                <tr>
                    <td>
                        <strong>ADRESA:</strong>
                    </td>

                    <td>
                        ' . $address . '
                    </td>
                </tr>

                <tr>
                    <td>
                        <strong>TELEFONI:</strong>
                    </td>

                    <td>
                        ' . $phone . '
                    </td>
                </tr>

                <tr>
                    <td>
                        <strong>DATA:</strong>
                    </td>

                    <td>
                        ' . date('d.m.Y') . '
                    </td>
                </tr>

            </table>

            <br><br>


            <table
                border="1"
                cellpadding="6"
                cellspacing="0"
            >

                <thead>

                    <tr
                        style="
                            background-color:#eeeeee;
                            font-weight:bold;
                        "
                    >

                        <th width="7%" align="center">
                            #
                        </th>

                        <th width="18%">
                            DATA
                        </th>

                        <th width="15%">
                            LLOJI
                        </th>

                        <th width="40%">
                            PËRSHKRIMI
                        </th>

                        <th width="20%" align="right">
                            SHUMA
                        </th>

                    </tr>

                </thead>

                <tbody>
        ';


        /*
        * TRANSAKSIONET
        */
        $nr = 1;

        foreach ($transactions as $transaction) {

            $description = htmlspecialchars(
                $transaction['description'] ?? '',
                ENT_QUOTES,
                'UTF-8'
            );


            $date = date(
                'd.m.Y',
                strtotime(
                    $transaction['created_at']
                )
            );


            if ($transaction['type'] == 'debt') {

                $type = 'DETYRIM';

                $amount =
                    '+ ' .
                    number_format(
                        (float)$transaction['amount'],
                        2,
                        '.',
                        ','
                    ) .
                    ' €';
            } else {

                $type = 'PAGESË';

                $amount =
                    '- ' .
                    number_format(
                        (float)$transaction['amount'],
                        2,
                        '.',
                        ','
                    ) .
                    ' €';
            }


            $html .= '

                <tr>

                    <td
                        width="7%"
                        align="center"
                    >
                        ' . $nr . '
                    </td>

                    <td width="18%">
                        ' . $date . '
                    </td>

                    <td width="15%">
                        ' . $type . '
                    </td>

                    <td width="40%">
                        ' . $description . '
                    </td>

                    <td
                        width="20%"
                        align="right"
                    >
                        <strong>
                            ' . $amount . '
                        </strong>
                    </td>

                </tr>
            ';


            $nr++;
        }


        /*
        * NËSE NUK KA TRANSAKSIONE
        */
        if (empty($transactions)) {

            $html .= '

                <tr>

                    <td
                        colspan="5"
                        align="center"
                    >
                        Nuk ka transaksione.
                    </td>

                </tr>
            ';
        }


        /*
        * TOTALI
        */
        $html .= '

                <tr
                    style="
                        background-color:#eeeeee;
                        font-weight:bold;
                    "
                >

                    <td
                        colspan="4"
                        align="right"
                    >
                        DETYRIM AKTUAL:
                    </td>

                    <td align="right">

                        ' .
            number_format(
                $totalDebt,
                2,
                '.',
                ','
            ) .
            ' €

                    </td>

                </tr>

                </tbody>

            </table>
        ';


        /*
        * SHKRUAJ HTML NË PDF
        */
        $pdf->writeHTML(
            $html,
            true,
            false,
            true,
            false,
            ''
        );


        /*
        * PASTRO OUTPUT
        */
        if (ob_get_length()) {

            ob_end_clean();
        }


        /*
        * SHFAQ PDF NË BROWSER
        */
        $pdf->Output(
            'Historia-Detyrimit-' .
                $client['name'] .
                '.pdf',
            'I'
        );

        exit;
    }

    public function print_debt()
    {
        if ($this->session->userdata('role') != 'admin') {
            show_404();
            return;
        }

        $clientId = (int) $this->input->post('client_id');

        if (!$clientId) {
            show_404();
            return;
        }

        if (ob_get_length()) {
            ob_end_clean();
        }

        $printUrl = base_url(
            'admin/invoices/print_debt_pdf/' . $clientId
        );

        echo '<!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">

            <title>Printo Historinë e Detyrimit</title>

            <style>
                html,
                body {
                    margin:0;
                    padding:0;
                    height:100%;
                }

                iframe {
                    width:100%;
                    height:100%;
                    border:none;
                }
            </style>

        </head>

        <body>

            <iframe
                id="pdfFrame"
                src="' .
            htmlspecialchars(
                $printUrl,
                ENT_QUOTES,
                'UTF-8'
            ) .
            '"
            ></iframe>

            <script>

                const iframe =
                    document.getElementById("pdfFrame");

                iframe.addEventListener(
                    "load",
                    function() {

                        try {

                            iframe.contentWindow.focus();

                            iframe.contentWindow.print();

                        } catch (e) {

                            console.error(e);

                        }

                    }
                );

            </script>

        </body>
        </html>';

        exit;
    }

    public function debt_transactions_ajax($clientId)
    {
        if ($this->session->userdata('role') != 'admin') {
            show_404();
            return;
        }

        $page = (int) $this->input->get('page');

        if ($page < 1) {
            $page = 1;
        }

        $perPage = 10;

        $offset = ($page - 1) * $perPage;

        // Numri total
        $totalTransactions = $this->db
            ->where('client_id', $clientId)
            ->count_all_results('debt_transactions');

        // Transaksionet e faqes
        $transactions = $this->db
            ->where('client_id', $clientId)
            ->order_by('id', 'DESC')
            ->limit($perPage, $offset)
            ->get('debt_transactions')
            ->result_array();

        $data['transactions'] = $transactions;
        $data['page'] = $page;
        $data['per_page'] = $perPage;
        $data['total_transactions'] = $totalTransactions;

        $this->load->view(
            'admin/debt-transactions-table',
            $data
        );
    }

    // =============================================================
    // SEARCH KLIENTËT ME DETYRIME NGA FATURA
    // =============================================================
    public function search_debt_clients_invoice()
    {
        if (!in_array($this->session->userdata('role'), ['admin', 'sales'])) {
            $this->output->set_status_header(403)->set_content_type('application/json')->set_output(json_encode([]));
            return;
        }

        $search = trim($this->input->get('search', true));
        if ($search === '') {
            $this->output->set_content_type('application/json')->set_output(json_encode([]));
            return;
        }

        $this->db->select('id, name, address, phone');
        $this->db->from('debt_clients');
        $this->db->group_start()
            ->like('name', $search)
            ->or_like('address', $search)
            ->or_like('phone', $search)
            ->group_end();
        $this->db->order_by('name', 'ASC');
        $this->db->limit(10);

        $clients = $this->db->get()->result_array();
        $this->output->set_content_type('application/json')->set_output(json_encode($clients));
    }

    // =============================================================
    // TRANSFERO FATURËN SI DETYRIM TË KLIENTIT
    // =============================================================

    public function invoice_to_debt()
    {
        $reply = function ($status, $message, $httpCode = 200, $extra = []) {
            return $this->output
                ->set_status_header($httpCode)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode(array_merge([
                    'status' => $status,
                    'message' => $message
                ], $extra), JSON_UNESCAPED_UNICODE));
        };

        if (!in_array($this->session->userdata('role'), ['admin', 'sales'])) {
            return $reply(false, 'Nuk keni qasje.', 403);
        }

        $invoiceId = (int) $this->input->post('invoice_id');
        if ($invoiceId <= 0) {
            return $reply(false, 'ID e faturës nuk është valide.', 400);
        }

        $invoice = $this->db->where('id', $invoiceId)
            ->get('invoices')->row_array();

        if (!$invoice) {
            return $reply(false, 'Fatura nuk u gjet.', 404);
        }

        if (
            $this->session->userdata('role') === 'sales' &&
            (int) $invoice['user_id'] !== (int) $this->session->userdata('id')
        ) {
            return $reply(false, 'Nuk keni qasje në këtë faturë.', 403);
        }

        $hasInvoiceId = $this->db->field_exists('invoice_id', 'debt_transactions');
        $marker = 'FATURA_ID:' . $invoiceId . ' -';

        // Kërko lidhjen edhe në përshkrim: disa transaksione të vjetra
        // mund të jenë krijuar para shtimit të kolonës invoice_id.
        $existing = null;
        if ($hasInvoiceId) {
            $existing = $this->db->where('invoice_id', $invoiceId)
                ->where('type', 'debt')
                ->order_by('id', 'ASC')
                ->get('debt_transactions')->row_array();
        }
        if (!$existing) {
            $existing = $this->db->where('type', 'debt')
                ->like('description', $marker, 'after')
                ->order_by('id', 'ASC')
                ->get('debt_transactions')->row_array();
        }

        $total = (float) $invoice['total_price_invoice'];
        $prepayment = (float) $invoice['prepayment_price_invoice'];
        $newAmount = round(max(0, $total - $prepayment), 2);

        // Për faturë të re si detyrim kërko klientin.
        // Për përditësim mbaj klientin e transaksionit ekzistues.
        if (!$existing) {
            if ($newAmount <= 0) {
                return $reply(false, 'Fatura është paguar plotësisht; nuk ka shumë për detyrim.', 400);
            }

            $clientId = (int) $this->input->post('debt_client_id');
            if ($clientId <= 0) {
                return $reply(false, 'Zgjidhni klientin për regjistrimin e detyrimit.', 400);
            }

            $client = $this->db->where('id', $clientId)
                ->get('debt_clients')->row_array();
            if (!$client) {
                return $reply(false, 'Klienti i zgjedhur nuk u gjet.', 404);
            }

            $insert = [
                'client_id' => $clientId,
                'type' => 'debt',
                'amount' => number_format($newAmount, 2, '.', ''),
                'description' => $marker . 'Detyrimi nga fatura #' . $invoiceId
            ];
            if ($hasInvoiceId) {
                $insert['invoice_id'] = $invoiceId;
            }

            $this->db->trans_begin();

            // Kontroll i dytë brenda transaksionit për të shmangur
            // regjistrimin e dyfishtë nga klikime të përsëritura.
            if ($hasInvoiceId) {
                $already = $this->db->where('invoice_id', $invoiceId)
                    ->where('type', 'debt')->get('debt_transactions')->row_array();
            } else {
                $already = $this->db->where('type', 'debt')
                    ->like('description', $marker, 'after')
                    ->get('debt_transactions')->row_array();
            }
            if ($already) {
                $this->db->trans_rollback();
                return $reply(false, 'Detyrimi është regjistruar tashmë. Rifreskoni faqen dhe provoni përsëri.', 409);
            }

            $ok = $this->db->insert('debt_transactions', $insert);
            if (!$ok || $this->db->trans_status() === false) {
                $this->db->trans_rollback();
                return $reply(false, 'Detyrimi nuk u regjistrua.', 500);
            }
            $this->db->trans_commit();

            return $reply(
                true,
                'Detyrimi prej ' . number_format($newAmount, 2) . ' € u regjistrua me sukses.',
                200,
                ['client_id' => $clientId, 'action' => 'created']
            );
        }

        $clientId = (int) $existing['client_id'];
        $oldAmount = round((float) $existing['amount'], 2);

        if ($newAmount === $oldAmount) {

            // Lidhe me faturën edhe transaksionin e vjetër,
            // nëse më parë kishte vetëm ID-në në përshkrim.
            if ($hasInvoiceId && empty($existing['invoice_id'])) {

                $ok = $this->db
                    ->where('id', (int) $existing['id'])
                    ->where('type', 'debt')
                    ->update('debt_transactions', [
                        'invoice_id' => $invoiceId
                    ]);

                if (!$ok) {
                    return $reply(
                        false,
                        'Lidhja e transaksionit me faturën nuk u ruajt.',
                        500
                    );
                }
            }

            return $reply(
                true,
                'Shuma e detyrimit është e njëjtë. Nuk u ndryshua asgjë.',
                200,
                [
                    'client_id' => $clientId,
                    'action' => 'unchanged'
                ]
            );
        }

        $update = ['amount' => number_format($newAmount, 2, '.', '')];
        if ($hasInvoiceId && empty($existing['invoice_id'])) {
            $update['invoice_id'] = $invoiceId;
        }

        $ok = $this->db->where('id', (int) $existing['id'])
            ->where('type', 'debt')
            ->update('debt_transactions', $update);

        if (!$ok) {
            return $reply(false, 'Detyrimi nuk u përditësua.', 500);
        }

        return $reply(
            true,
            'Detyrimi i faturës u përditësua nga ' .
                number_format($oldAmount, 2) . ' € në ' .
                number_format($newAmount, 2) . ' €.',
            200,
            ['client_id' => $clientId, 'action' => 'updated']
        );
    }
}
