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
        if(!empty($input['email']) && !empty($input['role'])){
            $data = $this->api_model->register_email($input['email'], $input['role']);
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
        if(!empty($input['verify_code']) && !empty($input['access_token']) && !empty($input['device_type']) && !empty($input['push_token'])){
            $data = $this->api_model->check_verify_code($input['access_token'], $input['verify_code'], $input['device_type'], $input['push_token']);
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
        email, phone number, parent_fname and parent_lname
        */
        if( !empty($input['email']) && 
            !empty($input['phone']) && 
            !empty($input['parent_fname']) && 
            !empty($input['parent_lname'])
        ){
            $data = $this->api_model->update_profile($input);
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