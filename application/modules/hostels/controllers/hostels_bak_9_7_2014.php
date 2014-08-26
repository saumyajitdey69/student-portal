<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Hostels extends CI_Controller {
    function __construct(){
        parent::__construct();
        {
            $this->load->model('auth/auth_model', '', TRUE);
            if ($this->nativesession->get('userid') === null)
            {
                redirect(base_url('audit'), 'location', 301);
                return false;
            }
        }
        $this->load->model('audit/audit_model');
        if ($this->audit_model->profile_edited($this->nativesession->get('userid')) === false)
        {
            $this->session->set_flashdata('danger', 'Complete your profile');
            redirect(base_url('audit/profile'), 'location', 301);
            return false;
        }
        $this->load->model('hostelmodel', '', TRUE);
        $this->load->model('messmodel', '', TRUE);
    }

    public function index(){

        $data['title'] = 'Online Hostel & Mess Allotment';
        $this->load->model('studentmodel');
        $regno = $this->hostelmodel->userid_to_regno($this->nativesession->get('userid'));
        //$data['hosteltransactions'] = $this->hostelmodel->get_student_transactions($regno);
        $data['studenttransactions'] = $this->studentmodel->get_student_transactions($regno);
        //$data['messtransactions'] = $this->messmodel->get_student_messtransactions($regno);
        //$data['hostelhistory'] = $this->hostelmodel->hostel_allotment_history($regno);
        //$data['messhistory'] = $this->messmodel->mess_allotment_history($regno);
        $messdues = $this->messmodel->getMessDues($regno);
        $data['messdues'] = ($messdues != FALSE) ? $messdues : 'N/A';
        $data['regno'] = $regno;
        $this->_render_page('home', $data);
      //return $this->home();
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
        $this->index();
        return;
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
        $this->_render_page('hostel/main', $data);
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

    public function _get_allowed_mess_hostel($payment_detail){
        $userId = $this->nativesession->get('userid');
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
        $userId = $this->nativesession->get('userid');
        $hostel_mess = $this->hostelmodel->get_hostel_mess_list_student($userId);
        $mess_due = $this->get_mess_due();
        $flag = false;
        if($payment_detail['messtransactions'] && $hostel_mess['mess']){
            foreach ($hostel_mess['mess'] as $key => $mess) {
                $flag = true;
                $amount_to_be_paid = 4000;
                // print_r($payment_detail['total_mess_due']);
                // print_r($payment_detail);
                $amount_paid = intval($payment_detail['total_aggr_mess']);
                //amout paid should be 4000 under any circumstances for anyone to join summer hostel allotment.
                if($amount_paid != $amount_to_be_paid){
                    $flag = false;
                    unset($hostel_mess['mess'][$key]);
                }
                if (empty($hostel_mess['mess'])) {
                    $hostel_mess['mess'] =FALSE;
                }
            }
            foreach ($hostel_mess['hostel'] as $key => $hostel) {
             if($flag == false){
                unset($hostel_mess['hostel'][$key]);
            }
        }
    }else{
        $hostel_mess['mess'] = FALSE;
        $hostel_mess['hostel'] = FALSE;
    }
    return $hostel_mess;
}

public function get_mess_due(){
    $userId = $this->nativesession->get('userid');
    $mess_due = $this->hostelmodel->get_mess_due($userId);
    return $mess_due;
}
public function payment_detail_check() {
    $userId = $this->nativesession->get('userid');
    $payment_detail = $this->hostelmodel->payment_detail_check($userId);
    return $payment_detail;
}
public function _is_alloted_hostel() {
    $userId = $this->nativesession->get('userid');
    $hostel = $this->hostelmodel->is_alloted_hostel($userId);
    return $hostel;
}
public function _is_alloted_mess() {
    $userId = $this->nativesession->get('userid');
    $mess = $this->hostelmodel->is_alloted_mess($userId);
    return $mess;
}
public function _is_alloted_hostel_summer() {
    $userId = $this->nativesession->get('userid');
    $hostel = $this->hostelmodel->is_alloted_hostel($userId);
    return $hostel;
}
public function _is_alloted_mess_summer() {
    $userId = $this->nativesession->get('userid');
    $mess = $this->hostelmodel->is_alloted_mess($userId);
    return $mess;
}
public function allotment ($type='') {
    if ($type=='') {
        header("location: ./allotment/room");
        return 0;
    }
    $payment_detail = $this->payment_detail_check();
    $this->_get_hostel_total($payment_detail);
    $this->_get_mess_total_summer($payment_detail);
    $hostel_mess = $this->_get_allowed_mess_hostel_summer($payment_detail);
    if(!($hostel_mess['hostel'] && $hostel_mess['mess'])){
        $data['error'] = 'Not Elegible for any Mess or Hostel';
        header('location: ../home');
    }
    $data = array();
    $data['current_page'] = 'hostel';
    $data['current_nav'] = 'single';
    $data['scripts'] = array('hostel.js');
    if ($type == "room") {
        if($this->_is_alloted_hostel()){
            header("location: ../home");
            return 0;
        }
        $data['title'] = 'Online Room Allotment';
        $data['hostel_mess_detail'] = $hostel_mess;
        $this->_render_page('hostel/allotment', $data);
    }
    if($type == "mess"){
        $data['title'] = 'Online Mess Allotment';
        $data['hostel_mess_detail'] = $hostel_mess;
        $this->_render_page('hostel/messallotment', $data);
    }
}

public function get_Hostel_Detail_JSON($hostelId){
    $hostel_detail = $this->hostelmodel->HolstelDetail($hostelId);
    echo json_encode($hostel_detail);
}

public function get_room_list_JSON($hostelId='',$floor=''){
    if(is_null($hostelId)||is_null($floor)) return print('error');
    $room_list = $this->hostelmodel->roomList($hostelId,$floor);
    echo json_encode($room_list);
}

public function single_room() {
    $room_id = $this->input->post('roomId');
    $hostel_id = $this->input->post('hostelId');
    $userId = $this->nativesession->get('userid');
    $payment_detail = $this->payment_detail_check();
    $this->_get_hostel_total($payment_detail);
    $this->_get_mess_total_summer($payment_detail);
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
    $mess_id = $this->input->post('messId');
    $userId = $this->nativesession->get('userid');
    $payment_detail = $this->payment_detail_check();
    $this->_get_hostel_total($payment_detail);
    $this->_get_mess_total_summer($payment_detail);
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
        $userId = $this->nativesession->get('userid');
        $data['group_info'] = $this->hostelmodel->fetch_group_info($userId);
        $this->_render_page('hostel/group', $data);
    }
    public function create_group() {
        $userId = $this->nativesession->get('userid');
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
}
?>
