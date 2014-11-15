<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Import_data extends CI_Model
{
	public function __construct()
	{
		parent::__construct();

	}
	public function finalize_import($userid)
	{
		$this->old_db=$this->load->database('old_student',TRUE,TRUE);
		$query = $this->old_db->update('student_auth', array('imported'=>'1'), array('userid' => $userid));
		if ($this->old_db->affected_rows() >= 0) {
			return TRUE;
		}
		else
			return FALSE;
	}
	public function check_username($username)
	{
		$this->old_db=$this->load->database('old_student',TRUE,TRUE);
		$query = $this->old_db->get_where('student_data', array('username' => $username));
		if ($query->num_rows() >= 0) {
			return FALSE;
		}
		else
			return TRUE;
	}
	public function check($id,$pass)//can be email or userid
	{
		$this->old_db=$this->load->database('old_student',TRUE,TRUE);
		$status=array();
		$password=md5($pass);
		$username=$id;
		$import_student_data=NULL;
		$import_auth_data=NULL;
		if(filter_var($id, FILTER_VALIDATE_EMAIL)) {
			//valid mail id
        	$query=$this->old_db->get_where('student_data',array('email'=>$id));
        	if($query->num_rows()==1)
        	{
        		//valid email of student registered
        		$userid=$query->row()->userid; //get user id
        		$query2=$this->old_db->get_where('student_auth',array('userid'=>$userid));
        		if($query2->num_rows()==1)
        		{
        			$username=$query2->row()->username;
        			$import_auth_data=$query2->row();
        			$import_student_data=$query->row();
        		}
        		else
        		{
        			return FALSE;
        		}
        	}
        	else
        		return FALSE;//wrong email id given,has to register again
		}
		$credentials=array(
			'username'=>$username,
			'password'=>$password
			);
		$query=$this->old_db->get_where('student_auth',$credentials);
		if ($query->num_rows() == 1) {
			$status['success']=1;
			if($import_student_data==NULL) //not and email id
			{
				$query_student_data=$this->old_db->get_where('student_data',array('username'=>$id));
				$import_student_data=$query_student_data->first_row('array');
			}
			if($import_auth_data==NULL) 
			{
				$import_auth_data=$query->first_row('array');
			}
			$status['student_data']=$import_student_data;
			$status['auth_data']=$import_auth_data;
			return $status;
		} else {
			$this->db->select('')->from('student_auth')->where(array('username' => $credentials['username']))->limit(1);
			$query = $this->db->get();
			if ($query->num_rows() == 0) {
				$status['success']=0;
				$status['message']="Username/Password invalid";
				return $status;
			} else {
				return false;
			}
		}
	}
}

?>