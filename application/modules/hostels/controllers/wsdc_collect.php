<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
*/
class Wsdc_collect extends MY_Controller
{
	
	function __construct(){
        parent::__construct();
        $this->load->library('auth/ion_auth');
        if (!$this->ion_auth->logged_in())
            redirect('auth/login');
        $this->load->model('audit/audit_model');
        if ($this->audit_model->profile_edited($this->user_id) === false)
        {
            $this->session->set_flashdata('danger', 'Complete your profile');
            redirect(base_url('audit/profile'), 'location', 301);
            return false;
        }
        $this->load->model('hostelmodel', '', TRUE);
        $this->load->model('messmodel', '', TRUE);
        $this->load->model('studentmodel');
	}
	public function index($value=''){
		$data['current_page'] = 'wsdc_collect';
	    $data['title'] = 'WSDC Collect | OMAHA';
	    $this->load->model('studentmodel');
	    $regno = $this->hostelmodel->userid_to_regno($this->user_id);
	    $data['neftdd_details'] = $this->studentmodel->has_neft($regno);
	    $messdues = $this->messmodel->getMessDues($regno);
	    $data['regno'] = $regno;
	    $data['scripts'] = array('bootstrap-datepicker.js','neft.js');
	    $this->_render_page('wsdc_collect', $data);
	  //return $this->home();
	}
	public function neft_details(){
	    $response = array();
	    $error = array();
	    $message = array();
	    $details = $this->input->post();
	    if (!($details['mode'] == 'neft' || $details['mode'] == 'dd' || $details['mode'] == 'inter')) {
	        $error_m = 'undefined mode';
	        array_push($error, $error_m);
	    }
	    if(floatval($details['ammnt'])==0){
	        $error_m = 'invalid ammount';
	        array_push($error, $error_m);
	    }
	    if(empty($details['id'])){
	        $error_m = 'invalid transaction ID';
	        array_push($error, $error_m);
	    }
	    if(empty($details['date'])){
	        $error_m = 'invalid date';
	        array_push($error, $error_m);
	    }
	    if(!isset($details['category'])){
	        $error_m = 'invalid category';
	        array_push($error, $error_m);
	    }

	    $regno = $this->hostelmodel->userid_to_regno($this->user_id);
	    $details['regno'] = $regno;
	    if(!empty($error)){
	        $response['message'] = $message;
	        $response['error'] = $error;
	        echo json_encode($response);
	        return 1;
	    }
	    if($details['mode']=='neft'){
	        $details['mode']='1';
	    }
	    if($details['mode']=='dd'){
	        $details['mode']='2';
	    }
	    if($details['mode']=='inter'){
	        $details['mode']='3';
	    }
	    $status = $this->studentmodel->add_neft_detail($details);
	    if($status){
	        $message_d = 'successful';
	        array_push($message, $message_d);
	        $response['message'] = $message;
	        echo json_encode($response);
	    }else{
	        $error_m = 'Some error occured';
	        array_push($error, $error_m);
	        $response['message'] = $message;
	        $response['error'] = $error;
	        echo json_encode($response);
	    }
	}
	public function neft_files(){
	    $regno = $this->hostelmodel->userid_to_regno($this->user_id);
	    $files = $_FILES['files'];
	    $id = $_POST['transaction_id'];
	    $uploaddir = './uploads/'.$regno .'/';
	    $response = array();
	    $error = array();
	    $messages = array();
	    if(!file_exists($uploaddir)){
	        mkdir($uploaddir);
	    }
	    if($files['size'][0]/1024>1024){
	        $error_m = 'file too big';
	        array_push($error, $error_m);
	        $response['error'] = $error;
	        echo json_encode($response);
	        return 1;
	    }
	    $uploadfile = $uploaddir . basename($id.'.jpeg');
	    if (move_uploaded_file($files['tmp_name'][0], $uploadfile)) {
	    	$message = 'successful';
	        array_push($messages, $message);
	        $response['messages'] = $message;
	        echo json_encode($response);
	    } else {
	        $error_m = 'file upload failed';
	        array_push($error, $error_m);
	        $response['error'] = $error;
	        echo json_encode($response);
	        return 1;
	    }
	}
	function _render_page($view, $data=null, $render=false){
	    $data['current_section'] = 'hostels';
	    $this->viewdata = (empty($data)) ? $data: $data;
	    $view_html = array( 
	        $this->load->view('base/header', $data, $render),
	        $this->load->view('menu/header', $data, $render),
	        $this->load->view($view, $this->viewdata, $render),
	        $this->load->view('menu/footer', $data),
	        $this->load->view('base/footer', $data, $render)
	        );
	    if (!$render) return $view_html;
	}
}
/* End of file test.php */
/* Location: ./application/modules/audit/controllers/test.php */
?>