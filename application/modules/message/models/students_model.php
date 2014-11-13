<?php
class Students_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_details($search_query)
	{
		$this->load->model('audit/audit_model');
		$db_students=$this->load->database("student", TRUE);
		$db_students->from("student_data");
		foreach ($search_query as $key => $query) {
			$query= trim($query);
			if($query!=""){
				$db_students->or_like('name', $query);
				$db_students->or_like('roll_number', $query);				
				$db_students->or_like('registration_number', $query);				
			}
		}		

		$query=$db_students->get();
		if($query->num_rows()>0)
			return $query->result();
		else
			return FALSE;
	}

	public function get_details_advance($search_query, $result_count = '5', $order_by_col = 'first_name')
	{
		$db_students=$this->load->database("student", TRUE);

		$db_students->select('first_name, last_name ,username , email, phone, branch, registration_number, roll_number, joining_year')->from("student_data as data");

		$db_students->join("users as auth",'auth.id = data.userid', 'inner');
		foreach ($search_query as $key => $query) {
			$query_string = "";
			if(is_array($query) && array_key_exists("name", $query))
			{
				// $db_students->like('name', $query['name']);
				if(strlen($query['name']) === 1){
				$query['name'] = $db_students->escape($query['name']."%");
			}else
			{
				$query['name'] = $db_students->escape("%".$query['name']."%");

			}
				$query_string .= "((( "."first_name"." LIKE ".$query['name'];
				$query_string .= ") OR ( "."last_name"." LIKE ".$query['name'].'))';
				// unset($query['name']);
			}
			if(is_array($query) && count($query) > 0)  //this will run always
			{
				// $db_students->where($query);
				if(array_key_exists("name", $query))
				{
					unset($query['name']);
					if(count($query) > 0)
					{
						$query_string .= ' AND ';
					}
				}
				else
				{
					$query_string = "";
					$query_string .= "(";
				}
				// return $query;
				$count = 0;
				foreach ($query as $key => $value)
				{
						$count++;
					if($value !== "")
					{
						$value= $db_students->escape($value);
						$query_string .= $key.' = '.$value;
					}
					if($count < count($query))
					{
						$query_string .= ' AND ';
					}
				}

				$query_string .= ") ";
			}
			$db_students->or_where($query_string);
		}	
		
		$query=$db_students->limit($result_count)->order_by($order_by_col)->get();
		if($query->num_rows()>0)
			return $query->result();
		else
			return FALSE;
	}
}
?>