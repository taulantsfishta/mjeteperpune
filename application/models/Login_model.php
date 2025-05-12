<?php
class Login_model extends CI_Model
{

    public function edit_option_md5($action, $id, $table)
    {
        $this->db->where('md5(id)', $id);
        $this->db->update($table, $action);
        return;
    }

    //-- check post email
    public function check_email($email)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('email', $email);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }


    // check valid user by id
    public function validate_id($id)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('md5(id)', $id);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function insert($data, $table)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }



    //-- check valid user
    function validate_user()
    {

        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('first_name', $this->input->post('user_name'));
        $this->db->where('password', $this->safe_b64encode($this->input->post('password')));
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            $user = $query->result();
            if ($user[0]->status == 0) {
                return false;
            }

            return $query->result();
        } else {
            return false;
        }
    }

    public function update_user_session($user_id, $session_id)
    {
        $this->db->where('id', $user_id);
        $this->db->update('user', ['session_id' => $session_id]);
    }

    public function check_login_session($userId){
        if(!empty($userId)){
            $this->db->select('*');
            $this->db->from('user');
            $this->db->where('id', $userId);
            $this->db->limit(1);

            $query = $this->db->get();
            $user = $query->result();

            if ($user[0]->session_id != session_id()) {
                $ci = get_instance();
	            $ci->session->sess_destroy();
	            redirect(base_url() . 'auth', 'refresh');
	        }

        }
    }

    public  function safe_b64encode($string)
    {
        $data = base64_encode($string);
        $data = str_replace(array('+', '/', '='), array('-', '_', ''), $data);
        return $data;
    }
}
