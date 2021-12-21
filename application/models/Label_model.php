<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Label_model extends CI_Model {
	public function get_label()
	{
		$this->db->select('*');
		$this->db->from('tb_label_berita');
		$this->db->group_by('slug_label');
		$query = $this->db->get();
		return $query;
	}
	public function get_label_by_slug($label)
	{
		$query = $this->db->get_where('tb_label_berita', array('slug_label' => $label));
		return $query;
	}
	public function get_berita_by_label($label)
	{
		$this->db->select('tb_berita.*, tb_kategori_berita.*, tb_users.*');
		$this->db->from('tb_berita');
		$this->db->join('tb_kategori_berita', 'id_kategori_berita = id_kategori', 'left');
		$this->db->join('tb_users', 'id_author = id', 'left');
		$this->db->where('publish_berita', 1);
		$this->db->like('label_berita', $label, 'BOTH');
		$query = $this->db->get();
		return $query;
	}
	public function get_label_berita_perpage($offset, $limit, $label)
	{
		$this->db->select('tb_berita.*, tb_kategori_berita.*, tb_users.*');
		$this->db->from('tb_berita');
		$this->db->join('tb_kategori_berita', 'id_kategori_berita = id_kategori', 'left');
		$this->db->join('tb_users', 'id_author = id', 'left');
		$this->db->where('publish_berita', 1);
		$this->db->like('label_berita', $label, 'BOTH');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query;
	}	

}

/* End of file Label_model.php */
/* Location: ./application/models/Label_model.php */

 ?>