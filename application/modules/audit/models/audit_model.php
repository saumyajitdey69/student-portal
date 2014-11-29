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
		$query = $this->db->get();
		if ($query->num_rows() == 1) {
			return $query->first_row();
		} else {
			return false;
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
	
	public function profile_edited($userid)
	{
		$this->db->select('')->from($this->tables['student_auth'])->where(array('id' => $userid, 'profile_edited' => 1))->limit(1);
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
