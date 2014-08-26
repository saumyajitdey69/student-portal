<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Slip extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth/auth_model', '', TRUE);
		if ($this->nativesession->get('userid') === null)
		{
			redirect(base_url('auth'), 'location', 301);
			return false;
		}
		$this->load->model('audit_model');
		if ($this->audit_model->profile_edited($this->nativesession->get('userid')) === false)
		{
			$this->session->set_flashdata('danger', 'Complete your profile');
			redirect(base_url('audit/profile'), 'location', 301);
			return false;
		}
		$this->load->helper('language');
		$this->load->model('slip_model');

	}
	public function index()
	{
		$data['current_page'] = 'slip';
		$userid=$this->nativesession->get('userid');
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