<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Results_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//$this->load->config('results_config');
		//$this->tables = $this->config->item('tables', 'results_config');
		// $this->tables = array("results" => "results_odd_2013", "status" => "info_odd_2013", "subject_code" => "subjects_odd_2013", "feedback" =>"student_feedback", "student" =>"student_data"); 
		$this->tables = array("results" => "results_even_2014", "status" => "info_even_2014", "subject_code" => "subjects_even_2014", "feedback" =>"student_feedback", "student" =>"student_data"); 
	}
	
	public function list_all_results($rollno)
	{
		$results_db = $this->load->database('results', TRUE);
		$query = $results_db->select()
		->join($this->tables['subject_code'], $this->tables['results'].'.'.'reference_id'.'='.$this->tables['subject_code'].'.'.'reference_id')
		->join($this->tables['status'], $this->tables['results'].'.'.'reference_id'.'='.$this->tables['status'].'.'.'reference_id')
		->where('RegNo', $rollno)
		->from($this->tables['results'])
		->get();
		if(!empty($query) and $query->num_rows() > 0)
			return $query->result('array');
		else
			return FALSE;
	//return $this->tables;
	}

	public function check_feedback($userid = '', $rollno='')
	{
		$old_db=$this->load->database('default',TRUE);
		$query = $old_db->select('feedback, final_year')
		->where(array('userid' => $userid))
		->from($this->tables['feedback'])
		->get();
		$status = array();
		if($query->num_rows() === 1)
		{
			$feedback = $query->first_row()->feedback;
			$final_year = $query->first_row()->final_year;
			$fcount = 0;
			for ($i=0; $i < strlen($feedback); $i++) { 
				if($feedback[$i] == 1)
				{
					$fcount++;
				}
			}
			// if($this->_is_result_blocked($rollno) === TRUE)
			// {
			// 	$status['code'] = false;
			// 	$status['message'] = 'Your results are blocked. Please contact Associate Dean Examination for further details. <br> WSDC does not have results of these students.';
			// 	return $status;
			// }
			$register_db = $this->load->database('reg', TRUE);
			$query = $register_db->select()->where('roll', $rollno)->get('registered');
			if($query->num_rows() == 0)
			{
				//may be 1st year
				$student_db = $this->load->database('default', TRUE);
				$query2=$student_db->get_where($this->tables['student'],array("userid"=>$userid));
				if($query2->num_rows()==1)
				{
				$regno=$query2->row()->registration_number;
				$register_db = $this->load->database('reg', TRUE);
				$query = $register_db->select()->where('roll', $regno)->get('registered');
				}
			}
			$registered = $query->result('array');
			$register_db->close();
			$rcount = 0;
			foreach ($registered as $key => $reg) {
				for($j=1; $j<= 15; $j++)
				{
					if($reg['c'.$j] != null)
					{
						$rcount++;
					}
				}
			}
			$status['rcount']=$rcount;
			$status['fcount']=$fcount;
			if($rcount == $fcount)
			{
				if($final_year == '1')
				{
					if($this->_check_exit_feedback($userid) == true)
					{
						$status['code'] = true;
						return $status;
					}
					else
					{
						$status['code'] = false;
						$status['number'] = '1';
						$status['message'] = 'You did not fill the exit feedback.';
						return $status;
					}
				}
				else
				{
					$status['code'] = true;
					return $status;
				}
			}
			else
			{
				$status['code'] = false;
				$status['number'] = '1';
				$status['message'] = 'You did not fill the academic feedback';
				return $status;
			}
		}
		else
		{
			$status['code'] = false;
			$status['message'] = 'You did not fill the academic feedback';
			return $status;
		}
	}

	public function _is_result_blocked($roll='')
	{
		$results_db = $this->load->database('results', TRUE);
		$query = $results_db->select('roll')->where('roll', $roll)->get('allowed');
		if($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	public function _is_allowed_for_feedback($roll='')
	{
		$results_db = $this->load->database('results', TRUE);
		$query = $results_db->select('roll')->where('roll', $roll)->get('allowed_2014odd');
		if($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	public function _check_exit_feedback($userid = '')
	{
		$feedback_db = $this->load->database('default', TRUE);
		$query = $feedback_db->select('userid')->where('userid', $userid)->get('exit_feedback');
		if($query->num_rows() === 1)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	public function get_userid($roll)
	{
		$this->db->select('userid')->from('student_data')->where(array('roll_number' => $roll))->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 1) {
			return $query->first_row()->userid;
		} else {
			return false;
		}
	}
	public function get_roll_number($userid)
	{
		$this->db->select('roll_number')->from('student_data')->where(array('userid' => $userid))->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 1) {
			return $query->first_row()->roll_number;
		} else {
			return false;
		}
	}
	public function get_old_user_id($roll)
	{
		$old_db=$this->load->database('student',TRUE,TRUE);
		$old_db->select('userid')->from('student_data')->where(array('roll_number' => $roll))->limit(1);
		$query = $old_db->get();
		if ($query->num_rows() == 1) {
			return $query->first_row()->userid;
		} else {
			return false;
		}
	}

// public function get_subjects($reference_id)
// {
// 	$results_db = $this->load->database('results', TRUE);
// 	$query = $results_db->select()
// 						->where('reference_id', $reference_id)
// 						->from($this->tables['subject_code'])
// 						->get();
// 	if($query->num_rows() > 0)
// 		return $query->result();
// 	else
// 		return FALSE;
// }

}

/* End of file results_model.php */
/* Location: ./application/modules/audit/models/results_model.php */