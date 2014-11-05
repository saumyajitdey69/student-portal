<?php

class Auth_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->old_db=$this->load->database('old_student',TRUE,TRUE);
    }

    public function verify_credentials($credentials) {
        $credentials['password']=md5($credentials['password']);
        $query=$this->old_db->get_where('student_auth',$credentials);
        if ($query->num_rows() == 1) {
            return $query->first_row();
        } else {
            $this->old_db->select('')->from('student_auth')->where(array('username' => $credentials['username']))->limit(1);
            $query = $this->old_db->get();
            if ($query->num_rows() == 0) {
                return 0;
            } else {
                return false;
            }
        }
    }

    public function update_ip($credentials) {
        $this->old_db->where('username',$credentials['username']);
        $this->old_db->set('access_count','access_count+1',FALSE);
        $this->old_db->set('access_location',$credentials['access_location']);
        $this->old_db->update('student_auth');
    }

    public function get($userid) {
        $this->old_db->select()->from('student_data')->where(array('userid' => $userid))->limit(1);
        $query = $this->old_db->get();
        if ($query->num_rows() == 1) {
            return $query->first_row();
        } else {
            return false;
        }
    }


    public function get_userid_actlink($id) {
        $this->old_db->select("userid")->from('student_auth')->where(array('activation_link' => $id))->limit(1);
        $query = $this->old_db->get();
        if ($query->num_rows() == 1) {
            return $query->first_row()->userid;
        } else {
            return false;
        }
    }

    public function set_new_password($activation_link,$password){
        $this->old_db->update('student_auth',
            array('password' => md5($password), 'activation_link' => ''),
            array('activation_link' => $activation_link));
        if ($this->old_db->affected_rows() === 1){
            return true;
        } else {
            return false;
        }
    }

    public function get_userid_email($email) {
        $this->old_db->select('userid')->from('student_data')->where(array('email' => $email))->limit(1);
        $query = $this->old_db->get();
        if ($query->num_rows() == 1) {
            return $query->first_row()->userid;
        } else {
            return false;
        }
    }

    // public function get_roll_number($userid)
    // {
    //     $this->old_db->select('roll_number')->from('student_data')->where(array('userid' => $userid))->limit(1);
    //     $query = $this->old_db->get();
    //     if ($query->num_rows() == 1) {
    //         return $query->first_row()->roll_number;
    //     } else {
    //         return false;
    //     }
    // }

    public function activation($activation_link)
    {
        $this->old_db->update('student_auth', array('active' => 1), array('activation_link' => $activation_link));
        if ($this->old_db->affected_rows() === 1) {
            return true;
        } else {
            return false;
        }
    }

    // public function get_courses($roll_number, $arr = '')
    // {
    //     $query = $this->old_db->select()->from('registration_list')->where(array('roll_number' => $roll_number))->limit(1);
    //     if ($query->num_rows() == 1) {
    //         return $query->first_row($arr);
    //     } else {
    //         return false;
    //     }
    // }

    public function set_activation_link($userid)
    {
        $link = time().md5(mt_rand(1000000, 9999999));
        $data = array('activation_link' => $link);
        $this->old_db->update('student_auth', $data, array('userid' => $userid));
        return $link;
    }

    public function get_account_status($value,$param='userid'){
        // returns the active state of the userid account
        $this->old_db->select('active')->from('student_auth')->where(array("$param" =>$value))->limit(1);
        $query = $this->old_db->get();
        return $query->first_row()->active;
    }

    public function activate($link)
    {
        $data["active"] = 1;
        $data["activation_link"] = "";
        $this->old_db->update('student_auth', $data, array('activation_link' => $link));
        if ($this->old_db->affected_rows() === 1) {
            return true;
        } else {
            return false;
        }
    }

    public function activate_account($link)
    {
        $this->old_db->select()->from('student_auth')->where(array('activation_link'=>$link));
        $query=$this->old_db->get();
        if ($query->num_rows() != 1) {
            return "No such Activation Link";
        } else {
            foreach ($query->result() as $row) {
                $this->old_db->where(array('activation_link'=>$row->activation_link,'userid' => $row->userid));
                $query2=$this->old_db->update('student_auth',array('active'=>1,'activation_link'=>''));
                if($this->old_db->affected_rows() == 1){
                    return "success";
                }else{
                    return "Database Error";
                }
            }
        }
    }
    public function verify_username_exists($username){
        // return "return by check username";
        // $query = $this->old_db->from('student_auth')->where("username" => "$username")->get();
        $this->old_db->select()->from('student_data')->where(array('username' => $username));
        $query = $this->old_db->get();
        // return "Funtime".$query->num_rows();
        if($query->num_rows() == 1 ){
            return true;
        }
        else{
            return false;
        }
    }

    public function create($details)
    {
        $status = array('status' => false, 'message' => '');

        $student_data_insert=false;
        $student_auth_insert=false;
        if($this->verify_username_exists($details['username'])){
            $status['message'] = "Username already exists. Please try a different one";
        }

        if($this->old_db->insert('student_data', $details)){
            $student_data_insert = true;
        } else {
            if($this->old_db->_error_number()==1062){
                //in case of duplicate entries for one of the unique key columns
                $status['message'] = "Please verify the details you have entered. Some of the fields already exist";
                // $dtatus['message'] .=  $this->old_db->_error_message();
                return $status;
            } else {
                //for all other types of errors during inserting
                $status['message'] = "Database error";
                return $status;
            }
        }
        $userid = $this->old_db->insert_id();
        $activation_link = md5(uniqid(rand(),true));
        $authDetails = array(
            'userid' => $userid,
            'username' => $details['username'],
            'password' => $details['password'],
            'activation_link' => $activation_link
            );
        $status['activationLink'] = $activation_link;
        if($this->old_db->insert('student_auth', $authDetails)){
            $student_auth_insert = true;
        } else {
            if($this->old_db->_error_number()==1062){
                //in case of duplicate entries for one of the unique key columns
                $status['message'] = "Please verify the details you have entered";
                return $status;
            }else{
                //all types of errors during inserting
                $status['message'] = "Database error";
                return $status;
            }
        }
        $this->old_db->insert('student_feedback', array('userid' => $userid));
        $status['status'] = true;
        return $status;
    }

    public function changepasswd($userid, $currentpasswd, $newpasswd)
    {
        $data = array('password' => $newpasswd );
        $this->old_db->update('student_auth', $data, array('userid' => $userid, 'password' => $currentpasswd));
        if ($this->old_db->affected_rows() === 1) {
            return true;
        } else {
            return false;
        }
    }

}