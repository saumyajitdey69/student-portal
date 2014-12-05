<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
*/
class User_data_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->config('auth/ion_auth', TRUE);
		$this->tables  = $this->config->item('tables', 'ion_auth');
	}
	public function get_all_user_data()
	{	
		$this->db->select()
				->from($this->tables['users'])
				->join($this->tables['student_data'],'users.id=student_data.userid');
		$query=$this->db->get();
		// print_r($query->result());
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		else
			return FALSE;
	}
}

/* End of file user_data_model.php */
/* Location: ./application/modules/auth/models/user_data_model.php */