<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Audit extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('audit_model');
		if ($this->audit_model->profile_edited($this->user_id) === false)
		{
			$this->session->set_flashdata('danger', 'Complete your profile');
			redirect(base_url('audit/profile'), 'location', 301);
			return false;
		}
		$image = 'assets/upload/thumbs/'.$this->session->userdata('registration_number').'.jpg';
		if(!file_exists($image))
			redirect('upload');

	}

	/*Error*/
	// public function correction()
	// {
	// 	if($this->ion_auth->is_admin())
	// 	{
	// 		$rollNumbers=$this->correction_model->getAllRollNumbers();
	// 		foreach ($rollNumbers as $rollNumber) 
	// 		{
	// 			$userId=$this->correction_model->getUserId($rollNumber['roll']);
	// 			$feedbackDetails=$this->correction_model->getFeedback();
	// 			$count=count($feedbackDetails);
	// 			$feedback="";
	// 			for($i=0;$i<$count;$i++)
	// 				$feedback+="1";
	// 			$this->correction_model->insertFeedback($userId,$feedback);
	// 		}
	// 	}
	// }
	public function view($username = '')
	{
		$this->load->library('form_validation');

		$details = $this->audit_model->get_public_profile($username);
        // var_dump($details);
		$data['details'] = $details;
		$data['submitted'] = '';
		$data['scripts'] = array('profile/profile.js');
		$data['title'] = "Profile";
		$data['current_page'] = "profile";
		$this->_render_page('profile/index', $data);
	}

	public function getSearchData(){
		$searchStr = $this->input->post('search-string');
		return $this->audit_model->getSeachItem($searchStr, true, '5');
	}

	public function index()
	{
		$this->home();
	}

	public function home()
	{
		$data['title'] = "Audit | Home";
		$data['current_section'] = 'audit';
		$data['current_page'] = "home";
		$data['title'] = 'Student Portal | Academic Section ';
		$data['scripts'] = array('home.js');
		$this->_render_page('audit/home', $data);
	}
	
	public function results()
	{
		$flag = '1';
		$this->load->model('results_model');
		$data = array();
		$roll_number = $this->results_model->get_roll_number($this->user_id);
		// $old_user_id=$this->results_model->get_old_user_id($roll_number);
		$feedback =array();
		$feedback = $this->results_model->check_feedback($this->user_id, $roll_number);
		if($feedback['code'] === TRUE)
		{
			$data['results'] = $this->results_model->list_all_results($roll_number);
		}
		else
		{
			$data['results'] = null;
			$data['message'] = $feedback['message'];
		}
		if(isset($feedback['number']) and $feedback['number'] == '1')
		{
			$data['message'] .= '<p>You can not see your academic results.<br> <strong>Contact Associate Dean Academic Audit <<a href="mailto:asd_aa@nitw.ac.in" target="_blank">asd_aa@nitw.ac.in</a></strong><br></p>';
			// get feedback status
			$this->load->model('audit/feedback_model');
			$feedback_status=$this->feedback_model->get_status($this->user_id);
			$query=$this->feedback_model->get_feedback_courses($this->user_id);
			$structure=array();
			$j=0;
			foreach ($query as $row)
			{
				$structure[$j]['branch']=$row['branch'];
				$structure[$j]['sem']=$row['sem'];
				$structure[$j]['session_id']=$row['session_id'];
				$structure[$j]['class']=$row['class'];
				$k=0;
				$structure_id=$this->feedback_model->get_structure_id($structure[$j]);
				// $structure_id=$row['structure_id'];
				$structure[$j]['sec']=$row['sec'];
				for($i=1;$i<=15;$i++)
				{
					$cid="c".$i;
					$name="name".$i;
					$credit="credit".$i;
					$type="type".$i;
					if(!is_null($row[$cid]) and $row[$type]!='e')
					{
						$structure[$j]['courses'][$k]['id']=$row[$cid];
						$structure[$j]['courses'][$k]['name']=$row[$name];
						$structure[$j]['courses'][$k]['credits']=$row[$credit];
						$structure[$j]['courses'][$k]['type']=$row[$type];
						$faculty_detail=$this->feedback_model->get_cfid
						($structure_id,$row[$cid],$row['sec']);
						if($faculty_detail!=FALSE)
						{
							$structure[$j]['courses'][$k]['cfid']=$faculty_detail->id;
							$structure[$j]['courses'][$k]['faculty_id']=$faculty_detail->faculty_id;

							$structure[$j]['courses'][$k]['faculty_name']=$faculty_detail->faculty_name;
						}
						$k++;
					}
				}

				$j++;
			}
			$data['feedback_status']  = $feedback_status;
			$data['students_courses'] = $structure;
		}
		$data['title'] = "Academic Results";
		$data['current_section'] = 'audit';
		$data['current_page'] = 'result';
		$this->_render_page('audit/results/index2', $data);
	}

	public function resultsvma()
	{
		$flag = '1';
		$this->load->model('results_model');
		$data = array();
		$roll_number = $this->results_model->get_roll_number($this->user_id);
		// $old_user_id=$this->results_model->get_old_user_id($roll_number);
		$feedback =array();
		$feedback = $this->results_model->check_feedback($this->user_id, $roll_number);
		if($feedback['code'] === TRUE)
		{
			$data['results'] = $this->results_model->list_all_results($roll_number);
		}
		else
		{
			$data['results'] = null;
			$data['message'] = $feedback['message'];
		}
		if(isset($feedback['number']) and $feedback['number'] == '1')
		{
			$data['message'] .= '<p>You can not see your academic results.<br> <strong>Contact Associate Dean Academic Audit <<a href="mailto:asd_aa@nitw.ac.in" target="_blank">asd_aa@nitw.ac.in</a>><br></p>';
		}
		// print_r($data['results']);
		// if(empty($data['results']))
		// {
		// 	$this->session->set_flashdata('danger', 'Your results are not yet declare');
		// 	redirect('audit/home');
		// }
		$data['title'] = "Academic Results";
		$data['current_section'] = 'audit';
		$data['current_page'] = 'result';
		$this->_render_page('audit/results/index', $data);
	}

	public function calendar()
	{
		$data = array();
		$data['title'] = "Academic Calender 2014-15";
		$data['current_section'] = 'audit';
		$data['current_page'] = 'calendar';
		$this->_render_page('audit/calendar/index', $data);
	}

	function _render_page($view, $data=null, $render=false)
	{
		$data['current_section'] = 'audit';
		$data['admin_logged']=$this->ion_auth->is_admin();
		$view_html = array(
			$this->load->view('base/header', $data, $render),
			$this->load->view('audit/menu/header', $data, $render),
			$this->load->view($view, $data, $render),
			$this->load->view('audit/menu/footer', $data, $render),
			$this->load->view('base/footer', $data, $render)
			);
		if (!$render) return $view_html;
	}

	//attempt to solve some issues related to auth @shashi
	public function letsseewhatwillhappen()
	{
		$this->load->model('audit_model');
		$this->audit_model->swap_password();
	}
}

/* End of file profile.php */
/* Location: ./application/modules/profile/controllers/profile.php */