<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		// Include authentication library and check for logged in status
		$this->load->library('auth/ion_auth');
		if (!$this->ion_auth->logged_in())
			redirect(base_url('auth'), 'location', 301);
	}

	public function index()
	{
		$data['title'] = "Student Profile | WSDC";
		$this->_render_page('public_profile', $data);
	}


	function _render_page($view, $data=null, $render=false)
	{
		if(empty($data['current_page'])) $data['current_page'] = "";
		$this->viewdata = (empty($data)) ? $data: $data;
		$view_html = array(
			$this->load->view('base/header', $data, $render),
			$this->load->view('profile/menu/header', $data, $render),
			$this->load->view($view, $this->viewdata, $render),
			$this->load->view('profile/menu/footer', $data, $render),
			$this->load->view('base/footer', $data, $render)
			);
		if (!$render) return $view_html;
	}

}

/* End of file profile.php */
/* Location: ./application/modules/profile/controllers/profile.php */