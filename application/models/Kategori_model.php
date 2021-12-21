<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_model extends CI_Model {

	public function get_kategori($limit = '')
	{
		$this->db->select('*');
		$this->db->from('tb_kategori_berita');
		$this->db->group_by('slug_kategori');
		$this->db->order_by('nama_kategori', 'asc');
		if (empty($limit)) {
			$query = $this->db->get();
		}else{
			$this->db->limit($limit);
			$query = $this->db->get();
		}
		return $query;
	}
	public function get_berita_by_kategori($slug)
	{
		$query = $this->db->query("SELECT tb_berita.*, tb_kategori_berita.*, tb_users.*
			FROM `tb_berita`
			LEFT Join tb_users ON id_author = id
			LEFT JOIN tb_kategori_berita ON id_kategori_berita = id_kategori
			WHERE slug_kategori = '$slug' AND publish_berita = 1
			GROUP BY slug_berita");
		return $query;
	}
	public function get_kategori_berita_perpage($offset, $limit, $slug)
	{
		$query = $this->db->query("SELECT tb_berita.*, tb_kategori_berita.*, tb_users.*
			FROM `tb_berita`
			LEFT Join tb_users ON id_author = id
			LEFT JOIN tb_kategori_berita ON id_kategori_berita = id_kategori
			WHERE slug_kategori = '$slug' AND publish_berita = 1
			GROUP BY slug_berita LIMIT $offset, $limit ");
		return $query;
	}

}

/* End of file Kategori_model.php */
/* Location: ./application/models/Kategori_model.php */

?>