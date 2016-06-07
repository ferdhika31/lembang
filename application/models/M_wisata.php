<?php if ( ! defined('BASEPATH')) exit('Alag siah!');

class M_wisata extends CI_Model {
	
	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2016-05-17 20:26:28
		* @Keterangan 			: Model wisata alam
	**/

	function __construct(){
		parent::__construct();
		$this->tb_wisata = 'wisata_alam';
		$this->tb_wisata_galeri = 'wisata_alam_galeri';
		$this->tb_user = 'user';
		$this->tb_komentar = 'komentar_alam';
		$this->tb_rating = 'rating_alam';
	}

	public function getAllWisata(){
		$query = $this->db->select("*,".$this->tb_wisata.".stt as status_wisata");
		$query = $this->db->join($this->tb_user, $this->tb_user.'.user_id='.$this->tb_wisata.'.user_id','left');
		$query = $this->db->get($this->tb_wisata);
		$query = $query->result_array();

		return $query;
	}

	public function getSearchWisata($where){
		$query = $this->db->select("*,".$this->tb_wisata.".stt as status_wisata");
		$query = $this->db->join($this->tb_user, $this->tb_user.'.user_id='.$this->tb_wisata.'.user_id','left');
		$query = $this->db->like('nama_wisata_alam', $where); 
		$query = $this->db->get($this->tb_wisata);
		$query = $query->result_array();

		return $query;
	}

	public function getWisata($where=array(),$namaWisata=null){
		$query = $this->db->select("*,".$this->tb_wisata.".stt as status_wisata");
		$query = $this->db->join($this->tb_user, $this->tb_user.'.user_id='.$this->tb_wisata.'.user_id','left');
		$query = (!empty($namaWisata)) ? $this->db->like('nama_wisata_alam', $namaWisata) : '';
		$query = $this->db->get_where($this->tb_wisata, $where);
		$query = $query->result_array();

		return $query;
	}

	public function getWisataPer($awal="",$akhir=""){
		$query = $this->db->select("*,".$this->tb_wisata.".stt as status_wisata");
		$query = $this->db->join($this->tb_user, $this->tb_user.'.user_id='.$this->tb_wisata.'.user_id','left');
		$query = $this->db->get($this->tb_wisata,$awal,$akhir);
        $query = $query->result_array();

        return $query;
	}

	public function getOneWisata($where=array()){
		$query = $this->db->select("*,".$this->tb_wisata.".stt as status_wisata");
		$query = $this->db->join($this->tb_user, $this->tb_user.'.user_id='.$this->tb_wisata.'.user_id','left');
		$query = $this->db->get_where($this->tb_wisata,$where);
		$query = $query->result_array();

		if(!empty($query)){
			return $query[0];
		}
	}

	public function ubahWisata($field=array(),$idna=array()){
		$query = $this->db->update($this->tb_wisata,$field,$idna);
		return $query;
	}

	public function tambahWisata($inp=array()){
		$query = $this->db->insert($this->tb_wisata,$inp);
		$query = $this->db->insert_id();
		return $query;
	}

	public function hapusWisata($idna=array()){
		$query = $this->db->delete($this->tb_wisata,$idna);
		return $query;
	}

	public function getGaleri($id_wisata=null){
		$query = $this->db->get_where($this->tb_wisata_galeri,array('wisata_alam_id'=>$id_wisata));
		$query = $query->result_array();

		return $query;
	}

	public function simpanGaleri($inp=array()){
		$query = $this->db->insert($this->tb_wisata_galeri,$inp);
		return $query;
	}

	public function hapusGaleri($id_wisata=null){
		$query = $this->db->delete($this->tb_wisata_galeri,array('wisata_alam_id'=>$id_wisata));
		return $query;
	}

	// Nilai/rating
	public function getAvRatingWisata($wisata_id=null){
		$query = $this->db->query("select *,SUM(jumlah_bintang)/COUNT(rating_alam_id) as jumRating, COUNT(rating_alam_id) as totRating from rating_alam where wisata_alam_id=$wisata_id");
		$query = $query->result_array();

		if(!empty($query)){
			return $query[0];
		}
	}

	public function getRatingWisata($wisata_id=null){
		$query = $this->db->join($this->tb_user,$this->tb_user.'.user_id='.$this->tb_rating.'.user_id');
		$query = $this->db->get_where($this->tb_rating,array('wisata_alam_id'=>$wisata_id));
		$query = $query->result_array();

		return $query;
	}

	// Komentar
	public function getAllKomentar(){
		$query = $this->db->join($this->tb_wisata,$this->tb_wisata.'.wisata_alam_id='.$this->tb_komentar.'.wisata_alam_id');
		$query = $this->db->join($this->tb_user,$this->tb_user.'.user_id='.$this->tb_komentar.'.user_id');
		$query = $this->db->get($this->tb_komentar);

		$query = $query->result_array();

		return $query;
	}

	public function getKomentarWisata($id_wisata=null){
		$query = $this->db->join($this->tb_wisata,$this->tb_wisata.'.wisata_alam_id='.$this->tb_komentar.'.wisata_alam_id');
		$query = $this->db->join($this->tb_user,$this->tb_user.'.user_id='.$this->tb_komentar.'.user_id');
		$query = $this->db->get_where($this->tb_komentar,array($this->tb_komentar.'.wisata_alam_id'=>$id_wisata));

		$query = $query->result_array();

		return $query;
	}

	public function getKomentarPer($awal="",$akhir=""){
		// $query = $this->db->select("*,".$this->tb_wisata.".stt as status_wisata");
		$query = $this->db->join($this->tb_wisata,$this->tb_wisata.'.wisata_alam_id='.$this->tb_komentar.'.wisata_alam_id');
		$query = $this->db->join($this->tb_user,$this->tb_user.'.user_id='.$this->tb_komentar.'.user_id');
		$query = $this->db->get($this->tb_komentar,$awal,$akhir);
        $query = $query->result_array();

        return $query;
	}

	public function delKomentar($id_komentar=null){
		$query = $this->db->delete($this->tb_komentar,array('komentar_alam_id'=>$id_komentar));
		return $query;
	}

}