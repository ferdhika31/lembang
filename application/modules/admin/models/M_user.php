<?php if ( ! defined('BASEPATH')) exit('Alag siah!');

class M_user extends CI_Model {
	
	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2016-05-10 13:51:59
	**/

	function __construct(){
		parent::__construct();
		$this->tb_user = 'user';
	}

	public function getInfoUser($where=array()){
		$query = $this->db->get_where($this->tb_user,$where);
		$query = $query->result_array();

		if(!empty($query)){
			return $query[0];
		}
	}

}