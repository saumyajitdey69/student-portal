<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feedback_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->config('audit/audit_config',  TRUE);
        $this->tables = $this->config->item('tables', 'audit_config');
    }
        
    public function update_cgpa_data()
    {
        $db_register=$this->load->database('results',TRUE);
        $query=$db_register->get($this->tables['results_odd']);
        // print_r($query->result());
        foreach ($query->result() as $row) {
            $roll=$row->RegNo;
            $userid=$this->get_userid($roll);
            $cgpa=0;
            $db_feedback=$this->load->database('feedback',TRUE);
            $query2=$db_feedback->get_where($this->tables['student_feedback'],array('userid'=>$userid,'cgpa'=>$cgpa));
            if($query2->num_rows()==1)
            {
                $db_feedback->update($this->tables['student_feedback'],array('cgpa'=>$row->Cgpa),array('userid'=>$userid));
                print_r($userid.'=>'.$row->Cgpa."\n");
            }
        }
    }
    public function add_missing_course($course_id,$structure_id,$sec)
    {
        $data=array(   
                'course_id'=>$course_id,
                'structure_id'=> $structure_id,
                'sec' => $sec
                ); 
        $db_register=$this->load->database('feedback',TRUE);
        $query3=$db_register->get_where($this->tables['missing_courses'],$data);
        if($query3->num_rows()==0)
            $db_register->insert($this->tables['missing_courses'],$data); 
    }
    public function get_roll($userid)
    {
        $this->db = $this->load->database('default',TRUE);
        $query=$this->db->get_where($this->tables['student_data'],array("userid"=>$userid));
        if($query->num_rows()==1)
            return $query->row()->roll_number;
        else
            return FALSE;
    }

  public function get_reg_no($userid)
    {
        $this->db = $this->load->database('default',TRUE);
        $query=$this->db->get_where($this->tables['student_data'],array("userid"=>$userid));
        if($query->num_rows()==1)
            return $query->row()->registration_number;
        else
            return FALSE;
    }
    public function get_userid($roll)
    {
        $db=$this->load->database('default',TRUE);
        $query=$db->get_where($this->tables['student_data'],array("roll_number"=>$roll));
        if($query->num_rows()==1)
            return $query->row()->userid;
        else
            return FALSE;
    }
    public function get_student_data($userid)
    {
        $this->db = $this->load->database('default',TRUE);
        $query=$this->db->get_where($this->tables['student_data'],array("userid"=>$userid));
        if($query->num_rows()==1)
            return $query->row();
        else
            return FALSE;
    }
    public function get_rollnos()
    {
        $db_register=$this->load->database('reg',TRUE);
        $query=$this->db->get_where($this->tables['registered']);
        if($query->num_rows()>0)
            return $query->result();
        else
            return FALSE;
    }
    public function get_rollnos2()
    {
        $db_register=$this->load->database('reg',TRUE);
        $query=$this->db->get_where($this->tables['registered']);
        if($query->num_rows()>0)
            return $query->result_array();
        else
            return FALSE;
    }
    public function get_courses($roll)
    {
        $data['roll']=$roll;
        $db_register=$this->load->database('reg',TRUE);
        $db_register->like('roll',$roll);
        $query=$db_register->get($this->tables['registered']);
        return $query->result_array();
    
    }
	
   public function get_section($roll)
	{
	$db_register = $this->load->database('reg',TRUE);
	$query = $db_register->select('sec')
				->from($this->tables['registered'])
				->where(array('roll'=>$roll))
				->get();
	if($query->num_rows()==1 )
		return $query->row()->sec;
	else
		return FALSE;
	}	

  public function get_feedback_courses($userid)
    {
        $this->db = $this->load->database('default',TRUE);
        $query=$this->db->get_where($this->tables['student_data'],array('userid'=>$userid));
        if($query->num_rows()==1)
            $data['roll']=$query->row()->roll_number;
        else
            return FALSE;
        $db_register=$this->load->database('reg',TRUE);
        $db_register->like('roll',$data['roll']);
        $query=$db_register->get($this->tables['registered']);
        // If the student is regisrered using registration number then, first swap the registration number with roll number in registration database and also swap the registraion numnber with roll number in attendace portal. - Vaibhav Awachat
        if($query->num_rows() === 0){
        	        if($this->auto_correct_roll_number($userid)){
                        // fetch database again
                        $db_register=$this->load->database('reg',TRUE);
                        $db_register->like('roll',$data['roll']);
                        $query2=$db_register->get($this->tables['registered']);
                        return $query2->result_array();
                    } 
            else
                return false;
        }
        else{
     	   return $query->result_array();
    	}
    
    }

    public function auto_correct_roll_number($userid)
    {
    	//return false;
       
    	// get the correct registration number
    	$regno = $this->get_reg_no($userid);
    	// get correct roll number
    	$correct_roll = $this->get_roll($userid);
    	// search the roll number in registration database
        $db_register=$this->load->database('reg',TRUE);
        $query = $db_register->select('roll')->where('roll',$correct_roll)->get('registered');
        if($query->num_rows() === 0){
        	// the roll number does not exits, it means that faculty advisor must have used registration number to register.
            // swap the registration number and roll number in attendance module as well
            return $this->swap_reg_with_roll($regno, $correct_roll);
        }
        else{
            //The database is already correct, nothing to change
            // We might face some issues with the repeaters.
            return true;
        }
    }

    public function swap_reg_with_roll($regno, $correct_roll)
    {
     $db_register=$this->load->database('reg',TRUE);
        // check the registration number in atendance module, TR sir added reg and roll both :(
     $query = $db_register->where('rollno', $regno)->update('attendance_record', array('rollno' => $correct_roll));
        if($db_register->_error_number() == 1062) // duplicate entry
        {
            return false;
        }
            // swap in registration database
            // for all regular and backlog stulog students.
        $query = $db_register->where('roll', $regno)->update('registered', array('roll' => $correct_roll));
        return true;
    }

    public function get_structure_id($data)
    {
        $db_register=$this->load->database('reg',TRUE);
        // $query=$db_register->get_where($this->tables['list_of_all_classes'],array('class_name'=>$data['class']));
        // $data['class']=$query->row()->class_code;
        $query=$db_register->get_where('regular',$data);
        if($query->num_rows()==1)
            return $query->row()->structure_id;
        else
            return FALSE;
    }
    public function get_cfid($structure_id,$course_id,$sec)
    {
        $db_register=$this->load->database('reg',TRUE);
	    if($sec=='0')
            $sec="NO";
        $data=array(
            'structure_id'=>$structure_id,
            'course_id'=>$course_id,
            'section'=>$sec
            );
        $query=$db_register->get_where($this->tables['faculty_course'],$data);

        if($query->num_rows()==1)
            return $query->row();
        else
            return FALSE;
    }
    public function insert_feedback($data)
    {
        $db_feedback = $this->load->database('feedback',TRUE);
        // $data=array('id'=>NULL,
        //     'cfid'=>$cfid,
        //     'cgpa'=>$cgpa,
        //     'value'=>$value);
        // print_r($data);
        return $db_feedback->insert($this->tables['feedback'],$data);
    }
    public function insert_feedback_comment($data)
    {
        $db_feedback = $this->load->database('feedback',TRUE);
            // $data=array('id'=>NULL,
            //     'cfid'=>$cfid,
            //     'cgpa'=>$cgpa,
            //     'type'=>$type,
            //     'comment'=>$content);

           return $db_feedback->insert($this->tables['feedback_comments'],$data);
    }
    public function update_feedback_status($userid,$status)
    {
        $db_feedback = $this->load->database('feedback',TRUE);
        $data=array(
            'feedback'=>$status
            );
        $db_feedback->where('userid',$userid);
        return $db_feedback->update($this->tables['student_feedback'],$data);
    }
    public function get_status($userid)
    {
	$db_feedback = $this->load->database('feedback',TRUE);
        $query=$db_feedback->get_where($this->tables['student_feedback'],
            array('userid' =>$userid));
       if($query->num_rows()==1)
            return $query->row()->feedback;
        else
            return FALSE;
    }

    public function get_cgpa($userid)
    {
        $feedback_db = $this->load->database('feedback', TRUE);
        $feedback_db->select('cgpa')->from($this->tables['student_feedback'])->where(array('userid' => $userid));
        $query = $feedback_db->get();
        if ($query->num_rows() == 1) {
            return $query->first_row()->cgpa;
        } else {
            return -1;
        }
    }

    public function set_cgpa($userid, $cgpa)
    {   
        $db_feedback = $this->load->database('feedback',TRUE);
        $db_feedback->set('userid', $userid);
        $db_feedback->set('cgpa', $cgpa);
        $db_feedback->insert($this->tables['student_feedback']);
    }

    public function get_cgpa_results($roll_number)
    {
        $db_results  = $this->load->database('results',TRUE);
        $query= $db_results->select('cgpa')
                            ->from($this->tables['results_even_2014'])
                            ->where(array('RegNo'=>$roll_number))
                            ->get();
        if($query->num_rows > 0)
            return $query->row()->cgpa;
        else
            return 0 ;
    }

}
