<?php

/** @property news_model $news_model *
 */
class Contact extends Front_end
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
        $data['menu_active'] = 'contact';
        $data['courses'] = json_encode($this->apis_model->getJsonCourses());
        $data['levels'] = $this->apis_model->getLevels();
        $data['param1'] = rand(0, 10);
        $data['param2'] = rand(0, 10);
        $data['results'] = array();
        $this->view('content/contact_visit', $data);
    }
    function visit()
    {
        $hashed_password = password_hash("ucmas_welcome",PASSWORD_DEFAULT);
        $data['token'] = $hashed_password;
        $data['courses'] = json_encode($this->apis_model->getJsonCourses());
        $data['levels'] = $this->apis_model->getLevels();
        $data['results'] = array();
        $data['param1'] = rand(0, 10);
        $data['param2'] = rand(0, 10);
        $this->view('content/contact_visit', $data);
    }
    function captcha(){
        $param1 = rand(0, 10);
        $param2 = rand(0, 10);

        echo json_encode(array("param1"=>$param1, "param2"=>$param2));exit;
    }
    function request_save()
    {
        $data['menu_active'] = 'contact';
        $data['results'] = array();

        if(isset($_POST['token']) && $_POST['question'] != "" && password_verify("ucmas_welcome",$_POST['token'])){
            $this->apis_model->save_contact($_POST['question'], $_POST['username'],$_POST['email'], $_POST['sel_hear'], $_POST['comment']);
            echo json_encode(array("success"=>"OK"));
        }else {
            echo json_encode(array("success"=>"false"));
        }

    }
}