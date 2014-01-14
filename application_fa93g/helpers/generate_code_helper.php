<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if( !function_exists('generate_code') ){
	
	/*
	function generate_code($what){
		
		$CI =& get_instance();
		$CI->load->library('dateconverter');
		$CI->load->model('sharedDB_model');
		
		switch($what)
		{
			case 'customer':
				$code = 'CT';
				$table = 'customers';
			case 'inventory':
				$code = 'IN';
				$table = 'inventory';
			case 'stock':
				$code = 'ST';
				$table = 'stock';
			case 'transaction':
				$code = 'IN';
				$table = 'invoices';
			case 'vehicle':
				$code = 'VH';
				$table = 'vehicles';
			case 'warehouse':
				$code = 'warehouse';	
		}
		
		$nepDate = $CI->dateconverter->eng_to_nep(date('Y'), date('m'), date('j'));
		
		$code .= ' - ';
		$code .= substr($nepDate['year'], 1, 3);
		$code .= '/';
		$code .= sprintf("%02s", $nepDate['month']);
		$code .= '/';
		$code .= sprintf("%02s", $nepDate['date']);
		
		$id = $CI->sharedDB_model->get($table, array('id'), NULL, 'id asc');
		
		return $code;
	}
	*/
	
	function generate_code( $what, $number = '' ){
		
			$CI =& get_instance();
			$CI->load->library('dateconverter');
			$CI->load->model('sharedDB_model');
			
				if($what == 'customer'){
					$code = 'CT';
					$table = 'customers';
				}
				elseif($what == 'inventory'){
					$code = 'IV';
					$table = 'inventory';
				}
				elseif($what == 'stock'){
					$code = 'ST';
					$table = 'stock';
				}
				elseif($what == 'transaction'){
					$code = 'IN';
					$table = 'invoices';
				}
				elseif($what == 'vehicle'){
					$code = 'VH';
					$table = 'vehicles';
				}
				elseif($what == 'warehouse'){
					$code = 'WH';	
					$table = 'warehouse';	
				}
			
			$nepDate = $CI->dateconverter->eng_to_nep(date('Y'), date('m'), date('j'));
			
			$code .= '-';
			$code .= substr($nepDate['year'], 1, 3);
			$code .= '/';
			$code .= sprintf("%02s", $nepDate['month']);

		
			if( $number == '' ){ $number = 1; }
			
			$code .= '/' . $number;
			
			$there = $CI->sharedDB_model->get($table, array('id'), array('code' => $code));
			
			if(count($there) == 0){
				return $code;
				break;
			}
			else {
				$number = $number + 1; 
				$number = intval( $number );
				return generate_code( $what, $number );
			}
			
			
	}
}
