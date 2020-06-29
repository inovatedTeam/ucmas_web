<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Api_model extends CI_Model
{

    public  $lang = "en";
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
        return $result;
    }
    function make_in($arr, $parameter ){
		$str = "";
		$str .= "(";
		if(count($arr) > 0){
			for($i=0; $i < count($arr); $i++){
				if($i == 0) $str .= $arr[$i][$parameter];
				else{
					$str .= " ,".$arr[$i][$parameter];
				}
			}
			$str .= ")";
			return $str;
		}
		else{
			return false;
		}
	}

    /************************************* app function *****************************************/
    function register_email($email) {
        $result = [];
        $is_user = false;
        $sql_classroom = "SELECT * FROM _classrooms WHERE email = ? LIMIT 1";
        $query_classroom = $this->db->query($sql_classroom, [$email]);
        $role = '';
        if($query_classroom->num_rows() > 0){
            $user = $query_classroom->row_array();
            if($user['member_type'] == 'teacher') {
                $role = 'teacher';
            }else{
                $role = 'student';
            }
            $is_user = true;
        }
        if(!$is_user){
            $role = 'student';
            $sql = "SELECT * FROM orders WHERE email = ? AND is_student = 0 LIMIT 1";
            $query = $this->db->query( $sql, [$email] );
            if($query->num_rows() > 0){
                $is_user = true;
            }
        }
        if(!$is_user){
            $role = 'teacher';
            $sql = "SELECT * FROM _teachers WHERE email = ? LIMIT 1";
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
                $result = ['success' => 'OK', 'access_token' => $access_token, 'role'=> $role];
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
    function check_verify_code($input){
        extract($input); // $access_token, $verification_code, $device_type, $push_token, $role
        $query = $this->db->query( "SELECT * FROM _devices WHERE access_token = ? AND verify_code = ? LIMIT 1", [$access_token, $verification_code] );
        if($query->num_rows() > 0){
            $result = $query->row_array();
            $sql = "SELECT a.*, c.level_id, c.course_id, c.level_name, c.description, c.date_start, c.date_end  
                    FROM _classrooms as a 
                    LEFT JOIN (
                        SELECT d.*, e.level_name, f.date_start, f.date_end 
                        FROM _classes d 
                        LEFT JOIN levels_en e ON d.level_id = e.id
                        LEFT JOIN courses_en f ON d.course_id = f.id
                    ) c ON a.c_id = c.id
                    WHERE a.email = ? AND a.c_id <> 0";
            $query = $this->db->query( $sql, [$result['email']] );
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
                $data = $this->get_initial_data_by_user($child, $role);
                $data['role'] = $role;
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

    function get_initial_data_by_user($child, $role){

        $result = [];
        if($role == 'student'){
            $lessons = $this->getLessonsByLevelID($child);
            $assignments = $this->getAssignmentsByChild($child);
            $questions = $this->getQuestionsByChild($child);
            $ex_results = $this->getExAttemptsByChild($child);
            $result['lessons'] = $lessons;
            $result['assignments'] = $assignments;
            $result['questions'] = $questions;
            $result['ex_results'] = $ex_results;
        }else{
            // teacher
            $students = $this->getStudents($child['c_id']);
            $lessons = $this->getLessonsByLevelID($child);
            $assignments = $this->getAssignmentsByTeacher($child, $students);
            $questions = $this->getQuestionsByTeacher($child);
            $result['students'] = $students;
            $result['lessons'] = $lessons;
            $result['assignments'] = $assignments;
            $result['questions'] = $questions;
        }
        
        return $result;
    }
    function check_token(){
        $result = [];
        $focus_id = $this->functions->authentication();
        $sql = "SELECT a.*, c.level_id, c.course_id, c.level_name, c.description, c.date_start, c.date_end  
                FROM _classrooms as a 
                LEFT JOIN (
                    SELECT d.*, e.level_name, f.date_start, f.date_end 
                    FROM _classes d 
                    LEFT JOIN levels_en e ON d.level_id = e.id
                    LEFT JOIN courses_en f ON d.course_id = f.id
                ) c ON a.c_id = c.id
                WHERE a.email = (SELECT email FROM _classrooms WHERE id = ?)  AND a.c_id <> 0";
        $query = $this->db->query( $sql, [$focus_id] );
        if($query->num_rows() > 0){
            $children = $query->result_array();
            $child = $children[0];
            foreach($children as $row) {
                if($row['id'] == $focus_id){
                    $child = $row;
                }
            }
            $data = $this->get_initial_data_by_user($child, $child['member_type']);
            $data['role'] = $child['member_type'];
            $data['child'] = $child;
            $data['children'] = $children;
            $result = ['success' => 'OK', 'data'=> $data];   
        }else{
            $result = ['success' => 'fail', 'message' => "Token is right. You didn't added any classroom. Please contact to admin."];    
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

    function is_check_complete_lesson($child, $lesson_id) {
        $exercises = $this->db->where(['level_id'=> $child['level_id'], 'lesson_id'=>$lesson_id])->get('_exercises')->result_array();
        if($exercises){
            foreach($exercises as $ex){
                $count = 0;
                if($child['member_type'] == 'student') {
                    // $count = $this->db->where(['s_id'=>$child['id'], 'ex_id'=>$ex['id'], 'is_completed'=>1])->count_all_results('_ex_attempts');
                    $count = $this->db->where(['c_id'=>$child['c_id'], 'ex_id'=>$ex['id'], 'is_finished'=>'yes'])->count_all_results('_ex_exams');
                }else{ // teacher
                    $count = $this->db->where(['c_id'=>$child['c_id'], 'ex_id'=>$ex['id'], 'is_finished'=>'yes'])->count_all_results('_ex_exams');
                }
                if($count == 0){
                    return false;
                }
            }
        }else{
            return false;
        }
        return true;
    }

    function getLessonsByLevelID($child){
        $level_id = $child['level_id'];
        // get lessons from level_id
        
        $sql = "SELECT * FROM _lessons WHERE level_id = ?";
        $result = array();
        $query = $this->db->query( $sql, [$level_id] );
        if($query->num_rows() > 0){
            $arr = $query->result_array();
            foreach($arr as $k){
                $k['complete'] = 0;
                if($this->is_check_complete_lesson($child, $k['id'])){
                    $k['complete'] = 1;
                }
                $result[] = $k;
            }
        }
        return $result;
    }
    function getStudents($c_id){
        $result = array();
        $result = $this->db->select('id, first_name, last_name, email')->where('c_id', $c_id)
            ->where('member_type', 'student')->order_by('first_name', 'ASC')->get('_classrooms')->result_array();
        return $result;
    }
    
    function getAssignmentsByChild($child){
        $level_id = $child['level_id'];
        // get completed assignments
        $ex_results = [];
        $sql_results = "SELECT a.* FROM _ex_attempts a
                        WHERE a.s_id = ? AND a.is_completed = 1
                        ";
                        // INNER JOIN (SELECT MAX(updated) as max_updated FROM _ex_attempts WHERE s_id = ? AND is_completed = 1 AND ((ex_type = 'reading' ) OR ex_type <> 'reading') GROUP BY ex_id ) b
                        // ON a.updated = b.max_updated
        $query_results = $this->db->query($sql_results, [$child['id']]);
        if($query_results->num_rows() > 0){
            $arr = $query_results->result_array();
            foreach($arr as $k){
                if(!in_array($k['ex_id'], $ex_results)){
                    $ex_results[] = $k['ex_id'];
                }
            }
        }
        $add_query = "";
        if(count($ex_results) > 0) {
            $str_ex_results_ids = implode(",", $ex_results);
            if($str_ex_results_ids){
                $add_query = " AND a.id NOT IN (".$str_ex_results_ids. ")";
            }
        }

        // echo $add_query;exit;

        // get lessons from level_id
        $sql = "SELECT a.*, b.lesson_name FROM _exercises a
                LEFT JOIN _lessons b ON a.lesson_id = b.id
                WHERE a.level_id = ? AND a.lesson_id in (SELECT id FROM _lessons WHERE level_id = ?) AND a.exercise_type = 'reading'
                AND a.id IN (SELECT ex_id FROM _ex_exams WHERE c_id = ? AND is_finished = 'yes') AND a.id NOT IN (SELECT ex_id FROM _ex_attempts WHERE s_id = ? AND is_completed = 1)
                ORDER BY lesson_id, ex_order ASC";
        $result = array();
        $query = $this->db->query( $sql, [$level_id, $level_id, $child['c_id'], $child['id']] );
        if($query->num_rows() > 0){
            $arr = $query->result_array();
            foreach($arr as $k){
                $k['complete'] = 0;
                if(in_array($k['id'], $ex_results)){
                    $k['complete'] = 1;
                }else{

                    $result[] = $k;
                }
                // $result[] = $k;
            }
        }
        return $result;
    }

    function checkCompleteAssignmentByTeacher($assignment, $students){
        foreach($students as $student) {
            $conditions = ['ex_id'=> $assignment['id'], 's_id'=> $student['id'], 'is_completed'=> 1];
            $chk = $this->db->where($conditions)->count_all_results('_ex_attempts');
            // $str = $this->db->last_query();
            // print_r($chk);
            // exit;
            if($chk == 0){
                return 0;
            }
        }
        return 1;
    }
    function getAssignmentsByTeacher($child, $students){
        $level_id = $child['level_id'];
        
        // get lessons from level_id
        $sql = "SELECT a.*, b.lesson_name FROM _exercises a
                LEFT JOIN _lessons b ON a.lesson_id = b.id
                WHERE a.level_id = ? AND a.lesson_id in (SELECT id FROM _lessons WHERE level_id = ?) AND a.exercise_type = 'reading' 
                AND a.id IN (SELECT ex_id FROM _ex_exams WHERE c_id = ? AND is_finished = 'yes')
                ORDER BY lesson_id, ex_order ASC";
        $result = array();
        $query = $this->db->query( $sql, [$level_id, $level_id, $child['c_id']] );
        if($query->num_rows() > 0){
            $arr = $query->result_array();
            foreach($arr as $k){
                $is_complete = $this->checkCompleteAssignmentByTeacher($k, $students);
                // $is_complete = $this->db->where(['c_id'=> $child['c_id'], 'ex_id'=> $k['id'], 'is_finished'=>'yes'])->get('_ex_exams')->row_array();
                $k['complete'] = 0;
                if($is_complete){
                    $k['complete'] = 1;
                }else{
                    $result[] = $k;
                }
                // $result[] = $k;
            }
        }
        return $result;
    }
    function getQuestionsByChild($child){
        $result= [];
        $questions= [];
        $query = "";
        if($child['member_type'] == 'student') {
            $sql = "SELECT a.*, CONCAT(b.first_name,' ',b.last_name) as student_name 
                    FROM _questions a 
                    LEFT JOIN _classrooms b ON a.s_id = b.id 
                    WHERE a.s_id = ? AND a.c_id = ? ORDER BY a.created DESC";
            $query = $this->db->query($sql, [$child['id'], $child['c_id']]);
        }else {
            $sql = "SELECT a.*, CONCAT(b.first_name,' ',b.last_name) as student_name 
                    FROM _questions a 
                    LEFT JOIN _classrooms b ON a.s_id = b.id
                    WHERE a.c_id = ? ORDER BY a.created DESC";
            $query = $this->db->query($sql, [$child['c_id']]);
        }
        if($query->num_rows() > 0){
            $questions = $query->result_array();
        }

        if(count($questions) > 0) {
            foreach($questions as $question) {
                $temp = [];
                // $temp[] = $question;
                $sql_a = "SELECT * FROM _answers WHERE question_id = ? ORDER BY created ASC";
                $query_a = $this->db->query($sql_a, [$question['id']]);
                if($query_a->num_rows() > 0){
                    $arr_ans = $query_a->result_array();
                    foreach($arr_ans as $row){
                        $temp[] = $row;
                    }
                }
                $result[] = ['question'=>$question, 'answers'=>$temp];
            }
        }
        return $result;
    }
    function getQuestionsByTeacher($child){
        $result= [];
        $questions= [];
        $query = "";
        if($child['member_type'] == 'student') {
            $sql = "SELECT a.*, CONCAT(b.first_name,' ',b.last_name) as student_name 
                    FROM _questions a 
                    LEFT JOIN _classrooms b ON a.s_id = b.id 
                    WHERE a.s_id = ? AND a.c_id = ? ORDER BY a.created DESC";
            $query = $this->db->query($sql, [$child['id'], $child['c_id']]);
        }else {
            $sql = "SELECT a.*, CONCAT(b.first_name,' ',b.last_name) as student_name 
                    FROM _questions a 
                    LEFT JOIN _classrooms b ON a.s_id = b.id
                    WHERE a.c_id = ? ORDER BY a.created DESC";
            $query = $this->db->query($sql, [$child['c_id']]);
        }
        if($query->num_rows() > 0){
            $questions = $query->result_array();
        }

        if(count($questions) > 0) {
            foreach($questions as $question) {
                $temp = [];
                // $temp[] = $question;
                $sql_a = "SELECT * FROM _answers WHERE question_id = ? ORDER BY created ASC";
                $query_a = $this->db->query($sql_a, [$question['id']]);
                if($query_a->num_rows() > 0){
                    $arr_ans = $query_a->result_array();
                    foreach($arr_ans as $row){
                        $temp[] = $row;
                    }
                }
                $result[] = ['question'=>$question, 'answers'=>$temp];
            }
        }
        return $result;
    }
    function getAssignments(){
        $focus_id = $this->functions->authentication();
        $child = $this->get_child($focus_id);
        $data = $this->getAssignmentsByChild($child);
        return ['success' => 'OK', "assignments"=> $data];
    }
    function getExercises($lesson_id) {
        $focus_id = $this->functions->authentication();
        $child = $this->get_child($focus_id);
        if($child['member_type'] == 'student'){
            /*
            $ex_results = [];
            $sql_results = "SELECT a.* FROM _ex_attempts a WHERE s_id = ? AND is_completed = 1";
            $query_results = $this->db->query($sql_results, [$focus_id]);
            if($query_results->num_rows() > 0){
                $arr = $query_results->result_array();
                foreach($arr as $k){
                    if(!in_array($k['ex_id'], $ex_results)){
                        $ex_results[] = $k['ex_id'];
                    }
                }
            }
            */
            $ex_results = [];
            $arr = $this->db
                ->where(['lesson_id'=> $lesson_id, 'c_id'=> $child['c_id'], 'is_finished'=> 'yes'])
                ->get('_ex_exams')->result_array();
            foreach($arr as $k){
                if(!in_array($k['ex_id'], $ex_results)){
                    $ex_results[] = $k['ex_id'];
                }
            }
    
            $sql = "SELECT * FROM _exercises WHERE lesson_id = ?";
            $result = array();
            $query = $this->db->query( $sql, [$lesson_id] );
            if($query->num_rows() > 0){
                $arr = $query->result_array();
                foreach($arr as $k){
                    $k['complete'] = 0;
                    if(in_array($k['id'], $ex_results)){
                        $k['complete'] = 1;
                    }
                    $result[] = $k;
                }
            }
            return ['success' => 'OK', "exercises"=> $result];
        }else { // teacher
            $ex_results = [];
            $arr = $this->db
                ->where(['lesson_id'=> $lesson_id, 'c_id'=> $child['c_id'], 'is_finished'=> 'yes'])
                ->get('_ex_exams')->result_array();
            foreach($arr as $k){
                if(!in_array($k['ex_id'], $ex_results)){
                    $ex_results[] = $k['ex_id'];
                }
            }
    
            $sql = "SELECT * FROM _exercises WHERE lesson_id = ?";
            $result = array();
            $query = $this->db->query( $sql, [$lesson_id] );
            if($query->num_rows() > 0){
                $arr = $query->result_array();
                foreach($arr as $k){
                    $k['complete'] = 0;
                    if(in_array($k['id'], $ex_results)){
                        $k['complete'] = 1;
                    }
                    $result[] = $k;
                }
            }
            return ['success' => 'OK', "exercises"=> $result];

        }
    }

    /* user profile update */
    function get_child($user_id) {
        $sql = "SELECT a.*, c.level_id, c.course_id, c.level_name, c.description 
                FROM _classrooms as a 
                LEFT JOIN (SELECT d.*, e.level_name FROM _classes d LEFT JOIN levels_en e ON d.level_id = e.id) c ON a.c_id = c.id
                WHERE a.id = ?";
        $result = array();
        $query = $this->db->query( $sql, [$user_id] );
        if($query->num_rows() > 0){
            $result = $query->row_array();    
        }
        return $result;
    }

    function get_children($user_id) {
        $sql = "SELECT a.*, c.level_id, c.course_id, c.level_name, c.description, c.date_start, c.date_end  
                FROM _classrooms as a 
                LEFT JOIN (
                    SELECT d.*, e.level_name, f.date_start, f.date_end 
                    FROM _classes d 
                    LEFT JOIN levels_en e ON d.level_id = e.id
                    LEFT JOIN courses_en f ON d.course_id = f.id
                ) c ON a.c_id = c.id
                WHERE a.email = (SELECT email FROM _classrooms WHERE id = ?) AND a.c_id <> 0";
        $result = array();
        $query = $this->db->query( $sql, [$user_id] );
        if($query->num_rows() > 0){
            $result = $query->result_array();    
        }
        return $result;
    }

    function select_child($child_id) {
        $focus_id = $this->functions->authentication();
        $child = $this->get_child($child_id);
        $children = $this->get_children($focus_id);

        // update focus_id in device table
        $headers = $this->input->request_headers();
        $this->db->update('_devices', ['focus_id' => $child['id']], ['access_token'=> $headers['Access-Token']]);
        
        $data = $this->get_initial_data_by_user($child, $child['member_type']);
        $data['role'] = $child['member_type'];
        $data['child'] = $child;
        $data['children'] = $children;
        $result = ['success' => 'OK', 'data'=> $data];  
        return $result;
    }
    function update_profile($input) {
        $focus_id = $this->functions->authentication();
        $child = $this->get_child($focus_id);
        $children = $this->get_children($focus_id);
        foreach($children as $child){
            if($child['id'] == $focus_id) {
                // current child
                $data = [
                    'email' => $input['email'],
                    // 'phone' => $input['phone'],
                ];
                // if($input['member_type'] == 'student'){
                //     $data['parent_fname'] = $input['parent_fname'];
                //     $data['parent_lname'] = $input['parent_lname'];
                // }else{
                //     $data['first_name'] = $input['parent_fname'];
                //     $data['last_name'] = $input['parent_lname'];
                // }
                $this->db->update('_classrooms', $data, ['id' => $child['id']]);
            }else{
                // other child
                $data = [
                    'email' => $input['email'],
                    // 'phone' => $input['phone'],
                ];
                // if($input['member_type'] == 'student'){
                //     $data['parent_fname'] = $input['parent_fname'];
                //     $data['parent_lname'] = $input['parent_lname'];
                // }else{
                //     $data['first_name'] = $input['parent_fname'];
                //     $data['last_name'] = $input['parent_lname'];
                // }
                $this->db->update('_classrooms', $data, ['id' => $child['id']]);
            }
        }

        // get updated child data
        $child = $this->get_child($focus_id);
        $children = $this->get_children($focus_id);

        if($child['member_type'] == 'teacher'){
            // update email in teachers table
            $this->db->update('_teachers', ['email'=>$input['email']], ['id'=>$child['relation_id']]);
        }
        // update email in device table
        $headers = $this->input->request_headers();
        $this->db->update('_devices', ['email' => $input['email']], ['access_token'=> $headers['Access-Token']]);

        $data = $this->get_initial_data_by_user($child, $child['member_type']);
        $data['role'] = $child['member_type'];
        $data['child'] = $child;
        $data['children'] = $children;
        $result = ['success' => 'OK', 'data'=> $data];  
        return $result;
    }

    /* user profile update end */

    /* question and answers */
    function get_questions(){
        $focus_id = $this->functions->authentication();
        $child = $this->get_child($focus_id);
        $result = $this->getQuestionsByChild($child);
        return ['success' => 'OK',"questions"=>$result];
    }
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
        
        if($child['member_type'] == 'student'){
            $data = [
                's_id' => $focus_id,
                'c_id' => $child['c_id'],
                'question' => $input['question']
            ];
            $this->db->insert('_questions', $data);
            $result = $this->getQuestionsByChild($child);
        }else{ // teacher
            $data = [
                's_id' => $input['student_id'],
                't_id' => $focus_id,
                'c_id' => $child['c_id'],
                'creator' => 'teacher',
                'question' => $input['question']
            ];
            $this->db->insert('_questions', $data);
            $result = $this->getQuestionsByTeacher($child);
        }
        
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
        $result = $this->getQuestionsByChild($child);
        return ['success' => 'OK', "questions"=> $result];
    }
    /* question and answers end */
    /* exam exercise */
    function examStartExercise($input) {
        $focus_id = $this->functions->authentication();
        $child = $this->get_child($focus_id);
        
        $data = [
            'c_id' => $child['c_id'],
            'level_id' => $input['level_id'],
            'lesson_id' => $input['lesson_id'],
            'ex_id' => $input['ex_id'],
            'ex_type' => $input['ex_type'], // reading|html|video_mp4|video_youtube|listening
            'duration' => $input['duration'], 
            'is_finished' => $input['is_finished'], // yes | no
        ];
        if($input['ex_type'] == 'reading'){
            $data['s_ids'] = $input['s_ids'];
            $data['time_start'] = $input['time_start'];
            $data['time_end'] = $input['time_end'];
        }

        $sql = "SELECT * FROM _ex_exams WHERE c_id = ? AND ex_id=? AND is_finished = ? ";
        $query = $this->db->query($sql, [$child['c_id'], $input['ex_id'], $input['is_finished']]);
        // $str = $this->db->last_query();
        // echo $str;exit;
        $exam_id = 0;
        if($query->num_rows() > 0){
            $exam_id = $query->row_array()['id'];
            $this->db->update('_ex_exams', $data, ['id' => $exam_id]);
        }else{
            $this->db->insert('_ex_exams', $data);
            $exam_id = $this->db->insert_id();    
        }

        return ['success' => 'OK', "exam_id"=> $exam_id];
    }
    function examEndExercise($input) {
        $focus_id = $this->functions->authentication();
        $child = $this->get_child($focus_id);
        
        $data = [
            'is_finished' => $input['is_finished'], // yes | no
        ];
        
        $this->db->update('_ex_exams', $data, ['id'=>$input['exam_id']]);

        return ['success' => 'OK'];
    }
    function checkExam() {
        $focus_id = $this->functions->authentication();
        $child = $this->get_child($focus_id); // student
        
        $start_time = time();
        $arr = $this->db->where(['c_id'=>$child['c_id'], 'ex_type='=>'reading', 'is_finished'=> 'no', 'time_start > '=>$start_time])
                        ->order_by('created', 'DESC')->limit(1)->get('_ex_exams')->row_array();
        if($arr){
            $s_ids = explode(',', $arr['s_ids']);
            if(in_array($focus_id, $s_ids)){
                $exercise = $this->db->where('id', $arr['ex_id'])->get('_exercises')->row_array();
                return ['success' => 'OK', "exam"=> $arr, 'exercise'=>$exercise];
            }else{
                return ['success' => 'fail', "message"=> "this is not attended"];
            }
        }else{
            return ['success' => 'fail', "message"=> "there is no exam"];
        }

        
    }
    function attemptStartExercise($input) {
        $focus_id = $this->functions->authentication();
        $child = $this->get_child($focus_id);
        
        $data = [
            's_id' => $child['id'],
            'level_id' => $input['level_id'],
            'lesson_id' => $input['lesson_id'],
            'ex_id' => $input['ex_id'],
            'ex_type' => $input['ex_type'], // reading|html|video_mp4|video_youtube|listening
            'is_exam' => $input['is_exam'], // yes | no
            'is_completed' => $input['is_completed'], // 0|1
        ];
        if($input['ex_type'] == 'reading' && $input['is_exam'] == 'yes'){
            $data['exam_id'] = $input['exam_id'];
            $data['time_start'] = $input['time_start'];
            $data['time_end'] = $input['time_end'];
        }

        if($input['ex_type'] == 'reading'){
            $sql = "SELECT * FROM _ex_attempts WHERE s_id = ? AND ex_id=? AND is_completed = ? ORDER BY is_exam DESC, id DESC LIMIT 1";
            $query = $this->db->query($sql, [$child['id'], $input['ex_id'], (int)$input['is_completed']]);
        }else{
            $sql = "SELECT * FROM _ex_attempts WHERE s_id = ? AND ex_id=? AND is_exam = ? AND is_completed = ? ";    
            $query = $this->db->query($sql, [$child['id'], $input['ex_id'], $input['is_exam'], (int)$input['is_completed']]);
        }
        
        $attempt_id = 0;
        if($query->num_rows() > 0){
            $attempt_id = $query->row_array()['id'];
            if($input['ex_type'] == 'reading' && $input['is_exam'] == 'yes'){
                // remove attempt history
                $saved_result = $this->db->where('attempt_id', $attempt_id)
                                        ->delete('_ex_results');
            }
        }else{
            $this->db->insert('_ex_attempts', $data);
            $attempt_id = $this->db->insert_id();    
        }

        $saved_result = [];
        if($input['ex_type'] == 'reading' && $input['is_exam'] == 'no'){
            // get saved result
            $saved_result = $this->db->where('attempt_id', $attempt_id)->get('_ex_results')->result_array();
        }

        return ['success' => 'OK', "attempt_id"=> $attempt_id, 'saved_result'=> $saved_result];
    }
    function attemptEndExercise($input) {
        $focus_id = $this->functions->authentication();
        $child = $this->get_child($focus_id);
        
        $data = [
            'is_completed' => $input['is_completed'], // 0|1
        ];
        if($input['ex_type'] == 'reading'){
            $data['a'] = $input['a'];
            $data['c'] = $input['c'];
            $data['s'] = $input['s'];
            $data['w'] = $input['w'];
            $duration = 0;
            $sql = "SELECT SUM(duration) as duration FROM _ex_results WHERE attempt_id=?";
            $query = $this->db->query($sql, [$input['attempt_id']]);
            if($query->num_rows() > 0){
                $duration = (float)$query->row_array()['duration'];
            }
            $data['duration'] = $duration;
        }
        $data['updated'] = date("Y-m-d H:i:s", time());

        $this->db->update('_ex_attempts', $data, ['id' => $input['attempt_id']]);
        $ex_results = $this->getExAttemptsByChild($child);
        $assignments = $this->getAssignmentsByChild($child);
        return ['success' => 'OK', "ex_results"=> $ex_results, "assignments"=> $assignments];
    }
    function resultExercise($input) {
        $focus_id = $this->functions->authentication();
        
        $data = [
            'attempt_id' => $input['attempt_id'],
            'sub_id' => $input['sub_id'],
            'sub_status' => $input['sub_status'],
            'nb' => $input['nb'],
            'duration' => $input['duration']
        ];

        $this->db->insert('_ex_results', $data);
        return ['success' => 'OK'];
    }
    function getExamResult($input) {
        $focus_id = $this->functions->authentication();
        
        $exam_id = $input['exam_id'];
        $exam = $this->db->where('id', $exam_id)->get('_ex_exams')->row_array();
        $time_start = $exam['time_start'];
        $time_end = (int)$exam['time_end'] + 5; // 5 seconds
        // $date_start = date('Y:m:d H:i:s', $time_start);
        // $date_end = date('Y:m:d H:i:s', $time_end);
        $s_ids = $exam['s_ids'];

        $result = [];
        $students = explode(',', $s_ids);
        if(count($students) > 0) {
            foreach($students as $student){
                $temp['s_id'] = $student;
                $temp['results'] = [];
                $sql = "SELECT a.* 
                        FROM _ex_results a 
                        WHERE a.attempt_id = (SELECT id FROM _ex_attempts WHERE s_id = ? AND exam_id = ? AND is_exam = 'yes')
                        ORDER BY a.sub_id";
                $query = $this->db->query($sql, [$student, $exam_id]);
                // $sql = $this->db->last_query();
                // echo $sql; exit;
                if($query->num_rows() > 0) {
                    $arr = $query->result_array();
                    $temp['results'] = $arr;
                }
                $result[] = $temp;
            }

        }
        
        return ['success' => 'OK', 'results'=> $result];
    }
    function getTeacherExerciseResult($input) {
        $focus_id = $this->functions->authentication();
        $child = $this->get_child($focus_id); // teacher

        $ex_id = $input['ex_id'];
        $exam = $this->db->where(['c_id'=>$child['c_id'], 'ex_id'=> $ex_id, 'is_finished'])->limit(1)->get('_ex_exams')->row_array();
        $exam_id = $exam['id'];
        $time_start = $exam['time_start'];
        $time_end = (int)$exam['time_end'] + 5; // 5 seconds
        // $date_start = date('Y:m:d H:i:s', $time_start);
        // $date_end = date('Y:m:d H:i:s', $time_end);
        $s_ids = $exam['s_ids'];

        $result = [];
        // $students = explode(',', $s_ids);
        $students = $this->getStudents($child['c_id']);
        if(count($students) > 0) {
            foreach($students as $student){
                $temp['s_id'] = $student['id'];
                $attempt_id = $this->db->where(["s_id"=>$student['id'], "ex_id" => $ex_id])->order_by('is_exam', 'desc')->order_by('id', 'desc')->get('_ex_attempts')->row_array();
                // echo $this->db->last_query();exit;
                $temp['results'] = [];
                $sql = "SELECT a.* 
                        FROM _ex_results a 
                        INNER JOIN (select *, MAX(nb) as max_nb FROM _ex_results 
                        WHERE attempt_id = ? GROUP BY sub_id) b
                        ON a.nb = b.max_nb AND a.sub_id = b.sub_id
                        WHERE a.attempt_id = ?
                        ORDER BY a.sub_id
                        ";
                // $sql = "SELECT a.* 
                //         FROM _ex_results a 
                //         WHERE a.attempt_id = (SELECT id FROM _ex_attempts WHERE s_id = ? AND exam_id = ? AND is_exam = 'yes')
                //         ORDER BY a.sub_id";
                if($attempt_id){
                    $query = $this->db->query($sql, [$attempt_id['id'], $attempt_id['id']]);
                    // $sql = $this->db->last_query();
                    // echo $sql; exit;
                    if($query->num_rows() > 0) {
                        $arr = $query->result_array();
                        $temp['results'] = $arr;
                    }
                }
                $result[] = $temp;
            }

        }
        
        return ['success' => 'OK', 'results'=> $result];
    }
    function getExAttemptsByChild($child){
        $result= [];
        $ex_results= [];
        $exercises= [];
        $sql = "SELECT id, level_id, lesson_id, exercise_type, ex_tags, ex_name, ex_description FROM _exercises WHERE level_id = ? ";
        $query = $this->db->query($sql, [$child['level_id']]);
        if($query->num_rows() > 0){
            $exercises = $query->result_array();
        }
        $sql_results = "SELECT a.* FROM _ex_attempts a
                        INNER JOIN (SELECT MAX(updated) as max_updated FROM _ex_attempts WHERE s_id = ? AND is_completed = 1 AND ((ex_type = 'reading' AND is_exam = 'yes' ) OR ex_type <> 'reading') GROUP BY ex_id ) b
                        ON a.updated = b.max_updated";
        $query_results = $this->db->query($sql_results, [$child['id']]);
        if($query_results->num_rows() > 0){
            $ex_results = $query_results->result_array();
        }

        $ct_ex = count($exercises);
        $ct_ex_results = count($ex_results);
        $result['ct_ex'] = $ct_ex;
        $result['ct_ex_results'] = $ct_ex_results;
        // $t_speed = 0;
        // $t_score = 0;
        // if($ct_ex > 0 && $ct_ex_results > 0) {
        //     foreach($ex_results as $row) {
        //         $temp_speed = 0;
        //         $temp_speed = floor( ($row['estimate_time'] - $row['duration'])/$row['estimate_time']*100);
        //         $t_speed += $temp_speed;
        //         $t_score += $row['ex_score'];
        //     }
        //     $result['average_speed'] = floor($t_speed / $ct_ex_results);
        //     $result['average_score'] = floor($t_score / $ct_ex_results);
        // }else{
        // }
        $result['average_speed'] = "none";
        $result['average_score'] = "none";
        return $result;
    }
    /* exam exercise end */
    
}
