<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if( !function_exists('csfr') ){
	
	function csfr( $type = "hidden" ){
		
		$CI =& get_instance();
		return '<div style="display: none;"><input type="'.$type.'" name="'.$CI->security->get_csrf_token_name().'" value="'.$CI->security->get_csrf_hash().'"></div>';
		
	}
}
