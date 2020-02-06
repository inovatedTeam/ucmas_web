<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Admin_model extends CI_Model
{

    public  $lang = "en";
    public  $langs = array("en", "no", "se", "da");
    private $save_photo = "./assets/uploads/";
    private $save_ex_photo = "./assets/exercises/";

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
        $sql = "SELECT * FROM orders WHERE email = ? LIMIT 1";
        $query = $this->db->query( $sql, [$email] );
        if($query->num_rows() > 0){
            $result = $query->row_array();
            $verification_code = $this->generate_code(6);
            $access_token = $this->generate_token(32);
            // register access token into device table
            $query_register = $this->db->query( "INSERT INTO _devices(email, device_type, push_token, access_token, verify_code) VALUES(?, '', '', ?, ?)", 
            [$email, $access_token, $verification_code] );
            if(!$this->functions->send_verification_email($email, $verification_code)){
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
            if(!$this->functions->send_verification_email($result['email'], $verification_code)){
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
            $query = $this->db->query( "SELECT * FROM orders WHERE email = ? AND state = 1 AND cfirst_name <> '' ", [$result['email']] );
            if($query->num_rows() > 0){
                $results = $query->result_array();
                // selected children = $results[0]
            }else{

            }
        }else{
            $result = ['success' => 'fail', 'message' => "verification code is wrong. Please input right code."];
        }
        return $result;
    }

    function is_exist_email($token, $device_id) {

        $result = array(
            "id"=>0, 
            "lesson_id"=>0, 
            "first_name"=> "",
            "last_name"=> "",
            "email"=> "",
            "phone"=> "",
        );
        if($id > 0) {
            $sql = "SELECT * FROM _teachers WHERE id = $id";
            $query = $this->db->query( $sql );
            if($query->num_rows() > 0){
                $result = $query->row_array();
            }
        }

        return $result;
    }
    /************************************* app function end *****************************************/

    function isAdmin($username, $password) {

        $sql = "select * from users where (username= '$username' OR email= '$username') and password='". md5($password) ."'";
        $result = array();
        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $result['status'] = 1;
            $arr = $query->row_array();
            $_SESSION['user_id'] = $arr['id'];
            $_SESSION['username'] = $arr['username'];
            $_SESSION['email'] = $arr['email'];
            $_SESSION['permission'] = $arr['permission'];
        }else{
            $result['status'] = 0;
            $result['message'] = "Invalid email or password";
        }
        return $result;
    }
    function randomPassword($length) {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < $length; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
    function forgot_password($email) {

        $sql = "select * from users where (username= '$email' OR email= '$email') limit 1";
        $result = array();
        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $user = $query->row_array();
            $new_pass = $this->randomPassword(6);
            // update password
            if($this->db->query( "UPDATE users SET password = '".md5($new_pass)."' WHERE id = ?", [$user['id']] ) ){
                // send email
                $to = $user['email'];
                $subject = "Updated password";
                $txt = "Your new password is " . $new_pass;
                $headers = "From: info@ucmas.no" . "\r\n" .
                    "CC: info@ucams.no";

                if(mail($to,$subject,$txt,$headers)){
                    $result['status'] = 1;
                    $result['message'] = "Admin sent new password to your email";
                }else{
                    $result['status'] = 0;
                    $result['message'] = "Email didn't send.";
                }
            }else{
                $result['status'] = 0;
                $result['message'] = "Database error";
            }

        }else{
            $result['status'] = 0;
            $result['message'] = "Invalid email";
        }
        return $result;
    }

    function getFeatures() {

        $sql = "SELECT * FROM features ORDER BY id ASC";
        $result = array();
        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $result = $query->result_array();
        }

        return $result;
    }
    /* language */
    function getPath($lang){
        $folder = "english";
        switch ($lang){
            case 'en':
                $folder = "english";
                break;
            case 'no':
                $folder = "norwegian";
                break;
            case 'da':
                $folder = "danish";
                break;
            case 'se':
                $folder = "swedish";
                break;
            default:
                $folder = "english";
                break;
        }
        $path = "application/language/".$folder."/home_lang.php";
        return $path;
    }
    function getLanguage($lang) {

        $path = $this->getPath($lang);
        $content = file_get_contents($path);
        $content = str_replace("<?php", "", $content);
        return $content;
    }
    function saveLanguage($lang) {

        $path = $this->getPath($lang);
        $fp = fopen($path, "w");
        fwrite($fp, "<?php \r\n".$_POST['content']);
        fclose($fp);

        return true;
    }

    /* page languages */

    function getPageLangs() {

        $sql = "SELECT * FROM page_langs ORDER BY id ASC";
        $result = array();
        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $result = $query->result_array();
        }
        return $result;
    }

    function getPageLang($id, $lang = "en") {
        $result = array();
        if($id == 0){
            $id = 1;
        }

        $sql = "SELECT id, c_section, en_section1, en_section2, en_section3, en_section4, ".$lang."_section1 as section1, 
            ".$lang."_section2 as section2, ".$lang."_section3 as section3, ".$lang."_section4 as section4 FROM page_langs WHERE id = $id";
        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $result = $query->result_array();
            return $result[0];
        }else{
            return $result;
        }
    }
    function savePageLang($id) {
        extract($_POST);

        $description = str_replace('"', "'", $page_section1);
        $htmlcode1 = $this->db->escape_str($description);
        $add_query = "";
        if($c_section == 2){
            $description2 = str_replace('"', "'", $page_section2);
            $htmlcode2 = $this->db->escape_str($description2);
            $add_query = ",".$sel_lang."_section2 = '$htmlcode2'";
        }elseif($c_section == 3){
            $description2 = str_replace('"', "'", $page_section2);
            $htmlcode2 = $this->db->escape_str($description2);
            $add_query .= ",".$sel_lang."_section2 = '$htmlcode2'";
            $description3 = str_replace('"', "'", $page_section3);
            $htmlcode3 = $this->db->escape_str($description3);
            $add_query .= ",".$sel_lang."_section3 = '$htmlcode3'";
        }elseif($c_section == 4){
            $description2 = str_replace('"', "'", $page_section2);
            $htmlcode2 = $this->db->escape_str($description2);
            $add_query .= ",".$sel_lang."_section2 = '$htmlcode2'";
            $description3 = str_replace('"', "'", $page_section3);
            $htmlcode3 = $this->db->escape_str($description3);
            $add_query .= ",".$sel_lang."_section3 = '$htmlcode3'";
            $description4 = str_replace('"', "'", $page_section4);
            $htmlcode4 = $this->db->escape_str($description4);
            $add_query .= ",".$sel_lang."_section4 = '$htmlcode4'";
        }

        $sql = "UPDATE page_langs SET ".$sel_lang."_section1 = '$htmlcode1' $add_query WHERE id = $sel_page";
        if($this->db->query( $sql ) ){
            return true;
        }else{
            return false;
        }
    }

    /* Levels */
    function getLevels($lang) {

        $sql = "SELECT * FROM levels_".$lang." ORDER BY order_num, id ASC";
        $result = array();
        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $result = $query->result_array();
        }

        return $result;
    }
    function getListLevels($lang) {

        $sql = "SELECT id, level_name FROM levels_".$lang." ORDER BY order_num, id ASC";
        $result = array();
        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $result = $query->result_array();
        }
        $arr = $this->make_list($result, "id","level_name");

        return $arr;
    }
    function getLevel($id, $lang) {

        $result = array("id"=>0, "order_num"=>0,"level_name"=>"", "description"=> "", "age_group"=> "", "class_size"=> "",
            "duration"=> "", "sessions"=> "", "fee_standard"=> "", "fee_siblings"=> "", "fee_families"=> "",
            "ft_1"=> "","ft_2"=> "","ft_3"=> "","ft_4"=> "","ft_t1"=> "","ft_t2"=> "","ft_t3"=> "","ft_t4"=> "",
            "next_level"=> 0, "prev_level"=> 0, "note"=> "", "is_visible"=>0);
        $sql = "SELECT * FROM levels_".$lang." WHERE id = $id";
        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $result = $query->row_array();
        }

        return $result;
    }
    function saveLevel($level_id, $lang) {
        extract($_POST);
        $description = str_replace('"', "'", $description);
        $htmlcode = $this->db->escape_str($description);
        if($level_id == 0){

            $langs = array("en", "no", "se", "da");
            $sql_insert = "INSERT INTO levels_".$sel_lang."(order_num, level_name, description, age_group, class_size, duration, sessions, fee_standard, fee_siblings, fee_families, ft_t1, ft_t2, ft_t3, ft_t4, ft_1, ft_2, ft_3, ft_4, next_level, prev_level, is_visible) 
                    VALUES ('$order_num', '$level_name', '$htmlcode', '$age_group', '$class_size', '$duration', '$sessions', '$fee_standard', '$fee_siblings', '$fee_families', '$ft_t1', '$ft_t2', '$ft_t3', '$ft_t4', '$ft_1', '$ft_2', '$ft_3', '$ft_4', '$next_level', '$prev_level', '$is_visible')";
            $this->db->query( $sql_insert );
            $new_id = $this->db->insert_id();

            foreach ($langs as $sel_lang) {
                if($sel_lang != $lang){
                    $sql = "INSERT INTO levels_".$sel_lang."(id, order_num, level_name, description, age_group, class_size, duration, sessions, fee_standard, fee_siblings, fee_families, ft_t1, ft_t2, ft_t3, ft_t4, ft_1, ft_2, ft_3, ft_4, next_level, prev_level, is_visible) 
                    VALUES ($new_id, $order_num, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '$next_level', '$prev_level', '$is_visible')";
                    $this->db->query( $sql );
                }
            }
            return true;
        }else{
            $sql = "UPDATE levels_".$lang." SET order_num=$order_num, level_name = '$level_name', description = '$htmlcode', age_group = '$age_group', class_size = '$class_size', duration = '$duration', sessions = '$sessions', fee_standard = '$fee_standard', fee_siblings = '$fee_siblings'
                   , fee_families = '$fee_families', ft_t1 = '$ft_t1', ft_t2 = '$ft_t2', ft_t3 = '$ft_t3', ft_t4 = '$ft_t4', ft_1 = '$ft_1', ft_2 = '$ft_2', ft_3 = '$ft_3', ft_4 = '$ft_4', prev_level = '$prev_level', next_level = '$next_level', is_visible = '$is_visible' WHERE id = $level_id";
            if($this->db->query( $sql ) ){
                return true;
            }else{
                return false;
            }
        }

    }
    function deleteLevel($id) {
        $langs = array("en", "no", "se", "da");
        foreach ($langs as $lang) {
            $sql = "DELETE FROM levels_".$lang." WHERE id = $id";
            $this->db->query( $sql );
        }

        return true;
    }
    /* Programs */
    function getPrograms($lang) {

        $sql = "SELECT * FROM program_".$lang." ORDER BY id ASC";
        $result = array();
        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $result = $query->result_array();
        }

        return $result;
    }
    function getProgram($id, $lang) {

        $result = array("id"=>0,
            "program_name"=>"",
            "level_ids"=> "",
            "best_suited_for"=> "",
            "duration"=> "",
            "sessions"=> "",
            "delivered_by"=> "",
            "pre_requisites"=> "",
            "learnings"=> "",
            "fee_standard"=> "",
            "fee_siblings"=> "",
            "fee_low_income_families"=> ""
        );
        $sql = "SELECT * FROM program_".$lang." WHERE id = $id";
        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $result = $query->row_array();
        }

        return $result;
    }
    function saveProgram($program_id, $lang) {
        extract($_POST);
        $sql = "";
        $level_ids = implode(",",$ids);
        if($program_id == 0){
            $langs = array("en", "no", "se", "da");
            foreach ($langs as $sel_lang) {
                if($sel_lang == $lang){
                    $sql = "INSERT INTO program_".$sel_lang."(program_name, level_ids, best_suited_for, duration, sessions, delivered_by, pre_requisites, learnings, fee_standard, fee_siblings, fee_low_income_families) 
                    VALUES ('$program_name', '$level_ids', '$best_suited_for', '$duration', '$sessions', '$delivered_by', '$pre_requisites', '$learnings', '$fee_standard', '$fee_siblings', '$fee_low_income_families')";
                    $this->db->query( $sql );
                }else{
                    $sql = "INSERT INTO program_".$sel_lang."(program_name, level_ids, best_suited_for, duration, sessions, delivered_by, pre_requisites, learnings, fee_standard, fee_siblings, fee_low_income_families) 
                    VALUES ('$program_name', '$level_ids', '', '', '', '', '', '', '', '', '')";
                    $this->db->query( $sql );
                }
            }
            return true;
        }else{
            $sql = "UPDATE program_".$lang." SET program_name = '$program_name', level_ids = '$level_ids', best_suited_for = '$best_suited_for', duration = '$duration', sessions = '$sessions', delivered_by = '$delivered_by', pre_requisites = '$pre_requisites'
                   , learnings = '$learnings', fee_standard = '$fee_standard', fee_siblings = '$fee_siblings', fee_low_income_families = '$fee_low_income_families' WHERE id = $program_id";
        }

        if($this->db->query( $sql ) ){
            return true;
        }else{
            return false;
        }
    }
    function deleteProgram($id) {
        $langs = array("en", "no", "se", "da");
        foreach ($langs as $lang) {
            $sql = "DELETE FROM program_".$lang." WHERE id = $id";
            $this->db->query( $sql );
        }

        return true;
    }


    /* FAQs */
    function getFaqs() {

        $sql = "SELECT * FROM faqs ORDER BY id ASC";
        $result = array();
        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $result = $query->result_array();
        }
        return $result;
    }
    function getFaq($id, $lang) {

        $result = array("id"=>0, "en_faq_title"=>"", "en_description"=> "", "da_faq_title"=>"", "da_description"=> "", "se_faq_title"=>"", "se_description"=> "", "no_faq_title"=>"", "no_description"=> "");
        $sql = "SELECT * FROM faqs WHERE id = $id";
        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $result = $query->row_array();
        }
        return $result;
    }
    function saveFaq($faq_id) {
        extract($_POST);
        $sql = "";
        $description = str_replace('"', "'", $description);
        $htmlcode = $this->db->escape_str($description);
        if($faq_id == 0){
            $sql = "INSERT INTO faqs(".$sel_lang."_faq_title, ".$sel_lang."_description) 
                    VALUES ('$faq_title', '$htmlcode')";
        }else{
            $sql = "UPDATE faqs SET ".$sel_lang."_faq_title = '$faq_title', ".$sel_lang."_description = '$htmlcode' WHERE id = $faq_id";
        }
        if($this->db->query( $sql ) ){
            return true;
        }else{
            return false;
        }
    }
    function deleteFaq($id) {
        $sql = "";
        $sql = "DELETE FROM faqs WHERE id = $id";
        if($this->db->query( $sql ) ){
            return true;
        }else{
            return false;
        }
    }

    /* Home */
    function getHomeVideo() {

        $sql = "SELECT * FROM home WHERE section = 1";
        $result = array();
        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $result = $query->result_array();
        }
        return $result;
    }
    function getHomePicture() {

        $sql = "SELECT * FROM home WHERE section = 2";
        $result = array();
        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $result = $query->result_array();
        }
        return $result;
    }
    function saveHome($faq_id) {
        extract($_POST);
        $sql = "";
        $description = str_replace('"', "'", $description);
        $htmlcode = $this->db->escape_str($description);
        if($faq_id == 0){
            $sql = "INSERT INTO faqs(".$sel_lang."_faq_title, ".$sel_lang."_description) 
                    VALUES ('$faq_title', '$htmlcode')";
        }else{
            $sql = "UPDATE faqs SET ".$sel_lang."_faq_title = '$faq_title', ".$sel_lang."_description = '$htmlcode' WHERE id = $faq_id";
        }
        if($this->db->query( $sql ) ){
            return true;
        }else{
            return false;
        }
    }
    function deleteHome($id) {
        $sql = "";
        $sql = "DELETE FROM faqs WHERE id = $id";
        if($this->db->query( $sql ) ){
            return true;
        }else{
            return false;
        }
    }

    /* Orders */
    function getOrders() {

        $sql = "SELECT c.*, ab.level_name FROM orders c LEFT JOIN 
                (select a.id, b.level_name from courses_en a left join levels_en b on a.level_id = b.id) as ab
                ON c.course_id = ab.id
                ORDER BY id DESC";
        $result = array();
        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $result = $query->result_array();
        }
        return $result;
    }
    function getOrder($id) {

        $sql = "SELECT c.*, ab.level_name FROM orders c LEFT JOIN 
                (select a.id, a.address, a.date_start, a.date_end, b.level_name from courses_en a 
                left join levels_en b on a.level_id = b.id) as ab
                ON c.course_id = ab.id
                WHERE c.id = $id";

        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $result = $query->row_array();
        }
        return $result;
    }
    function deleteOrder($id) {
        $sql = "";
        $sql = "DELETE FROM orders WHERE id = $id";
        if($this->db->query( $sql ) ){
            return true;
        }else{
            return false;
        }
    }

    /* Settings */
    function getSettings() {

        $sql = "SELECT * FROM settings ORDER BY id ASC";
        $result = array();
        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $result = $query->result_array();
        }

        return $result;
    }
    function getSetting($id) {

        $result = array("id"=>0,
            "content_title"=>"",
            "en_section"=> "",
            "no_section"=> "",
            "da_section"=> "",
            "se_section"=> ""
        );
        $sql = "SELECT * FROM settings WHERE id = $id";
        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $result = $query->row_array();
        }

        return $result;
    }
    function saveSetting($setting_id, $sel_lang) {
        extract($_POST);
        $description = str_replace('"', "'", $description);
        $htmlcode = $this->db->escape_str($description);

        $sql = "UPDATE settings SET ".$sel_lang."_section = '$htmlcode' WHERE id = $setting_id";
        if($this->db->query( $sql ) ){
            return true;
        }else{
            return false;
        }
    }
    function deleteSetting($id) {
        $sql = "";
        $sql = "DELETE FROM settings WHERE id = $id";
        if($this->db->query( $sql ) ){
            return true;
        }else{
            return false;
        }
    }

    /* Courses */
    function getCourses($limit = 0, $lang = "en") {
        $sql = "";
        if($limit > 0) {
            $sql = "SELECT a.*, b.level_name as level_name FROM courses_".$lang." a LEFT JOIN levels_en b ON a.level_id = b.id ORDER BY a.c_order ASC LIMIT  $limit";
        }else{
            $sql = "SELECT a.*, b.level_name as level_name FROM courses_".$lang." a LEFT JOIN levels_en b ON a.level_id = b.id ORDER BY a.c_order ASC";
        }
        $result = array();
        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $result = $query->result_array();
        }

        return $result;
    }
    function getCourse($id,  $lang) {

        $result = array("id"=>0,
            "level_id"=>"",
            "level_name"=> "",
            "price"=> "",
            "lot"=> 0,
            "lat"=> 0,
            "address"=> "",
            "course_day"=> "",
            "date_start"=> time(),
            "date_end"=> time(),
            "time_duration"=> ""
        );
        $sql = "SELECT a.*, b.level_name as level_name FROM courses_".$lang." a LEFT JOIN levels_".$lang." b ON a.level_id = b.id WHERE a.id = $id";
        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $result = $query->row_array();
        }

        return $result;
    }
    function saveCourse($course_id, $lang) {

        extract($_POST);
        $sql = "";
        $date_start = strtotime($date_start);
        $date_end = strtotime($date_end);
        if($course_id == 0){
            $langs = array("en", "no", "se", "da");
            foreach ($langs as $sel_lang) {
                if($sel_lang == $lang){
                    $sql = "INSERT INTO courses_".$sel_lang."(level_id, lot, lat, address, date_start, date_end, course_day, price, time_duration, age_range) 
                    VALUES ('$level_id', '$lot', '$lat', '$address', '$date_start', '$date_end', '$course_day', '$price', '$time_duration', '$age_range')";
                    $this->db->query( $sql );

                }else{
                    $sql = "INSERT INTO courses_".$sel_lang."(level_id, lot, lat, address, date_start, date_end, course_day, price, time_duration, age_range) 
                    VALUES ('$level_id', '$lot', '$lat', '$address', '$date_start', '$date_end', '', '', '', '$age_range')";
                    $this->db->query( $sql );
                }
                $new_id = $this->db->insert_id();
                $this->db->update("courses_".$sel_lang, ["c_order"=>$new_id], ["id" => $new_id]);
            }
            return true;
        }else{
            $sql = "UPDATE courses_".$lang." SET level_id = '$level_id', lot = '$lot', lat = '$lat', address = '$address', date_start = '$date_start', 
            date_end = '$date_end', course_day = '$course_day', price = '$price', time_duration = '$time_duration', age_range = '$age_range' WHERE id = $course_id";
            if($this->db->query( $sql ) ){
                return true;
            }else{
                return false;
            }
        }
    }
    function deleteCourse($id) {
        $langs = array("en", "no", "se", "da");
        foreach ($langs as $lang) {
            $sql = "DELETE FROM courses_".$lang." WHERE id = $id";
            $this->db->query( $sql );
        }

        return true;
    }
    function changeSort($order, $cur_order){

        $q_cur_course = $this->db->query("SELECT * FROM courses_en WHERE c_order = ?", [$cur_order]);
        $cur_course_id = $q_cur_course->row_array()['id'];


        if($order == "up"){
            $order_sql = "SELECT IF( ISNULL(MAX(c_order)), 0, MAX(c_order)) as new_order FROM courses_en 
                          WHERE c_order < ?";
        }else{
            $order_sql = "SELECT IF( ISNULL(MIN(c_order)), 0, MIN(c_order)) as new_order FROM courses_en 
                          WHERE c_order > ?";
        }
        $q_target_order = $this->db->query($order_sql, [$cur_order]);
        if($q_target_order->num_rows() > 0){
            $target_order = $q_target_order->row_array()['new_order'];
            if($target_order == 0){
                return true;
            }else{
                foreach ($this->langs as $sel_lang) {
                    $this->db->update("courses_".$sel_lang, ["c_order" => $cur_order], ["c_order" => $target_order]);
                    $this->db->update("courses_".$sel_lang, ["c_order" => $target_order], ["id" => $cur_course_id]);
                }
                return true;
            }
        }
    }
    /* photo upload */
    function uploadPhoto($level_id) {
        if (isset($_FILES['photo'])) {

            $default = explode(".", $_FILES["photo"]["name"]);
            $extension = end($default);
            $filename = "level_".$this->generate_token(16) . "." . $extension;
            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $this->save_photo. $filename)) :
                $sql = "INSERT INTO photos(level_id, photo) VALUES ($level_id, '$filename')";
                if(!$this->db->query($sql)){
                    redirect_url("admin/level/edit/$level_id/err1");
                }
            endif;
        }

        return true;
    }
    function getPhotos($level_id) {
        $sql = "SELECT * FROM photos WHERE level_id = $level_id ORDER BY id ASC";
        $result = array();
        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $result = $query->result_array();
        }

        return $result;
    }
    function deletePhoto($photo_id) {
        $sql = "DELETE FROM photos WHERE id = $photo_id";
        if($this->db->query( $sql ) ){
            return true;
        }else{
            return false;
        }
    }

    /* picture upload */
    /* photo upload */
    function uploadPicture($section) {
        if (isset($_FILES['photo'])) {

            extract($_POST);
            $default = explode(".", $_FILES["photo"]["name"]);
            $extension = end($default);
            $filename = "home_photo_".$this->generate_token(16) . "." . $extension;
            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $this->save_photo. $filename)) :
                $sql = "INSERT INTO home(media_link, en_description, da_description, se_description, no_description, section)
                        VALUES ('$filename', '$en_description', '$da_description', '$se_description', '$no_description', $section)";
                if(!$this->db->query($sql)){
                    redirect_url("admin/home/edit/");
                }
            endif;
        }

        return true;
    }

    function uploadVideo($section) {
        if (isset($_FILES['photo'])) {

            extract($_POST);
            $default = explode(".", $_FILES["photo"]["name"]);
            $extension = end($default);
            $filename = "home_video_".$this->generate_token(16) . "." . $extension;
            $en_description = $this->db->escape_str($en_description);
            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $this->save_photo. $filename)) :
                $sql = "INSERT INTO home(media_link, video_link, en_description, da_description, se_description, no_description, section)
                        VALUES ('$filename', '$video_link', '$en_description', '$da_description', '$se_description', '$no_description', $section)";

                if(!$this->db->query($sql)){
                    redirect_url("admin/home/edit/");
                }
            endif;
        }

        return true;
    }

    function deletePicture($picture_id) {
        $sql = "DELETE FROM home WHERE id = $picture_id";
        if($this->db->query( $sql ) ){
            return true;
        }else{
            return false;
        }
    }
    /* contacts */
    function getContacts() {
        $sql = "SELECT * FROM contacts ORDER BY created DESC";
        $result = array();
        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $result = $query->result_array();
        }

        return $result;
    }
    function deleteContact($contact_id) {
        $sql = "DELETE FROM contacts WHERE id = $contact_id";
        if($this->db->query( $sql ) ){
            return true;
        }else{
            return false;
        }
    }
    /* User */
    function getUsers() {

        $sql = "SELECT * FROM users WHERE 1 ORDER BY id ASC";
        $result = array();
        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $result = $query->result_array();
        }
        return $result;
    }
    function getUser($id) {

        $result = array("id"=>0, "username"=>"", "email"=> "");
        $sql = "SELECT * FROM users WHERE id = $id";
        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $result = $query->row_array();
        }
        return $result;
    }
    function saveUser($user_id) {
        extract($_POST);
        $sql = "";
        $now = time();
        if($user_id == 0){
            $sql = "INSERT INTO users(username, email, password, permission, created) 
                    VALUES ('$username', '$email', '".md5($password)."', 3, '$now')";
        }else{
            $sql = "UPDATE users SET username = '$username', email = '$email' WHERE id = $user_id";
        }

        if($this->db->query( $sql ) ){
            return true;
        }else{
            return false;
        }
    }
    function change_password($user_id) {
        extract($_POST);
        $user = $this->getUser($user_id);
        if(md5($old_password) != $user['password']){
            return "old password is not correct.";
        }else{
            $sql = "UPDATE users SET password = '".md5($npassword)."'WHERE id = $user_id";

            if($this->db->query( $sql ) ){
                return "";
            }else{
                return "database error";
            }
        }

    }
    function deleteUser($id) {
        $sql = "";
        $sql = "DELETE FROM users WHERE id = $id";
        if($this->db->query( $sql ) ){
            return true;
        }else{
            return false;
        }
    }

    /*********************************** mobile app *****************************************/
    /* Levels */
    function getLessons($level_id = 0) {

        $sql = "SELECT a.*, b.level_name FROM _lessons as a
                LEFT JOIN levels_en b
                ON a.level_id = b.id
                ORDER BY a.level_id, a.id ASC";
        if($level_id > 0) {
            $sql = "SELECT a.*, b.level_name FROM _lessons as a
                    LEFT JOIN levels_en b
                    ON a.level_id = b.id
                    WHERE a.level_id = $level_id
                    ORDER BY a.id ASC";
        }
        
        $result = array();
        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $result = $query->result_array();
        }

        return $result;
    }
    function getLesson($id) {

        $result = array(
            "id"=>0, 
            "lesson_name"=>"", 
            "lesson_description"=> ""
        );
        if($id > 0) {
            $sql = "SELECT * FROM _lessons WHERE id = $id";
            $query = $this->db->query( $sql );
            if($query->num_rows() > 0){
                $result = $query->row_array();
            }
        }

        return $result;
    }
    function saveLesson($lesson_id) {
        extract($_POST);
        if($lesson_id == 0){
            $sql_insert = "INSERT INTO _lessons(level_id, lesson_name, lesson_description) 
                    VALUES ('$level_id', '$lesson_name', '$lesson_description')";
            $this->db->query( $sql_insert );
            $new_id = $this->db->insert_id();
            return true;
        }else{
            $sql = "UPDATE _lessons SET level_id=$level_id, lesson_name = '$lesson_name', lesson_description = '$lesson_description' WHERE id = $lesson_id";
            if($this->db->query( $sql ) ){
                return true;
            }else{
                return false;
            }
        }

    }
    function deleteLesson($id) {
        $sql = "DELETE FROM _lessons WHERE id = $id";
        $this->db->query( $sql );

        return true;
    }
    /* Exercise Types */
    function getExercise_types() {

        $sql = "SELECT a.* FROM _exercise_types as a
                ORDER BY a.id ASC";
        $result = array();
        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $result = $query->result_array();
        }

        return $result;
    }
    function getExercise_type($id) {

        $result = array(
            "id"=>0, 
            "type_name"=>"", 
            "type_description"=> ""
        );
        if($id > 0) {
            $sql = "SELECT * FROM _exercise_types WHERE id = $id";
            $query = $this->db->query( $sql );
            if($query->num_rows() > 0){
                $result = $query->row_array();
            }
        }

        return $result;
    }
    function saveExercise_type($type_id) {
        extract($_POST);
        if($type_id == 0){
            $sql_insert = "INSERT INTO _exercise_types(type_name, type_description) 
                    VALUES ('$type_name', '$type_description')";
            $this->db->query( $sql_insert );
            $new_id = $this->db->insert_id();
            return true;
        }else{
            $sql = "UPDATE _exercise_types SET type_name = '$type_name', type_description = '$type_description' WHERE id = $type_id";
            if($this->db->query( $sql ) ){
                return true;
            }else{
                return false;
            }
        }

    }
    function deleteexercise_type($id) {
        $sql = "DELETE FROM _exercise_types WHERE id = $id";
        $this->db->query( $sql );

        return true;
    }
    /* Images */
    function getImages() {

        $sql = "SELECT a.* FROM _images as a
                ORDER BY a.id ASC";
        $result = array();
        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $result = $query->result_array();
        }

        return $result;
    }
    function getImage($id) {
        $result = array(
            "id"=>0, 
            "url"=>"", 
            "tags"=> ""
        );
        if($id > 0) {
            $sql = "SELECT * FROM _images WHERE id = $id";
            $query = $this->db->query( $sql );
            if($query->num_rows() > 0){
                $result = $query->row_array();
            }
        }

        return $result;
    }
    function saveImage($image_id) {
        extract($_POST);
        $ex_tags_str = "";
        if(count($ex_tags) > 0) {
            // update tags
            foreach($ex_tags as $ex_tag) {
                $sql = "SELECT * FROM _tags WHERE tag_name ='$ex_tag'";
                $query = $this->db->query( $sql );
                if($query->num_rows() > 0){
                    // already exist 
                }else{
                    // add tag
                    $this->db->query( "INSERT INTO _tags(tag_name) VALUES ('$ex_tag')" );
                }
            }
            $ex_tags_str = implode(",", $ex_tags);
        }

        if($image_id == 0){
            $sql_insert = "INSERT INTO _images(url, tags) 
                    VALUES (?, ?)";
            $this->db->query( $sql_insert, [$url, $ex_tags_str] );
            $image_id = $this->db->insert_id();
        }else{
            $data = [
                'url' => $url,
                'tags' => $ex_tags_str
            ];
            $this->db->update('_images', $data, ['id'=>$image_id]);
        }
        if (isset($_FILES['photo'])) {
            $default = explode(".", $_FILES["photo"]["name"]);
            $extension = end($default);
            $filename = "ex_image_".$this->generate_token(8) . "." . $extension;
            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $this->save_ex_photo. $filename)) :
                $this->db->update('_images', ['url'=> $filename], ['id'=>$image_id]);
            endif;
        }
        return true;
    }
    function deleteImage($id) {
        $sql = "DELETE FROM _images WHERE id = $id";
        $this->db->query( $sql );

        return true;
    }

    /* Tags */
    function getTags() {

        $result = array();
        $sql = "SELECT * FROM _tags ORDER BY tag_name ASC";
        $result = array();
        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $result = $query->result_array();
        }
        return $result;
    }

    function getTag($tag_id){
        $cur_tag_name = '';
        if($tag_id > 0) {
            $q_cur_tag = $this->db->query("SELECT * FROM _tags WHERE id = ?", [$tag_id]);
            $cur_tag_name = $q_cur_tag->row_array()['tag_name'];
        }
        return $cur_tag_name;
    }

    function getTagIdByName() {
        $result = [];
        $tags = $this->getTags();
        foreach($tags as $row) {
            $result[$row['tag_name']] = $row['id'];
        }
        return $result;
    }

    /* Exercise */
    function getExercises($level_id = 0, $lesson_id = 0) {

        $result = array();
        if($level_id > 0 && $lesson_id > 0) {
            $sql = "SELECT a.*, b.level_name, c.lesson_name 
                    FROM _exercises a
                    LEFT JOIN levels_en b ON a.level_id = b.id
                    LEFT JOIN _lessons c ON a.lesson_id = c.id
                    WHERE a.level_id = $level_id AND a.lesson_id = $lesson_id ORDER BY a.ex_order ASC";
            $result = array();
            $query = $this->db->query( $sql );
            if($query->num_rows() > 0){
                $result = $query->result_array();
            }
        }

        return $result;
    }
    function getExercise($id) {
        $result = array(
            "id"=>0, 
            "level_id"=>0, 
            "lesson_id"=>0, 
            "exercise_type"=> "HTML",
            "ex_order"=>0, 
            "ex_tags"=> "",
            "ex_name"=> "",
            "ex_description"=> "",
            "ex_time"=>1, 
            "ex_content"=>"", 
        );
        if($id > 0) {
            $sql = "SELECT * FROM _exercises WHERE id = $id";
            $query = $this->db->query( $sql );
            if($query->num_rows() > 0){
                $result = $query->row_array();
            }
        }

        return $result;
    }
    function saveExercise($level_id, $lesson_id, $exercise_id) {
        extract($_POST);
        $ex_content = "";
        if(strToLower($sel_type) == 'html') {
            $ex_content_html = str_replace('"', "'", $ex_content_html);
            $ex_content = $this->db->escape_str($ex_content_html);
        } else if(strToLower($sel_type) == 'video') {
            $ex_content = $this->db->escape_str($ex_content_video);
        } else if(strToLower($sel_type) == 'game1') {
            $ex_content = $this->db->escape_str($ex_content_game1);
        }
        $ex_tags_str= "";
        if(count($ex_tags) > 0) {
            // update tags
            foreach($ex_tags as $ex_tag) {
                $sql = "SELECT * FROM _tags WHERE tag_name ='$ex_tag'";
                $query = $this->db->query( $sql );
                if($query->num_rows() > 0){
                    // already exist 
                }else{
                    // add tag
                    $this->db->query( "INSERT INTO _tags(tag_name) VALUES ('$ex_tag')" );
                }
            }
            $ex_tags_str = implode(",", $ex_tags);
        }
        
        if($exercise_id == 0){
            $sql_insert = "INSERT INTO _exercises(level_id, lesson_id, exercise_type, ex_tags, ex_name, ex_description, ex_time, ex_content) 
                    VALUES ($level_id, $lesson_id, '$sel_type', '$ex_tags_str', '$ex_name', '$ex_description', $ex_time,'$ex_content')";
            $this->db->query( $sql_insert );
            $new_id = $this->db->insert_id();
            $this->db->update('_exercises', ['ex_order'=> $new_id], ['id' => $new_id]);
            return true;
        }else{
            $sql = "UPDATE _exercises SET exercise_type = '$sel_type', ex_tags = '$ex_tags_str', 
                    ex_name = '$ex_name', ex_description = '$ex_description', ex_time = $ex_time, ex_content = '$ex_content'  WHERE id = $exercise_id";
            if($this->db->query( $sql ) ){
                return true;
            }else{
                return false;
            }
        }

    }
    function deleteExercise($id) {
        $sql = "DELETE FROM _exercises WHERE id = $id";
        $this->db->query( $sql );

        return true;
    }
    function changeExerciseSort($order, $cur_order){

        $q_cur_ex = $this->db->query("SELECT * FROM _exercises WHERE ex_order = ?", [$cur_order]);
        $cur_ex_id = $q_cur_ex->row_array()['id'];

        if($order == "up"){
            $order_sql = "SELECT IF( ISNULL(MAX(ex_order)), 0, MAX(ex_order)) as new_order FROM _exercises 
                          WHERE ex_order < ?";
        }else{
            $order_sql = "SELECT IF( ISNULL(MIN(ex_order)), 0, MIN(ex_order)) as new_order FROM _exercises 
                          WHERE ex_order > ?";
        }
        $q_target_order = $this->db->query($order_sql, [$cur_order]);
        if($q_target_order->num_rows() > 0){
            $target_order = $q_target_order->row_array()['new_order'];
            if($target_order == 0){
                return true;
            }else{
                $this->db->update("_exercises", ["ex_order" => $cur_order], ["ex_order" => $target_order]);
                $this->db->update("_exercises", ["ex_order" => $target_order], ["id" => $cur_ex_id]);
                return true;
            }
        }
    }

    /* exerciseByTag */
    function getExerciseByTag($tag_id = 0) {
        $result = array();
        if($tag_id > 0) {
            $q_cur_tag = $this->db->query("SELECT * FROM _tags WHERE id = ?", [$tag_id]);
            $cur_tag_name = $q_cur_tag->row_array()['tag_name'];
            $sql = "SELECT a.*, b.level_name, c.lesson_name 
                    FROM _exercises a
                    LEFT JOIN levels_en b ON a.level_id = b.id
                    LEFT JOIN _lessons c ON a.lesson_id = c.id
                    WHERE a.ex_tags LIKE '%$cur_tag_name' OR a.ex_tags LIKE '$cur_tag_name' OR a.ex_tags LIKE '$cur_tag_name%' ";
            
            $result = array();
            $query = $this->db->query( $sql );
            if($query->num_rows() > 0){
                $result = $query->result_array();
            }
        }

        return $result;
    }

    /* Teachers */
    function getTeachers($level_id = 0) {

        $sql = "SELECT a.*, b.level_name FROM _teachers as a
                LEFT JOIN levels_en b
                ON a.level_id = b.id
                ORDER BY a.level_id, a.id ASC";
        if($level_id > 0) {
            $sql = "SELECT a.*, b.level_name FROM _teachers as a
                    LEFT JOIN levels_en b
                    ON a.level_id = b.id
                    WHERE a.level_id = $level_id
                    ORDER BY a.id ASC";
        }
        
        $result = array();
        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $result = $query->result_array();
        }

        return $result;
    }
    function getTeacher($id) {

        $result = array(
            "id"=>0, 
            "lesson_id"=>0, 
            "first_name"=> "",
            "last_name"=> "",
            "email"=> "",
            "phone"=> "",
        );
        if($id > 0) {
            $sql = "SELECT * FROM _teachers WHERE id = $id";
            $query = $this->db->query( $sql );
            if($query->num_rows() > 0){
                $result = $query->row_array();
            }
        }

        return $result;
    }
    function saveTeacher($teacher_id) {
        extract($_POST);
        if($teacher_id == 0){
            $sql_insert = "INSERT INTO _teachers(level_id, first_name, last_name, email, phone) 
                    VALUES ('$level_id', '$first_name', '$last_name', '$email', '$phone')";
            $this->db->query( $sql_insert );
            $new_id = $this->db->insert_id();
            return true;
        }else{
            $sql = "UPDATE _teachers SET level_id=$level_id, first_name = '$first_name', last_name = '$last_name', email = '$email', phone = '$phone' WHERE id = $teacher_id";
            if($this->db->query( $sql ) ){
                return true;
            }else{
                return false;
            }
        }

    }
    function deleteTeacher($id) {
        $sql = "DELETE FROM _teachers WHERE id = $id";
        $this->db->query( $sql );

        return true;
    }

    /* classrooms */
    function getClassrooms() {
        $sql = "SELECT a.*, b.level_name 
                FROM _classrooms as a
                LEFT JOIN levels_en b ON a.level_id = b.id
                ORDER BY a.level_id, a.id ASC";
        $result = array();
        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $data = $query->result_array();
            $classrooms = [];
            $classroom_id = 0;
            $teacher = "";
            $level_id = 0;
            $level_name = "";
            $course_id = "";
            $student_ct = 0;
            foreach($data as $row) {
                if(in_array($row['c_id'], $classrooms)){
                    $classroom_id = $row['c_id'];
                    if($row['member_type'] == 'teacher') $teacher =  $row['first_name']." ".$row['last_name'];
                    $level_id = $row['level_id'];
                    $level_name = $row['level_name'];
                    $course_id = $row['course_id'];
                    if($row['member_type'] == 'student') $student_ct ++;
                }else{ // new classroom
                    if($classroom_id != 0){ // add classroom data into result
                        $result[] = ['c_id' => $classroom_id, "level_id"=>$level_id, "level_name"=>$level_name, "course_id"=>$course_id, "teacher"=>$teacher, "student_ct"=>$student_ct];
                        $classroom_id = 0;
                        $teacher = "";
                        $level_id = 0;
                        $level_name = "";
                        $course_id = "";
                        $student_ct = 0;
                    }
                    $classrooms[] = $row['c_id'];
                    $classroom_id = $row['c_id'];
                    if($row['member_type'] == 'teacher') $teacher =  $row['first_name']." ".$row['last_name'];
                    $level_id = $row['level_id'];
                    $level_name = $row['level_name'];
                    $course_id = $row['course_id'];
                    if($row['member_type'] == 'student') $student_ct ++;
                }
            }
            if($classroom_id != 0){ // add classroom data into result
                $result[] = ['c_id' => $classroom_id, "level_id"=>$level_id, "level_name"=>$level_name, "teacher"=>$teacher, "course_id"=>$course_id, "student_ct"=>$student_ct];
            }

        }
        return $result;
    }

    function getCoursesByLevelID($level_id){
        if($level_id ==0) {
            return [];
        }else{
            $sql = "SELECT a.id FROM courses_en a WHERE a.level_id = $level_id ORDER BY a.c_order ASC";
            $result = array();
            $query = $this->db->query( $sql );
            if($query->num_rows() > 0){
                $result = $query->result_array();
            }
            return $result;
        }
    }
    function getClassroomTeacher($classroom_id) {
        $result = [];
        if($classroom_id > 0) {
            $sql = "SELECT CONCAT(first_name,' ',last_name) as username, email, relation_id FROM _classrooms WHERE c_id = $classroom_id AND member_type = 'teacher'";
            $query = $this->db->query( $sql );
            if($query->num_rows() > 0){
                $result = $query->result_array();
            }
        }
        return $result;
    }
    function getClassroomStudents($classroom_id) {
        $result = [];
        if($classroom_id > 0) {
            $sql = "SELECT CONCAT(first_name,' ',last_name) as username, email, relation_id FROM _classrooms WHERE c_id = $classroom_id AND member_type = 'student'";
            $query = $this->db->query( $sql );
            if($query->num_rows() > 0){
                $result = $query->result_array();
            }
        }
        return $result;
    }
    function getSuggestionTeachers($level_id, $teacher){
        $result = [];
        if($level_id > 0) {
            $add_query = "";
            $teacher_ids = $this->make_in($teacher, 'relation_id');
            $add_query = "";
            if($teacher_ids) $add_query = " AND id NOT IN $teacher_ids";
            $sql = "SELECT * FROM _teachers WHERE level_id = $level_id".$add_query;
            $query = $this->db->query( $sql );
            if($query->num_rows() > 0){
                $result = $query->result_array();
            }
        }
        return $result;
    }
    function getSuggestionStudents($level_id, $students){
        $result = [];
        if($level_id > 0) {
            $student_ids = $this->make_in($students, 'relation_id');
            $add_query = "";
            if($student_ids) $add_query = " AND id NOT IN $student_ids";
            $sql = "SELECT * FROM orders WHERE state=1 AND is_student=0 AND cfirst_name <> '' ".$add_query;
            $query = $this->db->query( $sql );
            if($query->num_rows() > 0){
                $result = $query->result_array();
            }
        }
        return $result;
    }
    function getNewClassroomID(){
        $query = $this->db->query( "SELECT IF(ISNULL(MAX(c_id)), 1, MAX(c_id)) as c_id FROM _classrooms" );
        if($query->num_rows() > 0){
            $result = $query->row_array();
            return $result['c_id'];
        }else{
            return 1; // first classroom
        }
    }
    function addTeacherIntoClassroom($teacher_id, $classroom_id, $level_id, $course_id){
        // is existing teacher ?
        $sql = "SELECT * FROM _classrooms WHERE member_type='teacher' AND relation_id = ? AND c_id=? LIMIT 1";
        $query = $this->db->query( $sql, [$teacher_id, $classroom_id] );
        if($query->num_rows() > 0){
            $teacher = $query->row_array();
            if($teacher['level_id'] == $level_id && $teacher['course_id'] == $course_id ){
                return true;
            }else{
                // update level and course
                $this->db->update('_classrooms', ["level_id"=> $level_id, "course_id"=> $course_id]);
                return true;
            }
        }else{
            // update orders table
            // add teacher
            $query = $this->db->query( "SELECT * FROM _teachers WHERE id = ? LIMIT 1", [$teacher_id] );
            if($query->num_rows() > 0){
                $teacher = $query->row_array();
                $data = [
                    "c_id"=> $classroom_id,
                    "level_id"=> $level_id,
                    "course_id"=> $course_id,
                    "member_type"=> "teacher",
                    "first_name"=> $teacher['first_name'],
                    "last_name"=> $teacher['last_name'],
                    "email"=> $teacher['email'],
                    "phone"=> $teacher['phone'],
                    "relation_id"=> $teacher_id
                ];
                $this->db->insert('_classrooms', $data);
                return true;
            }else{
                return false;
            }
        }
    }
    function addStudentIntoClassroom($student_id, $classroom_id, $level_id, $course_id){
        // is existing student ?
        $sql = "SELECT * FROM _classrooms WHERE member_type='student' AND relation_id = ? AND c_id=? LIMIT 1";
        $query = $this->db->query( $sql, [$student_id, $classroom_id] );
        if($query->num_rows() > 0){
            $student = $query->row_array();
            if($student['level_id'] == $level_id && $student['course_id'] == $course_id ){
                return true;
            }else{
                // update level and course
                $this->db->update('_classrooms', ["level_id"=> $level_id, "course_id"=> $course_id]);
                return true;
            }
        }else{
            // add student
            $query = $this->db->query( "SELECT * FROM orders WHERE id = ? LIMIT 1", [$student_id] );
            if($query->num_rows() > 0){
                // update orders table
                $this->db->update('orders', ["is_student"=>1], ['id'=>$student_id]);
                $student = $query->row_array();
                $data = [
                    "c_id"=> $classroom_id,
                    "level_id"=> $level_id,
                    "course_id"=> $course_id,
                    "member_type"=> "student",
                    "first_name"=> $student['cfirst_name'],
                    "last_name"=> $student['csurname'],
                    "email"=> $student['email'],
                    "phone"=> $student['phone'],
                    "relation_id"=> $student_id,
                    "dob"=> $student['dob'],
                    "address"=> $student['address'],
                    "post_code"=> $student['post_code'],
                    "city"=> $student['city'],
                    "country"=> $student['country'],
                    "gender"=> $student['cgender'] == 1 ? 'male' : 'female',
                    "school"=> $student['cschool'],
                    "parent_fname"=> $student['first_name'],
                    "parent_lname"=> $student['surname']
                ];
                $this->db->insert('_classrooms', $data);
                return true;
            }else{
                return false;
            }
        }
    }
    function saveClassroom($classroom_id) {
        extract($_POST);
        if($classroom_id == 0){
            $classroom_id = $this->getNewClassroomID();
        }
        $arr_teacher = $teacher_ids=="" ? [] : explode(",", $teacher_ids);
        $arr_students = $students_ids=="" ? [] : explode(",", $students_ids);
        if(count($arr_teacher)) {
            foreach($arr_teacher as $t){
                $this->addTeacherIntoClassroom($t, $classroom_id, $sel_level, $sel_course);
            }
        }
        if(count($arr_students)) {
            foreach($arr_students as $t){
                $this->addStudentIntoClassroom($t, $classroom_id, $sel_level, $sel_course);
            }
        }
        return true;
    }
    function deleteClassroom($id) {
        // $sql = "DELETE FROM _classrooms WHERE id = $id";
        // $this->db->query( $sql );

        return true;
    }
}
