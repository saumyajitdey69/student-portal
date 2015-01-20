<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hubs extends MY_Controller {

    function __construct()
    {
        parent::__construct();
    }

    // private function check() {
    //     if ($this->nativesession->get('userid') === null) {
    //         redirect(base_url('home'), 'location', 301);
    //         return false;
    //     }
    //     if ($this->student->profile_edited($this->nativesession->get('userid')) === false) {
    //         redirect(base_url('profile'), 'location', 301);
    //         return false;
    //     }
    // }

    public function index() {
        $data = array();       
        $data['current_page'] = 'hubs';
        $this->load->model('hub_model', '', TRUE);
        $data['hub_list'] = $this->hub_model->get();
        $data['title'] = "DC++ Hubs (".count($data['hub_list']).")";
        $data['css'] = array('dataTables.bootstrap.css');
        $data['scripts'] = array('auth/jquery.dataTables.min.js', 'auth/table.js');
        $this->_render_page('apps/hubs/index', $data);
    }


    public function update_hubs() {
        $token = $this->input->post('token');
        // $token ='rajakiaayegibarat';
        $hub_details = $this->input->post('content'); 
        $hub_details = json_decode($hub_details, true);
        $this->load->model('hub_model');
        // var_dump($hub_details);
        $this->hub_model->delete($token);
        $this->hub_model->insert($hub_details, $token);
    }

    function _render_page($view, $data=null, $render=false)
    {
       $data['current_section'] = 'apps';
        $view_html = array(
            $this->load->view('base/header', $data, $render),
            $this->load->view('apps/menu/header', $data, $render),
            $this->load->view($view, $data, $render),
            $this->load->view('apps/menu/footer', $data, $render),
            $this->load->view('base/footer', $data, $render)
            );
        if (!$render) return $view_html;
    }
}