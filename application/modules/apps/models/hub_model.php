<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hub_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

   	public function get_hubs()
   	{
   		$query =  $this->db->select('hub_address, hub_name, no_of_users, uptime')
                            ->from('hubs')
                            // ->where('timestamp >= ', strval(time()-300))
                            ->get();
         //$this->db->select()->from('hubs')->where('timestamp >=', time()-30);
   		return $query->result('array');
   	}
   	public function update_hubs($value)
   	{
   		//first authenticate the request..

   		$query = $this->db->select()->from('hubskeys')->where(array('key_s' => $value['secretkey']));
   		$query = $this->db->get();
   		if($query->num_rows()==0)
   		{
   			echo 'Unauthorized request!';
   			return;
   		}
   		// echo $value['secretkey'];
   		if($value['delete']=='1')
   		{//should be deleted!!
   			if($this->db->delete('hubs', array('hub_address' => $value['hub_address'])))
   			{
   				echo 'Deleted successfully';
   			} 
   			else
   				echo 'Failed to delete!';
   			return;
   		}

   		$this->db->select()->from('hubs')->where(array('hub_address' => $value['hub_address']));
   		$query = $this->db->get();
   		if($query->num_rows()>0)
   		{//already exisiting.. so just update the details...
   			$data = array(
               'hub_name' => $value['hub_name'],
               'no_of_users' => intval($value['no_of_users']),
               'uptime' => $value['uptime'],
               'timestamp' => time()
            );

			$this->db->where('hub_address', $value['hub_address']);
			if($this->db->update('hubs', $data))
			{
				echo 'Success!';
			} 
			else
				echo 'Failed!';
   		}
   		else
   		{//a new one... so add it into the table..
   			$data = array(
			   'hub_address' => $value['hub_address'] ,
			   'hub_name' => $value['hub_name'],
               'no_of_users' => intval($value['no_of_users']),
               'uptime' => $value['uptime'],
               'timestamp' => time()
			);

			if($this->db->insert('hubs', $data))
			{
				echo 'Success!';
			} 
			else
				echo 'Failed!';
   		}
   	}
}

/* End of file apps 2.php */
/* Location: .//tmp/fz3temp-1/apps 2.php */