<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		// get the table names from audit module
		$this->load->config('audit/audit_config', TRUE);
		$this->tables = $this->config->item('tables','audit_config');
	}

	// @author: Vaibhav Awachat
	// This function can retrieve any information of student
	// send the comma seperated list of columns required
	// default list is the public profile columns
	// $json false means, it will not give json output, json true means output is json
	// $array = true means , output is an array and false mean output is an object ( valid when json is false),
	//$single = true means first row only, false means complete results (multiple rows)
	// $where contains the array of where query (It should be passed always, cannot be blank)
	// $order is order by query
	public function get($where = array(), $single = false, $column = 'first_name, last_name, email, phone, username, roll_number, registration_number, joining_year, gender', $json = false, $array = true,  $order = 'first_name asc, roll_number asc, joining_year asc')
	{
		// default db is connected to students
		$this->db->select($column)
				 ->where($where)
				 ->from($this->tables['student_auth'].' as auth')
				 ->join($this->tables['student_data'].' as data', 'auth.id = data.userid', 'inner');
		if($single)
			$this->db->limit(1);

		$this->db->order_by($order);

		$query = $this->db->get();
		if($query->num_rows() > 0){
			if($single)
				if($json)
					return json_encode($query->first_row());
				else if($array)
					return $query->first_row('array');
				else
					return $query->first_row();
			else
				if($json)
					return json_encode($query->result());
				else if($array)
					return $query->result('array');
				else
					return $query->result();
		}
		else{
			return false;
		}
	}

}

/* End of file profile_model.php */
/* Location: ./application/modules/profile/models/profile_model.php */