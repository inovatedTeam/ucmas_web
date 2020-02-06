<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Search_model extends CI_Model
{

    public  $lang = "en";

    function __construct() {
        parent::__construct();
        $this->lang = $this->session->userdata("lang");

    }
    function getJsonCourses($course_id = 0) {

        if ($course_id > 0)
            $sql = "SELECT a.address,a.id, a.lot, a.lat, b.level_name as level_name FROM courses a LEFT JOIN levels b ON a.level_id = b.id WHERE a.id = $course_id ORDER BY a.id ASC ";
        else{
            $sql = "SELECT a.address,a.id, a.lot, a.lat, b.level_name as level_name FROM courses a LEFT JOIN levels b ON a.level_id = b.id ORDER BY a.id ASC ";
        }
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
        $sql = "SELECT a.address,a.id, a.lot, a.lat, b.level_name as level_name FROM courses a LEFT JOIN levels b ON a.level_id = b.id 
                WHERE  a.id in (
                              SELECT course_id
                                FROM (SELECT id as course_id,
                                      ( 6371 * ACOS( COS( RADIANS('".$lat."') )
                                      * COS( RADIANS( lat ) )
                                      * COS( RADIANS( lot ) - RADIANS('".$lot."') )
                                      + SIN( RADIANS('".$lat."') )
                                      * SIN( RADIANS( lat ) ) ) ) AS distance
                                    FROM courses ) tbl
                                WHERE tbl.distance < $radius
                            ) $add_query ORDER BY a.id ASC ";
        $result = array();
        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $result = $query->result_array();
        }

        return $result;
    }
    function getCourses($course_id = 0) {

        if ($course_id > 0)
            $sql = "SELECT a.*, b.level_name as level_name FROM courses a LEFT JOIN levels b ON a.level_id = b.id WHERE a.id = $course_id ORDER BY a.id ASC ";
        else{
            $sql = "SELECT a.*, b.level_name as level_name FROM courses a LEFT JOIN levels b ON a.level_id = b.id ORDER BY a.id ASC ";
        }
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
        $sql = "SELECT a.*, b.level_name as level_name FROM courses a LEFT JOIN levels b ON a.level_id = b.id 
                WHERE  a.id in (
                              SELECT course_id
                                FROM (SELECT id as course_id,
                                      ( 6371 * ACOS( COS( RADIANS('".$lat."') )
                                      * COS( RADIANS( lat ) )
                                      * COS( RADIANS( lot ) - RADIANS('".$lot."') )
                                      + SIN( RADIANS('".$lat."') )
                                      * SIN( RADIANS( lat ) ) ) ) AS distance
                                    FROM courses ) tbl
                                WHERE tbl.distance < $radius
                            ) $add_query ORDER BY a.id ASC ";
//        echo $sql;exit;
        $result = array();
        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $result = $query->result_array();
        }

        return $result;
    }
    function getLevels() {

        $sql = "SELECT * FROM levels ORDER BY id ASC";
        $result = array();
        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $result = $query->result_array();
        }

        return $result;
    }
    function getLevel($level_id) {

        $sql = "SELECT * FROM levels WHERE id = $level_id";
        $result = array();
        $query = $this->db->query( $sql );
        if($query->num_rows() > 0){
            $result = $query->row_array();
        }

        return $result;
    }
}
