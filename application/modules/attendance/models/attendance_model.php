<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Attendance_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->config('audit/audit_config');
		$this->tables = $this->config->item('tables');
	}

    public function get_roll($userid)
    {
        $this->db = $this->load->database('default',TRUE);
        $query=$this->db->get_where($this->tables['student_data'],array("userid"=>$userid));
        if($query->num_rows()==1)
            return $query->row()->roll_number;
        else
            return FALSE;
    }


	public function get_class_name($class_code)
	{
		$db_register = $this->load->database('reg' , TRUE);
		$query=$db_register->select()
							->from('classes')
							->where(array('class_code'=>$class_code))->get();
		if($query->num_rows()>0)
		{
			return $query->row()->class_name;
		}
		else
			return FALSE;
	}
	public function load_dates($data)
	{
		$db_register = $this->load->database('reg' , TRUE);
		$query=$db_register->select()
							->from($this->tables['attendance_dates'])
							->order_by('date asc')
							->where($data)->get();
		if($query->num_rows()>0)
			return $query->result_array();
		else
			return FALSE;
	}
	public function get_attendance($roll,$course_id,$branch,$sem,$class,$section,$session_id)
	{
		$details=array();
		$db_register = $this->load->database('reg' , TRUE);
		$query = $db_register->select('structure_id')
							 ->from($this->tables['regular'])
							 ->where(array('branch' => $branch, 'class' => $class,'sem'=>$sem,'session_id'=>$session_id))
				    		 ->limit(1)
							 ->get();
		//check if structure id exists
		 if($query->num_rows()==1)
		 {
		 	$structure_id=$query->row()->structure_id;
		 }
		 else
		 {
		 	$details['status']=0;
		 	$details['msg']="Course structure is not valid";
		 	return $details;
		 }
		$details_of_course=array(
			'structure_id'=>$structure_id,
			'course_id'=>$course_id,
			'section'=>$section
			);
		$classes_held=$this->load_dates($details_of_course);
		if($classes_held==FALSE)
		{
			$details['status']=1;
		 	$details['msg']="No classes held";
		 	return $details;
		}
		else
		{
			//classes held
			$details['status']=2;
			$details['no_classes']=0;
			$details['no_classes_attended']=0;
			foreach ($classes_held as $key => $value) {
				$uid=$classes_held[$key]['id'];
				$details['no_classes']+=$classes_held[$key]['no_hours'];
				$check=$db_register->select()
									->from($this->tables['attendance_record'])
									->where(array('id'=>$uid,'rollno'=>$roll))
									->limit(1)
									->get();
				if($check->num_rows()==0)
				{
					$details['no_classes_attended']+=$classes_held[$key]['no_hours'];
				}
			}
			return $details;
		}
	}
}