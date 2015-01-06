<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		// Include authentication library and check for logged in status
		$this->load->library('auth/ion_auth');
		if (!$this->ion_auth->logged_in())
			redirect(base_url('auth'), 'location', 301);

		// load the common model
		$this->load->model('profile/profile_model');
	}

	public function index()
	{
		$data['current_page'] = 'public';
		$data['title'] = $this->session->userdata('name');
		// public profile of logged in user.
		$data['profile'] = $this->profile_model->get(array('username' => $this->session->userdata('username')), true);
		$this->_render_page('public_profile', $data);
	}

	public function view($username = '')
	{
		$data['current_page'] = 'public';
		$data['profile'] = $this->profile_model->get(array('auth.username' => $username), true);
		if(empty($data['profile'])){
			$this->session->set_flashdata('danger', 'Username does not exist. Please check the username and try again.');
			redirect('profile');
		}
		$data['title'] = ucwords(strtolower($data['profile']['first_name']))." ".ucwords(strtolower($data['profile']['last_name']));
		$this->_render_page('profile/public_profile', $data);
	}

	function _render_page($view, $data=null, $render=false)
	{
		$data['current_section'] = 'profile';
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