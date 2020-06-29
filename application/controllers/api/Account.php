<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class Account extends REST_Controller {
    
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
            if(empty($params[$key])) {
                return $key;
            }
        }
        return "OK";
    }
       
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
	public function index_get($id = 0){
        if(!empty($id)){
            $data = $this->api_model->generate_token(8);
        }else{
            $data = $this->api_model->generate_token(8);
        }
     
        $this->response([$data], REST_Controller::HTTP_OK);
    }
    
    public function register_post(){
        $data = [];
        $rawPostData = file_get_contents('php://input');
        $input = (array)json_decode($rawPostData);
        if(!empty($input['email'])){
            $data = $this->api_model->register_email($input['email']);
        }else{
            $data = ['success' => 'fail', 'message' => "Error validation."];
        }
     
        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function resendcode_post(){
        $data = [];
        $rawPostData = file_get_contents('php://input');
        $input = (array)json_decode($rawPostData);
        if(!empty($input['access_token'])){
            $data = $this->api_model->resend_verify_code($input['access_token']);
        }else{
            $data = ['success' => 'fail', 'message' => "Error validation."];
        }
     
        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function verify_post(){
        $data = [];
        $rawPostData = file_get_contents('php://input');
        $input = (array)json_decode($rawPostData);
        $keys = ["verification_code", 'access_token', 'device_type', 'push_token', 'role'];
        $res = $this->validator($input, $keys);
       
        if( $res == "OK" ) {
            $data = $this->api_model->check_verify_code($input);
        }else{
            $data = ['success' => 'fail', 'message' => "Error validation."];
        }
    
        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function checkToken_post(){
        $data = [];
        $rawPostData = file_get_contents('php://input');
        $input = (array)json_decode($rawPostData);
        $data = $this->api_model->check_token();
     
        $this->response($data, REST_Controller::HTTP_OK);
    }
    
    // update profile
    public function profile_post()
    {
        $data = [];
        $rawPostData = file_get_contents('php://input');
        $input = (array)json_decode($rawPostData);
        /*
        email, phone, parent_fname and parent_lname
        */

        $keys = ["email"];
        $res = $this->validator($input, $keys);
       
        if( $res == "OK" ) {
            $data = $this->api_model->update_profile($input);
        }else{
            $data = ['success' => 'fail', 'message' => "Error validation."];
        }
     
        $this->response($data, REST_Controller::HTTP_OK);
    } 
    // select child
    public function selectChild_post()
    {
        $data = [];
        $rawPostData = file_get_contents('php://input');
        $input = (array)json_decode($rawPostData);
        $keys = ["child_id"];
        $res = $this->validator($input, $keys);
       
        if( $res == "OK" ) {
            $data = $this->api_model->select_child($input['child_id']);
        }else{
            $data = ['success' => 'fail', 'message' => "Error validation."];
        }
     
        $this->response($data, REST_Controller::HTTP_OK);
    } 
    // select classroom
    public function selectClassroom_post()
    {
        $data = [];
        $rawPostData = file_get_contents('php://input');
        $input = (array)json_decode($rawPostData);
        $keys = ["teacher_id"]; // teacher id
        $res = $this->validator($input, $keys);
       
        if( $res == "OK" ) {
            $data = $this->api_model->select_child($input['teacher_id']);
        }else{
            $data = ['success' => 'fail', 'message' => "Error validation."];
        }
     
        $this->response($data, REST_Controller::HTTP_OK);
    } 
     
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function index_put($id)
    {
        $input = $this->put();
        $this->db->update('items', $input, array('id'=>$id));
     
        $this->response(['Item updated successfully.'], REST_Controller::HTTP_OK);
    }
     
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function index_delete($id)
    {
        $this->db->delete('items', array('id'=>$id));
       
        $this->response(['Item deleted successfully.'], REST_Controller::HTTP_OK);
    }
    	
}