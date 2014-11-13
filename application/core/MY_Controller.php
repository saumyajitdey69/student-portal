<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        $this->load->library('auth/ion_auth');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }
        $this->user_id = $this->ion_auth->get_user_id();
        $this->user_name = $this->session->userdata('username');
        $this->name = $this->session->userdata('first_name');
    }

}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */