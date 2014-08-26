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
        $data['title'] = "Apps - Home";
        $data['current_page'] = 'home';
        $this->load->model('hub_model', '', TRUE);
        $data['hub_list'] = $this->hub_model->get_hubs();
        $data['scripts'] = array('jquery.dataTables.min.js', 'table.js');
        $this->_render_page('hubs/index', $data);
    }


    public function update_hubs() {
        if(!isset($_GET['hub_address'])|| 
            !isset($_GET['no_of_users'])|| 
            !isset($_GET['hub_name'])|| 
            !isset($_GET['uptime'])||
            !isset($_GET['delete'])||
            !isset($_GET['secretkey'])
            )
        {
            echo 'Invalid Request!';
            return;
        }

        $this->load->model('hub_model', '', TRUE);
        $this->hub_model->update_hubs($_GET);
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