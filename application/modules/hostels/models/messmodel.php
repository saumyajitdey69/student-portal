<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messmodel extends CI_Model {
	public function __construct()
	{
		parent::__construct();
				$this->load->config('hostels/hostels_config',  TRUE);
		$this->tables = $this->config->item('tables', 'hostels_config');
	}	

	//@Vaibahv Awachat
	public function getMessDues($regno = '')
	{
		$this->hostel_db = $this->load->database('hostels', TRUE);
		if(empty($regno)){
			return false;
		}
		$query = $this->hostel_db->select('due, advance, total')->from('messdues')->where('regno', $regno)->get();
		if($query->num_rows() > 0){
			return $query->first_row('array');
		}else{
			return false;
		}
	}

	//@Vaibhav Awachat
	public function MessDetail($messid='')
	{
		$this->hostel_db = $this->load->database('hostels', TRUE);
		if(!empty($messid)){
			$this->hostel_db->where('id', $messid);
		}
		$query = $this->hostel_db->select()->from('messes')->get();
		if($query){
			if(!empty($messid)){
			return $query->first_row('array');
		}
		else{
			return $query->result('array');
		}
		}else{
			return FALSE;
		}
	}

	//@Vaibhav Awachat
	public function mess_allotment_history($reg_no='')
	{
		$this->hostel_db = $this->load->database('hostels', TRUE);
		$query = $this->hostel_db->select('m.name as mess, ma.timestamp, ma.status')
								->where('regno', $reg_no)
								->from($this->tables['messallotments'].' as ma ')
								->join($this->tables['messes'].' as m', 'm.id = ma.messid')
								->order_by('timestamp desc')
								->get();
		if($query->num_rows())
			return $query->result('array');
		else
			return FALSE;
	}

	//@Vaibhav Awachat
	public function get_student_messtransactions($reg_no = '')
	{
		$this->hostel_db = $this->load->database('hostels', TRUE);
		$query = $this->hostel_db->select('bank_reference_no as transactionid,transaction_date as date, registration_number as regno, mess_dues, mess_advance, maintenance_charges, amount as total, transaction_type, timestamp')
		->where('registration_number', $reg_no)
		->get($this->tables['messtransactions']);
		if($this->hostel_db->affected_rows() > 0)
			return $query->result('array');
		else
			return FALSE;
	}
}

/* End of file messmodel.php */
/* Location: ./application/modules/hostels/models/messmodel.php */