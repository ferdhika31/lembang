<?php if ( ! defined('BASEPATH')) exit('Alag siah!');

class M_auth extends CI_Model {
	
	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2016-05-10 13:08:30
	**/

	function __construct(){
		parent::__construct();
		$this->user = 'user';
	}

	public function masuk($kolom=array()){
		$query = $this->db->get_where($this->user,$kolom);
		$query = $query->result_array();

		if($query){
			return $query[0];
		}
	}

	public function ambilProfil($kolom=array()){
		
	}
	
}