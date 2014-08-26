<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forms extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		{
			$this->load->model('forms/forms_model', '', TRUE);
			if ($this->nativesession->get('userid') === null) 
			{
				redirect(base_url('audit'), 'location', 301);
				return false;
			}
		}
		$this->session->set_flashdata('danger', 'TZ applications are closed. <a href="http://evm.technozion.org/apply"> Click here to apply for event manager</a>' );
		redirect('audit', 'refresh');
	}


	public function index()
	{
		$view = 'home';
		$data['current_page'] = 'home';
		$this->load->model('forms_model', TRUE);
		$roll = $this->forms_model->get_roll($this->nativesession->get('userid'));
		$sem = $this->forms_model->get_sem($roll);
		/*
			sem = -1 => not registered
			sem = 0 => backlog student
			else sem = sem
		*/
		//if(!($sem === 0 || $sem === -1))
		//{
			$cgpa = $this->forms_model->get_cgpa($roll);
		//}
		
		$new_roll = $this->forms_model->new_roll($roll);
		if($new_roll)
			$roll = $new_roll;
		$a = $this->forms_model->check($roll);
		$data['roll'] = $roll;
		$data['sem'] = $sem;
		$data['cgpa'] = $cgpa;
		$data['check'] = $a;
//echo $roll." ".$sem." ".$cgpa;
		$this->_render_page($view, $data);
	}

	public function submit()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('preference1', 'Preference 1', 'required');
		$this->form_validation->set_rules('position', 'Position', 'required');
		$this->form_validation->set_rules('question1', 'Question 1', 'trim|required|ctype_alnum|xss_clean');
		$this->form_validation->set_rules('question2', 'Question 2', 'trim|required|ctype_alnum|xss_clean');
		$this->form_validation->set_rules('question3', 'Question 3', 'trim|required|ctype_alnum|xss_clean');

		if($this->form_validation->run() === TRUE)
		{
			$roll = $this->input->post('roll');
			$preference1 = $this->input->post('preference1');
			$preference2 = $this->input->post('preference2');
			$position = $this->input->post('position');
			$question1 = $this->input->post('question1');
			$question2 = $this->input->post('question2');
			$question3 = $this->input->post('question3');	
			$this->load->model('forms_model', TRUE);
			$this->forms_model->enter_application($roll, $preference1, $preference2, $position, $question1, $question2, $question3);
			redirect(base_url('forms'));
		}
	}

	public function dean()
	{
		$this->load->model('forms_model', TRUE);
		$this->forms_model->dean();
	}	
	
	public function _render_page($view, $data)
	{
		$data['current_section'] = 'form';
		$view_html = array(
			$this->load->view('base/header', $data),
			$this->load->view($view, $data),
			$this->load->view('base/footer', $data)
			);
	}
}