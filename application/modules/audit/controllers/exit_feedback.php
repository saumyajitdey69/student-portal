<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exit_feedback extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('audit/audit_model');
		if ($this->audit_model->profile_edited($this->user_id) === false) 
		{
			$this->session->set_flashdata('danger', 'Complete your profile');
			redirect(base_url('audit/profile'), 'location', 301);
			return false;
		}
	}
	
	public function index() {
		$data = array();
		$data['title'] = "Exit Feedback";
		$data['section_page'] = 'audit';
		$data['current_page'] = 'exit_feedback';
		$data['scripts']=array('feedback/exit_feedback.js');
		// $this->session->set_flashdata('danger', 'Feedback is closed');
		// redirect('audit');
		$this->load->library('form_validation');
		//////// allowed feedback code ///////////
		$userid = $this->user_id;

		$this->load->model('audit/results_model', 'results_model');
		$roll = $this->results_model->get_roll_number($userid);
		if($this->results_model->_is_allowed_for_feedback($roll) === FALSE)
		{	
			$this->session->set_flashdata('danger', 'Exit feedback is closed. If you did not fill the exit feedback please contact Associate Dean Academic Audit. <br> After the approval of Dean it takes 2-3 days for receiving the results and activating feedback. <br> Please do not contact WSDC for this issue.');
			redirect('audit');
			return;
		}
        ////////////////////////////////
		$this->load->model('audit/exit_feedback_model');

		$is_final_year_status=$this->exit_feedback_model->is_final_year($userid);
		if($is_final_year_status==0)
		{
			$data['msg']="You are not eligible to fill exit-feedback.";
			$this->_render_page('audit/exit_feedback/msg',$data);
		}
		else
		{
			$status = $this->exit_feedback_model->exit_feedback_status($userid);
			if($status == 1){
				$data['msg']="You have already filled the exit-feedback";
				$this->_render_page('audit/exit_feedback/msg',$data);
			}

			else
				$this->_render_page('audit/exit_feedback/form',$data);
		}
	}
	
	public function submit_feedback() {
		$data['title'] = "Exit Feedback";
		$data['section_page'] = 'audit';
		$data['current_page'] = 'exit_feedback';
		$this->load->library('form_validation');
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');

		$this->form_validation->set_rules('degree', 'Degree', 'required');
		$this->form_validation->set_rules('department', 'Department', 'required');
		$this->form_validation->set_rules('specialization', 'CGPA', 'required');
		
		$this->form_validation->set_rules('social_class', 'Social Class', 'required');
		$this->form_validation->set_rules('academicsA[]', 'Academics A', 'required');
		$this->form_validation->set_rules('academicsB[]', 'Academics B', 'required');
		$this->form_validation->set_rules('academicsC[]', 'Academics C', 'required');
		$this->form_validation->set_rules('experiences[]', 'Experiencs', 'required');
		$this->form_validation->set_rules('goals[]', 'Goals', 'required');
		$this->form_validation->set_rules('extra-curricular[]', 'Extra-curricular', 'required');
		$this->form_validation->set_rules('changes[]', 'Changes', 'required');
		$this->form_validation->set_rules('overallA[]', 'Overall A', 'required');
		$this->form_validation->set_rules('overallB[]', 'Overall B', 'required');

		$this->form_validation->set_rules('overallC[]', 'Overall C', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('danger', validation_errors());
			redirect('audit/exit_feedback');
		}
		else
		{
			$this->load->model('audit/exit_feedback_model');
			$this->exit_feedback_model->insert_exit_feedback_data($this->user_id,$this->input->post());
			$data['msg']="Exit feedback submitted successfully.";
			$this->_render_page('audit/exit_feedback/msg',$data);
		}
	}
	
	function _render_page($view, $data=null, $render=false) {
		// $this->load->model('audit/exit_feedback_model');
		// $data['exit_feedback_tab']=$this->exit_feedback_model->is_final_year($this->user_id);
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
