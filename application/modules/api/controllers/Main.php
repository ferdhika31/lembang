<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	
	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2016-06-03 19:44:45
	**/

	function __construct(){
		parent::__construct();

		// Add origin header 
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Credentials: true');
		header('Access-Control-Allow-Method: PUT, GET, POST, DELETE, OPTIONS');
		header('Access-Control-Allow-Headers: Content-Type, x-xsrf-token');

		$this->load->helper(array(
			'tgl_indonesia'
		));
	}

	protected function outputJson($response=array(),$status=200){
		$this->output
		->set_status_header($status)
		->set_content_type('application/json', 'utf-8')
		->set_output(json_encode($response, JSON_PRETTY_PRINT))
		->_display();
		exit();
	}

}