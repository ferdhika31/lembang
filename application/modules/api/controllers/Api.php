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
		$this->load->model('m_wisata');
		$this->load->model('m_kuliner');
	}

	public function index(){
		$response = array(
			'status' => "Not Found."
		);

		$this->outputJson($response);
	}

	public function cekAkun(){
		$postdata = (array)json_decode(file_get_contents('php://input'));

		$data = array();
		@$fbid = $postdata['fbid'];

		if(!empty($fbid)){
			$query = $this->db->get_where('user',array('fb_id'=>$fbid));
			$query = $query->result_array();

			if(!empty($query)){
				$data = array(
					'user_id'			=> $query[0]['user_id'],
					'nama'				=> $query[0]['nama'],
					'email'				=> $query[0]['email'],
					// 'alamat'			=> $query[0]['alamat'],
					'status'			=> $query[0]['stt'],
					'date_registered' 	=> $query[0]['date_registered'],
					'fb_id'				=> $query[0]['fb_id']
				);
			}
		}

		$this->outputJson($data);
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

	public function fbLogin(){
		$postdata = (array)json_decode(file_get_contents('php://input'));
		$data = array('status'=> false);

		@$fbid = $postdata['fbid'];
		@$nama = $postdata['nama'];

		if(!empty($fbid)){
			$query = $this->db->get_where('user',array('fb_id'=>$fbid));
			$query = $query->result_array();

			// kalo belum terdaftar
			if(empty($query)){
				$data = array(
					'fb_id' 			=> $fbid,
					'nama'				=> $nama,
					'email'				=> $fbid."@dika.web.id",
					'alamat'			=> '',
					'username'			=> $fbid,
					'password'			=> '123456',
					'hak_akses'			=> 'user',
					'stt'				=> 1,
					'date_registered'	=> date('Y-m-d h:i:s')
				);
				// insert data user
				$insert = $this->db->insert('user',$data);
				$data = array('status'=> true);
			}
		}

		$this->outputJson($data);
	}

	public function daftarUsulan(){
		$postdata = (array)json_decode(file_get_contents('php://input'));
		@$userid = $postdata['user_id'];

		$wisata = array();

		if(!empty($userid)){
			$wisataAlam = $this->m_wisata->getWisata(array('wisata_alam.user_id'=>$userid));
			$wisataKuliner = $this->m_kuliner->getWisata(array('wisata_kuliner.user_id'=>$userid));

			foreach ($wisataAlam as $resA) {
				$wisata[] = array(
					'wisata_id'		=> $resA['wisata_alam_id'],
					'nama_wisata'	=> $resA['nama_wisata_alam'],
					'foto'			=> base_url('assets/upload/'.$resA['cover_photo']),
					'alamat_wisata'	=> $resA['alamat_wisata_alam'],
					'deskripsi'		=> $resA['deskripsi_wisata_alam'],
					'date_add'		=> (!empty($resA['date_add']))?tgl_indo(substr($resA['date_add'], 0,10)):null,
					'oleh'			=> $resA['nama'],
					'fb_id'			=> $resA['fb_id'],
					'user_id'		=> (int) $resA['user_id'],
					'status'		=> (int) $resA['status_wisata'],
					'tipe'			=> 'alam'
				);
			}
			foreach ($wisataKuliner as $resA) {
				$wisata[] = array(
					'wisata_id'		=> $resA['wisata_kuliner_id'],
					'nama_wisata'	=> $resA['nama_wisata_kuliner'],
					'foto'			=> base_url('assets/upload/'.$resA['cover_photo']),
					'alamat_wisata'	=> $resA['alamat_wisata_kuliner'],
					'deskripsi'		=> $resA['deskripsi_wisata_kuliner'],
					'date_add'		=> (!empty($resA['date_add']))?tgl_indo(substr($resA['date_add'], 0,10)):null,
					'oleh'			=> $resA['nama'],
					'fb_id'			=> $resA['fb_id'],
					'user_id'		=> (int) $resA['user_id'],
					'status'		=> (int) $resA['status_kuliner'],
					'tipe'			=> 'kuliner'
				);
			}
		}

		$this->outputJson($wisata);
	}

	public function kirimUsulan(){
		$postdata = (array)json_decode(file_get_contents('php://input'));

		// @$nama_wisata = "Test Lagi";
		// @$alamat = "Mana nya?";
		// @$deskripsi = "Aya we ah";
		// @$userid = 1;
		// @$cover = 'cover/default.jpg';
		// @$tipe = 'kuliner';

		@$nama_wisata = $postdata['nama_wisata'];
		@$alamat = $postdata['alamat_wisata'];
		@$deskripsi = $postdata['deskripsi'];
		@$userid = $postdata['user_id'];
		@$cover = (!empty($postdata['foto'])) ? "usul/".$postdata['foto'].'.jpg' : 'cover/default.jpg';
		@$tipe = $postdata['tipe'];

		$data = array('status'=> false);

		if(!empty($userid)){
			if($tipe=='alam'){
				$input = array(
					'nama_wisata_alam'		=> $nama_wisata,
					'alamat_wisata_alam'	=> $alamat,
					'deskripsi_wisata_alam'	=> $deskripsi,
					'stt'					=> 3,
					'featured'				=> 1,
					'cover_photo'			=> $cover,
					'date_add'				=> date('Y-m-d h:i:s'),
					'user_id'				=> $userid,
				);
				$kirim = $this->m_wisata->tambahWisata($input);
			}else{
				$input = array(
					'nama_wisata_kuliner'		=> $nama_wisata,
					'alamat_wisata_kuliner'		=> $alamat,
					'deskripsi_wisata_kuliner'	=> $deskripsi,
					'stt'						=> 3,
					'featured'					=> 1,
					'cover_photo'				=> $cover,
					'date_add'					=> date('Y-m-d h:i:s'),
					'user_id'					=> $userid,
				);
				$kirim = $this->m_kuliner->tambahWisata($input);
			}
		}

		$data = ($kirim) ? array('status'=> true) : array('status'=> false);

		$this->outputJson($data);
	}

	public function hapusUsulan(){
		$postdata = (array)json_decode(file_get_contents('php://input'));
		
		@$wisata_id = $postdata['wisata_id'];
		@$tipe = $postdata['tipe'];

		$data = array('status'=> false);

		if(!empty($wisata_id)){
			if($tipe=='kuliner'){
				$hapGal = $this->m_kuliner->hapusGaleri($wisata_id);
				$hapRat = $this->m_kuliner->hapusRating($wisata_id);
				$hapKom = $this->m_kuliner->hapusKomentarOnWis($wisata_id);
				$delete = $this->m_kuliner->hapusWisata(array('wisata_kuliner_id'=>$wisata_id));
			}else{
				$hapGal = $this->m_wisata->hapusGaleri($wisata_id);
				$hapRat = $this->m_wisata->hapusRating($wisata_id);
				$hapKom = $this->m_wisata->hapusKomentarOnWis($wisata_id);
				$delete = $this->m_wisata->hapusWisata(array('wisata_alam_id'=>$wisata_id));
			}
			$data = ($delete) ? array('status'=> true) : array('status'=> false);
		}

		$this->outputJson($data);
	}
}