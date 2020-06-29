<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class Question extends REST_Controller {
    
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
        $data = $this->api_model->get_questions();
     
        $this->response($data, REST_Controller::HTTP_OK);
    }
	public function add_post(){
        $data = [];
        $rawPostData = file_get_contents('php://input');
        $input = (array)json_decode($rawPostData);
        $keys = [
            'question', // question title
            'student_id', // student id
            ];
        $res = $this->validator($input, $keys);
       
        if( $res == "OK" ) {
            $data = $this->api_model->add_question($input);
        }else{
            $data = ['success' => 'fail', 'message' => "Error validation."];
        }
     
        $this->response($data, REST_Controller::HTTP_OK);
    }
	public function answer_post() {
        $data = [];
        $rawPostData = file_get_contents('php://input');
        $input = (array)json_decode($rawPostData);
        if( !empty($input['question_id']) && !empty($input['message']) ){
            $data = $this->api_model->add_answer($input);
        }else{
            $data = ['success' => 'fail', 'message' => "Error validation."];
        }
     
        $this->response($data, REST_Controller::HTTP_OK);
    }
    
    
    	
}