<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/MY_REST_Controller.php';
require  'vendor/autoload.php';

use \Firebase\JWT\JWT;

class Users extends MY_REST_Controller {
	protected $token;

	public function __construct()
	{		  
		parent::__construct();
		$this->token = $this->validate_token($this->input->request_headers()['Authorization']);
		$this->load->model('users/users_model','users');
    }

    public function index_get(){
		// checking role user permission 
		roleAccess($this->token, ['admin']);
		$perPage = (integer) $this->input->get('per_page', TRUE) != null ? (integer) $this->input->get('per_page', TRUE) : 10 ;
		$page = (integer) $this->input->get('page', TRUE) != null ? (integer) $this->input->get('page', TRUE) : 1;
		$start = ( $page * $perPage ) - $perPage;
	
		$totalRows = $this->users->get_all_users(array(
			"count" => true
		));

		$users = $this->users->get_all_users(array(
			"limit" => $perPage,
			"offset" => ($perPage * $page) - $perPage
		));

		$this->set_response_paginate(
			MY_REST_Controller::HTTP_OK,
			$this->lang->line('text_success'),
			$users,
			$totalRows,
			$perPage,
			$page,
			$start + 1,
			$start + count($users)
		);

	}
}