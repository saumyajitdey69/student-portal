<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Enotice extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index($page = 'academic-section')
	{
		$data['title'] = ucwords($page);
		$this->load->view($page, $data, FALSE);
	}

}

/* End of file enotice.php */
/* Location: ./application/modules/enotice/controllers/enotice.php */