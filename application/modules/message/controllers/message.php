<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message extends MX_Controller {

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
    $this->home();
}

public function home()
{
    $data['title'] = $this->lang->line('home_title');
    $data['scripts'] = array('auth/jquery.dataTables.js','auth/table.js', "message/message.js");
    $data['current_section'] = 'message';
    $data['current_page'] = "home";
    $this->_render_page('message/home', $data);

}

public function get_details() {
    $rolls = $this->input->post('rolls');
    $rolls = explode(",", $rolls);
    $search_query = array();
    foreach ($rolls as $key => $roll) {
        $roll = trim($roll);
        $details = array();
        if(strstr($roll, ':')){
            $details = explode(" ", $roll);
        }
        else{
            $details[] = $roll;
        }
        // print_r($details);
        $field = array();
        foreach ($details as $key => $detail) { 
            if(strpos($detail, ':') === FALSE)
            {
                if(ctype_digit($detail))
                {
                    if(strlen($detail) > 6){
                            // then its may be a phonr number
                        $field_name = "mobile";
                    }
                    else{
                        $field_name = "roll_number";
                    }
                }
                else
                    // else (ctype_alpha($detail))
                {
                    $field_name = "name";
                }
                    // else
                    // {
                    //     $field_name = "registration_number";
                    // }
                $field_value = $detail;
            }
            else
            {
                $field_name = substr($detail, 0, strpos($detail, ':')); 
                $field_value = substr($detail, strpos($detail, ':')+1);
            }
            $field[$field_name] =  $field_value;
        }
        array_push($search_query, $field);
    }
        // print_r($search_query);
        // return;
    $this->load->model('message/students_model', 'students_model', TRUE);
        // $students_data = $this->students_model->get_details($rolls);
    $students_data = $this->students_model->get_details_advance($search_query, '10');
    print_r(json_encode($students_data));
}

public function send($type) {


    $this->load->library('email');
    $this->load->model('message/students_model', 'students_model', TRUE);

    $type = intval($type);
    $rolls = $this->input->post('rolls');
    $rolls = explode(",", $rolls);
    $subject = $this->input->post('subject');
    $message = $this->input->post('message');
    $types = array(1 => 'SMS', 2 => 'Email', 3 => 'SMS & Email');
    if (!array_key_exists($type, $types)) {
        echo "Invalid";
        return;
    }
    $sender = $this->ion_auth->user()->row();

    $students_data = $this->students_model->get_details($rolls);

    $status = array();
    foreach ($students_data as $index => $student_data) {
            // // Send SMS
            // if ($type & 1 === 1) {
            //     $status[$student_data->roll_number]['sms']['status'] = 'success';
            // }
            // // Send Email
            // if ($type & 2 === 1) {
        $status[$student_data->roll_number]['email'] = 'failure';
        $this->email->from($sender->email, $sender->first_name);
        $this->email->to($student_data->email);

        $this->email->subject($subject);
        $this->email->message($message);

        if ($this->email->send()) {
            $status[$student_data->roll_number] = 'success';
        } else {
            $status[$student_data->roll_number] = 'failure';
        }
            // }
    }
    echo json_encode($status);
}

function _render_page($view, $data=null, $render=false)
{
    if($this->ion_auth->is_hod()) {
        $data['is_hod'] = TRUE;
    } else {
        $data['is_hod'] = FALSE;
    }
    $this->viewdata = (empty($data)) ? $data: $data;
    $view_html = array(
        $this->load->view('base/header', $data, $render),
        $this->load->view('message/menu/header', $data, $render),
        $this->load->view($view, $this->viewdata, $render),
        $this->load->view('message/menu/footer', $data, $render),
        $this->load->view('base/footer', $data, $render)
        );
    if (!$render) return $view_html;
}

}

/* End of file message.php */
/* Location: .//tmp/fz3temp-1/message.php */