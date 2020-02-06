<?php

/** @property news_model $news_model *
 */
class Admin extends Back_end
{
    private $week_day = array("0"=>"", "1"=>"Monday", "2"=>"Tuesday","3"=>"Wednesday","4"=>"Thursday","5"=>"Friday","6"=>"Saturday","7"=>"Sunday");
    private $languages = array("0"=>"en", "1"=>"da", "2"=>"se","3"=>"nr");
    private $age_ranges = array(
        "en"=>["1"=>"5 to 6 years old","2"=>"7 to 9 years old","3"=>"10 to 14 years old"],
        "da"=>["1"=>"5 to 6 years old","2"=>"7 to 9 years old","3"=>"10 to 14 years old"],
        "se"=>["1"=>"5 to 6 years old","2"=>"7 to 9 years old","3"=>"10 to 14 years old"],
        "no"=>["1"=>"5 til 6 år gammel","2"=>"7 til 9 år gammel","3"=>"10 til 14 år gammel"]
    );

    function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
    }

    // this function to handle getting all news
    function index()
    {
        redirect('admin/dashboard');
    }

    function login($err = "")
    {
        $data['err'] = $err;
        $this->view('admin/login', $data);
    }
    function login_request()
    {
        $arr = $this->admin_model->isAdmin($_REQUEST['email'], $_REQUEST['password']);
        if($arr['status']){
            $data['menu_active'] = 'dashboard';
            $data['menu_sub_active'] = 'dashboard';
            redirect('admin/dashboard');
        }else{
            $this->login($arr['message']);
        }
    }
    function forgot_password($err = "")
    {
        $data['err'] = $err;
        $this->view('admin/forgot_password', $data);
    }

    function forgot_password_request()
    {
        $arr = $this->admin_model->forgot_password($_REQUEST['email']);
        if($arr['status']){
            $this->forgot_password($arr['message']);
        }else{
            $this->forgot_password($arr['message']);
        }
    }

    function profile($err = "")
    {
        $data['err'] = "";
        $data['err_password'] = "";
        $data['user'] = $this->admin_model->getUser($_SESSION['user_id']);
        $this->view('admin/profile', $data);
    }

    function profile_update(){
        $error = $this->admin_model->change_password($_SESSION['user_id']);
        if($error == ""){
            redirect('admin/profile');
        }else{
            $data['err_password'] = $error;
            $data['user'] = $this->admin_model->getUser($_SESSION['user_id']);
            $this->view('admin/profile', $data);
        }
    }

    function logout()
    {
        $this->session->sess_destroy();
        redirect('admin/login','refresh');
    }

    function dashboard()
    {
        $data['menu_active'] = 'dashboard';
        $data['courses'] = $this->admin_model->getCourses(5);
        $this->view('admin/dashboard', $data);
    }

    function language($param1 = "", $param2 = "")
    {
        $data['err'] = "";
        switch ($param1){
            case "edit":
                $data['menu_active'] = 'language';
                $data['menu_sub_active'] = 'language';
                $data['content_en'] = $this->admin_model->getLanguage('en');
                $data['content'] = $this->admin_model->getLanguage($param2);
                $data['languages'] = $this->languages;
                $data['sel_lang'] = $param2;
                $data['sel_path'] = $this->admin_model->getPath($param2);
                $this->view('admin/language', $data);
                break;
            case "save":
                $this->admin_model->saveLanguage($param2);
                redirect("admin/language/edit/".$param2);
                break;
            default :
                $data['menu_active'] = 'language';
                $data['menu_sub_active'] = 'language';
                $data['content_en'] = $this->admin_model->getLanguage('en');
                $data['content'] = $this->admin_model->getLanguage($param2);
                $data['languages'] = $this->languages;
                $data['sel_lang'] = $param2;
                $data['sel_path'] = $this->admin_model->getPath($param2);
                $this->view('admin/language', $data);
                break;
        }

    }
    /* pages */
    function pages($param1 = "", $param2 = 1, $param3 = 'en')
    {
        $data['err'] = "";
        switch ($param1){
            case "edit":
                $data['menu_active'] = 'language';
                $data['menu_sub_active'] = 'language';
                $data['page_list'] = $this->admin_model->getPageLangs();
                $data['page'] = $this->admin_model->getPageLang($param2, $param3);
                $data['sel_page'] = $param2;
                $data['sel_lang'] = $param3;
                $this->view('admin/edit_pages', $data);
                break;
            case "save":
                $this->admin_model->savePageLang($param2);
                redirect("admin/pages/edit/".$param2."/".$param3);
                break;
            default :
                $data['menu_active'] = 'language';
                $data['menu_sub_active'] = 'language';
                $data['page_list'] = $this->admin_model->getPageLangs();
                $data['page'] = $this->admin_model->getPageLang($param2);
                $data['sel_page'] = $param2;
                $data['sel_lang'] = $param3;
                $this->view('admin/edit_pages', $data);
                break;
        }

    }
    /* level */
    function level($param1 = "", $param2 = 0, $param3 = "en")
    {
        $data['err'] = "";
        switch ($param1){
            case "view":
                $data['menu_active'] = 'levels';
                $data['menu_sub_active'] = 'level_view';
                $data['levels'] = $this->admin_model->getLevels($param3);
                $this->view('admin/level_view', $data);
                break;
            case "edit":
                $data['menu_active'] = 'levels';
                $data['menu_sub_active'] = '';
                $data['level'] = $this->admin_model->getLevel($param2,$param3);
                $data['level_en'] = $this->admin_model->getLevel($param2,"en");
                $data['levels'] = $this->admin_model->getLevels($param3);
                $data['photos'] = $this->admin_model->getPhotos($param2);
                $data['sel_lang'] = $param3;
                $this->view('admin/level_edit', $data);
                break;
            case "save":
                if($this->admin_model->saveLevel($param2, $param3)){
                    redirect('admin/level/view');
                }else{
                    $data['menu_active'] = 'levels';
                    $data['menu_sub_active'] = '';
                    $data['err'] = 'Database error';
                    $data['levels'] = $this->admin_model->getLevels($param3);
                    $data['photos'] = $this->admin_model->getPhotos($param2);
                    $data['level_en'] = $this->admin_model->getLevel($param2,"en");
                    $data['sel_lang'] = $param3;
                    redirect('admin/level_edit/'.$param2.'/'.$param3);
                }
                break;
            case "delete":
                if($this->admin_model->deleteLevel($param2)){
                    redirect('admin/level/view');
                }else{
                    $data['menu_active'] = 'levels';
                    $data['menu_sub_active'] = '';
                    $data['err'] = 'Database error';
                    $data['levels'] = $this->admin_model->getLevels();
                    $data['features'] = $this->admin_model->getFeatures();
                    $data['photos'] = $this->admin_model->getPhotos($param2);
                    $data['level_en'] = $this->admin_model->getLevel($param2,"en");
                    $data['sel_lang'] = $param3;
                    $this->view('admin/level_edit', $data);
                }
                break;
            default :
                $data['menu_active'] = 'levels';
                $data['menu_sub_active'] = 'level_view';
                $data['levels'] = $this->admin_model->getLevels($param3);
                $this->view('admin/level_view', $data);
                break;
        }

    }
    /* faq */
    function faq($param1 = "", $param2 = 0, $param3 = "en")
    {
        $data['err'] = "";
        switch ($param1){
            case "view":
                $data['menu_active'] = 'faq';
                $data['menu_sub_active'] = 'faq_view';
                $data['faqs'] = $this->admin_model->getFaqs();
                $this->view('admin/faq_view', $data);
                break;
            case "edit":
                $data['menu_active'] = 'Faqs';
                $data['menu_sub_active'] = '';
                $data['sel_lang'] = $param3;
                $data['faq'] = $this->admin_model->getFaq($param2, $param3);
                $this->view('admin/faq_edit', $data);
                break;
            case "save":
                if($this->admin_model->saveFaq($param2, $param3)){
                    redirect('admin/faq/view');
                }else{
                    $data['menu_active'] = 'Faqs';
                    $data['menu_sub_active'] = '';
                    $data['err'] = 'Database error';
                    $data['sel_lang'] = $param3;
                    $data['faq'] = $this->admin_model->getFaq($param2, $param3);
                    $this->view('admin/faq_edit', $data);
                }
                break;
            case "delete":
                if($this->admin_model->deleteFaq($param2)){
                    redirect('admin/faq/view');
                }else{
                    $data['menu_active'] = 'levels';
                    $data['menu_sub_active'] = '';
                    $data['err'] = 'Database error';
                    $data['levels'] = $this->admin_model->getLevels();
                    $data['features'] = $this->admin_model->getFeatures();
                    $data['photos'] = $this->admin_model->getPhotos($param2);
                    $this->view('admin/level_edit', $data);
                }
                break;
            default :
                $data['menu_active'] = 'faq';
                $data['menu_sub_active'] = 'faq_view';
                $data['faqs'] = $this->admin_model->getFaqs();
                $this->view('admin/faq_view', $data);
                break;
        }

    }
    /* home */
    function home($param1 = "", $param2 = 0, $param3 = "en")
    {
        $data['err'] = "";
        switch ($param1){
            case "edit":
                $data['menu_active'] = 'home';
                $data['menu_sub_active'] = '';
                $data['sel_lang'] = $param3;
                $data['videos'] = $this->admin_model->getHomeVideo($param2, $param3);
                $data['pictures'] = $this->admin_model->getHomePicture($param2, $param3);
                $this->view('admin/home_edit', $data);
                break;
            case "save":
                if($this->admin_model->saveFaq($param2, $param3)){
                    redirect('admin/faq/view');
                }else{
                    $data['menu_active'] = 'Faqs';
                    $data['menu_sub_active'] = '';
                    $data['err'] = 'Database error';
                    $data['sel_lang'] = $param3;
                    $data['faq'] = $this->admin_model->getFaq($param2, $param3);
                    $this->view('admin/faq_edit', $data);
                }
                break;
            case "delete":
                if($this->admin_model->deleteFaq($param2)){
                    redirect('admin/faq/view');
                }else{
                    $data['menu_active'] = 'levels';
                    $data['menu_sub_active'] = '';
                    $data['err'] = 'Database error';
                    $data['levels'] = $this->admin_model->getLevels();
                    $data['features'] = $this->admin_model->getFeatures();
                    $data['photos'] = $this->admin_model->getPhotos($param2);
                    $this->view('admin/level_edit', $data);
                }
                break;
            default :
                $data['menu_active'] = 'faq';
                $data['menu_sub_active'] = 'faq_view';
                $data['faqs'] = $this->admin_model->getFaqs();
                $this->view('admin/faq_view', $data);
                break;
        }

    }
    /* Order */
    function order($param1 = "", $param2 = 0, $param3 = "en")
    {
        $data['err'] = "";
        switch ($param1){
            case "view":
                $data['menu_active'] = 'order';
                $data['orders'] = $this->admin_model->getOrders();
                $this->view('admin/order_view', $data);
                break;
            case "edit":
                $data['menu_active'] = 'order';
                $data['order'] = $this->admin_model->getOrder($param2);
                $data['levels'] = $this->admin_model->getLevels("en");
                $this->view('admin/order_edit', $data);
                break;
            case "save":
                if($this->admin_model->saveOrder($param2)){
                    redirect('admin/order/view');
                }else{
                    $data['menu_active'] = 'order';
                    $data['menu_sub_active'] = '';
                    $data['err'] = 'Database error';
                    $data['sel_lang'] = $param3;
                    $data['order'] = $this->admin_model->getOrder($param2, $param3);
                    $this->view('admin/faq_edit', $data);
                }
                break;
            case "delete":
                if($this->admin_model->deleteOrder($param2)){
                    redirect('admin/order/view');
                }else{
                    redirect('admin/order/view');
                }
                break;
            default :
                $data['menu_active'] = 'order';
                $data['orders'] = $this->admin_model->getOrders();
                $this->view('admin/order_view', $data);
                break;
        }

    }
    /* Setting */
    function setting($param1 = "", $param2 = 0, $param3 = "en")
    {
        $data['err'] = "";
        switch ($param1){
            case "view":
                $data['menu_active'] = 'setting';
                $data['menu_sub_active'] = 'setting_view';
                $data['result'] = $this->admin_model->getSettings();
                $this->view('admin/setting_view', $data);
                break;
            case "edit":
                $data['menu_active'] = 'settings';
                $data['menu_sub_active'] = '';
                $data['sel_lang'] = $param3;
                $data['result'] = $this->admin_model->getSetting($param2, $param3);
                $this->view('admin/setting_edit', $data);
                break;
            case "save":
                if($this->admin_model->saveSetting($param2, $param3)){
                    redirect('admin/setting/edit/1');
                }else{
                    $data['menu_active'] = 'settings';
                    $data['menu_sub_active'] = '';
                    $data['err'] = 'Database error';
                    $data['sel_lang'] = $param3;
                    $data['result'] = $this->admin_model->getSetting($param2, $param3);
                    $this->view('admin/setting_edit', $data);
                }
                break;
            case "delete":
                if($this->admin_model->deleteSetting($param2)){
                    redirect('admin/setting/edit/1');
                }else{
                    $data['menu_active'] = 'levels';
                    $data['menu_sub_active'] = '';
                    $data['err'] = 'Database error';
                    $data['sel_lang'] = $param3;
                    $data['result'] = $this->admin_model->getSetting($param2, $param3);
                    $this->view('admin/setting_edit', $data);
                }
                break;
            default :
                $data['menu_active'] = 'setting';
                $data['menu_sub_active'] = 'setting_view';
                $data['sel_lang'] = $param3;
                $data['result'] = $this->admin_model->getSetting($param2, $param3);
                $this->view('admin/setting_edit', $data);
                break;
        }

    }

    function program1($param1 = "", $param2 = 0)
    {
        $data['err'] = "";
        switch ($param1){
            case "view":
                $data['menu_active'] = 'programs';
                $data['menu_sub_active'] = 'program_view';
                $data['programs'] = $this->admin_model->getPrograms();
                $this->view('admin/program_view', $data);
                break;
            case "edit":
                $data['menu_active'] = 'programs';
                $data['menu_sub_active'] = '';
                $data['program'] = $this->admin_model->getProgram($param2);
                $data['levels'] = $this->admin_model->getLevels();
                $this->view('admin/program_edit', $data);
                break;
            case "save":
                if($this->admin_model->saveProgram($param2)){
                    redirect('admin/program/view');
                }else{
                    $data['menu_active'] = 'programs';
                    $data['menu_sub_active'] = '';
                    $data['err'] = 'Database error';
                    $data['programs'] = $this->admin_model->getPrograms();
                    $data['levels'] = $this->admin_model->getLevels();
                    $this->view('admin/program_edit'.$param2, $data);
                }
                break;
            case "delete":
                if($this->admin_model->deleteProgram($param2)){
                    redirect('admin/program/view');
                }else{
                    $data['menu_active'] = 'programs';
                    $data['menu_sub_active'] = '';
                    $data['err'] = 'Database error';
                    $data['programs'] = $this->admin_model->getPrograms();
                    $data['levels'] = $this->admin_model->getLevels();
                    $this->view('admin/program_edit', $data);
                }
                break;
            default :
                $data['menu_active'] = 'programs';
                $data['menu_sub_active'] = 'program_view';
                $data['programs'] = $this->admin_model->getPrograms();
                $this->view('admin/program_view', $data);
                break;
        }

    }
    function program($param1 = "", $param2 = 0, $param3 = "en")
    {
        $data['err'] = "";
        switch ($param1){
            case "view":
                $data['programs'] = $this->admin_model->getPrograms('en');
                $this->view('admin/program_view', $data);
                break;
            case "edit":
                $data['menu_active'] = 'courses';
                $data['menu_sub_active'] = '';
                $data['program'] = $this->admin_model->getProgram($param2, $param3);
                $data['program_en'] = $this->admin_model->getProgram($param2, 'en');
                $data['levels'] = $this->admin_model->getLevels('en');

                $data['sel_lang'] = $param3;
                $this->view('admin/program_edit', $data);
                break;
            case "save":
                if($this->admin_model->saveProgram($param2, $param3)){
                    redirect('admin/program/view');
                }else{
                    $data['menu_active'] = 'programs';
                    $data['menu_sub_active'] = '';
                    $data['err'] = 'Database error';
                    $data['program'] = $this->admin_model->getProgram($param2, $param3);
                    $data['levels'] = $this->admin_model->getLevels('en');
                    $this->view('admin/program_edit', $data);
                }
                break;
            case "delete":
                if($this->admin_model->deleteProgram($param2, $param3)){
                    redirect('admin/program/view');
                }else{
                    $data['menu_active'] = 'programs';
                    $data['menu_sub_active'] = '';
                    $data['err'] = 'Database error';
                    $data['program'] = $this->admin_model->getProgram($param2, $param3);
                    $data['levels'] = $this->admin_model->getLevels('en');
                    $this->view('admin/program_edit', $data);
                }
                break;
            default :
                $data['programs'] = $this->admin_model->getPrograms('en');
                $this->view('admin/program_view', $data);
                break;
        }

    }
    /* course */
    function course($param1 = "", $param2 = 0, $param3 = "en")
    {
        $data['err'] = "";
        switch ($param1){
            case "view":
                $data['menu_active'] = 'courses';
                $data['menu_sub_active'] = 'course_view';
                $data['courses'] = $this->admin_model->getCourses();
                $data['week'] = $this->week_day;
                $this->view('admin/course_view', $data);
                break;
            case "edit":
                $data['menu_active'] = 'courses';
                $data['menu_sub_active'] = '';
                $data['age_ranges'] = $this->age_ranges[$param3];
                $data['en_age_ranges'] = $this->age_ranges['en'];
                $data['course'] = $this->admin_model->getCourse($param2, $param3);
                $data['course_en'] = $this->admin_model->getCourse($param2, "en");
                $data['levels'] = $this->admin_model->getLevels("en");
                $data['sel_lang'] = $param3;
                $data['week'] = $this->week_day;
                $this->view('admin/course_edit', $data);
                break;
            case "sort_up":
                $this->admin_model->changeSort("up", $param2);
                redirect('admin/course/view');
                break;
            case "sort_down":
                $this->admin_model->changeSort("down", $param2);
                redirect('admin/course/view');
                break;
            case "save":
                if($this->admin_model->saveCourse($param2, $param3)){
                    redirect('admin/course/view');
                }else{
                    $data['menu_active'] = 'courses';
                    $data['menu_sub_active'] = '';
                    $data['err'] = 'Database error';
                    $data['course'] = $this->admin_model->getCourse($param2, $param3);
                    $data['course_en'] = $this->admin_model->getCourse($param2, "en");
                    $data['levels'] = $this->admin_model->getLevels("en");
                    $data['sel_lang'] = $param3;
                    $data['week'] = $this->week_day;
                    $this->view('admin/course_edit', $data);
                }
                break;
            case "delete":
                if($this->admin_model->deletecourse($param2)){
                    redirect('admin/course/view');
                }else{
                    $data['menu_active'] = 'courses';
                    $data['menu_sub_active'] = '';
                    $data['err'] = 'Database error';
                    $data['course'] = $this->admin_model->getCourse($param2, $param3);
                    $data['course_en'] = $this->admin_model->getCourse($param2, "en");
                    $data['levels'] = $this->admin_model->getLevels("en");
                    $data['sel_lang'] = $param3;
                    $data['week'] = $this->week_day;
                    $this->view('admin/course_edit', $data);
                }
                break;
            default :
                $data['menu_active'] = 'courses';
                $data['menu_sub_active'] = 'course_view';
                $data['courses'] = $this->admin_model->getCourses();
                $data['week'] = $this->week_day;
                $this->view('admin/course_view', $data);
                break;
        }

    }

    function photo($param1 = "", $param2 = 0, $param3 = 0)
    {
        $data['err'] = "";
        switch ($param1){
            case "upload":
                $data['levels'] = $this->admin_model->uploadPhoto($param2);
                redirect("admin/level/edit/$param2");
                break;
            case "delete":
                if($this->admin_model->deletePhoto($param2)){
                    redirect("admin/level/edit/$param3");
                }else{
                    $data['menu_active'] = 'levels';
                    $data['menu_sub_active'] = '';
                    $data['level'] = $this->admin_model->getLevel($param2);
                    $data['levels'] = $this->admin_model->getLevels();
                    $data['features'] = $this->admin_model->getFeatures();
                    $data['photos'] = $this->admin_model->getPhotos($param2);
                    $this->view('admin/level_edit', $data);
                }
                break;
            default :
                $data['menu_active'] = 'courses';
                $data['menu_sub_active'] = 'course_view';
                $data['course'] = $this->admin_model->getCourse($param2);
                $data['levels'] = $this->admin_model->getLevels();
                $data['photos'] = $this->admin_model->getPhotos($param2);
                $this->view('admin/course_edit', $data);
                break;
        }

    }
    function picture($param1 = "", $param2 = 0)
    {
        $data['err'] = "";
        switch ($param1){
            case "upload":
                $data['levels'] = $this->admin_model->uploadPicture(2);
                redirect("admin/home/edit");
                break;
            case "upload_video":
                $data['levels'] = $this->admin_model->uploadVideo(1);
                redirect("admin/home/edit");
                break;
            case "delete":
                if($this->admin_model->deletePicture($param2)){
                    redirect("admin/home/edit");
                }else{
                    redirect("admin/home/edit");
                }
                break;
            default :
                redirect("admin/home/edit");
                break;
        }

    }

    function contact($param1 = "", $param2 = 0, $param3 = "en")
    {
        $data['err'] = "";
        switch ($param1){
            case "delete":
                if($this->admin_model->deleteContact($param2)){
                    redirect('admin/contact/view');
                }else{
                    redirect('admin/contact/view');
                }
                break;
            default :
                $data['menu_active'] = 'contact';
                $data['menu_sub_active'] = 'contact';
                $data['contacts'] = $this->admin_model->getContacts();
                $this->view('admin/contacts', $data);
                break;
        }

    }
    /* User */
    function user($param1 = "", $param2 = 0)
    {
        $data['err'] = "";
        $data['err_password'] = "";
        switch ($param1){
            case "view":
                $data['menu_active'] = 'user';
                $data['users'] = $this->admin_model->getUsers();
                $this->view('admin/user_view', $data);
                break;
            case "edit":
                $data['menu_active'] = 'user';
                $data['user'] = $this->admin_model->getUser($param2);
                $this->view('admin/user_edit', $data);
                break;
            case "save":
                if($this->admin_model->saveUser($param2)){
                    redirect('admin/user/view');
                }else{
                    $data['menu_active'] = 'user';
                    $data['menu_sub_active'] = '';
                    $data['err'] = 'Database error';
                    $data['user'] = $this->admin_model->getUser($param2);
                    $this->view('admin/user_edit', $data);
                }
                break;
            case "change_password":
                $error = $this->admin_model->change_password($param2);
                if($error == ""){
                    redirect('admin/user/view');
                }else{
                    $data['menu_active'] = 'user';
                    $data['menu_sub_active'] = '';
                    $data['err_password'] = $error;
                    $data['user'] = $this->admin_model->getUser($param2);
                    $this->view('admin/user_edit', $data);
                }
                break;
            case "delete":
                if($this->admin_model->deleteUser($param2)){
                    redirect('admin/user/view');
                }else{
                    redirect('admin/user/view');
                }
                break;
            default :
                $data['menu_active'] = 'user';
                $data['users'] = $this->admin_model->getUsers();
                $this->view('admin/user_view', $data);
                break;
        }

    }


     /*******************************************************************/
    /**************************** UCMAS APP ****************************/
    /*******************************************************************/
    /* lessons */
    function lesson($param1 = "", $param2 = 0, $param3 = "en")
    {
        $data['err'] = "";
        switch ($param1){
            case "view":
                $data['menu_active'] = 'lessons';
                $data['menu_sub_active'] = 'lesson_view';
                $data['levels'] = $this->admin_model->getLevels($param3);
                $data['lessons'] = $this->admin_model->getLessons();
                $this->view('admin/lesson_view', $data);
                break;
            case "edit":
                $data['menu_active'] = 'lessons';
                $data['menu_sub_active'] = '';
                $data['levels'] = $this->admin_model->getLevels($param3);
                $data['lesson'] = $this->admin_model->getLesson($param2);
                $this->view('admin/lesson_edit', $data);
                break;
            case "save":
                if($this->admin_model->saveLesson($param2)){
                    redirect('admin/lesson/view');
                }else{
                    $data['menu_active'] = 'lessons';
                    $data['menu_sub_active'] = '';
                    $data['err'] = 'Database error';
                    $data['levels'] = $this->admin_model->getLevels($param3);
                    $data['lesson'] = $this->admin_model->getLesson($param2);
                    $this->view('admin/lesson_edit', $data);
                }
                break;
            case "delete":
                if($this->admin_model->deletelesson($param2)){
                    redirect('admin/lesson/view');
                }else{
                    $data['menu_active'] = 'levels';
                    $data['menu_sub_active'] = '';
                    $data['err'] = 'Database error';
                    $data['levels'] = $this->admin_model->getLevels($param3);
                    $data['lesson'] = $this->admin_model->getLesson($param2);
                    $this->view('admin/level_edit', $data);
                }
                break;
            default :
                $data['menu_active'] = 'lessons';
                $data['menu_sub_active'] = 'lessons_view';
                $data['levels'] = $this->admin_model->getLevels($param3);
                $data['lessons'] = $this->admin_model->getLessons();
                $this->view('admin/lesson_view', $data);
                break;
        }

    }
    /* exercise_types */
    function exercise_type($param1 = "", $param2 = 0, $param3 = "en")
    {
        $data['err'] = "";
        switch ($param1){
            case "view":
                $data['menu_active'] = 'exercise_types';
                $data['menu_sub_active'] = 'exercise_type_view';
                $data['exercise_types'] = $this->admin_model->getExercise_types();
                $this->view('admin/exercise_type_view', $data);
                break;
            case "edit":
                $data['menu_active'] = 'exercise_types';
                $data['menu_sub_active'] = '';
                $data['exercise_type'] = $this->admin_model->getExercise_type($param2);
                $this->view('admin/exercise_type_edit', $data);
                break;
            case "save":
                if($this->admin_model->saveExercise_type($param2)){
                    redirect('admin/exercise_type/view');
                }else{
                    $data['menu_active'] = 'exercise_types';
                    $data['menu_sub_active'] = '';
                    $data['err'] = 'Database error';
                    $data['exercise_type'] = $this->admin_model->getExercise_type($param2);
                    $this->view('admin/exercise_type_edit', $data);
                }
                break;
            case "delete":
                if($this->admin_model->deleteexercise_type($param2)){
                    redirect('admin/exercise_type/view');
                }else{
                    $data['menu_active'] = 'levels';
                    $data['menu_sub_active'] = '';
                    $data['err'] = 'Database error';
                    $data['exercise_type'] = $this->admin_model->getExercise_type($param2);
                    $this->view('admin/level_edit', $data);
                }
                break;
            default :
                $data['menu_active'] = 'exercise_types';
                $data['menu_sub_active'] = 'exercise_types_view';
                $data['exercise_types'] = $this->admin_model->getExercise_types();
                $this->view('admin/exercise_type_view', $data);
                break;
        }

    }
    /* images */
    function image($param1 = "", $param2 = 0, $param3 = "en")
    {
        $data['err'] = "";
        switch ($param1){
            case "view":
                $data['menu_active'] = 'images';
                $data['menu_sub_active'] = 'image_view';
                $data['images'] = $this->admin_model->getImages();
                $this->view('admin/image_view', $data);
                break;
            case "new":
                $data['menu_active'] = 'images';
                $data['menu_sub_active'] = '';
                $data['image'] = $this->admin_model->getImage($param2);
                $data['ex_tags'] = $this->admin_model->getTags();
                $this->view('admin/image_new', $data);
                break;
            case "edit":
                $data['menu_active'] = 'images';
                $data['menu_sub_active'] = '';
                $data['image'] = $this->admin_model->getImage($param2);
                $data['ex_tags'] = $this->admin_model->getTags();
                $this->view('admin/image_edit', $data);
                break;
            case "save":
                if($this->admin_model->saveimage($param2)){
                    redirect('admin/image/view');
                }else{
                    $data['menu_active'] = 'images';
                    $data['menu_sub_active'] = '';
                    $data['err'] = 'Database error';
                    $data['image'] = $this->admin_model->getImage($param2);
                    $data['tags'] = $this->admin_model->getTags();
                    $this->view('admin/image_edit', $data);
                }
                break;
            case "delete":
                if($this->admin_model->deleteimage($param2)){
                    redirect('admin/image/view');
                }else{
                    $data['menu_active'] = 'levels';
                    $data['menu_sub_active'] = '';
                    $data['err'] = 'Database error';
                    $data['image'] = $this->admin_model->getImage($param2);
                    $this->view('admin/level_edit', $data);
                }
                break;
            default :
                $data['menu_active'] = 'images';
                $data['menu_sub_active'] = 'images_view';
                $data['images'] = $this->admin_model->getImages();
                $this->view('admin/image_view', $data);
                break;
        }

    }
    /* exercises */
    function exercise($param1 = "", $level_id = 0, $lesson_id = 0, $exercise_id = 0){
        $data['err'] = "";
        switch ($param1){
            case "view":
                $data['menu_active'] = 'exercises';
                $data['menu_sub_active'] = 'exercise_view';
                $data['tagIdByName'] = $this->admin_model->getTagIdByName();
                $data['levels'] = $this->admin_model->getLevels('en');
                $lessons = [];
                if($level_id > 0) $lessons = $this->admin_model->getLessons($level_id);
                $data['lessons'] = $lessons;
                $exercises = [];
                if($level_id > 0 && $lesson_id > 0) $exercises = $this->admin_model->getExercises($level_id, $lesson_id);
                $data['exercises'] = $exercises;
                $data['level_id'] = $level_id;
                $data['lesson_id'] = $lesson_id;
                $data['exercise_id'] = $exercise_id;
                $this->view('admin/exercise_view', $data);
                break;
            case "edit":
                $data['menu_active'] = 'exercises';
                $data['menu_sub_active'] = '';
                $data['tags'] = $this->admin_model->getTags();
                $data['exercise_types'] = $this->admin_model->getExercise_types();
                $data['exercise'] = $this->admin_model->getExercise($exercise_id);
                $data['level_id'] = $level_id;
                $data['lesson_id'] = $lesson_id;
                $data['exercise_id'] = $exercise_id;
                $this->view('admin/exercise_edit', $data);
                break;
            case "save":
                if($this->admin_model->saveExercise($level_id, $lesson_id, $exercise_id)){
                    redirect("admin/exercise/view/$level_id/$lesson_id");
                } else {
                    $data['menu_active'] = 'exercises';
                    $data['menu_sub_active'] = '';
                    $data['err'] = 'Database error';
                    $data['tags'] = $this->admin_model->getTags();
                    $data['exercise_types'] = $this->admin_model->getExercise_types();
                    $data['exercise'] = $this->admin_model->getExercise($exercise_id);
                    $data['level_id'] = $level_id;
                    $data['lesson_id'] = $lesson_id;
                    $data['exercise_id'] = $exercise_id;
                    $this->view('admin/exercise_edit', $data);
                }
                break;
            case "sort_up":
                $this->admin_model->changeExerciseSort("up", $exercise_id);
                redirect("admin/exercise/view/$level_id/$lesson_id");
                break;
            case "sort_down":
                $this->admin_model->changeExerciseSort("down", $exercise_id);
                redirect("admin/exercise/view/$level_id/$lesson_id");
                break;
            case "delete":
                if($this->admin_model->deleteExercise($exercise_id)){
                    redirect("admin/exercise/view/$level_id/$lesson_id");
                }else{
                    $data['menu_active'] = 'levels';
                    $data['menu_sub_active'] = '';
                    $data['err'] = 'Database error';
                    $data['levels'] = $this->admin_model->getLevels('en');
                    $lessons = [];
                    if($level_id > 0) $lessons = $this->admin_model->getLessons($level_id);
                    $data['lessons'] = $lessons;
                    $exercises = [];
                    if($level_id > 0 && $lesson_id > 0) $exercises = $this->admin_model->getExercises($lesson_id);
                    $data['exercises'] = $exercises;
                    $data['level_id'] = $level_id;
                    $data['lesson_id'] = $lesson_id;
                    $data['exercise_id'] = $exercise_id;
                    $this->view('admin/exercise_view', $data);
                }
                break;
            case "preview":
                $data['tags'] = $this->admin_model->getTags();
                $data['exercise_types'] = $this->admin_model->getExercise_types();
                $data['exercise'] = $this->admin_model->getExercise($exercise_id);
                $data['level_id'] = $level_id;
                $data['lesson_id'] = $lesson_id;
                $data['exercise_id'] = $exercise_id;
                $this->view('admin/exercise_preview', $data);
                break;
            default :
                redirect('admin/exercise/view');
                break;
        }

    }
    /* exerciseByTag */
    function exerciseByTag($param1 = "", $tag_id = 0)
    {
        $data['err'] = "";
        switch ($param1){
            case "view":
                $data['menu_active'] = 'exerciseByTag';
                $data['menu_sub_active'] = '';
                $data['tag_id'] = $tag_id;
                $data['tagIdByName'] = $this->admin_model->getTagIdByName();
                $data['tag_name'] = $this->admin_model->getTag($tag_id);
                $data['tags'] = $this->admin_model->getTags();
                $data['exercises'] = $this->admin_model->getExerciseByTag($tag_id);
                $this->view('admin/ex_by_tag_view', $data);
                break;
        }

    }
    /* teachers */
    function teacher($param1 = "", $param2 = 0, $param3 = "en"){
        $data['err'] = "";
        switch ($param1){
            case "view":
                $data['menu_active'] = 'teachers';
                $data['menu_sub_active'] = 'teacher_view';
                $data['levels'] = $this->admin_model->getLevels($param3);
                $data['teachers'] = $this->admin_model->getTeachers();
                $this->view('admin/teacher_view', $data);
                break;
            case "edit":
                $data['menu_active'] = 'teachers';
                $data['menu_sub_active'] = '';
                $data['levels'] = $this->admin_model->getLevels($param3);
                $data['teacher'] = $this->admin_model->getTeacher($param2);
                $this->view('admin/teacher_edit', $data);
                break;
            case "save":
                if($this->admin_model->saveTeacher($param2)){
                    redirect('admin/teacher/view');
                }else{
                    $data['menu_active'] = 'teachers';
                    $data['menu_sub_active'] = '';
                    $data['err'] = 'Database error';
                    $data['levels'] = $this->admin_model->getLevels($param3);
                    $data['teacher'] = $this->admin_model->getTeacher($param2);
                    $this->view('admin/teacher_edit', $data);
                }
                break;
            case "delete":
                if($this->admin_model->deleteTeacher($param2)){
                    redirect('admin/teacher/view');
                }else{
                    $data['menu_active'] = 'levels';
                    $data['menu_sub_active'] = '';
                    $data['err'] = 'Database error';
                    $data['levels'] = $this->admin_model->getLevels($param3);
                    $data['teacher'] = $this->admin_model->getTeacher($param2);
                    $this->view('admin/level_edit', $data);
                }
                break;
            default :
                $data['menu_active'] = 'teachers';
                $data['menu_sub_active'] = 'teachers_view';
                $data['levels'] = $this->admin_model->getLevels($param3);
                $data['teachers'] = $this->admin_model->getTeachers();
                $this->view('admin/teacher_view', $data);
                break;
        }

    }
    /* classrooms */
    function classroom($param1 = "", $level_id = 0, $course_id = 0, $classroom_id = 0){
        $data['err'] = "";
        switch ($param1){
            case "view":
                $data['menu_active'] = 'classrooms';
                $data['menu_sub_active'] = 'classroom_view';
                $data['classrooms'] = $this->admin_model->getClassrooms();
                $this->view('admin/classroom_view', $data);
                break;
            case "edit":
                $data['menu_active'] = 'classrooms';
                $data['menu_sub_active'] = '';
                $data['levels'] = $this->admin_model->getLevels('en');
                $data['courses'] = $this->admin_model->getCoursesByLevelID($level_id);
                $data['teacher'] = $this->admin_model->getClassroomTeacher($classroom_id);
                $data['json_teacher'] = json_encode($data['teacher']);
                $data['students'] = $this->admin_model->getClassroomStudents($classroom_id);
                $data['json_students'] = json_encode($data['students']);
                $data['su_teachers'] = $this->admin_model->getSuggestionTeachers($level_id, $data['teacher']);
                $data['su_students'] = $this->admin_model->getSuggestionStudents($level_id, $data['students']);
                $data['classroom_id'] = $classroom_id != 0 ? $classroom_id : $this->admin_model->getNewClassroomID($classroom_id);
                $data['level_id'] = $level_id;
                $data['course_id'] = $course_id;
                $this->view('admin/classroom_edit', $data);
                break;
            case "save":
                if($this->admin_model->saveClassroom($classroom_id)){
                    redirect('admin/classroom/view');
                }else{
                    $data['menu_active'] = 'classrooms';
                    $data['menu_sub_active'] = '';
                    $data['err'] = 'Database error';
                    $data['levels'] = $this->admin_model->getLevels('en');
                    $data['courses'] = $this->admin_model->getCoursesByLevelID($level_id);
                    $data['teacher'] = $this->admin_model->getClassroomTeacher($classroom_id);
                    $data['json_teacher'] = json_encode($data['teacher']);
                    $data['students'] = $this->admin_model->getClassroomStudents($classroom_id);
                    $data['json_students'] = json_encode($data['students']);
                    $data['su_teachers'] = $this->admin_model->getSuggestionTeachers($level_id, $data['teacher']);
                    $data['su_students'] = $this->admin_model->getSuggestionStudents($level_id, $data['students']);
                    $data['classroom_id'] = $classroom_id != 0 ? $classroom_id : $this->admin_model->getNewClassroomID($classroom_id);
                    $data['level_id'] = $level_id;
                    $data['course_id'] = $course_id;
                    $this->view('admin/classroom_edit', $data);
                }
                break;
            case "delete":
                if($this->admin_model->deleteClassroom($param2)){
                    redirect('admin/classroom/view');
                }else{
                    $data['levels'] = $this->admin_model->getLevels('en');
                    $data['courses'] = $this->admin_model->getCoursesByLevelID($level_id);
                    $data['teacher'] = $this->admin_model->getClassroomTeacher($classroom_id);
                    $data['json_teacher'] = json_encode($data['teacher']);
                    $data['students'] = $this->admin_model->getClassroomStudents($classroom_id);
                    $data['json_students'] = json_encode($data['students']);
                    $data['su_teachers'] = $this->admin_model->getSuggestionTeachers($level_id, $data['teacher']);
                    $data['su_students'] = $this->admin_model->getSuggestionStudents($level_id, $data['students']);
                    $data['classroom_id'] = $classroom_id != 0 ? $classroom_id : $this->admin_model->getNewClassroomID($classroom_id);
                    $data['level_id'] = $level_id;
                    $data['course_id'] = $course_id;
                    $this->view('admin/level_edit', $data);
                }
                break;
            default :
                $data['menu_active'] = 'classrooms';
                $data['menu_sub_active'] = 'classroom_view';
                $data['classrooms'] = $this->admin_model->getClassrooms();
                $this->view('admin/classroom_view', $data);
                $this->view('admin/classroom_view', $data);
                break;
        }

    }
    

}
