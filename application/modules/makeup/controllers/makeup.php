<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Makeup extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth/auth_model', '', TRUE);
		if ($this->nativesession->get('userid') === null) {
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
		$this->load->model('makeup/makeup_model');
	}

	public function index()
	{  
		$data['scripts'] = array('/makeup/makeup.js');
		$data['details'] = $this->makeup_model->get_student_details($this->nativesession->get('userid'));
		$registered = $this->makeup_model->get_student_info($this->nativesession->get('userid'));
		$new_registered = array();
		if(!empty($registered) || $registered != false)
			foreach ($registered as $key => $r) {
				$item = $r;
				$item["lists"] = $this->makeup_model->get_registered_coursese_list($r['id']);
				$new_registered[] = $item;
			}
			$data['registered'] = $new_registered;
			$this->_render_page('index', $data);
		}

		public function add_course()
		{
			$course_id = $this->input->post('courseid');
			$course_name = $this->input->post('course_name');
			$status = array();
			if($this->makeup_model->add_course($course_id, $course_name) === true)
			{
				$status['code'] = "1";
				$status['message'] = 'Course successfully added in database';
				$status = json_encode($status);
				echo $status;
				return;
			}
			else
			{
				$status['code'] = "0";
				$status['message'] = 'Unable to add course in database. Please try again';
				$status = json_encode($status);
				echo $status;
				return;
			}
		}

		public function makeup_slip(){
			$this->load->model('makeup/makeup_model');
			$data['current_page'] = 'slip';
			$data['scripts'] = array('makeup/makeup.js','makeup/slip.js');
			$userid=$this->nativesession->get('userid');
			// details in student info table, all the trasactions and everything
			// may have multiple trasactions
			$registered= $this->makeup_model->get_student_info($userid); 

			//make a new registered array for processing
			$new_registered = array();
			if(!empty($registered) || $registered != false)
				foreach ($registered as $key => $r) {
					$item = $r;
					// get the registreed courses list for each trasactions
					$item["lists"] = $this->makeup_model->get_registered_coursese_list($r['id']);
					$new_registered[] = $item;
				}
				$data['registered'] = $new_registered;
				// $data[''registered'] has the trasaction id and all the transaction correspoing to it.
				$count = 0;
				if (!empty($new_registered) and $new_registered != FALSE){
					foreach ($new_registered as $key => $r) {
						$data['reg_roll'] = $r['rollNo'];
						$data['reg_name'] = $r['name'];
						$data['reg_branch'] = $r['branch'];
						$data['reg_course'] = $r['class'];
						$data['transaction_ids'][$key]= $r["transaction_id"] ;
						$data['paid']= $r["paid"] ;
						$data['transaction_date']=$r["transaction_date"] ;
						if (!$r["lists"] == false){
							foreach ($r["lists"] as $key => $list){
								$data['reg_course_id'][$count]=$list['course_id'] ;
								$data['reg_id'][$count]=$list['id'] ;
								$data['reg_course_name'][$count]=$list['course_name'];
								$count++;
								// $data['reg_course_credit'][$key]=$list['credit'] ;
								// $data['reg_study_exam'][$key]=$list['type'];
							}
						}
					}
				}
				$data['current_section'] = 'slip';
				$data['current_page'] = "makeup";
				if($registered==FALSE)
				{
					$this->session->set_flashdata('danger', 'You did not registered for makeup examination. Please register and then print registration slip');
					redirect(base_url('makeup'), 'location', 301);
				}
				else
				{ 
					$this->load->model('makeup_model');
					$details=$this->makeup_model->get_cid_sem_year($data['reg_roll']);
					$flag=true;
					foreach ($details as $key => $value) {
						$data['course_id'][$key]=$value['course_id'];
						$data['sem'][$key]=$value['sem'];
						$data['year'][$key]=$value['year'];
						if($value['sem']=="0" || $value['year']=="0")
						{
							$flag=false;
						}
					}

					if($flag==false){
						$this->session->set_flashdata('danger', 'Please Update semester and year of all subjects');
						$data['details'] = $this->makeup_model->get_courses_all($data['reg_roll']);
						
						$this->_render_page('makeup/update_sem_year',$data);
						return;

					}
					else
					{		 
						$data['details'] = $this->makeup_model->get_courses_all($data['reg_roll']);
						$this->load->view('makeup/slip',$data);
					}
				}
			}

			public function update_courses_details()
			{
				$this->load->library('form_validation');
				$this->form_validation->set_rules('id', 'Course id', 'trim|required|is_numeric|xss_clean');
				$this->form_validation->set_rules('year', 'Year', 'trim|required|is_numeric|xss_clean');
				$this->form_validation->set_rules('sem', 'Semester ', 'trim|required|is_numeric|xss_clean');
				$status=array();
				if($this->form_validation->run())
				{
					$id = $this->input->post("id");
					$sem = $this->input->post("sem");
					$year = $this->input->post("year");
					$userid = trim($this->nativesession->get('userid'));
			// get roll number, registration  number, name, roll number, branch, class, contact
					$user_data = $this->makeup_model->get_student_details($this->nativesession->get('userid'));
					$flag = $this->makeup_model->update_courses($id, $year, $sem);
					if($flag === TRUE)
					{
						$status['code'] = '1';
						$status['message'] = 'Course semester and year updated successfully';
						$status= json_encode($status);
						echo $status;
						return;
					}
					else
					{
						$status['code'] = '0';
						$status['message'] = "It is already updated, please ignore";
						$status= json_encode($status);
						echo $status;
						return;
					}
				}
				else
				{
					$status['code'] = '0';
					$status['message'] = validation_errors();
					$status= json_encode($status);
					echo $status;
					return;
				}
			}

			public function update_details2(){
				$this->load->model('makeup_model');
				$userid=$this->nativesession->get('userid');
				$temp= $this->makeup_model->get_student_info($userid);
				$data = $this->makeup_model->update_sem_year($temp[0]['rollNo'] ,
					array('course_id'=> $this->input->post('course_id'),
						'sem' => $this->input->post('semester'),
						'year' => $this->input->post('year')
						)
					);

				redirect('makeup/makeup_slip',$data) ;


			}
			public function update_details(){
				$this->load->model('makeup_model');
				$userid=$this->nativesession->get('userid');
				//$temp may make multiple trasactions
				$temp= $this->makeup_model->get_student_info($userid);  
				foreach ($temp as $key => $t) {
					$course_det=$this->makeup_model->get_cid_sem_year($t['rollNo']);
					$details=array();
					foreach ($course_det as $key => $value) {
						$details['course_id'][$key]=$value['course_id'];
						$details['sem'][$key]=$this->input->post('semester');
						$details['year'][$key]=$this->input->post('year') ;
					}
				}
				$this->makeup_model->update($temp[0]['rollNo'],$details);
				redirect('makeup/makeup_slip','refresh') ;
			}


			public function register()
			{
				$status['code'] = '0';
				$status['message'] = "Online Registrations are closed. Please contact Associate Dean Examination for further details";
				$status= json_encode($status);
				echo $status;
				return;
				$this->load->library('form_validation');
				$this->form_validation->set_rules('transactionId', 'Transaction Id', 'trim|required|ctype_alnum|xss_clean');
				$this->form_validation->set_rules('totalAmtPaid', 'Total amount paid', 'trim|required|is_numeric|xss_clean|callback_amount_check');
				$this->form_validation->set_rules('tDate', 'Transaction Date', 'trim|required|xss_clean');
				$this->form_validation->set_rules('courses_list', 'Courses list', 'trim|required|xss_clean');
				$status=array();
				if($this->form_validation->run())
				{
					$tid = $this->input->post("transactionId");
					$tdate = $this->input->post("tDate");
					$list = json_decode($this->input->post("courses_list"), true);
					$totamt = $this->input->post("totalAmtPaid");
					$userid = trim($this->nativesession->get('userid'));
			// get roll number, registration  number, name, roll number, branch, class, contact
					$user_data = $this->makeup_model->get_student_details($this->nativesession->get('userid'));
					$flag = $this->makeup_model->register($tid, $tdate, $list, $totamt, $user_data, $userid);
					if($flag['code'] === TRUE)
					{
						$status['code'] = '1';
						$status['message'] = 'Registered successfully';
						$status= json_encode($status);
						echo $status;
						return;
					}
					else
					{
						$status['code'] = '0';
						$status['message'] = $flag['message'];
						$status= json_encode($status);
						echo $status;
						return;
					}
				}
				else
				{
					$status['code'] = '0';
					$status['message'] = validation_errors();
					$status= json_encode($status);
					echo $status;
					return;
				}
			}

			public function amount_check($amt)
			{
				$count = count(json_decode($this->input->post('courses_list'), TRUE));
				if($amt%600 != 0)
				{
					$this->form_validation->set_message('amount_check', 'The %s should be multiple of 600');
					return FALSE;
				}
				elseif($amt < 600){
					$this->form_validation->set_message('amount_check', 'The %s should be greater than 600');
					return FALSE;
				}
				elseif($amt/600 != $count)
				{
					$this->form_validation->set_message('amount_check', 'The total amount paid and the number of subject does not matches. Please check the amount and number of courses');
					return FALSE;
				}
				else
				{
					return TRUE;
				}
			}

			public function get_course()
			{
				$this->load->library('form_validation');
				$this->form_validation->set_rules('courseid', 'Course Id', 'trim|required|min_length[5]|ctype_alnum|xss_clean');
				$status=array();
				if($this->form_validation->run())
				{
					$item = $this->makeup_model->get_courses($this->input->post("courseid")) ;
					if($item != FALSE)
					{
						$status['code'] = '1';
						$status['course_id'] = $item["course_id"];
						$status['course_name'] = $item["course_name"];
						$status= json_encode($status);
						echo $status;
						return;
					}
					else
					{
						$status['code'] = '0';
						$status['message'] = 'Course does not exist in our database. Please send the course id and course name (full name) to wsdc.nitw@gmail.com. We will update it asap';
						$status= json_encode($status);
						echo $status;
						return;
					}
				}
				else
				{
					$status['code'] = '0';
					$status['message'] = validation_errors();
					$status= json_encode($status);
					echo $status;
					return;
				}
			}

			function _render_page($view, $data=null, $render=false)
			{
				$data['current_page'] ='makeup';
				$data['current_section'] = 'makeup';
				$view_html = array(
					$this->load->view('base/header', $data, $render),
					$this->load->view('menu/header'),
					$this->load->view($view, $data, $render),
					$this->load->view('menu/footer'),
					$this->load->view('base/footer', $data, $render)
					);
				if (!$render) return $view_html;
			}
		}

		/* End of file makeup.php */
		/* Location: ./application/modules/makeup/controllers/makeup.php */
