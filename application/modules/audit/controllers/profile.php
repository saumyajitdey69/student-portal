<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('audit/audit_model', 'audit_model');
		$this->load->library('form_validation');
        $this->load->helper('url');
	}

    public function index()
    {
        //$this->view($this->session->userdata('username'));
    }

    public function validate()
    {
        if($this->input->post('registration_number') === FALSE)
        {
            redirect(base_url('profile'), 'location', '301');
            return;
        }

        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('registration_number', 'Registration Number', 'trim|required|min_length[4]|is_unique[student_data.registration_number]');
        $this->form_validation->set_rules('roll_number', 'Roll Number', 'trim|required|min_length[4]|is_unique[student_data.roll_number]');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required|min_length[1]|max_length[1]');
        $this->form_validation->set_rules('dob', 'Date of Birth', 'trim|required');
        $this->form_validation->set_rules('nationality', 'Nationality', 'trim|required');
        $this->form_validation->set_rules('passport', 'passport', 'trim');
        $this->form_validation->set_rules('yearofjoining', 'Year of Joining', 'trim|required|min_length[4]|max_length[4]');
        $this->form_validation->set_rules('course', 'Course', 'trim|required');
        $this->form_validation->set_rules('branch', 'Branch', 'trim|required');
        $this->form_validation->set_rules('section', 'Section', 'trim|required');
        $this->form_validation->set_rules('email', 'Email ID', 'trim|required|valid_email');
        $this->form_validation->set_rules('phone_number', 'Phone Number', 'trim|required|min_length[10]|max_length[12]');
        $this->form_validation->set_rules('emergency_contact', 'Emergency Contact Number', 'trim|required|min_length[10]|max_length[12]|xss_clean');
        $this->form_validation->set_rules('sbh_account', 'SBH Account Number', 'trim');
        $this->form_validation->set_rules('hostel', 'Hostel', 'trim');
        $this->form_validation->set_rules('room_number', 'Hostel room number', 'trim');
        $this->form_validation->set_rules('mess', 'Mess', 'trim');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>','</div>');

        $data['scripts'] = array('profile/profile.js');
        $data['title'] = "Profile";
        $data['current_page'] = "profile";

        if($this->form_validation->run() === FALSE)
        {
            $data['submitted'] = '0';
        }
        else
        {

            $res = $this->audit_model->update($this->user_id ,
                array('name' => $this->input->post('name'),
                    'registration_number' => $this->input->post('registration_number'),
                    'roll_number' => $this->input->post('roll_number') ,
                    'gender' => $this->input->post('gender'),
                    'birthday'=> $this->input->post('dob'),
                    'country' => $this->input->post('nationality') ,
                    'passport' => $this->input->post('passport'),
                    'joining_year' => $this->input->post('yearofjoining'),
                    'course' => $this->input->post('course'),
                    'branch' => $this->input->post('branch'),
                    'current_section' => $this->input->post('section') ,'email' => $this->input->post('email'),
                    'mobile' => $this->input->post('phone_number') ,
                    'emergency_contact' => $this->input->post('emergency_contact'),
                    'sbh_account' => $this->input->post('sbh_account') ,
                    'hostel' => $this->input->post('hostel') ,
                    'hostel_room' => $this->input->post('room_number'),
                    'mess' => $this->input->post('mess'))
                );
            if ($res === true) {
                $data['submitted'] = 'Profile updated successfully!';
            } else {
                $data['submitted'] = 'Error updating profile';
            }
            $details = $this->audit_model->get($this->user_id);
            $data['details'] = $details;
        }

        $this->_render_page('profile/index', $data);

    }

	function _render_page($view, $data=null, $render=false)
	{
        $data['current_section'] = 'audit';
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

/* End of file profile.php */
/* Location: ./application/modules/profile/controllers/profile.php */