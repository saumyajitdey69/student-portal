<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Audit_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->config('audit/audit_config', TRUE);
		$this->tables = $this->config->item('tables','audit_config');
	}

	public function get($userid)
	{
		$this->db->select()->from($this->tables['student_data'])->where(array('userid' => $userid))->limit(1);
		$this->db->get();
		if ($query->num_rows() == 1) {
			return $query->first_row();
		} else {
			return false;
		}
	}

	// @author: Vaibhav Awachat

	public function get_public_profile($username = "")
	{
		$this->db->select('first_name, last_name, email, phone, roll_number, registration_number, joining_year, branch');
		$query=$this->db->join($this->tables['student_auth'].' as auth ', 'auth.id = data.userid')
					    ->limit(1)
					    ->where('username', $username)
					    ->get($this->tables['student_data'].' as data');
		if($query->num_rows()>0)
			return $query->first_row();
		else
			return FALSE;
	}

// @author: Vaibhav Awachat

	public function getSeachItem($searchStr = "", $json = true, $count = 5)
	{
		if(!empty($searchStr)){


		}
		else{
			$data = array();
			$data['roll_number'] = "000000";
			$data['name'] = 'No Input String';
		}
		if($json){
			return json_encode($data);
		}
		else{
			return $data;
		}

	}

	public function get_correct_details($userid)
	{
		$this->db->select()->from($this->tables['student_auth'])->where(array('id' => $userid))->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 1) {
			return $query->first_row();
		} else {
			return false;
		}
	}

	public function update($userid, $details)
	{
		$query = $this->db->update($this->tables['student_data'], $details, array('userid' => $userid));
		if ($this->db->affected_rows() >= 0) {
			$this->db->update($this->tables['student_auth'], array('profile_edited' => 1,
					'first_name'=>$details['name'],
					'phone'=>$details['mobile'],
					'email'=>$details['email']
				 	), array('id' => $userid));
			
			if ($this->db->affected_rows() >= 0) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	public function profile_edited($userid = '')
	{
		if(empty($userid)) return false; // need to make some changes here @awachat like passing proper information with cause
		$this->db->select('id')->from($this->tables['student_auth'])->where(array('id' => $userid, 'profile_edited' => 1))->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() === 1) {
			return true;
		} else {
			return false;
		}
	}

	public function change_email($userid)
	{

	}

}
