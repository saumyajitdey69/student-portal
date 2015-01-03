<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Radio extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['current_page'] = 'lanradio';
		$data['title'] = 'LAN Radio | Lan Radio Club';
		$data['css'] = array('jplayer/skin/blue.monday/css/jplayer.blue.monday.css');
		$data['scripts'] = array('jplayer/jquery.jplayer.min.js', 'jplayer/config.js');
		$this->_render_page('radio/index', $data);
	}

	public function indicator()
	{
		echo '';
	}

	function _render_page($view, $data=null, $render=false)
	{
		$data['current_section'] = 'apps';
		$view_html = array(
			$this->load->view('base/header', $data, $render),
			$this->load->view('menu/header', $data, $render),
			$this->load->view($view, $data, $render),
			$this->load->view('menu/footer', $data, $render),
			$this->load->view('base/footer', $data, $render)
			);
		if (!$render) return $view_html;
	}

}

/* End of file radio.php */
/* Location: ./application/controllers/radio.php */