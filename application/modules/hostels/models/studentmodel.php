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
		$query2 = $this->hostel_db->select('regno, emc, seatrent, mess_dues, mess_advance, maintenance_charges, (emc + seatrent + mess_advance + mess_dues + maintenance_charges) as total, timestamp')
								 ->where('regno', $reg_no)
								 ->get("studentpayments_main_2014");
		$mess = array();
		if($query->num_rows() > 0){
			$mess = $query->result('array');
		}
		if($query2->num_rows()> 0){
			if($mess == false){
				$mess = $query2->result('array');
			}
			else{
				$mess = array_merge($mess, $query2->result('array'));
			}
		}
		return $mess;
		
	}

	# winter
	//@Vaibhav Awachat
	public function get_current_student_transactions($reg_no = ''){
		if(empty($reg_no))
			return false;
		$this->hostel_db = $this->load->database('hostels', TRUE);
		$query = $this->hostel_db->select('regno, emc, seatrent, mess_dues, mess_advance, maintenance_charges, (emc + seatrent + mess_advance + mess_dues + maintenance_charges) as total, timestamp')
								 ->where('regno', $reg_no)
								 ->get($this->tables['studentpayments']);
		$mess = array();
		if($query->num_rows() > 0){
			$mess = $query->first_row('array');
			return $mess;
		}
		else{
			return false;
		}
		
	}


	// @Vaibhav Awachat

	public function swap_roll_with_reg($data = array())
	{
		// search roll in student data and if found replace it with registraion, make changes to transactions, messs, hostel
		$this->hostel_db = $this->load->database('hostels', TRUE);
		$query = $this->hostel_db->select('regno')->where('regno', $data['roll_number'])->get($this->tables['students'], 1);
		if($query->num_rows() > 0){
			// replace with registration number
			return $this->update_new_reg($data);
		}
		else{
			return false;
		}
	}

	public function update_new_reg($data = array())
	{
		$this->hostel_db = $this->load->database('hostels', TRUE);

			$this->hostel_db->update($this->tables['students'], array('regno' => $data['registration_number']), array('regno' => $data['roll_number']));			
			$this->hostel_db->update($this->tables['messallotments'], array('regno' => $data['registration_number']), array('regno' => $data['roll_number']));			
			$this->hostel_db->update($this->tables['messtransactions'], array('registration_number' => $data['registration_number']), array('registration_number' => $data['roll_number']));
			$this->hostel_db->update($this->tables['studentpayments_old'], array('regno' => $data['registration_number']), array('regno' => $data['roll_number']));

			// if no room is allotted to students then add new entry
			$query = $this->hostel_db->update($this->tables['roomallotments'], array('regno' => $data['registration_number']), array('regno' => $data['roll_number']));
			if($this->db->affected_rows()> 0)
				return true;
			else
				return false;			
	}

	// @Vaibhav Awachat

	public function swap_roll_with_reg_transaction($data = array())
	{
		// search the student with roll number in transaction tablle
		$this->hostel_db = $this->load->database('hostels', TRUE);
		$query = $this->hostel_db->select('registration_number, roll_number')->where('roll_number', $data['roll_number'])->from($this->tables['messtransactions'])->limit(1)->get();
		if($query->num_rows() > 0){
			$res = $query->first_row('array');
			$invalid_reg = $res['registration_number'];
			$correct_reg = $data['registration_number'];
			$new_data = array(
				'roll_number' => $invalid_reg,
				'registration_number' => $correct_reg
				);
			return $this->update_new_reg($new_data);
		}
		else{
			return false;
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

	// author: Vaibhav Awachat
	// this function fetch the class, gender and calculate the current year using registration database and hence maps with student type id
	// Student type id and registration number and dumped into wsdc_hostel.student table

	public function create_student($regno='', $sem = '')
	{
		$error = array();
		$error['status'] = true;
		// get course, joining year and gender from student profile
		$this->load->model('profile/profile_model','profile_model', TRUE);
		$this->load->database('default',true);
		$student_data = $this->profile_model->get(array('registration_number' => $regno), true, 'gender, joining_year, course, roll_number');
		// change gender alphabet to number
		$student_data['gender'] = trim($student_data['gender'])== 'M' ? '1' : '0';
		// get student course/class mapping
		$student_data['class'] = $this->get_course_id($student_data['course']);
		unset($student_data['course']);
		// get admission type id
		// for first year it's normal for all
		// its normal if not preset in dasa iccr table
		$this->hostel_db = $this->load->database('hostels', TRUE);
		$query = $this->hostel_db->select('admissiontypeid')->from('dasaiccr')->where('regno',$regno)->limit(1)->get();
		if($query->num_rows() > 0){
		$raw_data = $query->results('array');
		$student_data['admissiontypeid'] = $raw_data['admissiontypeid'] == null ? '1' : $raw_data['admissiontypeid'];
	    }
	    else{
	    	$student_data['admissiontypeid'] = '1';
	    }
		// get year
		// check the registration status
		// for we are checking last year semester registration, use hostel_reg for registration database
		// calculate year if not phd
		// $query3 = $this->hostel_reg_db->select('sem')->where(array('roll' => $student_data['roll_number']))->from('test_sem_reg2.registered')->limit(1)->get();
		
		$sem = trim($sem);
		if($sem == "1" || $sem == "2")
		{
			$student_data['year'] = '1';
		}
		elseif($sem == '3' || $sem == '4')
		{
			$student_data['year'] = '2';
		}
		elseif($sem == '5' || $sem == '6')
		{
			$student_data['year'] = '3';
		}
		elseif($sem == '7' || $sem === '8')
		{
			$student_data['year'] = '4';
		}
		elseif($sem == "12" || $sem == "34")
		{
			$student_data['year'] = '1'; #for mba students only
		}
		elseif($sem == '56' || $sem == '78')
		{
			$student_data['year'] = '3'; #for mba students only
		}
		else
		{
			$student_data['year'] = (date('Y') - $student_data['joining_year'] + 1);
		}

		// something for phd must be included
		// finally unset extra feilds from student_data
				unset($student_data['roll_number']);
				unset($student_data['joining_year']);
			$this->hostel_db = $this->load->database('hostels', TRUE);
			$query2 = $this->hostel_db->select('id')->where($student_data)->get('studenttypes', 1);
			$raw_data = $query2->first_row('array');
			$studenttypeid = $raw_data['id'];
			// now create new user
			$this->hostel_db->insert('students',array('regno' => $regno, 'hosteltypeid' => $studenttypeid));
			return true;
	}

	public function get_sem_from_Registered($roll = '')
	{
		$this->hostel_reg_db = $this->load->database('reg', TRUE);
		// check the registration status
		// for we are checking last year semester registration, use hostel_reg for registration database
		// calculate year if not phd
		//print_r($this->hostel_reg_db);
		$query = $this->hostel_reg_db->select('sem')->where(array('roll' => $roll))->from('registered')->limit(1)->get();
		if($query->num_rows() > 0){
			$sem  = $query->first_row('array');
			//$this->session->set_flashdata('danger', print_r($this->hostel_reg_db));
			return $sem['sem'];
		}
	}

	//author: Vaibhav Awachat
	// This is not good, it should be removed.

	public function get_course_id($course='')
	{
		switch ($course) {
			case 'btech':
				return '1';
				break;
			
			case 'mtech':
				return '2';
				break;

			case 'mca':
				return '3';
				break;

			case 'phd':
				return '6';
				break;

			case 'mba':
				return '4';
				break;

			case 'msc':
			case 'Msc. Tech':
				return '5';
			default:
				return '0';
				break;
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
						->where(array('registration_number'=>$regno,'type'=>'1'));
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