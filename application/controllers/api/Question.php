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

	public function add_post($id = 0){
        $data = [];
        $rawPostData = file_get_contents('php://input');
        $input = (array)json_decode($rawPostData);
        if(!empty($input['question'])){
            $data = $this->api_model->add_question($input);
        }else{
            $data = ['success' => 'fail', 'message' => "Error validation."];
        }
     
        $this->response($data, REST_Controller::HTTP_OK);
    }
	public function answer_post($id = 0) {
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