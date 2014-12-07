<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Apps extends MX_Controller {

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

    public function hubs() {
        $data = array();
       
        $data['current_page'] = 'home';
        $this->load->model('hub_model', '', TRUE);
        $data['hub_list'] = $this->hub_model->get();
        $data['title'] = "DC++ Hubs (".count($data['hub_list']).")";
        // $data['scripts'] = array('auth/jquery.dataTables.min.js', 'auth/table.js');
        $this->_render_page('hubs/index', $data);
    }


    public function update_hubs() {
        $hub_details = $this->input->post();
        $this->load->model('hub_model');
        $this->hub_model->update($hub_details);
    }

    function _render_page($view, $data=null, $render=false)
    {
        $data['current_section'] = 'audit';
        $view_html = array(
            $this->load->view('base/header', $data, $render),
            $this->load->view('hubs/menu/header', $data, $render),
            $this->load->view($view, $data, $render),
            $this->load->view('hubs/menu/footer', $data, $render),
            $this->load->view('base/footer', $data, $render)
            );
        if (!$render) return $view_html;
    }
}