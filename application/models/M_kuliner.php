<?php if ( ! defined('BASEPATH')) exit('Alag siah!');

class M_kuliner extends CI_Model {

	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2016-05-22 20:14:17
	**/

	function __construct(){
		parent::__construct();
		$this->tb_kuliner = 'wisata_kuliner';
		$this->tb_kuliner_galeri = 'wisata_kuliner_galeri';
		$this->tb_user = 'user';
		$this->tb_komentar = 'komentar_kuliner';
		$this->tb_rating = 'rating_kuliner';
	}

	public function getAllWisata(){
		$query = $this->db->select("*,".$this->tb_kuliner.".stt as status_kuliner");
		$query = $this->db->join($this->tb_user, $this->tb_user.'.user_id='.$this->tb_kuliner.'.user_id','left');
		$query = $this->db->get($this->tb_kuliner);
		$query = $query->result_array();

		return $query;
	}

	public function getSearchWisata($where){
		$query = $this->db->select("*,".$this->tb_kuliner.".stt as status_kuliner");
		$query = $this->db->join($this->tb_user, $this->tb_user.'.user_id='.$this->tb_kuliner.'.user_id','left');
		$query = $this->db->like('nama_wisata_kuliner', $where); 
		$query = $this->db->get($this->tb_kuliner);
		$query = $query->result_array();

		return $query;
	}

	public function getWisata($where=array(),$namaWisata=null){
		$query = $this->db->select("*,".$this->tb_kuliner.".stt as status_kuliner");
		$query = $this->db->join($this->tb_user, $this->tb_user.'.user_id='.$this->tb_kuliner.'.user_id','left');
		$query = (!empty($namaWisata)) ? $this->db->like('nama_wisata_kuliner', $namaWisata) : '';
		$query = $this->db->get_where($this->tb_kuliner, $where);
		$query = $query->result_array();

		return $query;
	}

	public function getWisataPer($awal="",$akhir=""){
		$query = $this->db->select("*,".$this->tb_kuliner.".stt as status_kuliner");
		$query = $this->db->join($this->tb_user, $this->tb_user.'.user_id='.$this->tb_kuliner.'.user_id','left');
		$query = $this->db->get($this->tb_kuliner,$awal,$akhir);
        $query = $query->result_array();

        return $query;
	}

	public function getOneWisata($where=array()){
		$query = $this->db->select("*,".$this->tb_kuliner.".stt as status_kuliner");
		$query = $this->db->join($this->tb_user, $this->tb_user.'.user_id='.$this->tb_kuliner.'.user_id','left');
		$query = $this->db->get_where($this->tb_kuliner,$where);
		$query = $query->result_array();

		if(!empty($query)){
			return $query[0];
		}
	}

	public function ubahWisata($field=array(),$idna=array()){
		$query = $this->db->update($this->tb_kuliner,$field,$idna);
		return $query;
	}

	public function tambahWisata($inp=array()){
		$query = $this->db->insert($this->tb_kuliner,$inp);
		$query = $this->db->insert_id();
		return $query;
	}

	public function hapusWisata($idna=array()){
		$query = $this->db->delete($this->tb_kuliner,$idna);
		return $query;
	}

	public function getGaleri($id_wisata=null){
		$query = $this->db->get_where($this->tb_kuliner_galeri,array('wisata_kuliner_id'=>$id_wisata));
		$query = $query->result_array();

		return $query;
	}

	public function simpanGaleri($inp=array()){
		$query = $this->db->insert($this->tb_kuliner_galeri,$inp);
		return $query;
	}

	public function hapusGaleri($id_wisata=null){
		$query = $this->db->delete($this->tb_kuliner_galeri,array('wisata_kuliner_id'=>$id_wisata));
		return $query;
	}

	// Nilai/rating
	public function topWisata(){
		$query = $this->db->query("select *,SUM(jumlah_bintang)/COUNT(rating_kuliner_id) as jumRating, COUNT(rating_kuliner_id) as totRating 
			from rating_kuliner GROUP BY wisata_kuliner_id ORDER BY totRating desc,jumRating desc limit 3");
		$query = $query->result_array();

		return $query;
	}

	public function getAvRatingWisata($wisata_id=null){
		$query = $this->db->query("select *,SUM(jumlah_bintang)/COUNT(rating_kuliner_id) as jumRating, COUNT(rating_kuliner_id) as totRating from rating_kuliner where wisata_kuliner_id=$wisata_id");
		$query = $query->result_array();

		if(!empty($query)){
			return $query[0];
		}
	}

	public function getRatingWisata($wisata_id=null){
		$query = $this->db->join($this->tb_user,$this->tb_user.'.user_id='.$this->tb_rating.'.user_id');
		$query = $this->db->get_where($this->tb_rating,array('wisata_kuliner_id'=>$wisata_id));
		$query = $query->result_array();

		return $query;
	}

	public function cekRating($where=array()){
		$query = $this->db->get_where($this->tb_rating,$where);
		$query = $query->result_array();

		if(!empty($query)){
			return $query[0];
		}
	}

	public function tambahRating($inp=array()){
		$query = $this->db->insert($this->tb_rating,$inp);
		return $query;
	}

	public function ubahRating($field=array(),$idna=array()){
		$query = $this->db->update($this->tb_rating,$field,$idna);
		return $query;
	}

	public function hapusRating($id_wisata=null){
		$query = $this->db->delete($this->tb_rating,array('wisata_kuliner_id'=>$id_wisata));
		return $query;
	}

	// Komentar
	public function kirimKomentar($inp=array()){
		$query = $this->db->insert($this->tb_komentar,$inp);
		return $query;
	}

	public function hapusKomentar($id_komentar=null){
		$query = $this->db->delete($this->tb_komentar,array('komentar_kuliner_id'=>$id_komentar));
		return $query;
	}

	public function hapusKomentarOnWis($id_wisata=null){
		$query = $this->db->delete($this->tb_komentar,array('wisata_kuliner_id'=>$id_wisata));
		return $query;
	}

	public function getAllKomentar(){
		$query = $this->db->join($this->tb_kuliner,$this->tb_kuliner.'.wisata_kuliner_id='.$this->tb_komentar.'.wisata_kuliner_id');
		$query = $this->db->join($this->tb_user,$this->tb_user.'.user_id='.$this->tb_komentar.'.user_id');
		$query = $this->db->get($this->tb_komentar);

		$query = $query->result_array();

		return $query;
	}

	public function getKomentarWisata($id_wisata=null){
		$query = $this->db->join($this->tb_kuliner,$this->tb_kuliner.'.wisata_kuliner_id='.$this->tb_komentar.'.wisata_kuliner_id');
		$query = $this->db->join($this->tb_user,$this->tb_user.'.user_id='.$this->tb_komentar.'.user_id');
		$query = $this->db->get_where($this->tb_komentar,array($this->tb_komentar.'.wisata_kuliner_id'=>$id_wisata));

		$query = $query->result_array();

		return $query;
	}

	public function getKomentarPer($awal="",$akhir=""){
		// $query = $this->db->select("*,".$this->tb_kuliner.".stt as status_wisata");
		$query = $this->db->join($this->tb_kuliner,$this->tb_kuliner.'.wisata_kuliner_id='.$this->tb_komentar.'.wisata_kuliner_id');
		$query = $this->db->join($this->tb_user,$this->tb_user.'.user_id='.$this->tb_komentar.'.user_id');
		$query = $this->db->get($this->tb_komentar,$awal,$akhir);
        $query = $query->result_array();

        return $query;
	}

	public function delKomentar($id_komentar=null){
		$query = $this->db->delete($this->tb_komentar,array('komentar_kuliner_id'=>$id_komentar));
		return $query;
	}

}