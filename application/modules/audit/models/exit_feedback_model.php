<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exit_feedback_model extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->config('audit/audit_config', TRUE);
		$this->tables = $this->config->item('tables','audit_config');
	}
	private function create_string($arr)
	{
		$str="";
		for($i=0;$i<sizeof($arr);$i++)
		{
			if($arr[$i]=="")
				$str=$str."0";
			else
				$str=$str.$arr[$i];
		}
		return $str;
	}
    public function is_final_year($userid)
	{
		$db_register=$this->load->database('default',TRUE);
		$query=$db_register->get_where($this->tables['student_feedback'],array('userid'=>$userid));
		if($query->num_rows()==1)
		{
			if($query->row()->final_year==1)
				return 1;
			else
				return 0;
		}
		else
			return FALSE;
	}
	public function exit_feedback_status($userid)
	{
		$db_register=$this->load->database('default',TRUE);
		$query=$db_register->get_where($this->tables['exit_feedback'],array('userid'=>$userid));
		if($query->num_rows()==1)
			return 1;
		else
			return 0;
	}
	public function insert_exit_feedback_data($userid,$post_data){

		$data=$post_data;
		$data['userid']=$userid;
		$data['academicsA']=$this->create_string($post_data['academicsA']);
		$data['academicsB']=$this->create_string($post_data['academicsB']);
		$data['academicsC']=$this->create_string($post_data['academicsC']);
		$data['experiences']=$this->create_string($post_data['experiences']);
		$data['goals']=$this->create_string($post_data['goals']);
		$data['extra-curricular']=$this->create_string($post_data['extra-curricular']);
		$data['changes']=$this->create_string($post_data['changes']);
		$data['overallA']=$this->create_string($post_data['goals']);
		$data['overallB']=$this->create_string($post_data['overallB']);
		$data['overallC']=$this->create_string($post_data['overallC']);
		$db_register=$this->load->database('default',TRUE);
		$db_register->insert($this->tables['exit_feedback'],$data); 
	}
}