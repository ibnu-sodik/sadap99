<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Halaman_model extends CI_Model {

	public function update_halaman($id_halaman, $nama_halaman, $konten, $slug, $deskripsi)
	{
		$tgl_update = date('Y-m-d H:i:s');
		$object = array(
			'nama_halaman' 		=> $nama_halaman,
			'konten_halaman' 	=> $konten,
			'deskripsi_halaman' 	=> $deskripsi,
			'slug_halaman' 		=> $slug,
			'halaman_update'		=> $tgl_update
		);
		$this->db->where('id_halaman', $id_halaman);
		$this->db->update('tb_halaman', $object);
	}

	public function hapus_halaman($id_halaman)
	{
		$this->db->where('id_halaman', $id_halaman);
		$this->db->delete('tb_halaman');
	}

	public function get_halaman_by_id($id_halaman)
	{
		$result = $this->db->query("SELECT * FROM tb_halaman WHERE id_halaman = '$id_halaman'");
		return $result;
	}	

	public function simpan_halaman($nama_halaman, $konten, $slug, $deskripsi)
	{
		$object = array(
			'nama_halaman' 		=> $nama_halaman,
			'konten_halaman' 	=> $konten,
			'deskripsi_halaman' 	=> $deskripsi,
			'slug_halaman' 		=> $slug
		);
		$this->db->insert('tb_halaman', $object);
	}

	public function get_all_halaman()
	{
		$this->db->select('*');
		$this->db->from('tb_halaman');
		$this->db->order_by('id_halaman', 'desc');
		$query = $this->db->get();
		return $query;
	}

}

/* End of file Halaman_model.php */
/* Location: ./application/models/admin/Halaman_model.php */

?>