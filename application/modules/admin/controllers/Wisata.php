<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once (dirname(__FILE__) . "/Main.php");

class Wisata extends Main{
	
	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2016-05-17 19:42:40
	**/

	function __construct(){
		parent::__construct();

		// Load model
		$this->load->model('m_wisata');

		// Load libraries
		$this->load->library('pagination');
	}

	public function index($id=null){
		// Title & desc
		$this->global_data['title'] = "Wisata Alam";
		$this->global_data['description'] = "Kelola tempat wisata alam";
		$this->global_data['menu'] = "wisata";
		
		$this->global_data['add_style'] = array(
			// base_url('assets/js/plugins/datatables/jquery.dataTables.min.css')
		);

		$this->global_data['add_script'] = array();

		// Notif
		$this->global_data['notif'] = $this->session->flashdata('notif');

		$stat = $this->input->get('stt');
		$cari = $this->input->get('cari');

		// Jumlah status
		$this->global_data['jumlahWis'][0] = count($this->m_wisata->getAllWisata());
		for($i=1;$i<=3;$i++){
			$this->global_data['jumlahWis'][$i] = count($this->m_wisata->getWisata(array('wisata_alam.stt'=> $i)));
		}

		// status
		if(!empty($stat)){
			$wisata = $this->m_wisata->getWisata(array('wisata_alam.stt'=> $this->input->get('stt')));

			$wisata = (!empty($cari)) ? $this->m_wisata->getWisata(array('wisata_alam.stt'=> $stat),$cari) : $this->m_wisata->getWisata(array('wisata_alam.stt'=> $stat));

			$jumlahData = count($wisata);
			$perPage = $jumlahData;
			$this->global_data['stt'] = "<input type=\"hidden\" name=\"stt\" value=\"".$stat."\" />";
		}else{
			$perPage = $this->config->item('jumlah_pagination');
			$jumlahData = count($this->m_wisata->getAllWisata());

			$wisata = (!empty($this->input->get('cari'))) ? $this->m_wisata->getSearchWisata($this->input->get('cari')) : $this->m_wisata->getWisataPer($perPage, $id);
			
			$this->global_data['stt'] = "";
		}

		// if(!empty($cari)){
		// 	$this->global_data['href_all'] = site_url('admin/wisata/?cari='.$cari);
		// 	$this->global_data['href_approve'] = site_url('admin/wisata/?cari='.$cari.'&stt=1');
		// 	$this->global_data['href_reject'] = site_url('admin/wisata/?cari='.$cari.'&stt=2');
		// 	$this->global_data['href_wait'] = site_url('admin/wisata/?cari='.$cari.'&stt=3');

		// }else{
			
		// }

		$this->global_data['href_all'] = site_url('admin/wisata');
		$this->global_data['href_approve'] = site_url('admin/wisata/?stt=1');
		$this->global_data['href_reject'] = site_url('admin/wisata/?stt=2');
		$this->global_data['href_wait'] = site_url('admin/wisata/?stt=3');
		

		//pengaturan pagination
		$config['base_url'] = site_url('admin/wisata/index');
		$config['total_rows'] = $jumlahData;
		$config['per_page'] = $perPage;
		$config['full_tag_open'] = '<div class="box-footer clearfix"><ul class="pagination pagination-sm no-margin pull-right">';
		$config['full_tag_close'] = '</ul></div>';
		$config['next_link'] = 'Lanjut &raquo;';
		$config['prev_link'] = '&laquo; Kembali';
		$config['cur_tag_open'] = '<li class="disabled"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['num_links'] = 1;
		$config['last_link'] = '<b>Akhir &rsaquo;</b>';
		$config['first_link'] = '<b>&lsaquo; Awal</b>';

		//inisialisasi config pagination
		$this->pagination->initialize($config);

		//buat pagination
		$this->global_data['halaman'] = $this->pagination->create_links(); 

		// data wisata
		$this->global_data['dataWisata'] = array();

		// $wisata = (!empty($this->input->get('cari'))) ? $this->m_wisata->getSearchWisata($this->input->get('cari')) : $this->m_wisata->getWisataPer($config['per_page'], $id);

		$no = $id+1;
		foreach ($wisata as $result) {
			if($result['status_wisata']==1){
				$status = "<span class=\"label label-sm label-success\">Diterima</span>";
			}else if($result['status_wisata']==2){
				$status = "<span class=\"label label-sm label-danger\">Ditolak</span>";
			}else{
				$status = "<span class=\"label label-sm label-warning\">Belum di Konfirmasi</span>";
			}

			// rating/nilai
			$rating = $this->m_wisata->getAvRatingWisata($result['wisata_alam_id']);
			$jumlahRating = $rating['jumRating'];

			$nilai ="";

			if(!$jumlahRating){ //0=false
				for($i=1;$i<=5;$i++){
					$nilai .= "<i class=\"fa fa-star-o\"></i>";
				}
			}else{
				for($i=1;$i<=ceil($jumlahRating);$i++){
					$nilai .= "<i class=\"fa fa-star\"></i>";
				}
				for($i=1;$i<=5-$jumlahRating;$i++){
					$nilai .= "<i class=\"fa fa-star-o\"></i>";
				}
			}

			$this->global_data['dataWisata'][] = array(
				'no'			=> $no,
				'wisata_id'		=> $result['wisata_alam_id'],
				'nama_wisata'	=> $result['nama_wisata_alam'],
				'oleh'			=> $result['nama'],
				'nilai'			=> $nilai,
				'stt'			=> $status,
				'date_add'		=> (!empty($result['date_add']))?tgl_indo(substr($result['date_add'], 0,10)):null,
				'href_view'		=> site_url('admin/wisata/view/'.$result['wisata_alam_id']),
				'href_edit'		=> site_url('admin/wisata/edit/'.$result['wisata_alam_id']),
				'href_delete'	=> site_url('admin/wisata/delete/'.$result['wisata_alam_id'])
			);
			$no++;
		}

		$this->global_data['total'] = "Total data : ";
		if($jumlahData>$perPage){
			$this->global_data['total'] .= $perPage;
			$this->global_data['total'] .= " dari ".$jumlahData." data.";
		}else{
			$jum = (!empty($this->input->get('cari'))) ? count($this->m_wisata->getSearchWisata($this->input->get('cari'))) : $jumlahData;
			$this->global_data['total'] .= $jum;
			$this->global_data['total'] .= " dari ".$jumlahData." data.";
		}

		$this->global_data['search'] = (!empty($this->input->get('cari'))) ? $this->input->get('cari') : '';

		$this->tampilan('wisata/list');
	}

	public function add(){
		// Title & desc
		$this->global_data['title'] = "Tambah Wisata";
		$this->global_data['description'] = "Tambah tempat wisata";
		$this->global_data['menu'] = "wisata";

		$this->global_data['notif'] = $this->session->flashdata('notif');

		if($this->input->post('kirim')){
			$nama = $this->input->post('nama');
			$alamat = $this->input->post('alamat');
			$cover = $this->input->post('cover');
			$hari = $this->input->post('hari');
			$buka = $this->input->post('buka');
			$tutup = $this->input->post('tutup');
			$lat = $this->input->post('lat');
			$long = $this->input->post('lon');
			$status = $this->input->post('status');
			$deskripsi = $this->input->post('deskripsi');

			if(empty($hari)){
				$hari = array();
			}

			if(!empty($nama) && !empty($alamat) && !empty($deskripsi) && !empty($lat) && !empty($long)){
				$input = array(
					'nama_wisata_alam'		=> $nama, 
					'alamat_wisata_alam'		=> $alamat,
					'cover_photo'		=> $cover,
					'deskripsi_wisata_alam' 	=> $deskripsi,
					'hari'				=> serialize($hari),
					'jam_buka'			=> $buka,
					'jam_tutup'			=> $tutup,
					'lat'				=> $lat,
					'long'				=> $long,
					'stt'				=> $status,
					'date_add'			=> date("Y-m-d h:i:s"),
					'featured'			=> 1,
					'user_id'			=> $this->session->userdata('id_user')
				);

				$simpan = $this->m_wisata->tambahWisata($input);

				$foto = $this->input->post('foto');

				if(!empty($simpan)||!empty($foto)){
					foreach ($foto as $foto) {
						// echo $foto['nama_foto'].':'.$foto['url_foto'].'<br>';
						$nama_foto = $foto['nama_foto'];
						$deskripsi_foto = $foto['deskripsi_foto'];
						$url_foto = $foto['url_foto'];

						if(!empty($nama_foto)||empty($deskripsi_foto)){
							$this->m_wisata->simpanGaleri(
								array(
									'nama_foto'			=> $nama_foto,
									'deskripsi_foto'	=> $deskripsi_foto,
									'url_foto'			=> $url_foto,
									'stt'				=> 1,
									'date_add'			=> date("Y-m-d"),
									'time_add'			=> date("h:i:s"),
									'wisata_alam_id'	=> $simpan
								)
							);
						}
					}
					$notif = "<div class=\"note note-success\">";
					$notif .= "<h4 class=\"block\">Sukses</h4>";
					$notif .= "<p><i class=\"fa fa-warning\"></i> Berhasil menambah data ".$nama."!</p>";
					$notif .= "</div>";

	             	$this->session->set_flashdata('notif',$notif);
	             	redirect('admin/wisata');
				}
			}else{ // Kalo kosong
				$notif = "<div class=\"note note-info\">";
				$notif .= "<h4 class=\"block\">Info</h4>";
				$notif .= "<p><i class=\"fa fa-warning\"></i> Tidak boleh ada yang kosong!</p>";
				$notif .= "</div>";

	         	$this->session->set_flashdata('notif',$notif);
	         	redirect('admin/wisata/add');
			}
			
		}

		$this->form();
	}

	public function edit(){
		$idnyah = $this->uri->segment(4);

		if(empty($idnyah)){
			redirect('admin/wisata');
		}

		$this->global_data['title'] = "Ubah Wisata";
		$this->global_data['description'] = "Ubah tempat wisata";
		$this->global_data['menu'] = "wisata";

		$this->global_data['notif'] = $this->session->flashdata('notif');

		$this->global_data['dataWisata'] = $this->m_wisata->getOneWisata(array('wisata_alam_id'=>$idnyah));
		$this->global_data['dataGaleri']	= $this->m_wisata->getGaleri($idnyah);

		if($this->input->post('kirim')){
			$nama = $this->input->post('nama');
			$alamat = $this->input->post('alamat');
			$cover = $this->input->post('cover');
			$hari = $this->input->post('hari');
			$buka = $this->input->post('buka');
			$tutup = $this->input->post('tutup');
			$lat = $this->input->post('lat');
			$long = $this->input->post('lon');
			$status = $this->input->post('status');
			$deskripsi = $this->input->post('deskripsi');

			if(empty($hari)){
				$hari = array();
			}

			if(!empty($nama) && !empty($alamat) && !empty($deskripsi) && !empty($lat) && !empty($long)){
				$input = array(
					'nama_wisata_alam'		=> $nama, 
					'alamat_wisata_alam'		=> $alamat,
					'cover_photo'		=> $cover,
					'deskripsi_wisata_alam' 	=> $deskripsi,
					'hari'				=> serialize($hari),
					'jam_buka'			=> $buka,
					'jam_tutup'			=> $tutup,
					'lat'				=> $lat,
					'long'				=> $long,
					'stt'				=> $status,
					'date_update'		=> date("Y-m-d h:i:s")
				);

				$ubah = $this->m_wisata->ubahWisata($input,array('wisata_alam_id'=>$idnyah));

				$foto = $this->input->post('foto');
				$this->m_wisata->hapusGaleri($idnyah);
				if(!empty($foto)){
					foreach ($foto as $foto) {
						// echo $foto['nama_foto'].':'.$foto['url_foto'].'<br>';
						$nama_foto = $foto['nama_foto'];
						$deskripsi_foto = $foto['deskripsi_foto'];
						$url_foto = $foto['url_foto'];

						if(!empty($nama_foto)||empty($deskripsi_foto)){
							$this->m_wisata->simpanGaleri(
								array(
									'nama_foto'			=> $nama_foto,
									'deskripsi_foto'	=> $deskripsi_foto,
									'url_foto'			=> $url_foto,
									'stt'				=> 1,
									'date_add'			=> date("Y-m-d"),
									'time_add'			=> date("h:i:s"),
									'wisata_alam_id'	=> $idnyah
								)
							);
						}	
					}
				}

				if($ubah){
	             	$notif = "<div class=\"note note-success\">";
					$notif .= "<h4 class=\"block\">Sukses</h4>";
					$notif .= "<p><i class=\"fa fa-warning\"></i> Berhasil mengubah data ".$nama."!</p>";
					$notif .= "</div>";

	             	$this->session->set_flashdata('notif',$notif);
	             	redirect('admin/wisata');
				}
			}else{ // Kalo kosong
				$notif = "<div class=\"note note-info\">";
				$notif .= "<h4 class=\"block\">Info</h4>";
				$notif .= "<p><i class=\"fa fa-warning\"></i> Tidak boleh ada yang kosong!</p>";
				$notif .= "</div>";

	         	$this->session->set_flashdata('notif',$notif);
	         	redirect('admin/wisata/edit/'.$idnyah);
			}
			
		}

		$this->form();
	}

	public function view(){
		$id = $this->uri->segment(4);

		if(empty($id)){
			redirect('admin/wisata');
		}

		$this->global_data['dataWisata'] = $this->m_wisata->getOneWisata(array('wisata_alam_id'=>$id));

		$this->global_data['title'] = $this->global_data['dataWisata']['nama_wisata_alam'];
		$this->global_data['description'] = "Lihat tempat wisata alam";
		$this->global_data['menu'] = "wisata";

		// Get galeri
		$this->global_data['dataGaleri'] = $this->m_wisata->getGaleri($id);
		// Get who is rating?
		$this->global_data['dataRating'] = array();
		$rating = $this->m_wisata->getRatingWisata($id);

		foreach ($rating as $res) {
			$nilai ="";
			$jumlahRating = $res['jumlah_bintang'];

			if(!$jumlahRating){ //0=false
				for($i=1;$i<=5;$i++){
					$nilai .= "<i class=\"fa fa-star-o\"></i>";
				}
			}else{
				for($i=1;$i<=ceil($jumlahRating);$i++){
					$nilai .= "<i class=\"fa fa-star\"></i>";
				}
				for($i=1;$i<=5-$jumlahRating;$i++){
					$nilai .= "<i class=\"fa fa-star-o\"></i>";
				}
			}

			$this->global_data['dataRating'][] = array(
				'oleh'		=> $res['nama'],
				'nilai'		=> $nilai,
				'tanggal'	=> (!empty($res['date_add']))?tgl_indo(substr($res['date_add'], 0,10)):null,
			);
		}

		$this->tampilan('wisata/view');
	}

	public function comment($id=null){
		$this->global_data['title'] = "Komentar Wisata Alam";
		$this->global_data['description'] = "Lihat komentar wisata alam";
		$this->global_data['menu'] = "wisata";

		// Notif
		$this->global_data['notif'] = $this->session->flashdata('notif');

		$jumlahData = count($this->m_wisata->getAllKomentar());
		$perPage = $this->config->item('jumlah_pagination');

		//pengaturan pagination
		$config['base_url'] = site_url('admin/wisata/comment');
		$config['total_rows'] = $jumlahData;
		$config['per_page'] = $perPage;
		$config['full_tag_open'] = '<div class="box-footer clearfix"><ul class="pagination pagination-sm no-margin pull-right">';
		$config['full_tag_close'] = '</ul></div>';
		$config['next_link'] = 'Lanjut &raquo;';
		$config['prev_link'] = '&laquo; Kembali';
		$config['cur_tag_open'] = '<li class="disabled"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['num_links'] = 1;
		$config['last_link'] = '<b>Akhir &rsaquo;</b>';
		$config['first_link'] = '<b>&lsaquo; Awal</b>';

		//inisialisasi config pagination
		$this->pagination->initialize($config);

		//buat pagination
		$this->global_data['halaman'] = $this->pagination->create_links(); 

		// data wisata
		$this->global_data['dataKomentar'] = array();

		$wisata = $this->m_wisata->getKomentarPer($config['per_page'], $id);

		$no = $id+1;
		foreach ($wisata as $result) {

			$this->global_data['dataKomentar'][] = array(
				'no'			=> $no,
				'komentar_id'	=> $result['komentar_alam_id'],
				'nama_wisata'	=> $result['nama_wisata_alam'],
				'oleh'			=> $result['nama'],
				'komentar'		=> strip_tags(htmlspecialchars_decode($result['komentar'])),
				'date_add'		=> (!empty($result['date_add']))?tgl_indo(substr($result['date_add'], 0,10)):null,
				'href_wisata'	=> site_url('admin/wisata/view/'.$result['wisata_alam_id'])
			);
			$no++;
		}

		$this->global_data['total'] = "Total data : ";
		if($jumlahData>$perPage){
			$this->global_data['total'] .= $perPage;
			$this->global_data['total'] .= " dari ".$jumlahData." data.";
		}else{
			$jum = (!empty($this->input->get('cari'))) ? count($this->m_wisata->getSearchWisata($this->input->get('cari'))) : $jumlahData;
			$this->global_data['total'] .= $jum;
			$this->global_data['total'] .= " dari ".$jumlahData." data.";
		}

		// Delete comment
		// pengennya ditampung di trash dulu
		$del = $this->input->get('delete');
		if(!empty($del)){
			$delete = $this->m_wisata->delKomentar($del);

			if($delete){
				$notif = "<div class=\"note note-success\">";
				$notif .= "<h4 class=\"block\">Sukses</h4>";
				$notif .= "<p><i class=\"fa fa-warning\"></i> Berhasil menghapus data!</p>";
				$notif .= "</div>";

				$this->session->set_flashdata('notif',$notif);
			}else{
				$notif = "<div class=\"note note-info\">";
				$notif .= "<h4 class=\"block\">Info</h4>";
				$notif .= "<p><i class=\"fa fa-warning\"></i> Gagal menghapus data!</p>";
				$notif .= "</div>";

				$this->session->set_flashdata('notif',$notif);
			}
			redirect('admin/wisata/comment');
		}


		$this->tampilan('wisata/comment');
	}

	public function delete(){
		$id = $this->uri->segment(4);

		if(!empty($id)){
			$delete = $this->m_wisata->hapusGaleri($id);
			$hapRat = $this->m_wisata->hapusRating($id);
			$hapKom = $this->m_wisata->hapusKomentarOnWis($id);
			if($delete){
				$this->m_wisata->hapusWisata(array('wisata_alam_id'=>$id));
				$notif = "<div class=\"note note-success\">";
				$notif .= "<h4 class=\"block\">Sukses</h4>";
				$notif .= "<p><i class=\"fa fa-warning\"></i> Berhasil menghapus data!</p>";
				$notif .= "</div>";

				$this->session->set_flashdata('notif',$notif);
			}else{
				$notif = "<div class=\"note note-info\">";
				$notif .= "<h4 class=\"block\">Info</h4>";
				$notif .= "<p><i class=\"fa fa-warning\"></i> Gagal menghapus data!</p>";
				$notif .= "</div>";

				$this->session->set_flashdata('notif',$notif);
			}
		}

		redirect('admin/wisata');
		
	}

	public function status(){
		$id = $this->input->get('id');

		if(!empty($id)){
			$status	= $this->input->get('type');
			if(!empty($status)){
				if($status=='approve'){
					$stt = 1;
				}else if($status=='reject'){
					$stt = 2;
				}
				$ubah = $this->m_wisata->ubahWisata(array('stt'=>$stt),array('wisata_alam_id'=>$id));
				if($ubah){
					$notif = "<div class=\"note note-info\">";
					$notif .= "<h4 class=\"block\">Info</h4>";
					$notif .= "<p><i class=\"fa fa-warning\"></i> Berhasil mengubah status!</p>";
					$notif .= "</div>";

					$this->session->set_flashdata('notif',$notif);
				}
			}
		}

		redirect('admin/wisata');
	}

	private function form(){
		$this->global_data['add_style'] = array();

		$this->global_data['add_script'] = array(
			base_url('assets/admin/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js'),
			base_url('assets/admin/global/plugins/select2/select2.min.js')
		);

		$this->global_data['add_script_up'] = array(
			base_url('assets/admin/plugins/tinymce/js/tinymce/tinymce.min.js'),
		);

		$this->tampilan('wisata/form');
	}

}