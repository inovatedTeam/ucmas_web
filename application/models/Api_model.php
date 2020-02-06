<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Api_model extends CI_Model
{

    public  $lang = "en";
    public  $langs = array("en", "no", "se", "da");
    private $save_photo = "./assets/uploads/";

    function __construct() {
        parent::__construct();
        $this->load->library('functions');
    }

    function generate_token($length = 8) {
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        //length:36
        $final_rand = '';
        for ($i = 0; $i < $length; $i++) {
            $final_rand .= $chars[rand(0, strlen($chars) - 1)];
        }
        return $final_rand;
    }
    function generate_code($length = 6) {
        $chars = "1234567890";
        //length:36
        $final_rand = '';
        for ($i = 0; $i < $length; $i++) {
            $final_rand .= $chars[rand(0, strlen($chars) - 1)];
        }
        return $final_rand;
    }
    function make_list($arr, $key1 = "", $key2 = ""){
        $result = array();
        for($i=0; $i < count($arr); $i++){
            $result[$arr[$key1]] = $arr[$key2];
        }
        print_r($result);exit;
        return $result;
    }

    /************************************* app function *****************************************/
    function register_email($email, $role) {
        $sql = "SELECT * FROM orders WHERE email = ? LIMIT 1";
        if($role == "teacher") {
            $sql = "SELECT * FROM _teachers WHERE email = ? LIMIT 1";
        }
        $query = $this->db->query( $sql, [$email] );
        if($query->num_rows() > 0){
            $result = $query->row_array();
            $verification_code = $this->generate_code(6);
            $access_token = $this->generate_token(32);
            // register access token into device table
            $query_register = $this->db->query( "INSERT INTO _devices(email, device_type, push_token, access_token, verify_code) VALUES(?, '', '', ?, ?)", 
            [$email, $access_token, $verification_code] );
            if($this->functions->send_verification_email($email, $verification_code)){
                // verification email sent
                $result = ['success' => 'OK', 'access_token' => $access_token];
            }else{
                $result = ['success' => 'fail', 'message' => "Error sending verification code."];
            }
        }else{
            $result = ['success' => 'fail', 'message' => "email not exist"];  
        }
        return $result;
        
    }
    function resend_verify_code($access_token) {
        $query = $this->db->query( "SELECT * FROM _devices WHERE access_token = ? LIMIT 1", [$access_token] );
        if($query->num_rows() > 0){
            $result = $query->row_array();
            $verification_code = $this->generate_code(6);
            $query_update = $this->db->query( "UPDATE _devices SET verify_code = ? WHERE access_token = ?", 
            [$verification_code, $access_token] );
            if($this->functions->send_verification_email($result['email'], $verification_code)){
                // verification email sent
                $result = ['success' => 'OK'];
            }else{
                $result = ['success' => 'fail', 'message' => "Error sending verification code."];
            }
        }else{
            $result = ['success' => 'fail', 'message' => "email not exist"]; 
        }
        return $result;
    }
    function check_verify_code($access_token, $verification_code, $device_type, $push_token){
        $query = $this->db->query( "SELECT * FROM _devices WHERE access_token = ? AND verify_code = ? LIMIT 1", [$access_token, $verification_code] );
        if($query->num_rows() > 0){
            $result = $query->row_array();
            $query_update = $this->db->query( "UPDATE _devices SET device_type = ?, push_token = ? WHERE access_token = ?", 
            [$device_type, $push_token, $access_token] );
            $query = $this->db->query( "SELECT a.*, b.level_name FROM _classrooms as a LEFT JOIN levels_en b on a.level_id = b.id WHERE a.email = ? ", [$result['email']] );
            if($query->num_rows() > 0){
                $children = $query->result_array();
                // selected children = $results[0]
                $lessons = $this->getLessonsByLevelID($children[0]['level_id']);
                $data = ["children"=> $children, "lessons"=>$lessons];
                $result = ['success' => 'OK', "child"=> $children[0], "children"=> $children, "lessons"=>$lessons];    
            }else{
                $result = ['success' => 'fail', 'message' => "verification code is right. You didn't added any classroom. Please contact to admin."];    
            }
        }else{
            $result = ['success' => 'fail', 'message' => "verification code is wrong. Please input right code."];
        }
        return $result;
    }

    function get_classroom_user($user_id){
        $result = [];
        $query = $this->db->query( "SELECT a.*, b.level_name FROM _classrooms as a LEFT JOIN levels_en b on a.level_id = b.id WHERE a.id = ? LIMIT 1", [$user_id] );
        if($query->num_rows() > 0){
            $result = $query->row_array();
        }
        return $result;
    }
    function check_token($user_id){
        $result = [];
        $email = $this->functions->authentication();
        $query = $this->db->query( "SELECT a.*, b.level_name FROM _classrooms as a LEFT JOIN levels_en b on a.level_id = b.id WHERE a.email = ? ", [$email] );
        if($query->num_rows() > 0){
            $child = $this->get_classroom_user($user_id);
            $children = $query->result_array();
            // selected children = $results[0]
            $lessons = $this->getLessonsByLevelID($child['level_id']);
            $data = ["children"=> $children, "lessons"=>$lessons];
            $result = ['success' => 'OK', "child"=> $child, "children"=> $children, "lessons"=>$lessons];    
        }else{
            $result = ['success' => 'fail', 'message' => "verification code is right. You didn't added any classroom. Please contact to admin."];    
        }
        return $result;
    }

    function is_exist_email($access_token, $push_token) {

        $query = $this->db->query( "SELECT * FROM _devices WHERE access_token = ? AND push_token = ? LIMIT 1", [$access_token, $push_token] );
        if($query->num_rows() > 0){
            $data = $query->row_array();
            $result = $data['email'];
        }else{
            $result = null;
        }
        return $result;
    }

    function getLessonsByLevelID($level_id){
        // get lessons from level_id
        $sql = "SELECT * FROM _lessons WHERE level_id = ?";
        $result = array();
        $query = $this->db->query( $sql, [$level_id] );
        if($query->num_rows() > 0){
            $result = $query->result_array();
        }
        return $result;
    }

    function getExercises($lesson_id) {
        $email = $this->functions->authentication();
        $sql = "SELECT * FROM _exercises WHERE lesson_id = ?";
        $result = array();
        $query = $this->db->query( $sql, [$lesson_id] );
        if($query->num_rows() > 0){
            $result = $query->result_array();    
        }
        return ['success' => 'OK', "exercises"=> $result]; ;
    }
    
}
