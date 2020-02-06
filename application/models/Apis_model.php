<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Apis_model extends CI_Model
{

    public  $lang = "en";
    private $week_day = array("0"=>"", "1"=>"Monday", "2"=>"Tuesday","3"=>"Wednesday","4"=>"Thursday","5"=>"Friday","6"=>"Saturday","7"=>"Sunday");
    function __construct() {
        parent::__construct();
        $this->load->library('functions');
        $this->lang = $this->session->userdata("lang");

    }
    function getPrograms() {

        $sql = "SELECT * FROM program_".$this->lang." ORDER BY id ASC";

        $result = array();
        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $result = $query->result_array();
        }
        return $result;
    }

    function make_arr($arr, $key){
        $result = array();
        foreach ($arr as $row){
            $result[$row[$key]] = $row;
        }
        return $result;
    }

    function getLevels($level_id = 0) {

        $sql = "";
        if($level_id == 0)
            $sql = "SELECT * FROM levels_".$this->lang." ORDER BY id ASC";
        else
            $sql = "SELECT * FROM levels_".$this->lang." WHERE id = $level_id ORDER BY id ASC";

        $result = array();
        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $result = $query->result_array();
        }

        return $result;
    }

    function getCourseAddresses() {

        $sql = "SELECT address FROM courses_".$this->lang." GROUP BY address";
        $result = array();
        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $result = $query->result_array();
        }

        return $result;
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
    function getAllImages($sort = "level_id") {
        $sql = "SELECT * FROM photos ORDER BY $sort ASC";
        $result = array();
        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $result = $query->result_array();
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
    function getPrevLevel($level_id) {
        $sql = "SELECT a.*, b.photo FROM levels_".$this->lang." a LEFT JOIN photos b ON a.id = b.level_id  WHERE a.id = (SELECT prev_level FROM levels_".$this->lang." WHERE id = $level_id) GROUP BY a.id";
        $result = array();
        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $result = $query->row_array();
        }

        return $result;
    }
    function getNextLevel($level_id) {
        $sql = "SELECT a.*, b.photo FROM levels_".$this->lang." a LEFT JOIN photos b ON a.id = b.level_id  WHERE a.id = (SELECT next_level FROM levels_".$this->lang." WHERE id = $level_id) GROUP BY a.id";
        $result = array();
        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $result = $query->row_array();
        }

        return $result;
    }
    function getFaqs() {

        $sql = "SELECT * FROM faqs ORDER BY id ASC";
        $result = array();
        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $result = $query->result_array();
        }

        return $result;
    }
    public function save_contact($category="", $customer_name="", $email="", $about_us="", $comment="") {
        if($category == "") return false;
        $now = time();
        $sql = "INSERT INTO contacts(category, customer_name, email, about_us, comment, created) 
                    VALUES ('$category', '$customer_name', '$email', '$about_us', ".$this->db->escape($comment).", '$now')";

        /* make email body */
        $to = EMAIL_SERVER;//"bluedreampro2017@gmail.com";
        $subject = "UCMAS Contact US";
        if($this->lang == 'no'){
            $subject = "UCMAS Kontaktforespørsel";
        }

        $message = "<h1>$subject</h1></br></br>";
        $message .= "<h3>request time : ".date('d M Y h:i:A', $now)."</h3>";
        $message .= '<table>';
        if($this->lang == 'en'){
            $message .= '<tr><td colspan="2" style="text-align: center"> UCMAS Contact Information </td></tr>';
        }elseif($this->lang == 'no'){
            $message .= '<tr><td colspan="2" style="text-align: center"> UCMAS kontaktinformasjon mottatt </td></tr>';
        }

        $message .= '<tr><td style="font-weight: bold;">Subject of the email</td><td>'.$category.'</td></tr>';
        $message .= '<tr><td style="font-weight: bold;">Customer Name</td><td>'.$customer_name.'</td></tr>';
        $message .= '<tr><td style="font-weight: bold;">Email</td><td>'.$email.'</td></tr>';
        $message .= '<tr><td style="font-weight: bold;">About US</td><td>'.$about_us.'</td></tr>';
        $message .= '<tr><td style="font-weight: bold;">Comment</td><td>'.$comment.'</td></tr>';
        $message .= '</table>';

        if($this->db->query( $sql ) ){
            return $this->send_mail($to, $category, $message, $email, 0);
        }else{
            return false;
        }
    }
    public function send_mail($to , $subject, $message, $email, $is_register){

        $config = Array(
            'protocol' => EMAIL_PROTOCOL,
            'smtp_host' => EMAIL_SMTP_HOST,
            'smtp_port' => EMAIL_SMTP_PORT,
            'smtp_user' => EMAIL_SMTP_USER,
            'smtp_pass' => EMAIL_SMTP_PASS,
            'charset'   => EMAIL_CHARSET,
            'wordwrap'=> EMAIL_WORDWRAP,
            'mailtype' => EMAIL_MAILTYPE
        );

        $config['newline']    = "\r\n";
       $this->load->library('email');

        $message = "<html><head></head><body>".$message."</body></html>";
        $this->email->to($to);
        $this->email->bcc($email);
        $this->email->from($email, "UCMAS Contact Information");
        $this->email->subject($subject);
        $this->email->message($message);

        if($this->email->send())
        {
            return true;
        }
        else
        {
            return false; //show_error($this->email->print_debugger());
        }

/*
        try {
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "From: < ".$email.">";

            if(mail($to, $subject, $message, $headers)){
                return true;
            }else{
                return false;
            }

            $message = "<html><head></head><body>".$message."</body></html>";
            if(mail($to, $subject, $message, $headers)){
                return true;
            }else{
                return false;
            }

        }
        catch (Exception $e)
        {
            return false;
        }
        */

    }

    function save_order($course_id){
        extract($_POST);
        $birthday = "";
        $dob = "";
        if($_POST['c_year'] != 0 && $_POST['c_month']!= 0 && $_POST['c_day']!= 0){
            $dob = $c_year."-".sprintf("%02d",$c_month)."-".sprintf("%02d",$c_day);
            error_log("child_birthday : $c_year - $c_month - $c_day");
//            $birthday = date('S F Y', strtotime($dob));
        }

        $newsletter = isset($newsletter) ? $newsletter : 0;
        $now = time();
        $sql = "INSERT INTO orders(course_id, first_name, surname, address, post_code, city, country, phone, email, cfirst_name, csurname,
                cgender, dob, cschool, sel_hear, comments, newsletter, created, state, course_fee )
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $params = [$course_id, $first_name, $surname, $address, $post_code, $city, $country, $phone, $email, $cfirst_name, 
                    $csurname, $cgender, $dob, $cschool, $sel_hear, $comments, $newsletter, $now, $is_register, $course_fee];

        $courses = $this->getCourses($course_id);
        $payload = array(
            "course_id" => $course_id,
            "first_name" =>$first_name,
            "surname" => $surname,
            "address" => $address,
            "post_code" => $post_code,
            "city" => $city,
            "country" => $country,
            "phone" => $phone,
            "email" => $email,
            "cfirst_name" => $cfirst_name,
            "csurname" => $csurname,
            "cgender" => $cgender,
            "dob" => $dob,
            "cschool" => $cschool,
            "sel_hear" => $sel_hear,
            "comments" => $comments,
            "newsletter" => $newsletter,
            "now" => $now,
            "is_register" => $is_register,
            "course_fee" => $course_fee,
            "courses" => $courses[0]

        );
        /* make email body */

        $subject = "";
        $is_register == '1' ? $subject = "UCMAS registration request" : $subject = "UCMAS contact request";
        if($this->lang == 'no'){
            $is_register == '1' ? $subject = "UCMAS Registreringbekreftelse" : $subject = "UCMAS Kontaktforespørsel";
        }

        if($this->db->query( $sql, $params ) ){
            return $this->functions->send_mail($email, $subject, $payload, $this->lang);
//            return $this->send_mail($to, $subject, $message);
        }else{
            return false;
        }
    }
    function getJsonCourses($course_id = 0) {

        if ($course_id > 0)
            $sql = "SELECT a.address,a.id, a.lot, a.lat, b.level_name as level_name FROM courses_".$this->lang." a LEFT JOIN levels_".$this->lang." b ON a.level_id = b.id WHERE a.id = $course_id AND a.level_id in (SELECT id FROM levels_".$this->lang." WHERE is_visible = 1) ORDER BY a.c_order ASC ";
        else{
            $sql = "SELECT a.address,a.id, a.lot, a.lat, b.level_name as level_name FROM courses_".$this->lang." a LEFT JOIN levels_".$this->lang." b ON a.level_id = b.id WHERE a.level_id in (SELECT id FROM levels_".$this->lang." WHERE is_visible = 1) ORDER BY a.c_order ASC ";
        }
        $result = array();
        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $result = $query->result_array();
        }

        return $result;
    }
    function getJsonCoursesByLevel($level_id) {

        $sql = "SELECT a.address,a.id, a.lot, a.lat, b.level_name as level_name FROM courses_".$this->lang." a LEFT JOIN levels_".$this->lang." b ON a.level_id = b.id 
                WHERE a.level_id = $level_id AND a.level_id in (SELECT id FROM levels_".$this->lang." WHERE is_visible = 1) ORDER BY a.c_order ASC ";
        $result = array();
        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $result = $query->result_array();
        }

        return $result;
    }
    function getJsonCoursesByForm() {

        extract($_POST);
        $add_query = "";
        if($level > 0){
            $add_query = " and a.level_id = $level";
        }
        $sql = "SELECT a.address,a.id, a.lot, a.lat, b.level_name as level_name FROM courses_".$this->lang." a LEFT JOIN levels_".$this->lang." b ON a.level_id = b.id 
                WHERE
                 a.level_id in (SELECT id FROM levels_".$this->lang." WHERE is_visible = 1) AND
                 a.id in (
                              SELECT course_id
                                FROM (SELECT id as course_id,
                                      ( 6371 * ACOS( COS( RADIANS('".$lat."') )
                                      * COS( RADIANS( lat ) )
                                      * COS( RADIANS( lot ) - RADIANS('".$lot."') )
                                      + SIN( RADIANS('".$lat."') )
                                      * SIN( RADIANS( lat ) ) ) ) AS distance
                                    FROM courses_".$this->lang." ) tbl
                                WHERE tbl.distance < $radius
                            ) $add_query ORDER BY a.c_order ASC ";
        $result = array();
        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $result = $query->result_array();
        }

        return $result;
    }
    function getJsonCoursesByLocation($lat, $lot) {

        $sql = "SELECT a.*, b.level_name as level_name FROM courses_".$this->lang." a 
                LEFT JOIN levels_".$this->lang." b ON a.level_id = b.id 
                WHERE a.lot = ? AND a.lat = ? AND  a.level_id in (SELECT id FROM levels_".$this->lang." WHERE is_visible = 1)
                ORDER BY a.c_order ASC ";
        $result = array();
        $query = $this->db->query( $sql, [$lot, $lat] );
        if($query->num_rows() > 0){
            $result = $query->result_array();
        }

        return $result;
    }
    function getCourses($course_id = 0) {

        if ($course_id > 0)
            $sql = "SELECT a.*, b.level_name as level_name FROM courses_".$this->lang." a LEFT JOIN levels_".$this->lang." b ON a.level_id = b.id 
            WHERE a.id = $course_id AND  a.level_id in (SELECT id FROM levels_".$this->lang." WHERE is_visible = 1)
            ORDER BY a.c_order ASC ";
        else{
            $sql = "SELECT a.*, b.level_name as level_name FROM courses_".$this->lang." a LEFT JOIN levels_".$this->lang." b ON a.level_id = b.id 
            WHERE  a.level_id in (SELECT id FROM levels_".$this->lang." WHERE is_visible = 1)
            ORDER BY a.c_order ASC ";
        }
        $result = array();
        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $result = $query->result_array();
        }

        return $result;
    }
    function getCoursesByLevel($level_id = 0) {

        $sql = "SELECT a.*, b.level_name as level_name FROM courses_".$this->lang." a LEFT JOIN levels_".$this->lang." b ON a.level_id = b.id 
        WHERE a.level_id = $level_id AND  a.level_id in (SELECT id FROM levels_".$this->lang." WHERE is_visible = 1)
        ORDER BY a.c_order ASC ";
        $result = array();
        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $result = $query->result_array();
        }

        return $result;
    }
    function getCoursesByForm() {

        extract($_POST);
        $add_query = "";
        if($level > 0){
            $add_query = " and a.level_id = $level";
        }
        $sql = "SELECT a.*, b.level_name as level_name FROM courses_".$this->lang." a LEFT JOIN levels_".$this->lang." b ON a.level_id = b.id 
                WHERE   a.level_id in (SELECT id FROM levels_".$this->lang." WHERE is_visible = 1) AND a.id in (
                              SELECT course_id
                                FROM (SELECT id as course_id,
                                      ( 6371 * ACOS( COS( RADIANS('".$lat."') )
                                      * COS( RADIANS( lat ) )
                                      * COS( RADIANS( lot ) - RADIANS('".$lot."') )
                                      + SIN( RADIANS('".$lat."') )
                                      * SIN( RADIANS( lat ) ) ) ) AS distance
                                    FROM courses_".$this->lang." ) tbl
                                WHERE tbl.distance < $radius
                            ) $add_query ORDER BY a.c_order ASC ";
//        echo $sql;exit;
        $result = array();
        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $result = $query->result_array();
        }

        return $result;
    }

    function getCoursesByCustomForm() {

        extract($_POST);
        $add_query = "";
        if(isset($_POST['sel_level']) && $sel_level > 0){
            $add_query .= " and a.level_id = ".$sel_level;
        }
        if(isset($_POST['sel_age_range']) && $_POST['sel_age_range'] != "" ) {
            $add_query .= " and a.age_range = $sel_age_range";
        }
        if(isset($_POST['sel_address'])) {
            $add_query .= " and a.address = '$sel_address'";
        }

        $sql = "SELECT a.*, b.level_name as level_name FROM courses_".$this->lang." a LEFT JOIN levels_".$this->lang." b ON a.level_id = b.id 
                WHERE  a.level_id in (SELECT id FROM levels_".$this->lang." WHERE is_visible = 1) $add_query ORDER BY a.c_order ASC ";

        $result = array();
        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $result = $query->result_array();
        }

        return $result;
    }

    function getJsonCoursesByCustomForm() {
        extract($_POST);
        $add_query = "";
        if(isset($_POST['sel_level']) && $sel_level > 0){
            $add_query .= " and a.level_id = ".$sel_level;
        }
        if(isset($_POST['sel_age_range']) && $_POST['sel_age_range'] != "" ) {
            $add_query .= " and a.age_range = $sel_age_range";
        }
        if(isset($_POST['sel_address'])) {
            $add_query .= " and a.address = '$sel_address'";
        }

        $sql = "SELECT a.address,a.id, a.lot, a.lat, b.level_name as level_name FROM courses_".$this->lang." a LEFT JOIN levels_".$this->lang." b ON a.level_id = b.id 
                WHERE  a.level_id in (SELECT id FROM levels_".$this->lang." WHERE is_visible = 1) $add_query ORDER BY a.c_order ASC ";

        $result = array();
        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $result = $query->result_array();
        }

        return $result;
    }

    function getLevel($level_id) {

        $sql = "SELECT * FROM levels_".$this->lang." WHERE id = $level_id";
        $result = array();
        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $result = $query->row_array();
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
    function getSetting($id, $lang) {

        $sql = "SELECT ".$lang."_section as section FROM settings WHERE id = $id";
        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $result = $query->row_array();
        }

        return $result;
    }

    function getHomeVideos() {
        $result = array();

        $sql = "SELECT * FROM home WHERE section = 1 LIMIT 4";

        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $result = $query->result_array();
            return $result;
        }else{
            return $result;
        }
    }
    function getHomePictures() {
        $result = array();
        $lang = $this->lang;
        $sql = "SELECT media_link, ".$lang."_description as description  FROM home WHERE section = 2 LIMIT 4";

        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $result = $query->result_array();
            return $result;
        }else{
            return $result;
        }
    }
}
