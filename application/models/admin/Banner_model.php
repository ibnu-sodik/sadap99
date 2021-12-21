<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Banner_model extends CI_Model {

	public function update_banner($id_banner, $judul_banner, $konten_banner)
	{
		$object = array(
			'judul_banner' => $judul_banner,
			'konten_banner' => $konten_banner
		);
		$this->db->where('id_banner', $id_banner);
		$this->db->update('tb_banner', $object);
	}

	public function update_banner_image($id_banner, $image, $judul_banner, $konten_banner)
	{
		$object = array(
			'judul_banner' => $judul_banner,
			'konten_banner' => $konten_banner,
			'gambar_banner' => $image
		);
		$this->db->where('id_banner', $id_banner);
		$this->db->update('tb_banner', $object);
	}

	public function hapus($id_banner)
	{
		$this->db->where('id_banner', $id_banner);
		$this->db->delete('tb_banner');
	}

	public function active_banner($id_banner)
	{
		$object = array('status_aktif' => 1);
		$this->db->where('id_banner', $id_banner);
		$this->db->update('tb_banner', $object);
	}

	public function inactive_all_banner()
	{
		$object = array('status_aktif' => 0);
		$this->db->update('tb_banner', $object);
	}

	public function simpan($image, $judul_banner, $konten_banner)
	{
		$object = array(
			'judul_banner' => $judul_banner,
			'konten_banner' => $konten_banner,
			'gambar_banner' => $image,
		);
		$this->db->insert('tb_banner', $object);
	}

	public function get_banner_by_id($id_banner)
	{
		$query = $this->db->query("SELECT * FROM tb_banner WHERE id_banner = '$id_banner' ");
		return $query;
	}

	public function get_all_data()
	{
		$query = $this->db->query("SELECT * FROM tb_banner ORDER BY status_aktif DESC ");
		return $query;
	}
	

}

/* End of file Banner_model.php */
/* Location: ./application/models/admin/Banner_model.php */
?>