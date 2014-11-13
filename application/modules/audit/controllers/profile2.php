<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		{
			$this->load->model('auth/auth_model', '', TRUE);
			if ($this->nativesession->get('userid') === null)
			{
				redirect(base_url('audit'), 'location', 301);
				return false;
			}
		}
		$this->load->model('audit/audit_model');
		$this->load->library('form_validation');
	}

}

/* End of file profile2.php */
/* Location: ./application/modules/audit/controllers/profile2.php */