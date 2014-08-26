<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		redirect('auth');
	}

	public function _404()
	{
		$this->load->view('error/404');
	}
}

/* End of file profile.php */
/* Location: ./application/modules/profile/controllers/profile.php */