<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feedback extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth/auth_model', '', TRUE);
		if ($this->nativesession->get('userid') === null)
		{
			redirect(base_url('auth'), 'location', 301);
			return false;
		}
		$this->load->model('audit_model');
		if ($this->audit_model->profile_edited($this->nativesession->get('userid')) === false)
		{
			$this->session->set_flashdata('danger', 'Complete your profile');
			redirect(base_url('audit/profile'), 'location', 301);
			return false;
		}
	}
	public function update_cgpa(){
		$this->load->model('audit/feedback_model');
		$this->feedback_model->update_cgpa_data();
	}
	public function get_missing()
	{
		$data = array();
		$this->load->model('feedback_model');
		$query=$this->feedback_model->get_rollnos();
		foreach ($query as $roll) {
			$query2=$this->feedback_model->get_courses($roll->roll);
			$structure=array();
			$j=0;
			foreach ($query2 as $row)
			{
				$structure[$j]['branch']=$row['branch'];
				$structure[$j]['sem']=$row['sem'];
				$structure[$j]['session_id']=$row['session_id'];
				$structure[$j]['class']=$row['class'];

				$k=0;
				$structure_id=$row['structure_id'];
			// $structure_id=$this->feedback_model->get_structure_id($structure[$j]);
				$structure[$j]['sec']=$row['sec'];
				for($i=1;$i<=15;$i++)
				{
					$cid="c".$i;
					$name="name".$i;
					$credit="credit".$i;
					$type="type".$i;
					if(!is_null($row[$cid]))
					{
						$structure[$j]['courses'][$k]['id']=$row[$cid];
						$structure[$j]['courses'][$k]['name']=$row[$name];
						$structure[$j]['courses'][$k]['credits']=$row[$credit];
						$structure[$j]['courses'][$k]['type']=$row[$type];
						if($row['sec']=="0")
							$row['sec']="NO";
						$faculty_detail=$this->feedback_model->get_cfid
						($structure_id,$row[$cid],$row['sec']);
						if($faculty_detail!=FALSE)
						{
							$structure[$j]['courses'][$k]['cfid']=$faculty_detail->id;
							$structure[$j]['courses'][$k]['faculty_id']=$faculty_detail->faculty_id;

							$structure[$j]['courses'][$k]['faculty_name']=$faculty_detail->faculty_name;
						}
						else
						{
							$this->feedback_model->add_missing_course($row[$cid],$structure_id,$row['sec']);
						}
						$k++;
					}
				}

				$j++;
			}
		}

	}

	public function index()
	{
		$data = array();
		$data['title'] = "Academic Feedback";
		$data['section_page'] = 'audit';
		$data['current_page'] = 'feedback';
		$data['scripts']=array('JavaScriptSpellCheck/include.js','feedback/feedback.min.js','notify/bootstrap-notify.js');
		$this->load->model('feedback_model');

		//////// allowed feedback code ///////////
		$userid = $this->nativesession->get('userid');

		$this->load->model('audit/results_model', 'results_model');
		$roll = $this->results_model->get_roll_number($userid);
		if($this->results_model->_is_allowed_for_feedback($roll) === FALSE)
		{	
			$this->session->set_flashdata('danger', 'Feedback is closed. If you did not fill the feedback please contact Associate Dean Academic Audit. <br> After the approval of Dean it takes 2-3 days for receiving the results and	activating feedback. <br> Please do not contact WSDC for this issue.');
			redirect('audit');
			return;
		}
        ////////////////////////////////
		if ($this->feedback_model->get_cgpa($this->nativesession->get('userid')) == 0) {
			redirect(base_url("audit/feedback/cgpa"), "location", 301);
			return;
		}
		$feedback_status=$this->feedback_model->get_status($this->nativesession->get('userid'));
		$query=$this->feedback_model->get_feedback_courses($this->nativesession->get('userid'));
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
				if(!is_null($row[$cid]))
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
		$data['feedback_status']=$feedback_status;
		$data['students_courses']=$structure;
		$data['userid']=$this->nativesession->get('userid');
		$this->_render_page('feedback/feedback_view',$data);
	}


	
	public function cgpa()
	{
		$data = array();
		$data['title'] = "CGPA - Feedback";
		$data['current_page'] = 'feedback';

		$this->_render_page('feedback/cgpa_form',$data);
	}
	public function setcgpa()
	{

		$this->load->model('feedback_model');
		$this->feedback_model->set_cgpa($this->nativesession->get('userid'), $this->input->post('cgpa'));
		redirect(base_url("audit/feedback"), "location", 301);
	}
	function submit_feedback()
	{
		$this->load->model('feedback_model');
		$data=$this->input->post();
		for($i=0;$i<35;$i++)
		{
			if($data['value'][$i]=='0')
			{
				echo 2;//all fields are not filled
				return;
			}
		}
		// $value=$this->input->post('value');
		// $cfid=$this->input->post('cfid');
		$userid=$this->nativesession->get('userid');
		// $comment=$this->input->post('comment');
		// $status_bit=$this->input->post('status');

		$status=$this->feedback_model->get_status($userid);
		$data['rollno']=$this->feedback_model->get_roll($userid);
		$data['cgpa']=$this->feedback_model->get_cgpa($userid);
		if(isset($_POST['comment']))
		{
			$comment=$data['comment'];
			unset($data['comment']);
		}
		$status_bit=$data['status'];
		$cfid=$data['cfid'];
		unset($data['status']);
		if($status[$status_bit]!='1')
		{
			$status_comment=1;
			$status_feedback=$this->feedback_model->insert_feedback($data);
			if(isset($_POST['comment']))
			{
				unset($data['value']);
				for($i=0;$i<sizeof($comment);$i++)
				{
					$data['comment']=$comment[$i]['content'];
					$data['comment_type']=$comment[$i]['type'];
					$status_comment=$status_comment & $this->feedback_model->insert_feedback_comment($data);
				}
				// print_r($comment);
			}
			$status[$status_bit]='1';
			$status=$this->feedback_model->update_feedback_status($userid,$status);
			if($status_feedback && $status_comment && $status)
				echo 1;
		}
		else
			echo 0;
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

/* End of file feedback.php */
/* Location: ./application/modules/audit/controllers/feedback.php */