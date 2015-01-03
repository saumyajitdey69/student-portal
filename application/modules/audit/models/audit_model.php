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
		$query = $this->db->select()->from($this->tables['student_data'])->where(array('userid' => $userid))->limit(1)->get();
		if ($query->num_rows() == 1) {
			return $query->first_row();
		} else {
			return false;
		}
	}

	// @author: Vaibhav Awachat
	// this is of no use
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
		$student_data_array=$details;
		unset($student_data_array['email']);
		$query = $this->db->update($this->tables['student_data'], $student_data_array, array('userid' => $userid));
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
//an attempt to minimise auth related issues. @shashi
	public function swap_password()
	{
		$db_audit = $this->load->database('old_student', TRUE);
		//$this->db->query('update student_auth as stu join student_data as s on s.userid = stu.userid set stu.password = s.password where s.userid = stu.userid');
		$k=1;
		$pass = "d41d8cd98f00b204e9800998ecf8427e";
		$data = $db_audit->select('userid')
				->from('student_auth')
				->where('password', $pass)
				->get();
		//print_r($data->result());
		foreach($data->result() as $stu)
		{
			$p = $db_audit->select('password')
				->from('student_data')
				->where('userid', $stu->userid)
				->get();
			//print_r($p->result());
			$pa = $p->row_array();
			$pas=array('password'=>$pa['password']);
			$query = $db_audit->update('student_auth',$pas, array('userid'=> $stu->userid));
			$k++;
		}
		echo $k;
	}

}
