<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	
	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2016-05-10 13:50:12
	**/

	function __construct(){
		parent::__construct();

		// cek login
		if(!$this->session->userdata('isLogin')){
			redirect('auth');
		}

		$this->load->model(array(
			'm_user'
		));

		$this->load->helper(array(
			'tgl_indonesia'
		));

		$this->config->load('website');

		// Deklarasi
		$this->global_data = array();

		$this->global_data['asset'] = base_url('asset');

		$this->global_data['dataUser'] = $this->m_user->getInfoUser(array('username'=> $this->session->userdata('uname')));

		// File script global
		$this->global_data['add_style'] = array();
		$this->global_data['add_script'] = array();
		$this->global_data['add_script_up'] = array();
	}

	protected function tampilan($view){
		$this->load->view('header',$this->global_data);
		$this->load->view('menu',$this->global_data);
		$this->load->view($view,$this->global_data);
		$this->load->view('footer',$this->global_data);
	}

}