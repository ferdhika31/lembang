<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once (dirname(__FILE__) . "/Main.php");

class Wisata extends Main{
	
	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2016-06-04 17:41:17
	**/

	function __construct(){
		parent::__construct();
		$this->load->model('m_wisata');
	}

	public function index(){
		$response = array(
			'status' => "Not Found."
		);

		$this->outputJson($response);
	}

	public function ambilSemua(){
		$wisata = $this->m_wisata->getAllWisata();

		$data = array();

		foreach ($wisata as $result) {
			$wisata_id = $result['wisata_alam_id'];

			// rating/nilai
			$rating = $this->m_wisata->getAvRatingWisata($result['wisata_alam_id']);
			$jumlahRating = $rating['jumRating'];

			$data[] = array(
				'wisata_id'				=> $wisata_id,
				'nama_wisata'			=> $result['nama_wisata_alam'],
				'cover_photo'			=> base_url('assets/upload/'.$result['cover_photo']),
				'alamat_wisata'			=> $result['alamat_wisata_alam'],
				'deskripsi_wisata'		=> $result['deskripsi_wisata_alam'],
				'cuplikan_deskripsi'	=> substr($result['deskripsi_wisata_alam'], 0,160),
				'hari'					=> unserialize($result['hari']),
				'jam_buka'				=> $result['jam_buka'],
				'jam_tutup'				=> $result['jam_tutup'],
				'lat'					=> $result['lat'],
				'long'					=> $result['long'],
				'latlong'				=> $result['lat'].','.$result['long'],
				'status'				=> $result['status_wisata'],
				'date_add'				=> $result['date_add'],
				'oleh'					=> $result['nama'],
				'nilai'					=> ceil($jumlahRating)
			);
		}

		$this->outputJson($data);
	}

	public function ambilSatu($id=null){
		$wisata = $this->m_wisata->getOneWisata(array('wisata_alam_id'=> $id));

		// rating/nilai
		$rating = $this->m_wisata->getAvRatingWisata($wisata['wisata_alam_id']);
		$jumlahRating = $rating['jumRating'];

		$data = array(
			'wisata_id'				=> $wisata['wisata_alam_id'],
			'nama_wisata'			=> $wisata['nama_wisata_alam'],
			'cover_photo'			=> base_url('assets/upload/'.$wisata['cover_photo']),
			'alamat_wisata'			=> $wisata['alamat_wisata_alam'],
			'deskripsi_wisata'		=> $wisata['deskripsi_wisata_alam'],
			'cuplikan_deskripsi'	=> substr($wisata['deskripsi_wisata_alam'], 0,160),
			'hari'					=> unserialize($wisata['hari']),
			'jam_buka'				=> $wisata['jam_buka'],
			'jam_tutup'				=> $wisata['jam_tutup'],
			'lat'					=> $wisata['lat'],
			'long'					=> $wisata['long'],
			'latlong'				=> $wisata['lat'].','.$wisata['long'],
			'status'				=> $wisata['status_wisata'],
			'date_add'				=> $wisata['date_add'],
			'oleh'					=> $wisata['nama'],
			'nilai'					=> ceil($jumlahRating)
		);

		$this->outputJson($data);
	}

	public function ambilGaleri($id=null){
		$wisata = $this->m_wisata->getGaleri($id);

		$data = array();

		foreach ($wisata as $result) {
			$wisata_id = $result['wisata_alam_id'];

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

	public function ambilKomentar($id=null){
		$wisata = $this->m_wisata->getKomentarWisata($id);

		$data = array();

		foreach ($wisata as $result) {
			$wisata_id = $result['wisata_alam_id'];

			$data[] = array(
				'wisata_id'				=> $wisata_id,
				'komentar'				=> strip_tags($result['komentar']),
				'oleh'					=> $result['nama'],
				'date_add'				=> $result['date_add']
			);
		}

		$this->outputJson($data);
	}

}