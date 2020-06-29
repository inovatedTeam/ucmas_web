<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class Exercise extends REST_Controller {
    
	  /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function __construct() {
       parent::__construct();
       $this->load->database();
       $this->load->model('api_model');
    }
    private function validator($params, $keys) {
        foreach($keys as $key) {
            if(!array_key_exists($key,$params) ) {
                return $key;
            }
        }
        return "OK";
    }
	public function index_post(){
        $data = [];
        $rawPostData = file_get_contents('php://input');
        $input = (array)json_decode($rawPostData);
        if(!empty($input['lesson_id'])){
            $data = $this->api_model->getExercises($input['lesson_id']);
        }else{
            $data = ['success' => 'fail', 'message' => "Error validation."];
        }
     
        $this->response($data, REST_Controller::HTTP_OK);
    }
	public function assignment_post(){
        $data = [];
        $rawPostData = file_get_contents('php://input');
        $input = (array)json_decode($rawPostData);
        $data = $this->api_model->getAssignments();
        
        $this->response($data, REST_Controller::HTTP_OK);
    }
	public function examStart_post(){
        $data = [];
        $rawPostData = file_get_contents('php://input');
        $input = (array)json_decode($rawPostData);
        $keys = [
            'level_id', 
            'lesson_id', 
            'ex_id', 
            'ex_type', // reading|html|video_mp4|video_youtube|listening
            'duration', 
            'is_finished', // 0|1
            ];
        $res = $this->validator($input, $keys);
       
        if( $res == "OK" ) {
            if($input['ex_type'] == 'reading'){
                $keys1 = [
                    's_ids', // exam attend users
                    'time_start', // str timestamp
                    'time_end' // str timestamp
                    ];
                $res1 = $this->validator($input, $keys1);
                if( $res1 == "OK" ) {    
                    $data = $this->api_model->examStartExercise($input);
                }else{
                    $data = ['success' => 'fail', 'message' => "Error validation(" . $res1 . ")."];
                }
            }else{
                $data = $this->api_model->examStartExercise($input);
            }
        }else{
            $data = ['success' => 'fail', 'message' => "Error validation(" . $res . ")."];
        }
     
        $this->response($data, REST_Controller::HTTP_OK);
    }
	public function examEnd_post(){
        $data = [];
        $rawPostData = file_get_contents('php://input');
        $input = (array)json_decode($rawPostData);
        $keys = [
            'exam_id', 
            'is_finished', // yes, no
            ];
        $res = $this->validator($input, $keys);
       
        if( $res == "OK" ) {
            $data = $this->api_model->examEndExercise($input);
        }else{
            $data = ['success' => 'fail', 'message' => "Error validation."];
        }
     
        $this->response($data, REST_Controller::HTTP_OK);
    }
	public function checkExam_post(){
        $data = [];
        $rawPostData = file_get_contents('php://input');
        $input = (array)json_decode($rawPostData);
        $data = $this->api_model->checkExam();
        
        $this->response($data, REST_Controller::HTTP_OK);
    }
    public function attemptStart_post(){
        $data = [];
        $rawPostData = file_get_contents('php://input');
        $input = (array)json_decode($rawPostData);
        $keys = [
            'level_id', 
            'lesson_id', 
            'ex_id', 
            'ex_type', // reading|html|video_mp4|video_youtube|listening
            'is_exam', // yes | no
            // 'duration', 
            'is_completed', // 0|1
            ];
        $res = $this->validator($input, $keys);
       
        if( $res == "OK" ) {
            if($input['ex_type'] == 'reading' && $input['is_exam'] == 'yes'){
                $keys1 = [
                    'exam_id', // exam_id
                    'time_start', // str timestamp
                    'time_end' // str timestamp
                    ];
                $res1 = $this->validator($input, $keys1);
                if( $res1 == "OK" ) {    
                    $data = $this->api_model->attemptStartExercise($input);
                }else{
                    $data = ['success' => 'fail', 'message' => "Error validation(" . $res1 . ")."];
                }
            }else{
                $data = $this->api_model->attemptStartExercise($input);
            }
        }else{
            $data = ['success' => 'fail', 'message' => "Error validation(" . $res . ")."];
        }
     
        $this->response($data, REST_Controller::HTTP_OK);
    }
	public function attemptEnd_post(){
        $data = [];
        $rawPostData = file_get_contents('php://input');
        $input = (array)json_decode($rawPostData);
        $keys = [
            'attempt_id', // attempt_id
            'level_id', 
            'lesson_id', 
            'ex_id', 
            'ex_type', // reading|html|video_mp4|video_youtube|listening
            'is_exam', // yes | no
            // 'duration', 
            'is_completed', // 0|1
            ];
        $res = $this->validator($input, $keys);
       
        if( $res == "OK" ) {
            if($input['ex_type'] == 'reading'){
                $keys1 = [
                    'a', // int
                    'c', // int
                    's', // int
                    'w', // int
                    ];
                $res1 = $this->validator($input, $keys1);
                if( $res1 == "OK" ) {    
                    $data = $this->api_model->attemptEndExercise($input);
                }else{
                    $data = ['success' => 'fail', 'message' => "Error validation."];    
                }
            }else{
                $data = $this->api_model->attemptEndExercise($input);
            }
        }else{
            $data = ['success' => 'fail', 'message' => "Error validation."];
        }
     
        $this->response($data, REST_Controller::HTTP_OK);
    }

	public function result_post(){
        $data = [];
        $rawPostData = file_get_contents('php://input');
        $input = (array)json_decode($rawPostData);
        $keys = [
            'attempt_id', 
            'sub_id', 
            'sub_status', 
            'nb', 
            'duration', 
            'created'
            ];
        $res = $this->validator($input, $keys);
       
        if( $res == "OK" ) {
            $data = $this->api_model->resultExercise($input);
        }else{
            $data = ['success' => 'fail', 'message' => "Error validation."];
        }
     
        $this->response($data, REST_Controller::HTTP_OK);
    }
    // get student exam result by second
	public function examResult_post(){
        $data = [];
        $rawPostData = file_get_contents('php://input');
        $input = (array)json_decode($rawPostData);
        $keys = [
            'exam_id'
            ];
        $res = $this->validator($input, $keys);
       
        if( $res == "OK" ) {
            $data = $this->api_model->getExamResult($input);
        }else{
            $data = ['success' => 'fail', 'message' => "Error validation."];
        }
     
        $this->response($data, REST_Controller::HTTP_OK);
    }
	public function teacherExerciseResult_post(){
        $data = [];
        $rawPostData = file_get_contents('php://input');
        $input = (array)json_decode($rawPostData);
        $keys = [
            'ex_id'
            ];
        $res = $this->validator($input, $keys);
       
        if( $res == "OK" ) {
            $data = $this->api_model->getTeacherExerciseResult($input);
        }else{
            $data = ['success' => 'fail', 'message' => "Error validation."];
        }
     
        $this->response($data, REST_Controller::HTTP_OK);
    }
    
    
    	
}