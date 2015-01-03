<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload_model extends CI_Model {

	function insert1($data){
		$this->db->insert("images", $data);
	}

}

/* End of file upload-model.php */
/* Location: ./application/modules/upload/models/upload-model.php */