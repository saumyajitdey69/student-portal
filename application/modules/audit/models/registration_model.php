<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registration_model extends CI_Model {

    public function __construct()
    {
       parent::__construct();
    }

    public function get_student_details($roll_number)
    {
        $this->db->select()
                 ->from('registration_list')
                 ->where(array('roll_number' => $roll_number))->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() !== 1) {
            // $this->db->select('')->from('student_data')->where('roll_number', $roll_number)->limit(1);
            // $det = $this->db->get();
            // if ($det->num_rows() !== 1) {
            //     return false;
            // } else if () {

            // }
            return false;
        } else {
            $result = $query->result_array();
            $student= $result[0];
            return $student;
        }
    }
   

}

/* End of file registration.php */
/* Location: ./application/models/registration.php */