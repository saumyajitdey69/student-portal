<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('display_errors', 'On');
//global ewc charges
$ewc_charge = 4500;
$allowed_student_types = array(71,72,73,74,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,95,94,102,103,39,47,55,63,41,49,57,65,104,43,51,59,67,107,45,53,61,69,40,48,56,64,42,50,58,66,105,44,52,60,68,106,46,46,54,62,70,46,94,95,102,103,108);

$iccr_ids = array(55,56,57,58,59,60,61,62,108);
class Hostels extends MY_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('audit/audit_model');
        if ($this->audit_model->profile_edited($this->user_id) === false)
        {
            $this->session->set_flashdata('danger', 'Complete your profile');
            redirect(base_url('audit/profile'), 'location', 301);
            return false;
        }
        $this->load->model('hostelmodel', '', TRUE);
        $this->load->model('messmodel', '', TRUE);
        $this->load->model('studentmodel');
    }

    public function index(){
        if($this->_is_alloted_hostel()){
            if(!$this->_is_alloted_mess()){
                header("location: /student/hostels/allotment/mess/");
            }
        }
        $data['title'] = 'Online Hostel & Mess Allotment';
        $data['error'] = array();
        $regno = $this->hostelmodel->userid_to_regno($this->user_id);
        $student_detail = $this->studentmodel->get_student_detail($regno);
        if($student_detail){
            if($student_detail['blocked']==1){
                $error = 'Your account is blocked';
                array_push($data['error'], $error);
            }
            if(in_array(intval($student_detail['hosteltypeid']), $GLOBALS['allowed_student_types'])){
                $data['allowed_allotment'] = TRUE;
                $data['allotment_url'] = '/student/hostels/allotment/';
            }else{
                $data['allowed_allotment'] = FALSE;
            } 
        }else{
            $error = 'An error occoured. Please Contact WSDC';
            array_push($data['error'], $error);
        }

         if($this->_is_alloted_hostel() && $this->_is_alloted_mess()){
            //$data['slip'] = true; 
            $data['slip_url'] = '/student/hostels/hostel_slip/'; 
            // redirect to slip
            redirect('/hostels/hostel_slip/');
            //var_dump($this->_is_neft());
        }
      
        
        //$data['hosteltransactions'] = $this->hostelmodel->get_student_transactions($regno);
        //$data['messtransactions'] = $this->messmodel->get_student_messtransactions($regno);
        //$data['hostelhistory'] = $this->hostelmodel->hostel_allotment_history($regno);
        //$data['messhistory'] = $this->messmodel->mess_allotment_history($regno);
        $data['studenttransactions'] = $this->studentmodel->get_student_transactions($regno);
        $payment_detail = $data['studenttransactions'][0];
        $data['payment_detail'] = $payment_detail;
        $data['allowed_hostel_mess'] = $this ->_get_allowed_mess_hostel_summer($payment_detail);
        $messdues = $this->messmodel->getMessDues($regno);
        $data['messdues'] = ($messdues != FALSE) ? $messdues : 'N/A';
        $data['regno'] = $regno;
        $this->_render_page('home2', $data);
      //return $this->home();
    }

    public function neft_check()
    {
        $has_neft=$this->_is_neft();
        for ($i=0; $i<count($has_neft)-1 ; $i++) { 
            if($has_neft[$i]['status']!=3){
                unset($has_neft[$i]);
            }
        }
        return $has_neft;
    }

    public function _is_neft()
    {
        $regno = $this->hostelmodel->userid_to_regno($this->user_id);
        return $this->studentmodel->has_neft($regno);
    }

    public function history()
    {
        $data['title'] = 'History';
        $this->_render_page('history', $data);
    }

    public function details()
    {
        $data['title'] = 'Hostel & Mess details';
        $hostels = $this->hostelmodel->HostelDetail();
        $messes = $this->messmodel->MessDetail();
        if(!empty($hostels) && $hostels != FALSE){
            $hostelstatus = $this->hostelmodel->hostelstatus();
            if(!empty($hostelstatus)){
                for ($i =0; $i<count($hostelstatus); $i++) {
                    for ($j =0; $j<count($hostels); $j++) {
                        if($hostelstatus[$i]['hostelid'] == $hostels[$j]['id'])
                        {
                            $hostels[$j]['vacancy'] = $hostelstatus[$i]['count'];
                        }
                    }
                }
            }
            $data['hostels'] = $hostels;
        }
        if(!empty($messes) && $messes != FALSE){
            $data['messes'] = $messes;
        }
        $this->_render_page('details', $data);
    }

    public function Home () {
        // $this->index();
        // return;
        $data = array();
        $data['current_page'] = 'hostel';
        $data['title'] = 'Online Hostel & Mess Allotment';
        $data['scripts'] = array('hostel.js');
        $payment_detail = $this->payment_detail_check();
        $this->_get_hostel_total($payment_detail);
        $this->_get_mess_total_summer($payment_detail);
        $data['payment_detail'] = $payment_detail;
        $data['allowed_hostel_mess'] = $this->_get_allowed_mess_hostel_summer($payment_detail);
        $data['allotment_detail']['hostel'] = $this->_is_alloted_hostel();
        $data['allotment_detail']['mess'] = $this->_is_alloted_mess();
        $this->_render_page('hostels/home', $data);
    }
    public function _get_hostel_total(&$payment_detail){
        if($payment_detail['transactions']){
            $payment_detail['total_tuition_fee'] = 0; 
            $payment_detail['total_other_fee'] = 0; 
            $payment_detail['total_emc_fee'] = 0; 
            $payment_detail['total_seat_fee'] = 0; 
            $payment_detail['total_aggr_hostel'] = 0;
            foreach ($payment_detail['transactions'] as $key => $transaction) {
                $payment_detail['total_tuition_fee'] += intval($transaction['tuitionfee']);
                $payment_detail['total_other_fee'] += intval($transaction['otherfee']);
                $payment_detail['total_emc_fee'] += intval($transaction['emc']);
                $payment_detail['total_seat_fee'] += intval($transaction['seatrent']);
                $payment_detail['total_aggr_hostel'] += intval($transaction['amount']);
            }
        }
    }
    public function _get_mess_total(&$payment_detail){
        if($payment_detail['messtransactions']){
            $payment_detail['total_mess_due'] = 0; 
            $payment_detail['total_mess_adv'] = 0; 
            $payment_detail['total_maintenance'] = 0; 
            $payment_detail['total_aggr_mess'] = 0;
            foreach ($payment_detail['messtransactions'] as $key => $transaction) {
                $payment_detail['total_mess_due'] += intval($transaction['mess_dues']);
                $payment_detail['total_mess_adv'] += intval($transaction['mess_advance']);
                $payment_detail['total_maintenance'] += intval($transaction['maintenance_charges']);
                $payment_detail['total_aggr_mess'] += intval($transaction['total_amount_paid']);
            }
        }
    }

    public function _get_mess_total_summer(&$payment_detail){
        if($payment_detail['messtransactions']){
            $payment_detail['total_mess_due'] = 0; 
            $payment_detail['total_mess_adv'] = 0; 
            $payment_detail['total_maintenance'] = 0; 
            $payment_detail['total_aggr_mess'] = 0;
            foreach ($payment_detail['messtransactions'] as $key => $transaction) {
                $payment_detail['total_mess_due'] += intval($transaction['mess_dues']);
                // $payment_detail['total_mess_adv'] += intval($transaction['mess_advance']);
                // $payment_detail['total_maintenance'] += intval($transaction['maintenance_charges']);
                $payment_detail['total_aggr_mess'] += intval($transaction['amount']);
            }
        }
    }

    public function hostel_slip(){
        $data['title'] = 'Hostel/Mess allotment slip';
        $data['error'] = array();
        $regno = $this->hostelmodel->userid_to_regno($this->user_id);
        $student_detail = $this->studentmodel->get_student_detail($regno);
        //var_dump($this->_is_alloted_hostel());
        //var_dump($this->_is_alloted_mess());
        if($this->_is_alloted_hostel() && $this->_is_alloted_hostel()){
            if(in_array($student_detail['hosteltypeid'], $GLOBALS['iccr_ids'])){
                $mess_due_arr = $this->get_mess_due();
                $mess_due = $mess_due_arr[0]['due'];
                $data = $this->studentmodel->get_student_transactions($regno);
                if(!$mess_due||$mess_due<0){
                        $this->load->model('studentmodel', TRUE);
                        $data['details'] = $this->studentmodel->get_student_details($regno);
                        //$data['transactions'] = $this->studentmodel->get_student_transactions_slip($regno);
                        $data['messtransactions'] = $this->studentmodel->get_student_messtransactions($regno);
                        $this->_render_page('allotment_slip2', $data);
                        return 0;
                    }
                if($data){
                    $payment_detail=$data[0];
                    if($payment_detail['mess_dues']>=$mess_due){
                        // $alloted_hostel = $this->_is_alloted_hostel();
                        // $alloted_mess = $this->_is_alloted_mess();
                        // $data['hostel'] = $alloted_hostel;
                        // $data['mess'] = $alloted_mess;
                        // $this->_render_page('allotment_slip', $data);
                        $this->load->model('studentmodel', TRUE);
                        $data['details'] = $this->studentmodel->get_student_details($regno);
                        //$data['transactions'] = $this->studentmodel->get_student_transactions_slip($regno);
                        $data['messtransactions'] = $this->studentmodel->get_student_messtransactions($regno);
                        $this->_render_page('allotment_slip2', $data);
                    }else{
                        echo "Please pay mess dues to generate slip.";
                    }
                }else{
                    echo "Please pay mess dues to generate slip.";
                }
            }else{
                $data = $this->neft_check();
                if($data){
                    if(!empty($data)){
                        unset($data['im_list']);
                        if(empty($data)){
                            echo "Please submit your DD/NEFT/Inter-Intra bank transaction detail at Hostel office. Hostel Office will give the receipt.";
                            return 1;
                        }else{
                            $this->load->model('studentmodel', TRUE);
                            $data['details'] = $this->studentmodel->get_student_details($regno);
                            //$data['transactions'] = $this->studentmodel->get_student_transactions_slip($regno);
                            $data['messtransactions'] = $this->studentmodel->get_student_messtransactions($regno);
                            $this->_render_page('allotment_slip2', $data);
                        }
                    }
                }else{
                        $this->load->model('studentmodel', TRUE);
                        $data['details'] = $this->studentmodel->get_student_details($regno);
                        //$data['transactions'] = $this->studentmodel->get_student_transactions_slip($regno);
                        $data['messtransactions'] = $this->studentmodel->get_student_messtransactions($regno);
                        $this->_render_page('allotment_slip2', $data);
                }
            	
            }
        }else{
            echo "No Hostel/Mess alloted";
        }
    }

    public function _get_allowed_mess_hostel($payment_detail){
        $userId = $this->user_id;
        $hostel_mess = $this->hostelmodel->get_hostel_mess_list_student($userId);
        $mess_due = $this->get_mess_due();
        if($payment_detail['messtransactions'] && $hostel_mess['mess']){
            foreach ($hostel_mess['mess'] as $key => $mess) {
                $amount_to_be_paid = intval($mess['messadvance']) + intval($mess_due);
                $amount_paid = intval($payment_detail['total_mess_due']) + intval($payment_detail['total_mess_adv']);
                if($amount_paid<$amount_to_be_paid){
                    unset($hostel_mess['mess'][$key]);
                }
                if (empty($hostel_mess['mess'])) {
                    $hostel_mess['mess'] =FLASE;
                }
            }
        }else{
            $hostel_mess['mess'] = FALSE;
        }
        if($payment_detail['transactions'] && $hostel_mess['hostel']){
            foreach ($hostel_mess['hostel'] as $key => $hostel) {
                $hostel_emc = 2500;
                $amount_to_be_paid_hostel = $hostel_emc + intval($hostel['hostelfee']) + intval($hostel['maintenance']);
                $amount_paid_hostel = $payment_detail['total_maintenance']+ $payment_detail['total_seat_fee'] + $payment_detail['total_emc_fee'];
                if($amount_paid_hostel<$amount_to_be_paid_hostel){
                    unset($hostel_mess['hostel'][$key]);
                }
            }
            if(empty($hostel_mess['hostel'])){
                $hostel_mess['hostel'] = FALSE;
            }
        }else{
            $hostel_mess['hostel'] = FALSE;
        }
        return $hostel_mess;
    }

    public function _get_allowed_mess_hostel_summer($payment_detail){
        $userId = $this->user_id;
        $hostel_mess = $this->hostelmodel->get_hostel_mess_list_student($userId);
        $mess_due_arr = $this->get_mess_due();
        $mess_due = $mess_due_arr[0]['due'];
        //for iccr check
        $regno = $this->hostelmodel->userid_to_regno($this->user_id);
        $student_detail = $this->studentmodel->get_student_detail($regno);
        $iccr = false;
        if(in_array(intval($student_detail['hosteltypeid']), $GLOBALS['iccr_ids'])){
            return $hostel_mess;
        }
        if($payment_detail && $hostel_mess['mess']){
            foreach ($hostel_mess['mess'] as $key => $mess) {
                $flag = true;
                $amount_to_be_paid = intval($mess['messadvance'])+intval($mess_due);
                // print_r($payment_detail['total_mess_due']);
                // print_r($payment_detail);
                $amount_paid = intval($payment_detail['mess_dues'])+intval($payment_detail['mess_advance']);
                //amout paid should be 4000 under any circumstances for anyone to join summer hostel allotment.
                if($amount_paid < $amount_to_be_paid){
                    $flag = false;
                    unset($hostel_mess['mess'][$key]);
                }
                if (empty($hostel_mess['mess'])) {
                    $hostel_mess['mess'] =false;
                }
            }
        }else{
            $hostel_mess['mess'] =false;
        }
        if($payment_detail && $hostel_mess['hostel']){
            foreach ($hostel_mess['hostel'] as $key => $hostel) {
                $flag = true;
                $amount_to_be_paid = intval($hostel['hostelfee'])+intval($hostel['maintenance'])+$GLOBALS['ewc_charge'];
                // print_r($payment_detail['total_mess_due']);
                // print_r($payment_detail);
                $amount_paid = intval($payment_detail['seatrent'])+intval($payment_detail['maintenance_charges'])+intval($payment_detail['emc']);
                //amout paid should be 4000 under any circumstances for anyone to join summer hostel allotment.
                if($amount_paid < $amount_to_be_paid){
                    $flag = false;
                    unset($hostel_mess['hostel'][$key]);
                }
                if (empty($hostel_mess['hostel'])) {
                    $hostel_mess['hostel'] =FALSE;
                }
            }
        }else{
            $hostel_mess['hostel'] =FALSE;
        }
        return $hostel_mess;
    }

public function get_mess_due(){
    $userId = $this->user_id;
    $mess_due = $this->hostelmodel->get_mess_due($userId);
    return $mess_due;
}
public function payment_detail_check() {
    $userId = $this->user_id;
    $payment_detail = $this->hostelmodel->payment_detail_check($userId);
    return $payment_detail;
}
public function _is_alloted_hostel() {
    $userId = $this->user_id;
    $hostel = $this->hostelmodel->is_alloted_hostel($userId);
    return $hostel;
}
public function _is_alloted_mess() {
    $userId = $this->user_id;
    $mess = $this->hostelmodel->is_alloted_mess($userId);
    return $mess;
}
public function _is_alloted_hostel_summer() {
    $userId = $this->user_id;
    $hostel = $this->hostelmodel->is_alloted_hostel($userId);
    return $hostel;
}
public function _is_alloted_mess_summer() {
    $userId = $this->user_id;
    $mess = $this->hostelmodel->is_alloted_mess($userId);
    return $mess;
}
public function allotment ($type='') {
    $regno = $this->hostelmodel->userid_to_regno($this->user_id);
    $student_detail = $this->studentmodel->get_student_detail($regno);
    if($student_detail){
        if($student_detail['blocked']==1){
            header("location: /student/hostels/home/");
        }else if(!in_array(intval($student_detail['hosteltypeid']), $GLOBALS['allowed_student_types'])){
            header("location: /student/hostels/home/");
        }
    }else{
        echo "An error occoured!";
        return 1;
    }
    if ($type=='') {
        header("location: /student/hostels/allotment/room/");
    }
    $data = array();
    $regno = $this->hostelmodel->userid_to_regno($this->user_id);
    $data['studenttransactions'] = $this->studentmodel->get_student_transactions($regno);
    $payment_detail = $data['studenttransactions'][0];
    $hostel_mess = $this->_get_allowed_mess_hostel_summer($payment_detail);
    $hostel_mess = $this->_get_allowed_mess_hostel_summer($payment_detail);
    if(!($hostel_mess['hostel'] && $hostel_mess['mess'])){
        $data['error'] = 'Not Elegible for any Mess or Hostel';
        header('location: /student/hostels/home/');
    }
    $data['current_page'] = 'hostel';
    $data['current_nav'] = 'single';
    $data['scripts'] = array('hostel.js');
    if ($type == "room") {
        if($this->_is_alloted_hostel()){
            header("location: /student/hostels/home/");
            return 0;
        }
        $data['title'] = 'Online Room Allotment';
        $data['hostel_mess_detail'] = $hostel_mess;
        $this->_render_page('hostels/allotment2', $data);
    }
    if($type == "mess"){
        if(!$this->_is_alloted_hostel()){
            header("location: /student/hostels/allotment/room/");
            return 0;
        }
        $data['title'] = 'Online Mess Allotment';
        $data['hostel_mess_detail'] = $hostel_mess;
        $this->_render_page('hostels/messallotment2', $data);
    }
}

public function get_Hostel_Detail_JSON($hostelId=''){
    $hostel_detail = $this->hostelmodel->HostelDetail($hostelId);
    echo json_encode($hostel_detail);
}

public function get_room_list_JSON($hostelId='',$floor=''){
    if(is_null($hostelId)||is_null($floor)) return print('error');
    $room_list = $this->hostelmodel->roomList($hostelId,$floor);
    echo json_encode($room_list);
}

public function single_room() {
    $regno = $this->hostelmodel->userid_to_regno($this->user_id);
    $student_detail = $this->studentmodel->get_student_detail($regno);
    if($student_detail){
        if($student_detail['blocked']==1){
            echo "Your account is blocked";
            return false;
        }
    }else{
        echo "An error occoured";
        return false;
    }
    $room_id = $this->input->post('roomId');
    $hostel_id = $this->input->post('hostelId');
    $userId = $this->user_id;
    $regno = $this->hostelmodel->userid_to_regno($this->user_id);
    $data['studenttransactions'] = $this->studentmodel->get_student_transactions($regno);
    $payment_detail = $data['studenttransactions'][0];
    if($payment_detail=='blocked'){
        return print('blocked');
    }
    $hostel_mess = $this->_get_allowed_mess_hostel_summer($payment_detail);
    if(!($hostel_mess['hostel'] && $hostel_mess['mess'])){
        echo "error";
    }
    $hostels = $hostel_mess['hostel'];
    $flag = 0;
    foreach ($hostels as $key => $hostel) {
        if($hostel_id == $hostel['hostelid']){
            ++$flag;
            break;
        }
    }
    if(empty($hostel_id) || empty($room_id) || ($flag = 0)) return print('invalid');
    $status = $this->hostelmodel->book_single_room($hostel_id,$room_id,$userId);
    switch ($status) {
        case 1:
        echo "alloted";
        break;
        case 2:
        echo "invstu";
        break;
        case 3:
        echo "dberr";
        break;
        case 4:
        echo('success');
        break;
        case 5:
        echo('duplicate');
        break;
        case 6:
        echo('messfull');
        break;
        case 6:
        echo('dberr');
        break;
    }
}

public function single_mess() {
    $regno = $this->hostelmodel->userid_to_regno($this->user_id);
    $student_detail = $this->studentmodel->get_student_detail($regno);
    if($student_detail){
        if($student_detail['blocked']==1){
            echo "Please contact hostel person to know the reason and unblock the account in order to avail online booking";
            return flase;
        }
    }else{
        echo "An error occoured";
        return flase;
    }
    $mess_id = $this->input->post('messId');
    $hostel_id = $this->input->post('hostelId');
    $userId = $this->user_id;
    $regno = $this->hostelmodel->userid_to_regno($this->user_id);
    $data['studenttransactions'] = $this->studentmodel->get_student_transactions($regno);
    $payment_detail = $data['studenttransactions'][0];
    if($payment_detail=='blocked'){
        return print('blocked');
    }
    $hostel_mess = $this->_get_allowed_mess_hostel_summer($payment_detail);
    if(!($hostel_mess['hostel'] && $hostel_mess['mess'])){
        echo "error";
    }
    $messes = $hostel_mess['mess'];
    $flag = 0;
    foreach ($messes as $key => $mess) {
        if($mess_id == $mess['messid']){
            ++$flag;
            break;
        }
    }
    if(empty($mess_id) || ($flag = 0)) return print('invalid');
    $status = $this->hostelmodel->book_mess($mess_id,$userId);
    switch ($status) {
        case 9:
        echo "alloted";
        break;
        case 2:
        echo "invstu";
        break;
        case 8:
        echo "dberr";
        break;
        case 4:
        echo('success');
        break;
        case 5:
        echo('duplicate');
        break;
        case 6:
        echo('messfull');
        break;
        case 6:
        echo('dberr');
        break;
        case 7:
        echo('dberr');
        break;
    }
}


/*Group stuff starts here*/
    /*public function group() {
        $data['current_page'] = 'hostel';
        $data['current_nav'] = 'group';
        $data['title'] = 'Manage Group';
        $data['scripts'] = array('hostel_group.js');
        $userId = $this->user_id;
        $data['group_info'] = $this->hostelmodel->fetch_group_info($userId);
        $this->_render_page('hostel/group', $data);
    }
    public function create_group() {
        $userId = $this->user_id;
        if(empty($userId)) return print('error');
        $group = $this->hostelmodel->create_group($userId);
        switch ($group) {
            case 1:
                echo "notfound";
                break;
            case 2:
                echo "alredymem";
                break;
            case 3:
                echo "dberr";
                break;
            case 4:
                echo "dberr";
                break;
            case 5:
                echo "success";
                break;            
        }
    }

    public function add_member() {
        if(empty($this->input->post('rollno')) || empty($this->input->post('groupid'))) return "invalid";
        $roll = $this->input->post('rollno');
        $add_stat = $this->hostelmodel->add_member($roll,$group_id);
    }*/

    function _render_page($view, $data=null, $render=false){
        $data['current_section'] = 'hostels';
        $this->viewdata = (empty($data)) ? $data: $data;
        $view_html = array( 
            $this->load->view('base/header', $data, $render),
            $this->load->view('menu/header', $data, $render),
            $this->load->view($view, $this->viewdata, $render),
            $this->load->view('menu/footer', $data),
            $this->load->view('base/footer', $data, $render)
            );
        if (!$render) return $view_html;
    }

	public function test()
	{
		$this->load->model('studentmodel', TRUE);
                $data['messtransactions'] = $this->studentmodel->get_student_messtransactions("931217");
	}

}
?>
