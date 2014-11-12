<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Secret extends MX_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('auth/auth_model', '', TRUE);
		if ($this->user_id === null and ($this->user_id !== '1' or $this->user_id !== '6784'))
		{
			$this->session->set_flashdata('error', 'Not Authorized');
			redirect(base_url('audit/home'), 'location', 301);
			return false;
		}
	}
	public function results($roll)
	{
		if($roll=='') return;
		$flag = '1';
		$this->load->model('results_model');
		$data = array();
		$roll_number = $roll;
		$feedback =array();
		$userid=$this->results_model->get_userid($roll);
		$feedback = $this->results_model->check_feedback($userid, $roll_number);
		if($feedback['code'] === TRUE)
		{
			$data['results'] = $this->results_model->list_all_results($roll_number);
		}
		else
		{
			$data['results'] = null;
			$data['message'] = $feedback['message'];
		}
		echo '<br>';
		print_r($feedback);
		if(isset($feedback['number']) and $feedback['number'] == '1')
		{
			$data['message'] .= '<p>You can not see your academic results<br> <strong>Contact Associate Dean Academic Audit <<a href="mailto:asd_aa@nitw.ac.in" target="_blank">asd_aa@nitw.ac.in</a>>  <br> Student should come to the college and pay the fine in order to fill the feedback and see the results. </strong><br>Do not contact any of the WSDC members regarding incomplete course feedback or exit feedback.<br> If you have completely filled the feedback and unable to see the results, drop an email to wsdc.nitw@gmail.com <br>WSDC Team will contact you within 72 hours<br> As per the institute RO last date of filling feedback was April 28, 2014</p>';
		}
		// print_r($data['results']);
		// if(empty($data['results']))
		// {
		// 	$this->session->set_flashdata('danger', 'Your results are not yet declare');
		// 	redirect('audit/home');
		// }
		$data['title'] = "Academic Results";
		$data['current_section'] = 'audit';
		$data['current_page'] = 'result';
		$this->_render_page('results/index', $data);
	}

	// public function slip()
	// {
	// 	$data = array();
	// 	$data['title'] = "Audit - Registration Slip";
	// 	$data['current_page'] = 'slip';
	// 	$user_id = $this->user_id;
	// 	$roll=$this->student->get_roll_number($userid);
	// 	$data['user_id']=$user_id;
	// 	$raw_data = $this->registration->get_student_details($roll);
	// 	$data['reg_roll'] = $raw_data['roll_number'];
	// 	$data['reg_name'] = $raw_data['name'];
	// 	$data['reg_branch'] = $raw_data['branch'];
	// 	$data['reg_semester'] = $raw_data['semester'];
	// 	$data['reg_course'] = $raw_data['class'];
	// 	$data['reg_section'] = $raw_data['section'];
	// 	$data['reg_credits_study'] = $raw_data['study_credits'];
	// 	$data['reg_credits_study_exam'] = $raw_data['study_exam_credits'];
	// 	$NUMBER_OF_COURSES=15;
	// 	for ($i=1; $i <= $NUMBER_OF_COURSES ; $i++)
	// 	{
	// 		if(empty($raw_data['course_'.$i])) break;
	// 		$data['reg_course_id'][$i-1] = $raw_data['course_'.$i];
	// 		$data['reg_course_name'][$i-1] = $raw_data['name_'.$i];
	// 		$data['reg_course_credit'][$i-1] = $raw_data['credit_'.$i];
	// 		$data['reg_study_exam'][$i-1] = $raw_data['islab_'.$i];
	// 	}
	// 	$data['current_section'] = 'audit';
	// 	$data['current_page'] = "regslip";
	// 	$this->_render_page('registration/slip', $data);
	// }

	// public function calendar()
	// {
	// 	$data = array();
	// 	$data['title'] = "Academic Calender 2013-14";
	// 	$data['current_section'] = 'audit';
	// 	$data['current_page'] = 'calendar';
	// 	$this->_render_page('calendar/index', $data);
	// }

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