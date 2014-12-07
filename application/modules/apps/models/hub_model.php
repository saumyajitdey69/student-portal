<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hub_model extends CI_Model {

  public function __construct()
  {
    parent::__construct();        
    $this->db = $this->load->database('hubs', TRUE);
    $this->token = md5('rajakiaayegibarat');
  }

  public function get()
  {
    $query =  $this->db->select('address, name, users, uptime')->from('hubs')->get();
    return $query->result('array');
  }

  public function delete($token = '')
  {
    if($token != $this->token) 
      return false;
    if($this->db->delete('hubs')){
      echo 'Deleted successfully';
      return true;
    } 
    else{
      echo 'Failed to delete!';       
      return false;
    }
  }

  public function insert($value, $token)
  {
    //first authenticate the request..
    if($token != $this->token) 
      return false;

    if($this->db->insert('hubs', $data))
    {
      echo 'Success!';
      return true;
    } 
    else{
      echo 'Failed!';
      return false;
    }
  }
}

/* End of file apps 2.php */
/* Location: .//tmp/fz3temp-1/apps 2.php */