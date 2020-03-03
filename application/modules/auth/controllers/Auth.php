<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/MY_REST_Controller.php';
require  'vendor/autoload.php';

use \Firebase\JWT\JWT;

class Auth extends MY_REST_Controller {

	public function __construct()
	{		  
		parent::__construct();
		$this->load->model('auth/auth_model','auth');
    }

    /**
     * User register
     * 
     * @param name string required
     * @param email string required
     * @param password string required
     * @return response json
     */
    public function register_post(){
        // Set validations
		$this->form_validation->set_rules('name', 'name', 'required|alpha|trim|min_length[1]|max_length[50]');
		$this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'password', 'required|min_length[6]|max_length[20]');
        $this->form_validation->set_rules('re_enter_password', 'password', 'required|matches[password]');
		
		// Set data to validate
		$this->form_validation->set_data($this->post());
		
		// Run Validations
		if ($this->form_validation->run() == FALSE) {
			return $this->set_response(
				array(),
				$this->form_validation->error_array(),
				REST_Controller::HTTP_BAD_REQUEST
			);
		}

		// Check email availability 
		$email_available = $this->auth->check_email_availability($this->post('email'));

		if(!$email_available){
			return $this->set_response(
				array(), 
				$this->lang->line('text_duplicate_email'),
				REST_Controller::HTTP_CONFLICT
			);
		}
		
		// Get needed data of user
		$user_data = $this->form_validation->need_data_as($this->post(), array(
			'name' => null,
			'email' => null,
			'password' => null
		));
       
		// Finally save the user			
		$user_id = $this->auth->add($user_data);

		if(!$user_id){
			return $this->set_response(
				array(),
				$this->lang->line('text_server_error'),
				REST_Controller::HTTP_INTERNAL_SERVER_ERROR
			);
		}
			
		return $this->set_response(
			array(),
			$this->lang->line('text_registration_success'),
			REST_Controller::HTTP_CREATED
		);
    }

    /**
     * User Login
     * 
     * @param name / email string required
     * @param password string required
     * @return response json
     */

    public function login_post(){
        $date = new DateTime();
        // Set validations
		$this->form_validation->set_rules('name', 'name', 'required|trim|min_length[1]|max_length[50]');
        $this->form_validation->set_rules('password', 'password', 'required|min_length[6]|max_length[20]');
		
		// Set data to validate
		$this->form_validation->set_data($this->post());
		
		// Run Validations
		if ($this->form_validation->run() == FALSE) {
			return $this->set_response(
				array(),
				$this->form_validation->error_array(),
				REST_Controller::HTTP_BAD_REQUEST
			);
        }
        
        // Get needed data of user
		$payload = $this->form_validation->need_data_as($this->post(), array(
			'name' => null,
			'password' => null
        ));

        // Finally get user data			
        $user = $this->auth->is_valid($payload);
        
        if(!$user){
            return $this->set_response(
				array(),
				$this->lang->line('text_user_not_found'),
				REST_Controller::HTTP_BAD_REQUEST
			);
        }

        if($user->password != md5($payload['password'])){
            return $this->set_response(
				array(),
				$this->lang->line('text_invalid_password'),
				REST_Controller::HTTP_BAD_REQUEST
			);
        }

        $generate = array(
            "id" => $user->id,
            "name" => $user->name,
            "role" => $user->role,
            "email" => $user->email,
            "iat" => $date->getTimestamp(),
        );
        
		$jwt = JWT::encode($generate, $this->config->item('jwt_key'));
		
		$this->set_response(array(
                "Authorization" => $jwt 
            ),
            "Login Success Fully",
            MY_REST_Controller::HTTP_OK
        );
       
    }
}