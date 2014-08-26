<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Studentmodel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->config('hostels/hostels_config',  TRUE);
		$this->tables = $this->config->item('tables', 'hostels_config');
	}
	
	//@vaibhav awachat
	public function is_neft($regno ="")
	{
		$this->hostel_db = $this->load->database('hostels', TRUE);
		$query = $this->hostel_db->select()
								 ->where('regno', $regno)
								 ->get('rawpayments');
		if($query->num_rows() > 0)
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	//@Vaibhav Awachat
	public function get_student_transactions($reg_no = ''){
		if(empty($reg_no))
			return false;
		$this->hostel_db = $this->load->database('hostels', TRUE);
		$query = $this->hostel_db->select('regno, emc, seatrent, mess_dues, mess_advance, maintenance_charges, (emc + seatrent + mess_advance + mess_dues + maintenance_charges) as total, timestamp')
								 ->where('regno', $reg_no)
								 ->get($this->tables['studentpayments']);
		if($query->num_rows() > 0)
		{
			//print_r($query->result('array'));
			return $query->result('array');
		}
		else{
			return FALSE;
		}
	}

	/* 
	Anik Das
	function to get student type ID
	 */
	public function get_student_detail($regno=''){
		if(empty($regno)) return FALSE;
		$this->hostel_db = $this->load->database('hostels', TRUE);
		$this->hostel_db->select()
						->from('students')
						->where(array('regno'=>$regno));
		$query = $this->hostel_db->get();
		if($query->num_rows()>0){
			return $query->first_row('array');
		}else{
			return FALSE;
		}
	}

	/*
	Anik Das
	*/
	//this function also returns neft detail else false
	public function has_neft($regno){
		$this->hostel_db = $this->load->database('hostels', TRUE);
		$this->hostel_db->select('*')
						->from($this->tables['rawpayments'])
						->where(array('registration_number'=>$regno));
		$query = $this->hostel_db->get();
		if($query->num_rows()>0){
			$data = $query->result_array();
			$data['im_list'] = scandir('./uploads/'.$regno);
			return $data;
		}else{
			return false;
		}
	}
	public function add_neft_detail($data){
		$date = new DateTime();
		$insert_data = array(
			'registration_number' => $data['regno'],
			'transaction_id' => $data['id'],
			'transaction_date' => $data['date'],
			'type' => $data['category'],
			'category' => $data['mode'],
			'mess_dues' => $data['neftMessDue'],
			'mess_advance' => $data['neftMessAdv'],
			'seat_rent' => $data['neftSeat'],
			'maintenance' => $data['neftMain'],
			'EWC' => $data['neftEwc'],
			'fee_account' => $data['neftFee'],
			'other' => $data['neftOthers'],
			'total' => $data['ammnt'],
			'created_on' => $date->format('Y-m-d H:i:s')
		);
		$this->hostel_db = $this->load->database('hostels', TRUE);
		$this->hostel_db->insert($this->tables['rawpayments'], $insert_data);
		if($this->hostel_db->affected_rows()>0){
			return true;
		}else{
			return false;
		}
	}

	public function get_student_details($reg_num)
	{
		$this->hostel_db = $this->load->database('hostels', TRUE);
		$this->hostel_db->where('regno', $reg_num);
		$query = $this->hostel_db->select('regno, c.name as class, sd.roll_number as roll, sd.name as sname, sd.mobile as contact, sd.email as email, st.year as year, at.name as admissiontype, st.gender, r.number as room, r.floor as floor, h.name as hostel, m.name as mess, s.timestamp as timestamp, s.hosteltypeid as hostelid, s.messid, s.roomid, s.hosteltypeid as studenttypeid, s.blocked, mt.father_name as father')
		->join($this->tables['student_data1'].' AS sd ', 's.regno = sd.registration_number', 'left')
		->join($this->tables['studenttypes'].' AS st ', 's.hosteltypeid = st.id', 'left')
		->join($this->tables['admissiontypes'].' as at ', 'st.admissiontypeid = at.id', 'left')
		->join($this->tables['rooms'].' as r ', 's.roomid = r.id', 'left')
		->join($this->tables['classes'].' as c ', 'st.class = c.id', 'left')
		->join($this->tables['hostels'].' as h ', 'r.hostelid = h.id', 'left')
		->join($this->tables['messes'].' as m ', 's.messid = m.id', 'left')
		->join($this->tables['messtransactions'].' as mt ', 's.regno = mt.registration_number', 'left')
		->limit(1)
		->get($this->tables['students'].' as s ');
		if($query->num_rows() > 0)
		{
			return $query->first_row('array');
		}
		else
			return FALSE;
	}


	public function get_student_messtransactions($reg_no = '')
	{
		$this->hostel_db = $this->load->database('hostels', TRUE);
		$query = $this->hostel_db->select('bank_reference_no as transactionid, amount, transaction_date as date, transaction_type')
		->where('registration_number', $reg_no)
		->get($this->tables['messtransactions']);
		//print_r($query->result());
		if($this->db->affected_rows() > 0)
			return $query->result('array');
		else
			return FALSE;
	}

}

/* End of file studentmodel.php */
/* Location: ./application/modules/hostels/controllers/studentmodel.php */