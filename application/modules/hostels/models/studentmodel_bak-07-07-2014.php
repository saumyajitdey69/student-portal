<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Studentmodel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->config('hostels/hostels_config',  TRUE);
		$this->tables = $this->config->item('tables', 'hostels_config');
	}
	
	//@Vaibhav Awachat
	public function get_student_transactions($reg_no = '')
	{
		$this->hostel_db = $this->load->database('hostels', TRUE);
		$query = $this->hostel_db->select('regno, tuitionfee, otherfee, emc, seatrent, mess_dues, mess_advance, maintenance_charges, (tuitionfee + otherfee + emc + seatrent + mess_advance + mess_dues + maintenance_charges) as total, timestamp')
								 ->where('regno', $reg_no)
								 ->get($this->tables['studentpayments']);
		if($this->hostel_db->affected_rows() > 0)
			return $query->result('array');
		else
			return FALSE;
	}
}

/* End of file studentmodel.php */
/* Location: ./application/modules/hostels/controllers/studentmodel.php */