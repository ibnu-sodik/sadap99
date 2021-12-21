<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Author_model extends CI_Model {

	public function get_data_by_username($username)
	{
		$query = $this->db->query("SELECT * FROM tb_users WHERE username = '$username' AND status = 1 ");
		return $query;
	}

	public function get_berita_by_author($limit, $offset, $id)
	{
		$this->db->select('tb_berita.*, tb_kategori_berita.*, tb_users.*');
		$this->db->from('tb_berita');
		$this->db->join('tb_kategori_berita', 'id_kategori_berita = id_kategori', 'left');
		$this->db->join('tb_users', 'id_author = id', 'left');
		$this->db->where(array('id_author' => $id, 'publish_berita' => 1));
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query;
	}

	public function get_users()

	{
		$query = $this->db->get_where('tb_users', array('status' => 1));

		return $query;

	}

}

/* End of file Author_model.php */
/* Location: ./application/models/Author_model.php */

 ?>