<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once (dirname(__FILE__) . "/Main.php");

class Admin extends Main{
	
	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2016-05-10 13:55:09
	**/

	function __construct(){
		parent::__construct();

	}

	public function index(){
		// Title & desc
		$this->global_data['title'] = "Dashboard";
		$this->global_data['description'] = "dashboard";
		$this->global_data['menu'] = "dashboard";

		$this->tampilan('dashboard');
	}

	public function keluar(){
		$this->session->sess_destroy();
		redirect('admin/auth','refresh');
	}

}