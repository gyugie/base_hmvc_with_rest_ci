<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * allowed acces by user role to access endpoint
 * 
 * @param array user data
 * @param array role  
 * @return void
 */
if (! function_exists('roleAccess')):
    function roleAccess($token, $allowRoles){
        $CI =& get_instance();
        $CI->load->library('MY_REST_Controller');

        if( !in_array($token->role, $allowRoles) ){
            return $CI->set_response(
				array(),
				$CI->lang->line('text_access_denied'),
				REST_Controller::HTTP_UNAUTHORIZED
			);
        }
        
        return true;
    }
endif;