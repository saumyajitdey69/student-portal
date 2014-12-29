<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Slip extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('audit_model');
		if ($this->audit_model->profile_edited($this->user_id) === false)
		{
			$this->session->set_flashdata('danger', 'Complete your profile');
			redirect(base_url('audit/profile'), 'location', 301);
			return false;
		}
		$this->load->helper('language');
		$this->load->model('slip_model');
		$this->load->model('feedback_model');
	}

	public function index()
	{
		
		$userid=$this->user_id;
		$roll = $this->feedback_model->get_roll($userid);
		$data=$this->getSlipData($roll);
		$this->_render_page('registration/slip_new',$data);
	}
	public function even_sem14_15()
	{
		$userid=$this->user_id;
		$roll = $this->feedback_model->get_roll($userid);
		$data=$this->getSlipDataNew($roll);
		//print_r($data);

		foreach ($data as  $value) {
			$value['current_page'] = "slip_even";
			$this->_render_page('registration/currentslip',$value);
		}	
	}
	public function getSlipDataNew($roll)
	{   $slips=array();
		$num_of_slips=-1;
		$rows_data = $this->slip_model->get_registered_detail($roll,'reg_2014_15_even');
		$data['title'] = "Registration Slip";
		
		if(empty($rows_data))
		{
			$this->session->set_flashdata('danger', 'Student is not yet registered. Please check the roll number or register the student');
			redirect('registration/slip');
			return;
		}
		$count = 0;
		$data['reg_credits_study'] =0;
		$data['reg_credits_study_exam']=0;
		$flag=0;
		foreach($rows_data as $raw_data)
			{   	$temp=array();

				if($raw_data['backlog']=='0'){
					$data['current_section'] = 'registration';
					$data['current_page'] = "slip";		     
					$num_of_slips++;

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
			    foreach ($temp as $key => $value) {				
			    	$data['regular_courses']['reg_course_id'][$key] = $temp[$key]->cid;
			    	$data['regular_courses']['reg_course_name'][$key] = $temp[$key]->cname;
			    	$data['regular_courses']['reg_course_credit'][$key] = $temp[$key]->credits;
			    	$data['regular_courses']['reg_study_exam'][$key] = $temp[$key]->type;
			    }

			}
			else
			{
				
				$temp=json_decode($raw_data['regular_courses']);
				foreach ($temp as $key => $value) {	
					$data['reg_credits_study'] += $raw_data['scredits'];
					$data['reg_credits_study_exam'] += $raw_data['secredits'];				
					array_push($data['backlog_courses']['reg_course_id'], $temp[$key]->cid);
					array_push($data['backlog_courses']['reg_course_name'], $temp[$key]->cname);
					array_push($data['backlog_courses']['reg_course_credit'], $temp[$key]->credits);
					array_push($data['backlog_courses']['reg_study_exam'], $temp[$key]->type);
					$count++;
				}
			}
			
			
			$slips[$num_of_slips]=$data;
		}
		
		return $slips;
	}
	public function getSlipData($roll)
	{
		$rows_data = $this->slip_model->get_registered_detail($roll,'reg');
		$data['title'] = "Registration Slip";
		
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
			$this->session->set_flashdata('danger', 'Student is not yet registered for this session (i.e July 2014)');
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
					$count++;
				}
			}
		}
		$data['current_section'] = 'registration';
		$data['current_page'] = "slip";
		return $data;
	}
	public function index2()
	{
		$data['current_page'] = 'slip';
		$userid=$this->user_id;
		$this->load->model('feedback_model');
		$roll = $this->feedback_model->get_roll($userid);
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$raw_data = $this->slip_model->get_registered_detail($roll);
		$data['reg_roll'] = $raw_data['roll'];
		$data['reg_name'] = $raw_data['name'];
		$data['reg_branch'] = $raw_data['branch_name'];
		$data['reg_semester'] = $raw_data['sem'];
		$data['reg_course'] = $raw_data['class'];
		$data['reg_course_names']=$raw_data['class_name'];
		$data['reg_section'] = $raw_data['sec'];
		$data['reg_credits_study'] = $raw_data['scredits'];
		$data['reg_credits_study_exam'] = $raw_data['secredits'];
		for ($i=1; $i <= 15 ; $i++)
		{
			if(empty($raw_data['c'.$i])) break;
			$data['reg_course_id'][$i-1] = $raw_data['c'.$i];
			$data['reg_course_name'][$i-1] = $raw_data['name'.$i];
			$data['reg_course_credit'][$i-1] = $raw_data['credit'.$i];
			$data['reg_study_exam'][$i-1] = $raw_data['type'.$i];
		}
		$data['current_section'] = 'registration';
		$data['current_page'] = "slip";
		if($raw_data==FALSE)
		{
			$this->session->set_flashdata('danger', 'Unable to load registartion slip.Contact WSDC.');
			redirect(base_url('audit/profile'), 'location', 301);
		}
		else
			$this->load->view('registration/slip',$data,FALSE);

	}

	public function not_registered_check($str)
	{
		$this->form_validation->set_message('not_registered_check', '%s Not yet Registered');
		return $this->slip_model->not_registered_check($str);
	}


	function _render_page($view, $data=null, $render=false)
	{
		$data['current_section'] = 'audit';
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

/* End of file profile.php */
/* Location: ./application/modules/profile/controllers/profile.php */