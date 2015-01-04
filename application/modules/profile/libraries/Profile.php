<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile
{
	public function __construct()
	{
		$this->load->model('profile/profile_model', 'profile_model');	
	}
}