<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class HostelModel extends CI_Model {
	public function __construct(){
		parent::__construct();
		$this->load->config('hostels/hostels_config',  TRUE);
		$this->tables = $this->config->item('tables', 'hostels_config');
	}

	public function payment_detail_check($userId='') {
		$student_reg_arr = $this->userid_to_regno($userId);
		$regno = $student_reg_arr;
		$this->hostel_db = $this->load->database('hostels',TRUE);
		$where_clause = array(
			'regno' => $regno
		);
		$this->hostel_db->select()
						->from('students')
						->where($where_clause);
		$query = $this->hostel_db->get();
		if($query->num_rows >0 and $query->first_row()->blocked == '1')
		{
			return FALSE;
		}
		$payment_detail['students'] = ($query->num_rows>0?$query->first_row('array'):FALSE);
		$this->hostel_db->select()
						->from('transactions')
						->where($where_clause);
		$query2 = $this->hostel_db->get();
		$payment_detail['transactions'] = ($query2->num_rows>0?$query2->result_array():FALSE);
		$this->hostel_db->select()
						->from('messtransactions')
						->where(array('registration_number' => $regno));
		$query3 = $this->hostel_db->get();
		$payment_detail['messtransactions'] = ($query3->num_rows>0?$query3->result_array():FALSE);
		return $payment_detail;
	}

	public function HostelDetail($hostelId = ''){
		$this->hostel_db = $this->load->database('hostels', TRUE);
		if(!empty($hostelId)){
			$this->hostel_db->select()
							->from('hostels')
							->where(array('id' => $hostelId));
			$query = $this->hostel_db->get();
		}else{
			$query = $this->hostel_db->select()->from('hostels')->get();
		}
		if($query){
			if(!empty($hostelId)){
			return $query->first_row('array');
		}
		else{
			return $query->result('array');
		}
		}else{
			return FALSE;
		}
	}
	// hostel (fee account transactios)
	//@Vaibhav Awachat
	public function get_student_transactions($reg_no = '')
	{
		$this->hostel_db = $this->load->database('hostels', TRUE);
		$query = $this->hostel_db->select('bank_reference_no as transactionid,transaction_date as date, registration_number as regno, tuitionfee, otherfee, emc, seatrent, amount as total, transaction_type, timestamp')
								 ->where('registration_number', $reg_no)
								 ->get($this->tables['hostelstransactions']);
		if($this->hostel_db->affected_rows() > 0)
			return $query->result('array');
		else
			return FALSE;
	}

	//@Vaibhav Awachat
	public function hostel_allotment_history($reg_no='')
	{
		$this->hostel_db = $this->load->database('hostels', TRUE);
		$query = $this->hostel_db->select('h.name as hostel, r.floor, r.number as room, ra.timestamp, ra.status')
		->where('regno', $reg_no)
		->from($this->tables['roomallotments'].' as ra ')
		->join($this->tables['rooms'].' as r', 'r.id = ra.roomid')
		->join($this->tables['hostels'].' as h', 'h.id = r.hostelid')
		->order_by('timestamp desc')
		->get();
		if($query->num_rows())
			return $query->result('array');
		else
			return FALSE;
	}


	//@Vaibhav Awachat
	public function hostelstatus($hostelid='',$conditionid='',$floor='', $allotted = false)
	{
		$this->hostel_db = $this->load->database('hostels', TRUE);
		if(!empty($hostelid)){
			$this->hostel_db->where('hostelid', $hostelid);
		}
		if(!empty($conditionid)){
			$this->hostel_db->where('conditionid', $conditionid);
		}
		if(!empty($floor)){
			$this->hostel_db->where('floor', $floor);
		}
		if($allotted == true){
			$this->hostel_db->where('alloted', '1');
		}
		else
		{
			$this->hostel_db->where('alloted', '0');
		}
		$query = $this->hostel_db->select('COUNT(*) as count, hostelid, alloted as allotted')->group_by(array('hostelid','alloted'))->get('rooms');
		if($query->num_rows()){
			return $query->result('array');
		}
			else
				return FALSE;
		
	}


	public function get_hostel_mess_list_student($userId){
		$this->db = $this->load->database('default', TRUE);
		$this->db->select('registration_number as regno')
		         ->from('student_data')
		         ->where('userid',$userId);
		// $this->db->select('joining_year, course, gender')
		//          ->from('student_data')
		//          ->where('userid',$userId);
		$query = $this->db->get();
		if($query->num_rows>0){
			// $user_data = $query->first_row('array');
			// $current_year = 2014 - $user_data['joining_year'];
			// $class_map = array(
			// 	'btech' => 1,
			// 	'mtech' => 2,
			// 	//to be added
			//  );
			// $gender_map = array(
			// 	'M' => 1,
			// 	'F' => 0,
			// );
			// $where_clause = array('class' => $class_map[$user_data['course']], 
			// 					'year' => $current_year,
			// 					'gender' =>$gender_map[$user_data['gender']]
			// 					);
			$where_clause = array('regno' => $query->first_row()->regno);
			$this->hostel_db = $this->load->database('hostels', TRUE);
			$this->hostel_db->select('allowedhostels.hostelid, hostels.name, hostels.hostelfee, hostels.maintenance')
							->from('students as s ')
							->where($where_clause)
							->join('allowedhostels','s.hosteltypeid = allowedhostels.studenttypeid')
							->join('hostels','allowedhostels.hostelid = hostels.id');
			$query = $this->hostel_db->get();
			if($query->num_rows<=0){
				return FALSE;
			}
			// $where_clause = array('class' => $class_map[$user_data['course']], 
			// 					'year' => $current_year,
			// 					'gender' =>$gender_map[$user_data['gender']],
			// 					);
			$this->hostel_db = $this->load->database('hostels', TRUE);
			$this->hostel_db->select('allowedmesses.messid as messid, messes.name, messes.messadvance')
							->from('students as s ')
							->where($where_clause)
							->join('allowedmesses','s.hosteltypeid = allowedmesses.studenttypeid')
							->join('messes','allowedmesses.messid = messes.id AND messes.capacity > messes.currentcount');
			$query_mess = $this->hostel_db->get();
			if($query_mess->num_rows<=0) {
				$data['mess'] = 'nomess';
			}else{
				$messes = $query_mess->result_array();
				$data['mess'] = $query_mess->result_array();
			}
			$data['hostel'] = $query->result_array();
			// print_r($data)
			return $data;
		}else
			return FALSE;
	}
	public function get_mess_due($userId){
		$this->db = $this->load->database('default', TRUE);
		$this->db->select('registration_number as regno')
		         ->from('student_data')
		         ->where('userid',$userId);
		$query=$this->db->get();
		$this->hostel_db = $this->load->database('hostels', TRUE);
		$this->hostel_db->select()
						->from('messdues')
						->where(array('regno'=>$query->first_row()->regno));
		$query2 = $this->hostel_db->get();
		$mess_due = ($query2->num_rows>0?$query2->result_array():FALSE);
		return $mess_due;
	}
	public function roomList($hostelId, $floor) {
			$this->hostel_db = $this->load->database('hostels', TRUE);
			$where_clause = array(
				'hostelid' => $hostelId,
				'floor' => $floor,
				'alloted' => 0,
				'conditionid' => 1
			);
			$this->hostel_db->select()
							->from('rooms')
							->where($where_clause);
			$query = $this->hostel_db->get();
			if($query->num_rows>0) {
				$room_list = array();
				foreach ($query->result_array() as $room) {
					array_push($room_list, $room);
				}
				return $room_list;
			}else{
				return FALSE;
			}
	}
	public function userid_to_regno($userId) {
		$this->db = $this->load->database('default', TRUE);
		$this->db->select('registration_number')
		         ->from('student_data')
		         ->where('userid',$userId);
		$query_student = $this->db->get();
		if($query_student->num_rows<=0)
			return FALSE;
		return $query_student->first_row()->registration_number;
	}
	/*
		return codes:
		1 => room already alloted
		2 => student not found
		3 => database insert and update error occoureds
		4 => success
		5 => already alloted
		6 => mess full
		7 => database insert and update error occoureds
		8 => database update error occoureds (students)
		9 => mess alloted
	*/
	public function book_single_room($hostel_id,$room_id,$userId) {
		if($this->is_alloted_hostel($userId)) return 5;
		$this->hostel_db = $this->load->database('hostels', TRUE);
		if(!$this->userid_to_regno($userId)) return 2;
		$student_reg_arr = $this->userid_to_regno($userId);
		$insert_data = array(
			'roomid' => $room_id,
			'regno' => $student_reg_arr
		);
		$this->hostel_db = $this->load->database('hostels', TRUE);
		$where_clause = array(
			'id' => $room_id,
			'hostelid' => $hostel_id,
			'alloted' => 1
		);
		$this->hostel_db->update('rooms',array('alloted'=>1), array('id'=>$room_id));
		if($this->hostel_db->affected_rows()<=0) return 1;
		$this->hostel_db->where($where_clause);
		$this->hostel_db->insert('roomallotments',$insert_data);
		if($this->hostel_db->affected_rows()<=0) return 3;
		$update_data_student = array(
			'roomid' => $room_id
		);
		$this->hostel_db->where(array('regno'=>$student_reg_arr));
		$this->hostel_db->update('students',$update_data_student);
		if($this->hostel_db->affected_rows()<=0) return 8;
		return 4;
	}

	public function book_mess($mess_id,$userId){
		if($this->is_alloted_mess($userId)) return 9;
		$this->hostel_db = $this->load->database('hostels', TRUE);
		if(!$this->userid_to_regno($userId)) return 2;
		$student_reg_arr = $this->userid_to_regno($userId);
		$insert_data_mess = array(
			'messid' => $mess_id,
			'regno' => $student_reg_arr
		);
		$this->hostel_db = $this->load->database('hostels', TRUE);
		$this->hostel_db->where(array('id'=>$mess_id));
		$this->hostel_db->where('`currentcount` < `capacity`');
		$this->hostel_db->set('currentcount','`currentcount`+1',FALSE);
		$this->hostel_db->update('messes');
		if($this->hostel_db->affected_rows()<=0) return 6;
		$this->hostel_db->insert('messallotments',$insert_data_mess);
		if($this->hostel_db->affected_rows()<=0) return 7;
		$update_data_student = array(
			'messid' => $mess_id,
		);
		$this->hostel_db->where(array('regno'=>$student_reg_arr));
		$this->hostel_db->update('students',$update_data_student);
		if($this->hostel_db->affected_rows()<=0) return 8;
		return 4;
	}
	/*
		return codes:
		1 => student not found
	*/
	public function is_alloted_hostel($userId) {
		if(!$this->userid_to_regno($userId)) return 1;
		$student_reg_arr = $this->userid_to_regno($userId);
		$this->hostel_db = $this->load->database('hostels', TRUE);
		$where_clause = array(
			'regno' => $student_reg_arr,
			'status' => '1'
		);
		$this->hostel_db->select()
						->from('roomallotments')
						->join('rooms', 'rooms.id = roomallotments.roomid')
						->join('hostels', 'rooms.hostelid = hostels.id')
						->where($where_clause);
		$query_hostel = $this->hostel_db->get();
		if($query_hostel->num_rows<=0) return FALSE;
		return $query_hostel->first_row('array');					
	}


	public function add_payment_detail($methodId, $ammount, $date) {
        $userId = $this->nativesession->get('userid');
		$student_reg_arr = $this->userid_to_regno($userId);
		$regno = $student_reg_arr['registration_number'];
		$this->hostel_db = $this->load->database('hostels', TRUE);
		$data = array(
			'regno' => $regno,
			'methodid' => $methodId,
			'ammount' => $ammount,
			'date' => $date
		);
		$this->hostel_db->insert('payment_detail_student',$data);
		return ($this->hostel_db->affected_rows()>0?TRUE:FALSE);	
	}

	/*
		return codes:
		1 => student not found
	*/
		
	public function is_alloted_mess($userId) {
		if(!$this->userid_to_regno($userId)) return 1;
		$student_reg_arr = $this->userid_to_regno($userId);
		$this->hostel_db = $this->load->database('hostels', TRUE);
		$where_clause = array(
			'regno' => $student_reg_arr,
			'status' => '1'
		);
		$this->hostel_db->select('name as messname')
						->from('messallotments')
						->join('messes', 'messallotments.messid = messes.id')
						->where($where_clause);
		$query_hostel = $this->hostel_db->get();
		if($query_hostel->num_rows<=0) return FALSE;
		return $query_hostel->first_row('array');					
	}
	
	/*
		return codes:
		1 => student not found
		2 => already in a group
		3 => insert error to groups
		4 => insert error to groupmembers
		5 => success
	*/
	/*public function create_group($userId) {
		if(!$this->userid_to_regno($userId)) return 1;
		$student_reg_arr = $this->userid_to_regno($userId);
		$regno = $student_reg_arr['registration_number'];
		if($this->is_in_group($regno)) return 2;
		$this->hostel_db = $this->load->database('hostels', TRUE);
		$this->hostel_db->select()
						 ->from('groupmembers')
						 ->where(array('regno'=>$regno));
		$query = $this->hostel_db->get();
		$insert_data = array(
			'admin' => $regno,
			'count' => 1
		);
		$this->hostel_db->insert('groups',$insert_data);
		if($this->hostel_db->affected_rows()<=0) return 3;
		$group_id = $this->db->insert_id();
		$insert_data_member = array(
			'groupid' => $group_id,
			'regno' => $regno,
			'status' => 'accepted',
			'admin' => 1
		);
		$this->hostel_db->insert('groupmembers',$insert_data_member);
		if($this->hostel_db->affected_rows()<=0) return 4;
		return 5;
	}

	public function is_in_group($regno='') {
		if(empty($regno)){
	        $userId = $this->nativesession->get('userid');
			$student_reg_arr = $this->userid_to_regno($userId);
			$regno = $student_reg_arr['registration_number'];
		}
		$this->hostel_db = $this->load->database('hostels', TRUE);
		$this->hostel_db->select()
						 ->from('groupmembers')
						 ->where(array('regno'=>$regno));
		$query = $this->hostel_db->get();
		return ($query->num_rows>0 ? $query->result_array() : FALSE);
	}

	public function fetch_group_info($userId) {
		$student_reg_arr = $this->userid_to_regno($userId);
		$regno = $student_reg_arr['registration_number'];
		$group_id_arr = $this->is_in_group($regno);
		if(!$group_id_arr) return FALSE;
		if(count($group_id_arr) > 1 || $group_id_arr[0]['status'] === 'pending'){
			//confirms pending req
			$group_id = $group_id_arr[0]['groupid'];
			$this->hostel_db = $this->load->database('hostels', TRUE);
			$this->hostel_db->select()
							->from('groups')
							->where(array('id'=>$group_id));
			$query = $this->hostel_db->get();
			$result = array();
			$result['pending'] = TRUE;
			array_push($result, $query->result_array());
			return $result; 
		}
		$group_id = $group_id_arr[0]['groupid'];
		$this->hostel_db = $this->load->database('hostels', TRUE);
		$this->hostel_db->select()
						->from('groupmembers')
						->where(array('groupid'=>$group_id));
		$group_info = $this->hostel_db->get();
		$result = array('pending' => FALSE);
		array_push($result, $group_info->result_array());
		return $result;
	}
	/*
		return codes:
		1 => student not found
		2 => group full
		3 => insert fail to groupmembers
	*/
	/*public function add_member($roll,$group_id) {
		$this->db = $this->load->database('default',TRUE);
		$this->db->select('registration_number')
				 ->from('student_data')
				 ->where(array('roll_number'=>$roll));
		$query_reg = $this->db->get();
		if($query_reg->num_rows<=0) return 1;
		$reg_arr = $query_reg->first_row('array');
		$regno = $reg_arr['registration_number'];
		$this->db_hostel = $this->load->database('hostel',TRUE);
		$where_clause = array(
			'id' => $group_id,
			'`count`<' => 6
		);
		$update_data = array(
			'`count`' => '`count`+1'
		);
		$this->db_hostel->where($where_clause);
		$this->db_hostel->update('groups');
		if($this->db_hostel->affected_rows<=0) return 2;
		$insert_data = array(
			'groupid' => $group_id,
			'regno' => $regno,
			'status' => 'pending',
			'admin' => 0
		);
		$this->db_hostel->insert('groupmembers',$insert_data);
		if($this->db_hostel->affected_rows<=0) return 3;
		return 'success';
	}*/
}

/* End of file hostel.php */
/* Location: ./application/models/hostel.php */