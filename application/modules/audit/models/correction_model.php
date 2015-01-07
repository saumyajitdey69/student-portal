<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Correction_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//$this->load->config('results_config');
		//$this->tables = $this->config->item('tables', 'results_config');
		// $this->tables = array("results" => "results_odd_2013", "status" => "info_odd_2013", "subject_code" => "subjects_odd_2013", "feedback" =>"student_feedback", "student" =>"student_data"); 
		$this->tables = array("results" => "results_odd_2014", "status" => "info_odd_2014", "subject_code" => "subjects_odd_2014", "feedback" =>"wsdc_feedback_2014_15odd.student_feedback", "student" =>"student_data"); 
	}
}

/* End of file results_model.php */
/* Location: ./application/modules/audit/models/results_model.php */