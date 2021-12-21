<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Komentar_model extends CI_Model {
	public function hapus($id_komentar)

	{
		$this->db->where('id_komentar', $id_komentar);
		$this->db->delete('tb_komentar');

	}
	public function balas($id_komentar, $nama_komentar, $email_komentar, $id_komentar_berita, $id_author, $website_komentar, $konten_komentar)

	{
		$object = array(
			'nama_komentar'			=> $nama_komentar,
			'email_komentar'		=> $email_komentar,
			'parent_komentar' 		=> $id_komentar,
			'id_komentar_berita' 	=> $id_komentar_berita,
			'id_author_berita' 	=> $id_author,
			'website_komentar' 		=> $website_komentar,
			'konten_komentar' 		=> $konten_komentar,
			'dibaca'				=> '1'
		);
		$this->db->insert('tb_komentar', $object);

	}
	public function dibaca($id_komentar)

	{
		$object = array('dibaca' => '1');
		$this->db->where('id_komentar', $id_komentar);
		$this->db->update('tb_komentar', $object);

	}
	public function update($id_komentar, $website_komentar, $konten_komentar)

	{
		$object = array(
			'website_komentar' => $website_komentar,
			'konten_komentar' => $konten_komentar,
		);
		$this->db->where('id_komentar', $id_komentar);
		$this->db->update('tb_komentar', $object);

	}
	public function get_data_by_id($id_komentar)

	{
		$query = $this->db->get_where('tb_komentar', array('id_komentar' => $id_komentar));
		return $query;

	}
	public function get_all_komentar($offset, $limit, $id_personil)

	{
		$query = $this->db->query("SELECT tb_komentar.*, tb_berita.* FROM tb_komentar JOIN tb_berita ON id_komentar_berita = id_berita WHERE parent_komentar = '0' AND id_author_berita = '$id_personil'ORDER BY id_komentar DESC LIMIT $offset, $limit ");
		return $query;

	}
	public function get_unview_komentar_by_id_author($id_author)
	{
		$query = $this->db->query("SELECT * FROM tb_komentar WHERE dibaca = 0 AND id_author_berita = '$id_author'");
		return $query;
	}	
	}
	/* End of file Komentar_model.php */

/* Location: ./application/models/admin/Komentar_model.php */
?>