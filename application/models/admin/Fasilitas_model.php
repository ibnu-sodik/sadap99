<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Fasilitas_model extends CI_Model {

	public function hapus($id_fasilitas)
	{
		$this->db->where('id_fasilitas', $id_fasilitas);
		$this->db->delete('tb_fasilitas');
	}

	public function update_no_img($id_fasilitas, $nama_fasilitas, $deskripsi_fasilitas, $ikon_fasilitas)
	{
		$object = array(
			'nama_fasilitas' 		=> $nama_fasilitas,
			'deskripsi_fasilitas' 	=> $deskripsi_fasilitas,
			'ikon_fasilitas' 		=> $ikon_fasilitas,
		);
		$this->db->where('id_fasilitas', $id_fasilitas);
		$this->db->update('tb_fasilitas', $object);
	}

	public function update($id_fasilitas, $image, $nama_fasilitas, $deskripsi_fasilitas, $ikon_fasilitas)
	{
		$object = array(
			'nama_fasilitas' 		=> $nama_fasilitas,
			'deskripsi_fasilitas' 	=> $deskripsi_fasilitas,
			'gambar_fasilitas' 		=> $image,
			'ikon_fasilitas' 		=> $ikon_fasilitas,
		);
		$this->db->where('id_fasilitas', $id_fasilitas);
		$this->db->update('tb_fasilitas', $object);
	}

	public function simpan($image, $nama_fasilitas, $deskripsi_fasilitas, $ikon_fasilitas)
	{
		$object = array(
			'nama_fasilitas' 		=> $nama_fasilitas,
			'deskripsi_fasilitas' 	=> $deskripsi_fasilitas,
			'gambar_fasilitas' 		=> $image,
			'ikon_fasilitas' 		=> $ikon_fasilitas,
		);
		$this->db->insert('tb_fasilitas', $object);
	}

	public function get_data_by_id($id_fasilitas)
	{
		$this->db->select('*');
		$this->db->from('tb_fasilitas');
		$this->db->where('id_fasilitas', $id_fasilitas);
		$query = $this->db->get();
		return $query;
	}

	public function get_data()
	{
		$this->db->select('*');
		$this->db->from('tb_fasilitas');
		$this->db->order_by('id_fasilitas', 'desc');
		$query = $this->db->get();
		return $query;
	}

}

/* End of file Fasilitas_model.php */
/* Location: ./application/models/admin/Fasilitas_model.php */
?>