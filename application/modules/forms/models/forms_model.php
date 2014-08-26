<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forms_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->config('forms/forms_config', TRUE);
	}

	public function get_roll($userid)
	{
		$this->db = $this->load->database('default', TRUE);
		$this->db->select('roll_number')
		         ->from('student_data')
		         ->where('userid',$userid);
		$query_student = $this->db->get();
		if($query_student->num_rows<=0)
			return FALSE;
		return $query_student->first_row()->roll_number;
	}

	public function get_sem($roll)
	{
		$db_reg = $this->load->database('reg', TRUE);
		$xyz = $db_reg->select('roll')
			->where('regno',$roll)
			->from('student')
			->get();
		if($xyz->num_rows >= 1)
			$roll = $xyz->first_row()->roll;
		$db_reg->where('roll', $roll);
		$query = $db_reg->select('sem')
		->from('registered')
		->get();
		if($query->num_rows <= 0)
			return -1;
		elseif($query->num_rows > 1)
			return 0;
		else
			return $query->first_row()->sem;
	}

	public function new_roll($roll)
	{
		$db_reg = $this->load->database('reg', TRUE);
		$xyz = $db_reg->select('roll')
			->where('regno',$roll)
			->from('student')
			->get();
		if($xyz->num_rows >= 1)
			return $xyz->first_row()->roll;
		else
			return FALSE;
	}


	public function get_cgpa($roll)
	{
		$db_result = $this->load->database('results', TRUE);
		$db_result->where('RegNo', $roll);
		$query = $db_result->select_max('Cgpa')
		->from('results_even_2014')
		->get();
		if($query->num_rows <=0)
			return FALSE;
		return $query->first_row()->Cgpa;
	}

	public function check($roll)
	{
		$db_forms = $this->load->database('forms', TRUE);
		$db_forms->where('roll', $roll);
		$query = $db_forms->select('id')
			->from('applications')
			->get();
		if($query->num_rows <= 0)
			return 1;
		else
			return 0;
	}

	public function enter_application($roll, $preference1, $preference2, $position, $question1, $question2, $question3)
	{
		$db_forms = $this->load->database('forms', TRUE);
		$data = array('roll' => $roll, 'preference1' => $preference1, 'preference2' => $preference2, 'post' => $position, 'ques1' => $question1, 'ques2' => $question2, 'ques3' => $question3);
		$insert = $db_forms->insert('applications', $data);	
		return TRUE;
	}

	/*public function dean()
	{
		$db_reg = $this->load->database('reg', TRUE);
		$query = $db_reg->select('roll')
			->from('dean')
			->get();
		foreach($query->result() as $stu)
		{	
			$sem = $this->get_sem($stu->roll);
			if(($sem != -1) || ($sem != 0))
			{
				$data = array('sem'=>$sem);
				$db_reg->where('roll', $stu->roll);
				$update  = $db_reg->update('dean', $data);
			}
		}
		echo "done!!";				
	}*/
	
}