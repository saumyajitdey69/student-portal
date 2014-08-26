<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exitsurvey extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('auth/auth_model', '', TRUE);
		if ($this->nativesession->get('userid') === null) {
			redirect(base_url('auth'), 'location', 301);
			return false;
		}
		$this->load->model('audit/audit_model');
		if ($this->audit_model->profile_edited($this->nativesession->get('userid')) === false) 
		{
			$this->session->set_flashdata('danger', 'Complete your profile');
			redirect(base_url('audit/profile'), 'location', 301);
			return false;
		}
	}
	
	public function fill() {
		$data = array();
		$data['title'] = "Exit Feedback";
		$data['section_page'] = 'audit';
		$data['current_page'] = 'exitsurvey';
		$user = $this->nativesession->get('userid');
		
		// $this->load_model('audit/exitsurvey', 'exitsurvey', TRUE);
		// $status = $this->exitsurvey->feedback_status($user('roll_number'));
		// if($status == 'filled'){
		// 	$this->_render_page('audit/exitsurvey/filled',$data);
		// }
		
		
		
		$this->_render_page('audit/exitsurvey/form',$data);
	}
	
	public function submit() {
		$data = array();
		$data['wueation1'] = $this->input->post('wueation1');
		$this->load_model('audit/exitsurvey', 'exitsurvey', TRUE);
		$this->exitsurvey->submit($data);
		redirect(base_url('audit/exitsurvey/fill'), 'location', 301);
	}
	
	function _render_page($view, $data=null, $render=false) {
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

