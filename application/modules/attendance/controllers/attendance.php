<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Attendance extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('attendance_model');
	}
	public function even_sem14_15()
	{
		$data['title']="Attendance";
		$data['current_section'] = 'audit';
		$data['current_page'] = "attendance_even";
		// load registered data
		$userid=$this->user_id;
		$this->load->model('audit/slip_model');
		$this->load->model('attendance/attendance_model');
		$roll = $this->attendance_model->get_roll($userid);
		$rows_data = $this->slip_model->get_registered_detail($roll,'reg_2014_15_even');

		$data['regular_courses']['reg_course_id'] = array();
		$data['regular_courses']['reg_course_name'] = array();
		$data['regular_courses']['reg_course_credit'] = array();
		$data['regular_courses']['reg_study_exam'] = array();

		$data['backlog_courses']['reg_course_id'] = array();
		$data['backlog_courses']['reg_course_name'] = array();
		$data['backlog_courses']['reg_course_credit'] = array();
		$data['backlog_courses']['reg_study_exam'] = array();
		if(empty($rows_data))
		{
			$this->session->set_flashdata('danger', 'Student is not yet registered. Please check the roll number or register the student');
			redirect('audit/home');
			return;
		}
		$count = 0;
		$data['reg_credits_study']=0;
		$data['reg_credits_study_exam']=0;
		foreach($rows_data as $raw_data)
		{
			$temp=array();

			if($raw_data['backlog']=='0')
			{
				$data['regular_courses']['reg_course_id'] = array();
				$data['regular_courses']['reg_course_name'] = array();
				$data['regular_courses']['reg_course_credit'] = array();
				$data['regular_courses']['reg_study_exam'] = array();
				
				$data['backlog_courses']['reg_course_id'] = array();
				$data['backlog_courses']['reg_course_name'] = array();
				$data['backlog_courses']['reg_course_credit'] = array();
				$data['backlog_courses']['reg_study_exam'] = array();
			    $data['roll_number'] = $raw_data['roll']; // this is required to delete, please do not rename the variable or do not remove it @awachat
			    
			    $data['reg_roll'] = $raw_data['roll'];
			    $data['reg_name'] = $raw_data['name'];
			    $data['reg_branch'] = $raw_data['branch_name'];
			    $data['reg_semester'] = $raw_data['sem'];
			    $data['reg_course'] = $raw_data['class_name'];
			    $data['reg_section'] = $raw_data['sec'];
			    $data['reg_credits_study'] += $raw_data['scredits'];
			    $data['reg_credits_study_exam'] += $raw_data['secredits'];
			    
			    $temp=json_decode($raw_data['regular_courses']);
			    // var_dump($temp);
			    foreach ($temp as $key => $value) {				
			    	$data['regular_courses']['reg_course_id'][$key] = $temp[$key]->cid;
					$data['regular_courses']['reg_course_name'][$key] = $temp[$key]->cname;
					$data['regular_courses']['reg_course_credit'][$key] = $temp[$key]->credits;
					$data['regular_courses']['reg_study_exam'][$key] = $temp[$key]->type;
					if($temp[$key]->type==="e")
						$data['regular_courses']['attendance_details'][$key]['status']=4;
					else
						$data['regular_courses']['attendance_details'][$key]=$this->attendance_model
																		->get_attendance($raw_data['roll'],
																		$temp[$key]->cid,
																		$raw_data['branch'],
																		$raw_data['sem'],
																		$raw_data['class'],
																		$raw_data['sec'],$raw_data['session_id'],'reg_2014_15_even',$temp[$key]->batch);
			    }

			}
			else
			{
				
				$temp=json_decode($raw_data['regular_courses']);
				foreach ($temp as $key => $value) 
				{	
					$data['backlog_courses']['reg_course_id'][$count] = $temp[$key]->cid;
					$data['backlog_courses']['reg_course_name'][$count] = $temp[$key]->cname;
					$data['backlog_courses']['reg_course_credit'][$count] = $temp[$key]->credits;
					$data['backlog_courses']['reg_study_exam'][$count] = $temp[$key]->type;
					if($temp[$key]->type=="e")
						$data['backlog_courses']['attendance_details'][$count]['status']=4;
					else
					$data['backlog_courses']['attendance_details'][$count]=$this->attendance_model
																	->get_attendance($raw_data['roll'],
																		$temp[$key]->cid,
																		$raw_data['branch'],
																		$raw_data['sem'],
																		$raw_data['class'],
																		$raw_data['sec'],$raw_data['session_id'],'reg_2014_15_even',$temp[$key]->batch);
					$count++;
				}
			}
			
		}
		// var_dump($data);
		//registered data processed
		$this->_render_page('attendance/view',$data);
	}
	public function index()
	{
		$data['title']="Attendance";
		$data['current_section'] = 'audit';
		$data['current_page'] = "attendance";
		// load registered data
		$userid=$this->user_id;
		$this->load->model('audit/slip_model');
		$this->load->model('attendance/attendance_model');
		$roll = $this->attendance_model->get_roll($userid);
		$rows_data = $this->slip_model->get_registered_detail($roll,'reg');

		$data['regular_courses']['reg_course_id'] = array();
		$data['regular_courses']['reg_course_name'] = array();
		$data['regular_courses']['reg_course_credit'] = array();
		$data['regular_courses']['reg_study_exam'] = array();

		$data['backlog_courses']['reg_course_id'] = array();
		$data['backlog_courses']['reg_course_name'] = array();
		$data['backlog_courses']['reg_course_credit'] = array();
		$data['backlog_courses']['reg_study_exam'] = array();
		if(empty($rows_data))
		{
			$this->session->set_flashdata('danger', 'Student is not yet registered. Please check the roll number or register the student');
			redirect('audit/home');
			return;
		}
		$count = 0;
		$data['reg_credits_study']=0;
		$data['reg_credits_study_exam']=0;
		foreach($rows_data as $raw_data)
		{
			$data['roll_number'] = $raw_data['roll']; // this is required to delete, please do not rename the variable or do not remove it @awachat
			if($raw_data['backlog']==0)
			{
				$data['reg_roll'] = $raw_data['roll'];
				$data['reg_name'] = $raw_data['name'];
				$data['reg_branch'] = $raw_data['branch_name'];
				$data['reg_semester'] = $raw_data['sem'];
				$data['reg_course'] = $raw_data['class_name'];
				$data['reg_section'] = $raw_data['sec'];
				$data['reg_credits_study'] += $raw_data['scredits'];
				$data['reg_credits_study_exam'] += $raw_data['secredits'];
				for ($i=1; $i <= 15 ; $i++)
				{
					if(empty($raw_data['c'.$i])) break;
					$data['regular_courses']['reg_course_id'][$i-1] = $raw_data['c'.$i];
					$data['regular_courses']['reg_course_name'][$i-1] = $raw_data['name'.$i];
					$data['regular_courses']['reg_course_credit'][$i-1] = $raw_data['credit'.$i];
					$data['regular_courses']['reg_study_exam'][$i-1] = $raw_data['type'.$i];
					if($raw_data['type'.$i]==="e")
						$data['regular_courses']['attendance_details'][$i-1]['status']=4;
					else
						$data['regular_courses']['attendance_details'][$i-1]=$this->attendance_model
																		->get_attendance($raw_data['roll'],
																		$raw_data['c'.$i],
																		$raw_data['branch'],
																		$raw_data['sem'],
																		$raw_data['class'],
																		$raw_data['sec'],$raw_data['session_id'],'reg');
				}
			}
			else
			{
				for ($i=1; $i <= 15 ; $i++)
				{
					if(empty($raw_data['c'.$i])) break;
					
					$data['reg_credits_study'] += $raw_data['scredits'];
					$data['reg_credits_study_exam'] += $raw_data['secredits'];
					$data['backlog_courses']['reg_course_id'][$count] = $raw_data['c'.$i];
					$data['backlog_courses']['reg_course_name'][$count] = $raw_data['name'.$i];
					$data['backlog_courses']['reg_course_credit'][$count] = $raw_data['credit'.$i];
					$data['backlog_courses']['reg_study_exam'][$count] = $raw_data['type'.$i];
					if($raw_data['type'.$i]=="e")
						$data['backlog_courses']['attendance_details'][$count]['status']=4;
					else
					$data['backlog_courses']['attendance_details'][$count]=$this->attendance_model
																		->get_attendance($raw_data['roll'],
																		$raw_data['c'.$i],
																		$raw_data['branch'],
																		$raw_data['sem'],
																		$raw_data['class'],
																		$raw_data['sec'],$raw_data['session_id'],'reg');
					$count++;
				}
			}
		}
		// var_dump($data);
		//registered data processed
		$this->_render_page('attendance/view',$data);
	}
	function _render_page($view, $data=null, $render=false)
	{
		$data['current_section'] = 'attendance';
		$view_html = array(
			$this->load->view('base/header', $data, $render),
			$this->load->view('audit/menu/header', $data, $render),
			$this->load->view($view, $data, $render),
			$this->load->view('audit/menu/footer', $data, $render),
			$this->load->view('base/footer', $data, $render)
			);
		if (!$render) return $view_html;
	}
}