<?php

/** @property news_model $news_model *
 */
class Program extends Front_end
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
        $data['menu_active'] = 'program';
        $data['results'] = array();
        $data['levels'] = $this->apis_model->make_arr($this->apis_model->getLevels(), "id");
        $data['programs'] = $this->apis_model->getPrograms();
        $data['sections'] = $this->apis_model->getPageLang(6, $this->session->userdata('lang'));
        $this->view('content/program_view', $data);
    }
    function exam_competition()
    {
        $data['menu_active'] = 'program';
        $data['sections'] = $this->apis_model->getPageLang(8, $this->session->userdata('lang'));
        $this->view('content/program_exam', $data);
    }
    function training_methods()
    {
        $data['menu_active'] = 'program';
        $data['results'] = array();
        $data['sections'] = $this->apis_model->getPageLang(7, $this->session->userdata('lang'));
        $this->view('content/program_training', $data);
    }
    function faq()
    {
        $data['menu_active'] = 'program';
        $data['results'] = array();
        $data['faqs'] = $this->apis_model->getFaqs();
        $this->view('content/program_faq', $data);
    }

    function level($level_id = 0)
    {
        if($level_id == 0)
            redirect("program");
        $data['menu_active'] = 'program';
        $levels = $this->apis_model->getLevels($level_id);
        $data['level'] = $levels[0];
        $data['photos'] = $this->apis_model->getPhotos($level_id);
        $data['features'] = $this->apis_model->getFeatures($level_id);
        $data['prev_level'] = $this->apis_model->getPrevLevel($level_id);
        $data['next_level'] = $this->apis_model->getNextLevel($level_id);
        //
        $data['results'] = $this->apis_model->getCoursesByLevel($level_id);
        //

        $this->view('content/program_level', $data);
    }
}