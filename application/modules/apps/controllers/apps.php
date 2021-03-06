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
        $data['scripts'] = array('auth/jquery.dataTables.min.js', 'auth/table.js');
        $this->_render_page('hubs/index', $data);
    }


    public function update_hubs() {
        $token = $this->input->post('token');
        // $token ='rajakiaayegibarat';
        $hub_details = $this->input->post('content'); 
        // $hub_details = '[ {"Name":"NITW e-Library Network - Testing Complete (Staging)","Users":"182","UpTime":"1 days, 11 hours, 2 minutes","Address":"172.30.107.112","Software":"PtokaX DC Hub 0.5.0.1 "},{"Name":"JoKeR","Users":"55","UpTime":"0 days, 14 hours, 28 minutes","Address":"172.30.103.116","Software":"PtokaX DC Hub 0.5.0.2 "} ]';
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