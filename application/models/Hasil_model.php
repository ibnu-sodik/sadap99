<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Hasil_model extends CI_Model {
	
	function hitung_jumlah_cari($query)
	{
		$query = $this->db->query("SELECT tb_berita.*, tb_kategori_berita.*, tb_users.* FROM tb_berita
			LEFT Join tb_users ON id_author = id
			LEFT JOIN tb_kategori_berita ON tb_berita.id_kategori_berita = tb_kategori_berita.id_kategori
			WHERE judul_berita LIKE '%$query%' OR nama_kategori LIKE '%$query%'");
		return $query;
	}

	function get_pencarian_perpage($limit, $offset, $query)
	{
		$query = $this->db->query("SELECT tb_berita.*, tb_kategori_berita.*, tb_users.* FROM tb_berita
			LEFT Join tb_users ON id_author = id
			LEFT JOIN tb_kategori_berita ON tb_berita.id_kategori_berita = tb_kategori_berita.id_kategori
			WHERE judul_berita LIKE '%$query%' OR nama_kategori LIKE '%$query%' LIMIT $limit OFFSET $offset ");
		return $query;
	}

	

}

/* End of file Hasil_model.php */
/* Location: ./application/models/Hasil_model.php */

?>