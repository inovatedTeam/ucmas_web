<?php

/** @property news_model $news_model *
 */
class Franchising extends Front_end
{
    function __construct()
    {
        parent::__construct();
        $this->lang->load('home');
        $this->load->model('apis_model');
    }

    // this function to handle getting all news
    function index()
    {
        $data['menu_active'] = 'franchising';
        $data['results'] = array();
        $this->view('content/program_view', $data);
    }
    function teaching()
    {
        $data['menu_active'] = 'franchising';
        $data['sections'] = $this->apis_model->getPageLang(10, $this->session->userdata('lang'));
        $this->view('content/franchising_teaching', $data);
    }
    function franchising()
    {
        $data['menu_active'] = 'franchising';
        $data['results'] = array();
        $data['sections'] = $this->apis_model->getPageLang(11, $this->session->userdata('lang'));
        $this->view('content/franchising', $data);
    }
//    function request()
//    {
//        $data['menu_active'] = 'program';
//        $data['results'] = array();
//
//        $this->view('content/franchising_request', $data);
//    }
    function request_save()
    {
//        $data['menu_active'] = 'program';
//        $data['results'] = array();
//        $this->apis_model->save_contact($_POST['question'], $_POST['username'],$_POST['email'], $_POST['sel_hear'], $_POST['comment'], 1);
//        echo json_encode(array("success"=>"OK"));
    }
}