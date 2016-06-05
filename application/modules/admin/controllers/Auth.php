<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	
	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2016-05-10 11:42:42
	**/

	function __construct(){
		parent::__construct();



		$this->load->library('form_validation');
		$this->load->model('m_auth');
	}

	public function index(){
		// Info halaman 
		$data['title']	= 'Masuk';
		$data['description'] = '';

		$data['asset'] = base_url('assets/admin').'/'; 

		// Pesan
		$data['message'] = $this->session->flashdata('message');

		// Validasi
		$this->form_validation->set_rules('username', 'Username', 'required|min_length[4]|max_length[12]');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if($this->form_validation->run() == true){
			$uname = $this->input->post('username');
			$pass = $this->input->post('password');

			$akun = $this->m_auth->masuk(array('username'=>$uname,'password'=>$pass));

			if(!empty($akun)){
				$this->session->set_userdata(array(
					'isLogin'   => TRUE,
					'id_user'	=> $akun['user_id'],
					'hak'		=> $akun['hak_akses'],
					'uname'  	=> $uname,
				));
				redirect('admin');
			}else{
				$data['message'] = "Gagal login";
			}
		}else{
			// Pesan validasi
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
		}

		$this->load->view('auth/masuk',$data);
	}

	

}