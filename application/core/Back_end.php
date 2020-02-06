<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');


class Back_end extends CI_Controller {

     /**
     * count num of unreaded messages
     *
     * @var integer
     * 
     */
    function __construct() {
        parent::__construct();
//        $this->load->library('ion_auth');
//        $this->load->library('session');
        $this->check_user();
    }

    /**
     *
     * @param string $main_containt
     * @param array $data
     */
    function view($main_containt, $data = null) {
//        $this->load->view('admin/header',$data);
        $this->load->view($main_containt, $data);
//        $this->load->view('admin/footer',$data);
    }

    /**
     * give it the right string and it will 
     *
     * @param string $right
     * @return void
     */
    protected function check_user() {

        $public_allowed_urls = array("admin/login", "admin/login_request", "admin/forgot_password", "admin/forgot_password_request");
        $controller= $this->uri->segment(1); // controller
        $action = $this->uri->segment(2); // action
        $url = $controller . '/' . $action;
//        echo $url;exit;
        if ( ($this->session->userdata('permission') > 0) || (in_array($url, $public_allowed_urls)))
        {
            //redirect them to the login page
            return;
        }
        else
        {
            //redirect them to the home page because they must be an administrator to view this
            redirect('admin/login', 'refresh');
            exit;
        }
    }

}