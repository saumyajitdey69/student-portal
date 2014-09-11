<?php 

class Slip_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->config('audit/audit_config');
		$this->tables = $this->config->item('tables');
    }

	public function not_registered_check($roll)
	{
		$this->db_reg = $this->load->database('reg',TRUE);
		$query = $this->db_reg->where('roll',$roll)
							  ->get($this->tables['registered']);
		if($query->num_rows()<1){
			return FALSE;
		}else{
			return TRUE;
		}
	}
	public function get_registered_detail($roll)
	{
		$this->db_reg = $this->load->database('reg',TRUE);
		$query = $this->db_reg->where('roll',$roll)
							  ->get($this->tables['registered']);
		if($query->num_rows()<1){
			return FALSE;
		}else{
			$result = $query->result_array();
			return $result;
		}
	}
}
 ?>