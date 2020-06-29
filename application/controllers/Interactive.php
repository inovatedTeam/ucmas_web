<?php

/** @property news_model $news_model *
 */
class Interactive extends Front_end
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
        $data['menu_active'] = 'interactive';
        $data['results'] = $this->apis_model->getAllImages("level_id");
        $this->view('content/interactive', $data);
    }
}