<?php

/** @property news_model $news_model *
 */
class About extends Front_end
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
        $data['menu_active'] = '';
//        $data['sliders'] = $this->apis_model->getSliderImages();
//        $data['news'] = $this->apis_model->getNews();
        $data['sections'] = $this->apis_model->getPageLang(1, $this->session->userdata('lang'));
        $this->view('content/home', $data);
    }

    function about_ucmas()
    {
        $data['menu_active'] = 'about';
        $data['menu_sub_active'] = 'ucmas';
        $data['sections'] = $this->apis_model->getPageLang(1, $this->session->userdata('lang'));
        $this->view('content/about_ucmas', $data);
    }
    function abacus_finger_manipulation()
    {
        $data['menu_active'] = 'about';
        $data['menu_sub_active'] = 'history';
        $data['sections'] = $this->apis_model->getPageLang(2, $this->session->userdata('lang'));
        $this->view('content/about_history', $data);
    }
    function mission_vision()
    {
        $data['menu_active'] = 'about';
        $data['menu_sub_active'] = 'vision';
        $this->view('content/about_vision', $data);
    }

    function benefits_beyond_math()
    {
        $data['menu_active'] = 'about';
        $data['menu_sub_active'] = 'vision';
        $data['sections'] = $this->apis_model->getPageLang(3, $this->session->userdata('lang'));
        $this->view('content/about_benefit', $data);
    }
    function mental_arithmetics_training()
    {
        $data['menu_active'] = 'about';
        $data['menu_sub_active'] = 'vision';
        $data['sections'] = $this->apis_model->getPageLang(4, $this->session->userdata('lang'));
        $this->view('content/about_mental', $data);
    }
    function network()
    {
        $data['menu_active'] = 'about';
        $data['menu_sub_active'] = 'network';
        $data['sections'] = $this->apis_model->getPageLang(5, $this->session->userdata('lang'));
        $this->view('content/about_network', $data);
    }
    function global_network()
    {
        $data['menu_active'] = 'about';
        $data['menu_sub_active'] = 'global_network';
        $data['sections'] = $this->apis_model->getPageLang(6, $this->session->userdata('lang'));
        $this->view('content/about_network_global', $data);
    }

}
