<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Beranda_model extends CI_Model {
	public function get_populer_video()
	{
		$query = $this->db->query("SELECT * FROM tb_video ORDER BY views_video DESC LIMIT 1");
		return $query;
	}
	public function get_new_video()
	{
		$query = $this->db->query("SELECT * FROM tb_video ORDER BY id_video DESC LIMIT 1");
		return $query;
	}

	public function get_cta()
	{
		$query = $this->db->query("SELECT * FROM tb_cta");
		return $query;
	}
	public function get_berita_baru($limit)
	{
		$query = $this->db->query("SELECT tb_berita.*, tb_users.*, count(id_komentar) AS jumlah_komentar, tb_kategori_berita.* FROM tb_berita 
			LEFT JOIN tb_users ON id_author = id 
			LEFT JOIN tb_komentar ON id_berita = id_komentar_berita 
			LEFT JOIN tb_kategori_berita ON id_kategori_berita = id_kategori 
			WHERE publish_berita = 1 GROUP BY id_berita ORDER BY id_berita DESC LIMIT $limit");
		return $query;
	}
	public function get_berita_populer($limit)
	{			
		$this->db->select('tb_berita.*, tb_kategori_berita.*, tb_users.*');
		$this->db->from('tb_berita');
		$this->db->join('tb_kategori_berita', 'id_kategori_berita = id_kategori', 'left');
		$this->db->join('tb_users', 'id_author = id', 'left');
		$this->db->order_by('views_berita', 'desc');
		$this->db->where('publish_berita', 1);
		$this->db->limit($limit);
		$query = $this->db->get();
		return $query;
	}
	public function get_berita_review($limit)
	{
		$this->db->select('tb_berita.*, tb_users.*, count(id_komentar) AS jumlah_komentar, tb_kategori_berita.*');
		$this->db->from('tb_berita');
		$this->db->join('tb_users', 'id_author = id', 'left');
		$this->db->join('tb_kategori_berita', 'id_kategori_berita = id_kategori', 'left');
		$this->db->join('tb_komentar', 'id_komentar_berita = id_berita', 'left');
		$this->db->order_by('terakhir_dilihat', 'desc');
		$this->db->where('publish_berita', 1);
		$this->db->limit($limit);
		$query = $this->db->get();
		return $query;
	}
	public function get_berita_review_not_in($id_berita, $limit)
	{
		$this->db->select('tb_berita.*, tb_users.*, count(id_komentar) AS jumlah_komentar, tb_kategori_berita.*');
		$this->db->from('tb_berita');
		$this->db->join('tb_users', 'id_author = id', 'left');
		$this->db->join('tb_kategori_berita', 'id_kategori_berita = id_kategori', 'left');
		$this->db->join('tb_komentar', 'id_komentar_berita = id_berita', 'left');
		$this->db->order_by('terakhir_dilihat', 'desc');
		$this->db->where(array('publish_berita' => 1, 'id_berita !=' => $id_berita));
		$this->db->limit($limit);
		$query = $this->db->get();
		return $query;
	}
	public function get_berita_random($limit)
	{
		$this->db->select('*');
		$this->db->from('tb_berita');
		$this->db->order_by('rand()');
		$this->db->where('publish_berita', 1);
		$this->db->limit($limit);
		$query = $this->db->get();
		return $query;
	}
}
/* End of file Beranda_model.php */

/* Location: ./application/models/Beranda_model.php */
?>