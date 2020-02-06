<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * @property CI_Config $config
 * @property CI_Session $session
 */

class Front_end extends CI_Controller {

    function __construct() {

        parent::__construct();

        $this->load_lang();
//        $this->output->delete_cache();
    }

    /**
     * return module language file
     */
    protected function load_lang() {
        $lang = "";

        if(isset($_GET['lang']) && $_GET['lang'] != ""){
            $lang = $_GET['lang'];
            if($lang == "en"){
                $this->config->set_item('language',"english");
            }elseif ($lang == "da"){
                $this->config->set_item('language',"danish");
            }elseif ($lang == "no"){
                $this->config->set_item('language',"norwegian");
            }elseif ($lang == "se"){
                $this->config->set_item('language',"swedish");
            }
            $this->session->set_userdata("lang", $lang);
        }else if ($this->session->userdata('lang') == "da") {
            $this->config->set_item('language',"danish");
            $this->session->set_userdata("lang",'da');
        }else if ($this->session->userdata('lang') == "no") {
            $this->config->set_item('language',"norwegian");
            $this->session->set_userdata("lang",'no');
        }else if ($this->session->userdata('lang') == "se") {
            $this->config->set_item('language',"swedish");
            $this->session->set_userdata("lang",'se');
        }else if ($this->session->userdata('lang') == "en") {
            $this->config->set_item('language',"english");
            $this->session->set_userdata("lang",'en');
        }else {
            $lang = "no";
            $this->config->set_item('language',"swedish");
            $this->session->set_userdata("lang", $lang);
        }

        //  $this->lang->load($moduleName, $lang);
    }
    /**
     * present master page includes header and footer
     * @param string $main_containt
     * @param array $data 
     */
     function view($main_containt, $data = null) {

//         $this->load->view('theme/header', $data);
         $this->load->view($main_containt, $data);
//         $this->load->view('theme/footer');
    }
}