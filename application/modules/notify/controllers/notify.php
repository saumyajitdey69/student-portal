<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notify extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('auth/auth_model', '', TRUE);
		if ($this->nativesession->get('userid') === null)
		{
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
	public function index()
	{
		$data['notify'] = "Notification Center | WSDC";
		$this->_render_page('home', $data);
	}

	function _render_page($view, $data=null, $render=false)
	{
		if(empty($data['current_page'])) $data['current_page'] = "";
		$this->viewdata = (empty($data)) ? $data: $data;
		$view_html = array(
			$this->load->view('base/header', $data, $render),
			$this->load->view('notify/menu/header', $data, $render),
			$this->load->view($view, $this->viewdata, $render),
			$this->load->view('notify/menu/footer', $data, $render),
			$this->load->view('base/footer', $data, $render)
			);
		if (!$render) return $view_html;
	}
}

/* End of file notify.php */
/* Location: ./application/modules/notify/controllers/notify.php */