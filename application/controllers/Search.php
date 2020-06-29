<?php

/** @property news_model $news_model *
 */
class Search extends Front_end
{
    private $week_day = array("0"=>"", "1"=>"Monday", "2"=>"Tuesday","3"=>"Wednesday","4"=>"Thursday","5"=>"Friday","6"=>"Saturday","7"=>"Sunday");
    private $age_ranges = array(
        "en"=>["1"=>"classes_5_to_6_years_old","2"=>"classes_7_to_9_years_old","3"=>"classes_10_to_14_years_old"],
        "da"=>["1"=>"classes_5_to_6_years_old","2"=>"classes_7_to_9_years_old","3"=>"classes_10_to_14_years_old"],
        "se"=>["1"=>"classes_5_to_6_years_old","2"=>"classes_7_to_9_years_old","3"=>"classes_10_to_14_years_old"],
        "no"=>["1"=>"classes_5_to_6_years_old","2"=>"classes_7_to_9_years_old","3"=>"classes_10_to_14_years_old"]
    );

    function __construct()
    {
        parent::__construct();
        $this->lang->load('home');
        $this->load->model('apis_model');
    }

    // this function to handle getting all news
    function index()
    {
        $data['menu_active'] = 'search';
        $data['courses'] = json_encode($this->apis_model->getJsonCourses());
        // $data['levels'] = $this->apis_model->getLevels();
        // $data['results'] = array();
        // $data['sel_level'] = 0;
        // $data['address'] = "";
        $data['radius'] = 5;
        $data['lat'] = "59.9160302";
        $data['lot'] = "10.7361983";
        $data['week'] = $this->week_day;
        $data['addresses'] = $this->apis_model->getCourseAddresses();
        $lang = $this->session->userdata("lang");
        $data['age_ranges'] = $this->age_ranges[$lang];
        $data['results'] = array();
        $data['sel_age_range'] = "";
        $data['sel_level'] = 0;
        $data['sel_address'] = "";
        $this->view('content/search_view', $data);
    }

    function result($param1 = 0, $param2 = "course")
    {
        $data['menu_active'] = 'search';
        if($param2 == "course"){
            $result = $this->apis_model->getJsonCourses($param1);
            $data['courses'] = json_encode($result);
            $data['results'] = $this->apis_model->getCourses($param1);
            $data['week'] = $this->week_day;
            $data['levels'] = $this->apis_model->getLevels();
            $data['radius'] = 5;
            $data['sel_level'] = 0;
            $data['address'] = "";
            $lang = $this->session->userdata("lang");
            $data['age_ranges'] = $this->age_ranges[$lang];
            $data['sel_age_range'] = "";
            $data['sel_level'] = 0;
            $data['sel_address'] = "";
            $data['lot'] = $result[0]['lot'];
            $data['lat'] = $result[0]['lat'];
        }elseif($param2 == "level"){
            $result = $this->apis_model->getJsonCoursesByLevel($param1);
            $data['courses'] = json_encode($result);
            $data['results'] = $this->apis_model->getCoursesByLevel($param1);
            $data['sel_level'] = $param1;
            $data['week'] = $this->week_day;
            $data['levels'] = $this->apis_model->getLevels();
            $data['radius'] = 5;
            $data['address'] = "";
            $lang = $this->session->userdata("lang");
            $data['age_ranges'] = $this->age_ranges[$lang];
            $data['sel_age_range'] = "";
            $data['sel_level'] = 0;
            $data['sel_address'] = "";
            $data['lot'] = $result[0]['lot'];
            $data['lat'] = $result[0]['lat'];
        }

        $this->view('content/search_view', $data);
    }

    function location($location = "")
    {
        $data['menu_active'] = 'search';
        if($location == ""){
            redirect("search");
        }else{
            $locations = explode("_", $location);
            if(count($locations) != 2) {
                redirect("search");
            }

            $lat = $locations[0];
            $lot = $locations[1];
            $results = $this->apis_model->getJsonCoursesByLocation($lat, $lot);
            $data['courses'] = json_encode($results);
            $data['results'] = $results;
            $data['week'] = $this->week_day;
            $data['addresses'] = $this->apis_model->getCourseAddresses();
            $lang = $this->session->userdata("lang");
            $data['age_ranges'] = $this->age_ranges[$lang];
            $data['results'] = array();
            $data['sel_age_range'] = "";
            $data['sel_level'] = "";
            $data['sel_address'] = "";
            $data['radius'] = 5;
            $data['address'] = "";
            $data['lot'] = $lot;
            $data['lat'] = $lat;
        }

        $this->view('content/search_view', $data);
    }

    function form()
    {
        $data['menu_active'] = 'search';
        $data['courses'] = json_encode($this->apis_model->getJsonCoursesByForm());
        $data['results'] = $this->apis_model->getCoursesByForm();
        $data['levels'] = $this->apis_model->getLevels();
        $data['week'] = $this->week_day;
        $data['sel_level'] = $_POST['level'];
        $data['radius'] = $_POST['radius'];
        $data['address'] = $_POST['address'];
        $data['lot'] = $_POST['lot'];
        $data['lat'] = $_POST['lat'];
        $this->view('content/search_view', $data);
    }

    function form_custom()
    {
        $data['menu_active'] = 'search';
        $data['courses'] = json_encode($this->apis_model->getJsonCoursesByCustomForm());
        $result = $this->apis_model->getCoursesByCustomForm();
        $data['results'] = $result;
        $data['week'] = $this->week_day;
        $data['addresses'] = $this->apis_model->getCourseAddresses();
        $lang = $this->session->userdata("lang");
        $data['age_ranges'] = $this->age_ranges[$lang];
        $data['sel_age_range'] = isset($_POST['sel_age_range']) ? $_POST['sel_age_range'] : "";
        $data['sel_level'] = isset($_POST['sel_level']) ? $_POST['sel_level'] : 0;
        $data['sel_address'] = isset($_POST['sel_address']) ? $_POST['sel_address'] : "";
        $data['radius'] = 5;
        if(count($result) > 0) {
            $data['lot'] = $result[0]['lot'];
            $data['lat'] = $result[0]['lat'];
        }else {
            $data['lat'] = "59.9160302";
            $data['lot'] = "10.7361983";
        }
        
        $this->view('content/search_view', $data);
    }

    function signup($course_id = 0, $success = "")
    {
        if($course_id == 0){
            redirect("search");
        }
        $data['menu_active'] = 'search';
        $data['results'] = $this->apis_model->getCourses($course_id);
        $data['level'] = $this->apis_model->getLevel($data['results'][0]['level_id']);
        $data['terms'] = $this->apis_model->getSetting(1, $this->session->userdata('lang'));
        $data['week'] = $this->week_day;
        $data['course_id'] = $course_id;
        $data['success'] = "";
        $this->view('content/search_signup', $data);
    }
    function contact($course_id = 0, $success = "")
    {
        if($course_id == 0){
            redirect("search");
        }
        $data['menu_active'] = 'search';
        $data['results'] = $this->apis_model->getCourses($course_id);
        $data['level'] = $this->apis_model->getLevel($data['results'][0]['level_id']);
        $data['terms'] = $this->apis_model->getSetting(1, $this->session->userdata('lang'));
        $data['week'] = $this->week_day;
        $data['course_id'] = $course_id;
        $data['success'] = "";
        $this->view('content/search_contact', $data);
    }
    function form_contact($course_id = 0){

        $this->apis_model->save_order($course_id);
        $data['menu_active'] = 'search';
        $data['results'] = $this->apis_model->getCourses($course_id);
        $data['level'] = $this->apis_model->getLevel($data['results'][0]['level_id']);
        $data['terms'] = $this->apis_model->getSetting(1, $this->session->userdata('lang'));
        $data['week'] = $this->week_day;
        $data['course_id'] = $course_id;
        $data['success'] = "success";
        $this->view('content/search_contact', $data);
    }

    function form_register($course_id = 0){

        $this->apis_model->save_order($course_id);
        $data['menu_active'] = 'search';
        $data['results'] = $this->apis_model->getCourses($course_id);
        $data['level'] = $this->apis_model->getLevel($data['results'][0]['level_id']);
        $data['terms'] = $this->apis_model->getSetting(1, $this->session->userdata('lang'));
        $data['week'] = $this->week_day;
        $data['course_id'] = $course_id;
        $data['success'] = "success";
        $this->view('content/search_signup', $data);
    }


}
