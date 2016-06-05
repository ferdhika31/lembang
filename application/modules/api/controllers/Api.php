<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once (dirname(__FILE__) . "/Main.php");

class Api extends Main{
	
	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2016-06-03 19:44:17
	**/

	function __construct(){
		parent::__construct();
	}

	public function index(){
		$response = array(
			'status' => "Not Found."
		);

		$this->outputJson($response);
	}

}