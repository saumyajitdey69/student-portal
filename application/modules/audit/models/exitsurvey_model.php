<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exitsurvey_model extends CI_Model {

	public function __construct() {
		parent::__construct();
		// $this->load->config('audit/audit_config', TRUE);
		// $this->tables = $this->config->item('tables','audit_config');
	}
	
	public function feedback_status($roll_number) {
		$this->db->select('feedback_status')->from('students')->where(array('roll_number' => $roll_number, 'year' => $year));
		$query = $this->db->get();
	}
	
	public function insert_feedback($data) {
		$this->db->insert('exitsurvey', $data);
	}
