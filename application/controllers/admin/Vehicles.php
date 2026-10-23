<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Vehicles extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        check_login_user();

        // Vetëm admini ka qasje
        if ($this->session->userdata('role') != 'admin') {
            show_404();
            exit;
        }
    }


    // =====================================================
    // LISTA E VETURAVE
    // =====================================================

    public function index()
    {
        $data = array();

        $_SESSION['title_name'] = 'VETURAT E KOMPANISË';

        $data['page_title'] = 'LISTA E VETURAVE';


        $data['vehicles'] = $this->db
            ->from('company_vehicles')
            ->order_by('registration_expiry', 'ASC')
            ->get()
            ->result_array();


        $data['main_content'] = $this->load->view(
            'admin/vehicles',
            $data,
            TRUE
        );


        $this->load->view(
            'admin/index',
            $data
        );
    }


    // =====================================================
    // FAQJA - SHTO VETURË
    // =====================================================

    public function add()
    {
        $data = array();

        $_SESSION['title_name'] = 'SHTO VETURË';

        $data['page_title'] = 'SHTO VETURË';


        $data['main_content'] = $this->load->view(
            'admin/add-vehicle',
            $data,
            TRUE
        );


        $this->load->view(
            'admin/index',
            $data
        );
    }


    // =====================================================
    // RUAJ VETURËN E RE
    // =====================================================


    public function store()
    {
        if ($this->session->userdata('role') !== 'admin') {
            show_404();
            return;
        }

        if ($this->input->method(TRUE) !== 'POST') {
            show_404();
            return;
        }

        $plateNumber = strtoupper(trim(
            (string) $this->input->post('plate_number')
        ));

        // Largo hapesirat e panevojshme
        $plateNumber = preg_replace('/\s+/', '', $plateNumber);

        $brand = strtoupper(trim(
            (string) $this->input->post('brand')
        ));

        $model = strtoupper(trim(
            (string) $this->input->post('model')
        ));

        $registrationExpiry = trim(
            (string) $this->input->post('registration_expiry')
        );

        $currentKm = trim(
            (string) $this->input->post('current_km')
        );

        $respond = function ($status, $message, $code = 200) {
            return $this->output
                ->set_status_header($code)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode([
                    'status' => $status,
                    'message' => $message
                ]));
        };

        if ($plateNumber === '' || $registrationExpiry === '') {
            return $respond(
                false,
                'Targa dhe data e regjistrimit jane obligative.',
                422
            );
        }

        // Validimi i dates
        $date = DateTime::createFromFormat(
            '!Y-m-d',
            $registrationExpiry
        );

        if (!$date || $date->format('Y-m-d') !== $registrationExpiry) {
            return $respond(
                false,
                'Data e regjistrimit nuk eshte valide.',
                422
            );
        }

        // Kilometrat jane opsionale
        if (
            $currentKm !== '' &&
            (!ctype_digit($currentKm) || (float)$currentKm > 2147483647)
        ) {

            return $respond(
                false,
                'Kilometrat duhet te jene numer pozitiv.',
                422
            );
        }

        // Kontrollo targen pa dallim shkronjash,
        // hapesirash dhe vizash.
        $normalizedPlate = str_replace('-', '', $plateNumber);

        $existing = $this->db->query(
            "SELECT id
         FROM company_vehicles
         WHERE REPLACE(
             REPLACE(UPPER(plate_number), '-', ''),
             ' ', ''
         ) = ?
         LIMIT 1",
            [$normalizedPlate]
        )->row_array();

        if ($existing) {
            return $respond(
                false,
                'KJO VETURE ESHTE E REGJISTRUAR NE SISTEM!',
                409
            );
        }

        $insertData = [
            'plate_number' => $plateNumber,
            'brand' => $brand !== '' ? $brand : null,
            'model' => $model !== '' ? $model : null,
            'registration_expiry' => $registrationExpiry,
            'current_km' => $currentKm !== ''
                ? (int)$currentKm
                : null,
            'status' => 1
        ];

        $insert = $this->db->insert(
            'company_vehicles',
            $insertData
        );

        if (!$insert) {
            return $respond(
                false,
                'Gabim gjate ruajtjes se vetures.',
                500
            );
        }

        return $respond(
            true,
            'Vetura u regjistrua me sukses.'
        );
    }



    // =====================================================
    // FAQJA - NDRYSHO VETURËN
    // =====================================================

    public function edit($id)
    {
        $id = (int)$id;


        if ($id <= 0) {
            show_404();
            return;
        }


        $vehicle = $this->db
            ->from('company_vehicles')
            ->where('id', $id)
            ->limit(1)
            ->get()
            ->row_array();


        if (!$vehicle) {
            show_404();
            return;
        }


        $data = array();

        $_SESSION['title_name'] = 'NDRYSHO VETURËN';

        $data['page_title'] = 'NDRYSHO VETURËN';

        $data['vehicle'] = $vehicle;


        $data['main_content'] = $this->load->view(
            'admin/edit-vehicle',
            $data,
            TRUE
        );


        $this->load->view(
            'admin/index',
            $data
        );
    }


    // =====================================================
    // PËRDITËSO VETURËN
    // =====================================================

    public function update($id)
    {
        $id = (int)$id;


        if ($id <= 0) {
            show_404();
            return;
        }


        $vehicle = $this->db
            ->from('company_vehicles')
            ->where('id', $id)
            ->limit(1)
            ->get()
            ->row_array();


        if (!$vehicle) {
            show_404();
            return;
        }


        $plateNumber = strtoupper(
            trim(
                $this->input->post('plate_number')
            )
        );


        $brand = strtoupper(
            trim(
                $this->input->post('brand')
            )
        );


        $model = strtoupper(
            trim(
                $this->input->post('model')
            )
        );


        $registrationExpiry =
            trim(
                $this->input->post('registration_expiry')
            );


        $currentKm =
            trim(
                $this->input->post('current_km')
            );


        if (
            empty($plateNumber) ||
            empty($registrationExpiry)
        ) {

            $this->session->set_flashdata(
                'error',
                'Targa dhe data e regjistrimit janë obligative.'
            );

            redirect(
                'admin/vehicles/edit/' . $id
            );

            return;
        }


        // Kontrollo targën, por mos e numëro veturën aktuale
        $exists = $this->db
            ->from('company_vehicles')
            ->where('plate_number', $plateNumber)
            ->where('id !=', $id)
            ->count_all_results();


        if ($exists > 0) {

            $this->session->set_flashdata(
                'error',
                'Një veturë tjetër me këtë targë ekziston.'
            );

            redirect(
                'admin/vehicles/edit/' . $id
            );

            return;
        }


        $updateData = [

            'plate_number' =>
            $plateNumber,

            'brand' =>
            $brand !== ''
                ? $brand
                : null,

            'model' =>
            $model !== ''
                ? $model
                : null,

            'registration_expiry' =>
            $registrationExpiry,

            'current_km' =>
            $currentKm !== ''
                ? (int)$currentKm
                : null,

            'updated_at' =>
            date('Y-m-d H:i:s')
        ];


        $this->db
            ->where('id', $id)
            ->update(
                'company_vehicles',
                $updateData
            );


        $this->session->set_flashdata(
            'success',
            'Vetura u përditësua me sukses.'
        );


        redirect('admin/vehicles');
    }


    // =====================================================
    // FSHIJE VETURËN
    // =====================================================

    public function delete($id)
    {
        $id = (int)$id;


        if ($id <= 0) {
            show_404();
            return;
        }


        $vehicle = $this->db
            ->from('company_vehicles')
            ->where('id', $id)
            ->limit(1)
            ->get()
            ->row_array();


        if (!$vehicle) {

            $this->session->set_flashdata(
                'error',
                'Vetura nuk u gjet.'
            );

            redirect('admin/vehicles');
            return;
        }


        $delete = $this->db
            ->where('id', $id)
            ->delete('company_vehicles');


        if ($delete) {

            $this->session->set_flashdata(
                'success',
                'Vetura u fshi me sukses.'
            );
        } else {

            $this->session->set_flashdata(
                'error',
                'Vetura nuk u fshi.'
            );
        }


        redirect('admin/vehicles');
    }
}
