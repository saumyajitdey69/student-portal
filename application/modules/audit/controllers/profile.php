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
        $this->load->model('profile/profile_model');
        $data['details'] = $details = $this->profile_model->get(array('id' => $this->user_id), true, 'first_name, last_name, middle_name, registration_number, roll_number, gender, birthday, country, phone as mobile, email, emergency_contact, joining_year, course, branch, current_section, sbh_account, passport', false, false);
        // print_r($details);
        $data['submitted'] = '';
        $data['scripts'] = array('profile/profile.js');
        $data['title'] = "Profile";
        $data['current_page'] = "profile";
        $this->_render_page('profile/index', $data);
    }

    public function validate()
    {
        if (!$this->ion_auth->logged_in())
            redirect('auth/login');
        // if($this->input->post('registration_number') === FALSE)
        // {
        //     redirect(base_url('profile'), 'location', '301');
        //     return;
        // }

        $this->form_validation->set_rules('first_name', 'Name', 'trim|required|ctype_alpha');
        $this->form_validation->set_rules('middle_name', 'Name', 'trim|ctype_alpha');
        $this->form_validation->set_rules('last_name', 'Name', 'trim|required|ctype_alpha');
        $this->form_validation->set_rules('registration_number', 'Registration Number', 'trim|required|min_length[6]|max_length[7]|ctype_alnum');
        $this->form_validation->set_rules('roll_number', 'Roll Number', 'trim|required|min_length[4]|max_length[6]|ctype_digit');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required|min_length[1]|max_length[1]');
        $this->form_validation->set_rules('dob', 'Date of Birth', 'trim|required');
        $this->form_validation->set_rules('nationality', 'Nationality', 'trim|required');
        $this->form_validation->set_rules('passport', 'passport', 'trim');
        $this->form_validation->set_rules('yearofjoining', 'Year of Joining', 'trim|required|min_length[4]|max_length[4]');
        $this->form_validation->set_rules('course', 'Course', 'trim|required');
        $this->form_validation->set_rules('branch', 'Branch', 'trim|required');
        $this->form_validation->set_rules('section', 'Section', 'trim|required');
        $this->form_validation->set_rules('email', 'Email ID', 'trim|required|valid_email');
        $this->form_validation->set_rules('phone_number', 'Phone Number', 'trim|required|min_length[10]|max_length[10]');
        $this->form_validation->set_rules('emergency_contact', 'Emergency Contact Number', 'trim|required|min_length[10]|max_length[10]|xss_clean');
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
           // No need of swapping the number, we are allowing students to update the roll numbers and registrations number.
           // $var =  $this->input->post('swap');
           //  if($var == 'on'){
           //           $roll_number = $this->input->post('registration_number1');
           //           $registration_number = $this->input->post('roll_number1') ;
           //       }
           //       else
           //       {
           //         $roll_number = $this->input->post('roll_number1');
           //           $registration_number = $this->input->post('registration_number1') ;
           //       }
            $this->ion_auth->update($this->user_id, array(
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone_number'),           
                'first_name' => $this->input->post('first_name'),           
                'last_name' => $this->input->post('last_name'),           
                'middle_name' => $this->input->post('middle_name')           
                ));
            $res = $this->audit_model->update($this->user_id ,
                array('registration_number' => strtoupper($this->input->post('registration_number')),
                   'roll_number' => strtoupper($this->input->post('roll_number')) ,
                   'gender' => $this->input->post('gender'),
                   'birthday'=> $this->input->post('dob'),
                   'country' => $this->input->post('nationality') ,
                   'passport' => $this->input->post('passport'),
                   'joining_year' => $this->input->post('yearofjoining'),
                   'course' => $this->input->post('course'),
                   'branch' => $this->input->post('branch'),
                   'current_section' => $this->input->post('section'),
                   'mobile' => $this->input->post('phone_number') ,
                   'emergency_contact' => $this->input->post('emergency_contact'),
                   'sbh_account' => $this->input->post('sbh_account'))
                );
            if ($res === true) {
                $data['submitted'] = 'Profile updated successfully!';
            } else {
                $data['submitted'] = 'Error updating profile';
            }
            $this->load->model('profile/profile_model');
            $data['details'] = $details = $this->profile_model->get(array('id' => $this->user_id), true, 'first_name, last_name, middle_name, registration_number, roll_number, gender, birthday, country, phone as mobile, email, emergency_contact, joining_year, course, branch, current_section, sbh_account, passport', false, false);
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