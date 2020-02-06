<?php

/** @property news_model $news_model *
 */
class Home extends Front_end
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
        $data['courses'] = $this->apis_model->getCourses();
        $data['videos'] = $this->apis_model->getHomeVideos();
        $data['pictures'] = $this->apis_model->getHomePictures();
        $this->view('content/home', $data);
    }
}
