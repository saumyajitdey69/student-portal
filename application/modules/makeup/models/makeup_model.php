<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Makeup_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->config('makeup/makeup_config', TRUE);
		$this->tables = $this->config->item('tables', 'makeup_config');
	}

	public function add_course($course_id, $course_name)
	{
		$db_makeup = $this->load->database('makeup', TRUE);
		$query= $db_makeup->insert($this->tables['courses'], array('course_id'=>$course_id, 'course_name' => $course_name));
		if($db_makeup->affected_rows() > 0)
			return true;
		else
			return false;
	}

	public function get_student_details($userid = '')
	{
		$query = $this->db->where('userid', $userid)
		                  ->select('name, roll_number as roll, registration_number as regno, course as class, branch, mobile as contact')
		                  ->get($this->tables["student_data"]);
		return $query->first_row('array');
	}

	public function get_courses_all($roll='')
	{
		$db_makeup = $this->load->database('makeup', TRUE);
		$query= $db_makeup->where(array('roll_no' => $roll))->get($this->tables['course_details']);
		return $query->result('array');
	}

	public function get_student_info($userid='')
	{
		$db_makeup = $this->load->database('makeup', TRUE);
		$query = $db_makeup->select("rollNo,name,branch,class,transaction_id, transaction_date, paid, id")
				   ->where('userid', $userid)
		           ->order_by("id asc")
		           ->get($this->tables['student_info']);
		if($query->num_rows() > 0)
			 return $query->result('array');
			else
				return false;
	}
	public function get_registered_coursese_list($id = '')
	{   
		$db_makeup = $this->load->database('makeup', TRUE);
		$query = $db_makeup->select("id,subject.course_id,subject.course_name")
				   ->from('subject')
				   ->where('student_info_id', $id)
		           ->order_by("course_id asc")
		           // ->join('courses','courses.course_id= subject.course_id')
		           ->get();


		if($query->num_rows() > 0)
			 return $query->result('array');
			else
				return false;
	}

	public function get_courses($course_id)
	{
		$db_makeup = $this->load->database('makeup', TRUE);
		$query = $db_makeup->select("course_id, course_name")->where('course_id', $course_id)->get($this->tables['courses']);
		return $query->first_row('array');
	}

	public function get_cid_sem_year($roll){
		$db_makeup = $this->load->database('makeup', TRUE);
		$query = $db_makeup->select("course_id,sem,year")->where('roll_no', $roll)->get($this->tables['course_details']);
		return $query->result('array');
	}

	public function update_sem_year($roll,$course_det){
		 $db_makeup = $this->load->database('makeup', TRUE);			
		 $db_makeup->update('subject', $course_det, array('roll_no' => $roll,
		 												 'course_id'=>$course_det['course_id']));
			
	}

	public function update_courses($id='',$year='',$sem='')
	{
		$db_makeup = $this->load->database('makeup', TRUE);
		$data = array(
			'year'=>$year,
			'sem' => $sem
			);
		$query = $db_makeup->update($this->tables['course_details'], $data, array('id' => $id));
		if($db_makeup->affected_rows() == 1)
			return TRUE;
		else
			return FALSE;
	}

	public function update($roll, $details)
	{    $db_makeup = $this->load->database('makeup', TRUE);			
		 $db_makeup->update_batch('subject', $details, array('roll_no' => $roll));
		
	}
	public function register($tid="", $tdate="", $lists=array(), $totamt="", $user_data=array(), $userid)
	{
		$db_makeup = $this->load->database('makeup', TRUE); 
		$data = array(
			'userid'	=> $userid,
			'regId' 	=> $user_data['regno'],
			'rollNo'	=> $user_data['roll'],
			'name'		=> $user_data['name'],
			'branch'	=> $user_data['branch'],
			'class'		=> $user_data['class'],
			'number_of_courses' 	=> count($lists),
			'paid'					=> $totamt,
			'transaction_id' 		=> $tid,
			'transaction_date' 		=>$tdate
			);
		$status = array();
		$query = $db_makeup->insert($this->tables['student_info'],$data);
		if($db_makeup->affected_rows() === 1)
		{
			$id = $db_makeup->insert_id();
			$new_list= array();
			foreach ($lists as $key => $list) {
				$item['course_id'] = $list['course_id'];
				$item['course_name'] = $list['course_name'];
				$item['roll_no'] = $user_data['roll'];
				$item['student_info_id'] = $id;
				$new_list[] = $item;
			}
			$query = $db_makeup->insert_batch($this->tables['course_details'], $new_list);
			if($db_makeup->affected_rows() > 0)
			{
				$status['code'] = true;
			}
			else
			{
				$status['code'] = false;
				if($db_makeup->_error_number() == "1062")
				{
					$status['message'] = 'Some of the courses are already registered. Please check you registered courses and try again';
				}
				else
				{
					$status['message'] = 'Unable to register the courses. Please reload/refresh the page and try again.';
				}
				$query = $db_makeup->where("id", $id)->delete($this->tables['student_info']);
			}
		}
		else
		{
			$status['code'] = false;
			if($db_makeup->_error_number() == "1062")
			{
				$status['message'] = "Duplicate transaction id detected. Please check the transaction id";
			}
			else{
				$status['message'] = 'Unable to add the student information, refresh or reload and try again';
			}		
			
		}

		return $status;
	}
}

/* End of file makeup_model.php */
/* Location: ./application/modules/makeup/models/makeup_model.php */