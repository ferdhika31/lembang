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
		$this->load->model('m_user');
	}

	public function index(){
		$response = array(
			'status' => "Not Found."
		);

		$this->outputJson($response);
	}

	public function galeri(){
		$query = $this->db->query("select * from wisata_alam_galeri inner join 
				wisata_alam on wisata_alam.wisata_alam_id=wisata_alam_galeri.wisata_alam_id GROUP BY wisata_alam_galeri.wisata_alam_id
				union all
				select * from wisata_kuliner_galeri inner join
				wisata_kuliner on wisata_kuliner.wisata_kuliner_id=wisata_kuliner_galeri.wisata_kuliner_id GROUP BY wisata_kuliner_galeri.wisata_kuliner_id 
				ORDER BY RAND()"
		);
		$query = $query->result_array();

		$data = array();

		foreach ($query as $result) {
			$user = $this->m_user->getOneUser(array('user_id'=>$result['user_id']));
			$data[] = array(
				'wisata_alam_galeri_id'		=> $result['wisata_alam_galeri_id'],
				'wisata_alam_id'			=> $result['wisata_alam_id'],
				'nama_foto'					=> $result['nama_foto'],
				'url_foto'					=> base_url('assets/upload/'.$result['url_foto']),
				'deskripsi_foto'			=> $result['deskripsi_foto'],
				'date_add'					=> $result['date_add'],
				'oleh'						=> $user['nama'],
				'nama_wisata'				=> $result['nama_wisata_alam']
			);
		}

		$this->outputJson($data);
	}

}