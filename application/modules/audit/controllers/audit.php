<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Audit extends MY_Controller {

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

	}

	 public function view($username = '')
    {
		$this->load->library('form_validation');
    	
        $details = $this->audit_model->get_public_profile($username);
        // var_dump($details);
        $data['details'] = $details;
        $data['submitted'] = '';
        $data['scripts'] = array('profile/profile.js');
        $data['title'] = "Profile";
        $data['current_page'] = "profile";
        $this->_render_page('profile/index', $data);
    }

	public function getSearchData(){
		$searchStr = $this->input->post('search-string');
		return $this->audit_model->getSeachItem($searchStr, true, '5');
	}

	public function index()
	{
		$this->home();
	}

	public function home()
	{
		$data['title'] = "Audit | Home";
		$data['current_section'] = 'audit';
		$data['current_page'] = "home";
		$data['title'] = 'Student Portal | Academic Section ';
		$this->_render_page('audit/home', $data);
	}
	
	public function resultsvma()
	{
		$flag = '1';
		$this->load->model('results_model');
		$data = array();
		$roll_number = $this->results_model->get_roll_number($this->user_id);
		$feedback =array();
		$feedback = $this->results_model->check_feedback($this->user_id, $roll_number);

		if($feedback['code'] === TRUE)
		{
			$data['results'] = $this->results_model->list_all_results($roll_number);
		}
		else
		{
			$data['results'] = null;
			echo 'testing';
			$data['message'] = $feedback['message'];
		}
		if(isset($feedback['number']) and $feedback['number'] == '1')
		{
			$data['message'] .= '<p>You can not see your academic results<br> <strong>Contact Associate Dean Academic Audit <<a href="mailto:asd_aa@nitw.ac.in" target="_blank">asd_aa@nitw.ac.in</a>>  <br> Student should pay the fine in order to fill the feedback and see the results. </strong><br>DO NOT CONTACT ANY OF THE WSDC MEMBERS REGARDING INCOMPLETE COURSE FEEDBACK OR EXIT FEEDBACK.<br> If you have completely filled the feedback and unable to see the results, drop an email to wsdc.nitw@gmail.com <br>WSDC Team will contact you within 72 hours<br> As per the institute RO last date of filling feedback was April 28, 2014 <br> - By Order Dean Academic	</p>';
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

	public function results()
	{
		$flag = '1';
		$this->load->model('results_model');
		$data = array();
		$roll_number = $this->results_model->get_roll_number($this->user_id);
		$old_user_id=$this->results_model->get_old_user_id($roll_number);
		$feedback =array();
		$feedback = $this->results_model->check_feedback($old_user_id, $roll_number);
		if($feedback['code'] === TRUE)
		{
			$data['results'] = $this->results_model->list_all_results($roll_number);
		}
		else
		{
			$data['results'] = null;
			$data['message'] = $feedback['message'];
		}
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

	public function calendar()
	{
		$data = array();
		$data['title'] = "Academic Calender 2014-15";
		$data['current_section'] = 'audit';
		$data['current_page'] = 'calendar';
		$this->_render_page('calendar/index', $data);
	}

	function _render_page($view, $data=null, $render=false)
	{
		$data['current_section'] = 'audit';
		$data['admin_logged']=$this->ion_auth->is_admin();
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