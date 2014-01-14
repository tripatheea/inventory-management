<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


function in_object($val, $obj){
	// in_array for multi-dimensional objects/arrays.
	if($val == ""){ trigger_error("in_object expects parameter 1 must not empty", E_USER_WARNING); return false; }
	if(!is_object($obj)){ $obj = (object)$obj; } foreach($obj as $key => $value){ if(!is_object($value) && !is_array($value)){ if($value == $val){ return true; } } else{ return in_object($val, $value); } }
	return false;
}

if( !function_exists('permission_manager') ){
	
	function permission_manager(){
		
		$CI =& get_instance();
		
		$CI->load->library('tank_auth');
		
		// Authentication-related stuff.
		if ( ! $CI->tank_auth->is_logged_in())
		{
			redirect('/auth/login/');
		}
		else
		{
			$data['user_id']		  = $CI->tank_auth->get_user_id();
			$data['username']		  = $CI->tank_auth->get_username();
			$userPermission  = $CI->tank_auth->get_user_permission();
			/*
			if(isset($allowedMethods) && is_array($allowedMethods))
				$allowedMethods = array_key_exists($CI->router->class, $userPermission) ? $userPermission[$CI->router->class] : array();
			*/
			
			/*
			if(( ! in_object($CI->router->method, $userPermission)) && ( ! in_object('all', $userPermission)))
			{
				show_error('Sorry! You don\'t have permission to acess this page!<br><br>Please hit the back button of your browser to go back!', 403);
			}
			*/
			
			
			if ( (array_key_exists( 'king', $userPermission ) && $userPermission['king'] == 'yes' ) || array_key_exists( $CI->router->class, $userPermission ) && $userPermission[$CI->router->class] == 'all' ){
				# Yay! 
			}
			else {
				show_error('Sorry! You don\'t have permission to acess this page!<br><br>Please hit the back button of your browser to go back!', 403);
			}
			return $data;
		}	
	}
}