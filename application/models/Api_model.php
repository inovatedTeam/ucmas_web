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
        $result = [];
        $is_user = false;
        $sql_classroom = "SELECT * FROM __classrooms WHERE email = ? LIMIT 1";
        $query_classroom = $this->db->query($sql_classroom);

        if($query_classroom->num_rows() > 0){
            $is_user = true;
        }else{
            $sql = "SELECT * FROM orders WHERE email = ? AND is_student = 0 LIMIT 1";
            if($role == "teacher") {
                $sql = "SELECT * FROM _teachers WHERE email = ? LIMIT 1";
            }
            $query = $this->db->query( $sql, [$email] );
            if($query->num_rows() > 0){
                $is_user = true;
            }
        }
        
        if($is_user){
            $verification_code = $this->generate_code(6);
            $access_token = $this->generate_token(32);
            // register access token into device table
            $data = [
                'email' => $email,
                'access_token' => $access_token,
                'verify_code' => $verification_code,
            ];
            $this->db->insert( "_devices", $data);
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
            $query = $this->db->query( "SELECT a.*, b.level_name FROM _classrooms as a LEFT JOIN levels_en b on a.level_id = b.id WHERE a.email = ? ", [$result['email']] );
            if($query->num_rows() > 0){
                $children = $query->result_array();
                $child = $children[0];
                $update_data = [
                    'device_type' => $device_type,
                    'push_token' => $push_token
                ];
                if($result['focus_id'] == 0){
                    // update focus_id in devices table
                    $update_data['focus_id'] = $child['id'];
                }else{
                    // update child as focus_id
                    foreach($children as $row) {
                        if($row['id'] == $result['focus_id']){
                            $child = $row;
                        }
                    }
                }
                $this->db->update('_devices', $update_data, ['access_token' => $access_token]);

                // selected children = $results[0]
                $data = $this->get_initial_data_by_user($child);
                $data['child'] = $child;
                $data['children'] = $children;
                $result = ['success' => 'OK', 'data'=> $data];    
            }else{
                $result = ['success' => 'fail', 'message' => "verification code is right. You didn't added any classroom. Please contact to admin."];    
            }
        }else{
            $result = ['success' => 'fail', 'message' => "verification code is wrong. Please input right code."];
        }
        return $result;
    }

    function get_initial_data_by_user($child){

        $result = [];
        $lessons = $this->getLessonsByLevelID($child['level_id']);
        $assignments = $this->getExercisesByLevelID($child['level_id']);
        $result['lessons'] = $lessons;
        $result['assignments'] = $assignments;
        return $result;
    }
    function check_token(){
        $result = [];
        $focus_id = $this->functions->authentication();
        $query = $this->db->query( "SELECT a.*, b.level_name FROM _classrooms as a LEFT JOIN levels_en b on a.level_id = b.id WHERE a.id = ? ", [$focus_id] );
        if($query->num_rows() > 0){
            $children = $query->result_array();
            $child = $children[0];
            foreach($children as $row) {
                if($row['id'] == $focus_id){
                    $child = $row;
                }
            }
            $data = $this->get_initial_data_by_user($child);
            $data['child'] = $child;
            $data['children'] = $children;
            $result = ['success' => 'OK', 'data'=> $data];   
        }else{
            $result = ['success' => 'fail', 'message' => "verification code is right. You didn't added any classroom. Please contact to admin."];    
        }
        return $result;
    }

    function is_exist_email($access_token, $push_token) {

        $query = $this->db->query( "SELECT * FROM _devices WHERE access_token = ? AND push_token = ? LIMIT 1", [$access_token, $push_token] );
        if($query->num_rows() > 0){
            $data = $query->row_array();
            $result = $data['focus_id'];
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
    function getExercisesByLevelID($level_id){
        // get lessons from level_id
        $sql = "SELECT * FROM _exercises 
                WHERE level_id = ? AND id in (SELECT id FROM _lessons WHERE level_id = ?) 
                ORDER BY lesson_id, ex_order ASC";
        $result = array();
        $query = $this->db->query( $sql, [$level_id, $level_id] );
        if($query->num_rows() > 0){
            $result = $query->result_array();
        }
        return $result;
    }

    function getExercises($lesson_id) {
        $focus_id = $this->functions->authentication();
        $sql = "SELECT * FROM _exercises WHERE lesson_id = ?";
        $result = array();
        $query = $this->db->query( $sql, [$lesson_id] );
        if($query->num_rows() > 0){
            $result = $query->result_array();    
        }
        return ['success' => 'OK', "exercises"=> $result];
    }

    /* user profile update */
    function get_child($user_id) {
        $sql = "SELECT * FROM _classrooms WHERE id = ?";
        $result = array();
        $query = $this->db->query( $sql, [$user_id] );
        if($query->num_rows() > 0){
            $result = $query->row_array();    
        }
        return $result;
    }

    function get_children($user_id) {
        $sql = "SELECT * FROM _classrooms WHERE email = (SELECT email FROM _classrooms WHERE id = ?)";
        $result = array();
        $query = $this->db->query( $sql, [$user_id] );
        if($query->num_rows() > 0){
            $result = $query->row_array();    
        }
        return $result;
    }

    function update_profile($input) {
        $focus_id = $this->functions->authentication();
        $children = $this->get_children($focus_id);
        foreach($children as $child){
            if($child['id'] == $focus_id) {
                // current child
                $data = [
                    'email' => $input['email'],
                    'phone' => $input['phone'],
                    'parent_fname' => $input['parent_fname'],
                    'parent_lname' => $input['parent_lname'],
                ];
                $this->db->update('_classrooms', $data, ['id' => $child['id']]);
            }else{
                // other child
                $data = [
                    'email' => $input['email'],
                    'phone' => $input['phone'],
                    'parent_fname' => $input['parent_fname'],
                    'parent_lname' => $input['parent_lname'],
                ];
                $this->db->update('_classrooms', $data, ['id' => $child['id']]);
            }
        }
    }

    /* user profile update end */

    /* question and answers */
    function get_question_data($q_id) {
        $result = [];
        $sql_q = "SELECT * FROM _questions WHERE id = ? LIMIT 1";
        $query_q = $this->db->query($sql_q, [$q_id]);
        if($query_q->num_rows() > 0){
            $result['question'] = $query_q->row_array();
        }
        $sql_a = "SELECT * FROM _answers WHERE id = ?";
        $query_a = $this->db->query($sql_a, [$q_id]);
        if($query_a->num_rows() > 0){
            $result['answers'] = $query_a->result_array();
        }

        return $result;
    }
    function add_question($input) {
        $focus_id = $this->functions->authentication();
        $child = $this->get_child($focus_id);
        $data = [
            'student_id' => $focus_id,
            'c_id' => $child['c_id'],
            'question' => $input['question']
        ];

        $this->db->insert('_questions', $data);
        $new_id = $this->db->insert_id();
        $result = $this->get_question_data($new_id);
        return ['success' => 'OK', "questions"=> $result];
    }
    function add_answer($input) {
        $focus_id = $this->functions->authentication();
        $child = $this->get_child($focus_id);

        $data = [
            'question_id' => $input['question_id'],
            'message' => $input['message'],
        ];
        if($child['member_type'] == 'student'){
            $data['student_id'] = $focus_id;
        }else{
            $data['teacher_id'] = $focus_id;
        }

        $this->db->insert('_answers', $data);
        $result = $this->get_question_data($input['question_id']);
        return ['success' => 'OK', "questions"=> $result];
    }
    /* question and answers end */
    
}
