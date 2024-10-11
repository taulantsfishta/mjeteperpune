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
use PhpOffice\PhpSpreadsheet\IOFactory;

class Test extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        check_login_user();
        $db = $this->load->database();
        $this->load->model('common_model');
        $this->load->model('login_model');

        $this->category_id = 19;
    }

    public function index()
    {

        $excelFilePath = $this->category_id.'.xlsx';
        $spreadsheet = IOFactory::load($excelFilePath);
        $worksheet = $spreadsheet->getActiveSheet();

        $dataArray = [];

        foreach ($worksheet->getRowIterator() as $rowNumber => $row) {
            $rowData = ['row_number' => $rowNumber];

            $cellD = $worksheet->getCell('D' . $rowNumber);
            $cellE = $worksheet->getCell('E' . $rowNumber);

            $rowData['column_D'] = $cellD->getValue();
            $rowData['column_E'] = $cellE->getValue();

            $dataArray[] = $rowData;
        }

        $jsonData = json_encode($dataArray, JSON_PRETTY_PRINT);

        $jsonFilePath = __DIR__ . '/'. $this->category_id.'.json';
        file_put_contents($jsonFilePath, $jsonData);
    }


    public function readFromJsonFileAndAppendImage()
    {
        $jsonFilePath = __DIR__ . '/'.$this->category_id.'.json';
        $jsonContent = file_get_contents($jsonFilePath);

        $dataArray = json_decode($jsonContent, true);
        $data = [];

        $lastUsedCode = $this->db->select('code')->from('products')->where('id', $this->category_id)->order_by('code', 'desc')->limit(1)->get()->row_array();
        $nextCode = $lastUsedCode ? $lastUsedCode['code'] + 1 : 1;

        foreach ($dataArray as $key => $value) {
            if ($value['row_number'] > 1 && $value['row_number'] < 227) {
                $data[] = [
                    'name' => $value['column_D'],
                    'price' => $value['column_E'],
                    'image' => $this->category_id.'-' . $value['row_number'] . '.jpg',
                    'category_id' => $this->category_id,
                    'code' => $this->category_id.'-'.$nextCode,
                    'created_at' => current_datetime()
                ];

                $nextCode++; 
            }
        }

        $this->common_model->insert_batch($data, 'products');
    }
}



?>
