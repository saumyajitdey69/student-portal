<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Status extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$this->load->model('feedback_model');
		$data['title'] = "Academic Feedback Status";
		$query=$this->feedback_model->get_rollnos2();
		// print_r($query);
		$total=0;
		foreach ($query as $roll) {
			// $query2=$this->feedback_model->get_courses($roll->roll);
			$num_courses=0;
			// foreach ($query2 as $row)
			{
				for($i=1;$i<=15;$i++)
				{
					$cid="c".$i;
					if(!is_null($roll[$cid]))
					{
						$num_courses++;
					}
					else
						break;
				}
			}
			$userid=$this->feedback_model->get_userid($roll['roll']);
			$status=$this->feedback_model->get_status($userid);
			$flag=1;
			for($i=0;$i<$num_courses;$i++)
			{
				if($status[$i]=='0')
				{
					$flag=0;
					break;
				}
			}
			if($flag==0)
			{
				$total++;
				$student_data=$this->feedback_model->get_student_data($userid);
				// print_r($student_data->roll_number);
				$data['student_data'][]=$student_data;
			}
		}
		$data['total']=$total;
		$this->load->view('feedback/status',$data);
	}
	public function get_status()
	{
		$this->load->model('feedback_model');
		$data['title'] = "Academic Feedback Status";
		$query=$this->feedback_model->get_rollnos();
		// print_r($query);
		$total=0;
		foreach ($query as $roll) {
			$query2=$this->feedback_model->get_courses($roll->roll);
			$num_courses=0;
			foreach ($query2 as $row)
			{
				for($i=1;$i<=15;$i++)
				{
					$cid="c".$i;
					if(!is_null($row[$cid]))
					{
						$num_courses++;
					}
					else
						break;
				}
			}
			$userid=$this->feedback_model->get_userid($roll->roll);
			$status=$this->feedback_model->get_status($userid);
			$flag=1;
			for($i=0;$i<$num_courses;$i++)
			{
				if($status[$i]=='0')
				{
					$flag=0;
					break;
				}
			}
			if($flag==0)
			{
				$total++;
				$student_data=$this->feedback_model->get_student_data($userid);
				// print_r($student_data->roll_number);
				$data['student_data'][]=$student_data;
			}
		}
		$data['total']=$total;
		$this->load->view('feedback/status',$data);
	}
	function _render_page($view, $data=null, $render=false)
	{
		$data['current_section'] = 'audit';
		$view_html = array(
			$this->load->view('base/header', $data, $render),
			$this->load->view($view, $data, $render),
			$this->load->view('audit/menu/footer', $data, $render),
			$this->load->view('base/footer', $data, $render)
			);
		if (!$render) return $view_html;
	}
}