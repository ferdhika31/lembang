<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once (dirname(__FILE__) . "/Main.php");

class Kuliner extends Main{
	
	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2016-06-07 07:20:59
	**/

	function __construct(){
		parent::__construct();
		$this->load->model('m_kuliner');
	}

	public function index(){
		$response = array(
			'status' => "Not Found."
		);

		$this->outputJson($response);
	}

	public function ambilSemua(){
		$wisata = $this->m_kuliner->getAllWisata();

		$data = array();

		foreach ($wisata as $result) {
			if($result['status_kuliner']==1){
				$wisata_id = $result['wisata_kuliner_id'];

				// rating/nilai
				$rating = $this->m_kuliner->getAvRatingWisata($result['wisata_kuliner_id']);
				$jumlahRating = $rating['jumRating'];

				if($result['status_kuliner']==1){
					$data[] = array(
						'wisata_id'				=> $wisata_id,
						'nama_wisata'			=> $result['nama_wisata_kuliner'],
						'cover_photo'			=> base_url('assets/upload/'.$result['cover_photo']),
						'alamat_wisata'			=> $result['alamat_wisata_kuliner'],
						'deskripsi_wisata'		=> $result['deskripsi_wisata_kuliner'],
						'cuplikan_deskripsi'	=> substr($result['deskripsi_wisata_kuliner'], 0,160),
						'hari'					=> unserialize($result['hari']),
						'jam_buka'				=> $result['jam_buka'],
						'jam_tutup'				=> $result['jam_tutup'],
						'lat'					=> $result['lat'],
						'long'					=> $result['long'],
						'latlong'				=> $result['lat'].','.$result['long'],
						'status'				=> $result['status_kuliner'],
						'date_add'				=> $result['date_add'],
						'oleh'					=> $result['nama'],
						'nilai'					=> ceil($jumlahRating)
					);
				}
			}
		}

		$this->outputJson($data);
	}

	public function ambilSatu($id=null){
		$wisata = $this->m_kuliner->getOneWisata(array('wisata_kuliner_id'=> $id));
		$data =array();
		// rating/nilai
		if(!empty($wisata)){
			$rating = $this->m_kuliner->getAvRatingWisata($wisata['wisata_kuliner_id']);
			$jumlahRating = $rating['jumRating'];

			$data = array(
				'wisata_id'				=> $wisata['wisata_kuliner_id'],
				'nama_wisata'			=> $wisata['nama_wisata_kuliner'],
				'cover_photo'			=> base_url('assets/upload/'.$wisata['cover_photo']),
				'alamat_wisata'			=> $wisata['alamat_wisata_kuliner'],
				'deskripsi_wisata'		=> $wisata['deskripsi_wisata_kuliner'],
				'cuplikan_deskripsi'	=> substr($wisata['deskripsi_wisata_kuliner'], 0,160),
				'hari'					=> unserialize($wisata['hari']),
				'jam_buka'				=> $wisata['jam_buka'],
				'jam_tutup'				=> $wisata['jam_tutup'],
				'lat'					=> $wisata['lat'],
				'long'					=> $wisata['long'],
				'latlong'				=> $wisata['lat'].','.$wisata['long'],
				'status'				=> $wisata['status_kuliner'],
				'date_add'				=> $wisata['date_add'],
				'oleh'					=> $wisata['nama'],
				'nilai'					=> ceil($jumlahRating),
				'totRating'				=> $rating['totRating']
			);
		}

		$this->outputJson($data);
	}

	public function ambilGaleri($id=null){
		$wisata = $this->m_kuliner->getGaleri($id);

		$data = array();

		foreach ($wisata as $result) {
			$wisata_id = $result['wisata_kuliner_id'];

			$data[] = array(
				'wisata_id'				=> $wisata_id,
				'nama_foto'				=> $result['nama_foto'],
				'url_foto'				=> base_url('assets/upload/'.$result['url_foto']),
				'deskripsi_foto'		=> $result['deskripsi_foto'],
				'status'				=> $result['stt'],
				'date_add'				=> $result['date_add'],
				'time_add'				=> $result['time_add']
			);
		}

		$this->outputJson($data);
	}

	public function kirimKomentar(){
		$postdata = (array)json_decode(file_get_contents('php://input'));

		@$userid = $postdata['userid'];
		@$wisata_id = $postdata['wisata_id'];
		@$komentar = $postdata['komentar'];

		$data = array('status'=>false);

		if(!empty($userid) && !empty($komentar)){
			$input = array(
				'komentar'			=> $komentar,
				'date_add'			=> date("Y-m-d h:i:s"),
				'user_id'			=> $userid,
				'wisata_kuliner_id'	=> $wisata_id
			);

			$kirim = $this->m_kuliner->kirimKomentar($input);

			if($kirim){
				$data = array('status'=>true);
			}
		}

		$this->outputJson($data);
	}

	public function hapusKomentar(){
		$postdata = (array)json_decode(file_get_contents('php://input'));

		@$komentar_id = $postdata['komentar_id'];

		$data = array('status'=>false);

		if(!empty($komentar_id)){
			$hapus = $this->m_kuliner->hapusKomentar($komentar_id);

			if($hapus){
				$data = array('status'=>true);
			}
		}

		$this->outputJson($data);
	}

	public function ambilKomentar($id=null){
		$wisata = $this->m_kuliner->getKomentarWisata($id);

		$data = array();

		foreach ($wisata as $result) {
			$wisata_id = $result['wisata_kuliner_id'];

			$data[] = array(
				'komentar_id'			=> $result['komentar_kuliner_id'],
				'wisata_id'				=> $wisata_id,
				'komentar'				=> strip_tags($result['komentar']),
				'fb_id'					=> $result['fb_id'],
				'oleh'					=> $result['nama'],
				'date_add'				=> $result['date_add']
			);
		}

		$this->outputJson($data);
	}

	public function ambilTopWisata(){
		$topWisata = $this->m_kuliner->topWisata();

		$data = array();

		foreach ($topWisata as $result) {
			$wisata = $this->m_kuliner->getOneWisata(array("wisata_kuliner.wisata_kuliner_id" => $result['wisata_kuliner_id']));
			$data[] = array(
				'wisata_id'		=> $result['wisata_kuliner_id'],
				'nama_wisata'	=> $wisata['nama_wisata_kuliner'],
				'alamat_wisata'	=> $wisata['alamat_wisata_kuliner'],
				'photo_wisata'	=> base_url('assets/upload/'.$wisata['cover_photo']),
				'jumRating'		=> $result['jumRating'],
				'totRating'		=> $result['totRating']
			);
		}


		$this->outputJson($data);
	}

	public function tambahRating(){
		$postdata = (array)json_decode(file_get_contents('php://input'));

		@$idWisata = $postdata['wisata_id'];
		@$idUser = $postdata['userid'];
		@$jumRating = $postdata['jumRating'];

		$data = array('status'=>false);

		if(!empty($idWisata) && !empty($idUser) && !empty($jumRating)){
			$rating = $this->m_kuliner->cekRating(array('wisata_kuliner_id'=> $idWisata, 'user_id' => $idUser));

			if(!empty($rating)){ // update
				$val = array(
					'jumlah_bintang' 	=> $jumRating,
					'date_add'			=> date('Y-m-d h:i:s')
				);
				$where = array('rating_kuliner_id'=>$rating['rating_kuliner_id']);

				$ubahRat = $this->m_kuliner->ubahRating($val,$where); 
				
				if($ubahRat) $data = array('status'=>true);
			}else{ // add
				$val = array(
					'jumlah_bintang' 	=> $jumRating,
					'date_add'			=> date('Y-m-d h:i:s'),
					'wisata_kuliner_id'	=> $idWisata,
					'user_id'			=> $idUser
				);

				$tambahRat = $this->m_kuliner->tambahRating($val); 

				if($tambahRat) $data = array('status'=>true);
			}
		}

		$this->outputJson($data);
	}
}