<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model', '', TRUE);
    }

    private function is_logged_in() {
        if ($this->nativesession->get('userid') === null) {
            return false;
        } else {
            return true;
        }
    }

    public function index()
    {
        if ($this->is_logged_in()) {
            redirect(base_url("audit"), "location", 301);
            // redirect(base_url("audit/home"), "location", 301);
            return;
        }
        #script included in modules/auth/view/menu/footer.php
        $data[] = '';
        $this->_render_page('login', $data);
    }
    private function get_client_ip() {
     $ipaddress = '';
     if (getenv('HTTP_CLIENT_IP'))
         $ipaddress = getenv('HTTP_CLIENT_IP');
     else if(getenv('HTTP_X_FORWARDED_FOR'))
         $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
     else if(getenv('HTTP_X_FORWARDED'))
         $ipaddress = getenv('HTTP_X_FORWARDED');
     else if(getenv('HTTP_FORWARDED_FOR'))
         $ipaddress = getenv('HTTP_FORWARDED_FOR');
     else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
     else if(getenv('REMOTE_ADDR'))
         $ipaddress = getenv('REMOTE_ADDR');
     else
         $ipaddress = 'UNKNOWN';

     return $ipaddress; 
    }
    public function login()
    {
        $formData = $this->input->post('formData');
        $formData = json_decode($formData);

        $stat['status'] = "failure";
        $stat['activate'] = false;
        
        $creds['username']  = $formData->inputUserName;
        $creds['password']  = $formData->inputPassword;
        
        // print_r($creds);
        $status = $this->auth_model->verify_credentials($creds);
        if ($status === false) {
            $stat['message'] = "username/password do not match.";
        } else if ($status === 0) {
            $stat['message'] = "username does not exist";
        } else {
            if ($status->active !== "1") {
                $stat['message'] = "account not activated";
                $stat['activate'] = true;
            } else {
                $creds['access_location']=$this->get_client_ip();
                $this->auth_model->update_ip($creds);
                $this->nativesession->set('userid', $status->userid);
                $this->nativesession->set('permission', $status->permissions);
                $this->nativesession->set('queries', '0');
                $stat['status'] = "success";
            }
        }
        echo json_encode($stat);
    }

    public function register()
    {
        $data = array();
        $this->_render_register_page('auth/signup', $data);
    }

    public function signup()
    {
        $stat['message'] ="";
        $stat['status'] = "failure";

        $details = json_decode($this->input->post('formData'));
        $userDetails=array(
            "name" => $details->inputName,
            "email" => $details->inputEmail,
            "mobile" => $details->inputPhone,
            "username" => $details->inputUserName,
            "password" => md5($details->inputPassword),
            "registration_number" => $details->inputRegNumber,
            "roll_number" => $details->inputRollNumber
            );
        $creationStatus = $this->auth_model->create($userDetails);

        if ($creationStatus['status'] === true) {
            //send mail if databse inserting works fine
            $mailDetails['to'] = $userDetails['email'];
            $mailDetails['subject'] = 'Activation Link';
            $mailDetails['message'] =
            '
            Hi,

            To activate your account click on this '.base_url("auth/activate/".$creationStatus['activationLink']).' 
            Or copy paste the following link in the browser: '.base_url("auth/activate/".$creationStatus['activationLink']).'.

            For doubts contact: wsdc.nitw@gmail.com

            Reagers,
            WSDC, NITW';
            $this->load->library('myemail');
            if (($creationStatus['status'] = $this->myemail->send($mailDetails)) !== true) {
                $stat['status'] = "success";
                $stat['message'] = 'Account created. Error sending activation mail.';
            } else {
                $stat['message'] = "Account created. Please activate your account before proceeding further";
            }
        } else {
            $stat['message'] = "Account creation failed : ".$creationStatus['message'];
        }
        echo json_encode($stat);
    }

    public function activate($id)
    {
        if(empty($id)) redirect(base_url(),'location',301);
        // echo $this->auth_model->activate_account($id);
        $status = $this->auth_model->activate_account($id);
        if($status == "success"){
            $stat['message']="Succesfully account activated ";
            $stat['activated']=true;
        }else{
            $stat['message']=$status;
            $stat['activated']=false;
        }
        $this->_render_page('auth/activate', $stat, FALSE);
    }

    public function forgot(){
        $details = json_decode($this->input->post('formData'));
        $email=$details->inputEmail;
        $stat['status'] = "";
        $stat['message']="";
        if (($userid = $this->auth_model->get_userid_email($email)) === false) {
            $stat['message'] = 'Invalid Email';
        } else {
            if($this->auth_model->get_account_status($userid) == 0 ){
                $stat['message']="Account not activated.";
            }else{
                $activationLink = $this->auth_model->set_activation_link($userid);

                $this->load->library('myemail');
                $username = $this->auth_model->get($userid)->username;    
                $mailDetails['to'] = $email;
                $mailDetails['subject'] = "Forgot Password Link";
                $mailDetails['message'] = '
                Hi, 

                Your username is '.$username.'

                To reset your password click on this '.base_url("auth/reset/".$activationLink).'
                For doubts contact: wsdc.nitw@gmail.com.
                
                Cheers,
                Team WSDC.';

                if ($this->myemail->send($mailDetails)) {
                    $stat['message'] = "Mail Sent Successfully with a new Password reset link ";
                    $stat['status']="success";
                } else {
                    $stat['message'] = 'Error sending mail. Is your mail-id correct?';
                }
            }
        }
        echo json_encode($stat);
    }

    public function resendactivation()
    {
        $email = $this->input->post('email');
        $stat['status'] = "failure";
        if (($userid = $this->auth_model->get_userid_email($email)) === false) {
            $stat['message'] = 'Invalid Email';
        } else {
            if($this->auth_model->get_account_status($userid) == 1 ){
                $stat['message']="Account already activated.";
            }else{
                //Account not activated and requesed for new activation key
                $activationLink = $this->auth_model->set_activation_link($userid);

                $this->load->library('myemail');
                $mailDetails['to'] = $email;
                $mailDetails['subject'] = "Activation Link";
                $mailDetails['message'] = '
                To activate your account click on this <a href="'.base_url("auth/activate/".$activationLink).'">link</a>. Or copy paste the following link in the browser: '.base_url("auth/activate/".$activationLink).'. \r\n\r\nFor doubts contact: wsdc.nitw@gmail.com\r\nCheers,\r\nTeam WSDC';
                if ($this->myemail->send($mailDetails)) {
                    $stat['message'] = "Mail Sent Successfully with a new Activation link";
                    $stat['status']="success";
                } else {
                    $stat['message'] = 'Error sending mail. Is your mail-id correct?';
                }
            }
        }
        echo json_encode($stat);
    }

    public function reset_password() {
        $password = $this->input->post('password');
        $activationLink = $this->input->post('activationLink');

        if($this->auth_model->set_new_password($activationLink,$password)){
            $stat['message']='Password reset successful';
            $stat['status']="success";
        }else{
            $stat['message']='Password reset failed... Try again';
            $stat['status']="failure";
        }
        echo json_encode($stat);
    }

    public function changepasswd() {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $data = array();
        $data['scripts'] = array('profile.js');
        $data['title'] = "Change Password";
        $data['current_page'] = 'changepasswd';
        $this->load->view('base/header', $data, FALSE);
        $this->load->view('audit/menu/header', $data, FALSE);
        $this->load->view('auth/changepassword', $data, FALSE);
        $this->load->view('audit/menu/footer', $data, FALSE);
        $this->load->view('base/footer', $data, FALSE);
    }

    public function samepassword($str)
    {
        if($str == $this->input->post('currentpassword'))
        {
            $this->form_validation->set_message('samepassword', 'The new password cannot be same as previous  ');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    public function changepasswdvalidate()
    {
        if($this->input->post('newpassword') === false) redirect(base_url('auth/changepasswd'), "location", 301);
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('currentpassword', 'Current Password', 'trim|required|min_length[6]|xss_clean|md5');
        $this->form_validation->set_rules('newpassword', 'New password', 'trim|required|min_length[6]|matches[confirmnewpassword]|xss_clean|md5');
        $this->form_validation->set_rules('confirmnewpassword', 'New password confirmation', 'trim|required|min_length[6]|xss_clean|callback_samepassword');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>', '</div>');
        if ($this->form_validation->run() == TRUE)
        {
            if($this->auth_model->changepasswd($this->nativesession->get('userid'),
                $this->input->post('currentpassword'),
                $this->input->post('newpassword')) === TRUE)
            {
                $data = array();
                // $data['scripts'] = array('home.js');
                $data['title'] = "Audit Home";
                $data['message'] = "Password successfully changed";
                $this->session->set_flashdata('warning', 'Password successfully changed');
                $this->logout();
            }
            else
            {
                $data = array();
                // $data['scripts'] = array('feedback.js');
                $data['title'] = "Profile";
                $data['message'] = "Access Denied. Try again";
                redirect('auth/changepasswd');
            }
        }
        else
        {
            $data = array();
            // $data['scripts'] = array('feedback.js');
            $data['title'] = "Change Password";
            redirect('auth/changepasswd');
        }
    }

    public function reset($id) {
        if(empty($id)) {
            redirect(base_url(),"location",301);
            return ;
        }
        if (($userid = $this->auth_model->get_userid_actlink($id))===false) {
            redirect(base_url(),"location",301);
            return ;
        }
        $data['userid']=$userid;
        $data["activation_link"]=$id;
        $this->_render_page("auth/reset",$data,FALSE);
    }

    public function logout() {
        $this->nativesession->destroy();
        redirect(base_url(), "location", 301);
        return;
    }

    function _render_page($view, $data=null, $render=false)
    {
        $view_html = array( 
            $this->load->view('auth/menu/header', $data, $render),
            $this->load->view($view, $data, $render),  
            $this->load->view('auth/menu/footer', $data, $render),
            );
        if (!$render) return $view_html;
    }

    function _render_register_page($view, $data=null, $render=false)
    {
        $view_html = array( 
            $this->load->view('auth/menu/register_header', $data, $render),
            $this->load->view($view, $data, $render),  
            $this->load->view('auth/menu/footer', $data, $render),
            );
        if (!$render) return $view_html;
    }


}
