<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
*
*/
class Admin extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('url');
	}

}

/* End of file admin.php */
/* Location: ./application/modules/auth/controllers/admin.php */