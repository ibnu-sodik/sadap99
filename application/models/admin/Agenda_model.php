<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda_model extends CI_Model {

	public function update_agenda_no_img($id_agenda, $nama_agenda, $konten, $slug, $tgl_pelaksanaan, $durasi, $deskripsi)
	{
		$tgl_update = date('Y-m-d H:i:s');
		$object = array(
			'nama_agenda' 		=> $nama_agenda,
			'konten_agenda' 	=> $konten,
			'deskripsi_agenda' 	=> $deskripsi,
			'tgl_pelaksanaan' 	=> $tgl_pelaksanaan,
			'slug_agenda' 		=> $slug,
			'durasi' 			=> $durasi,
			'agenda_update'		=> $tgl_update
		);
		$this->db->where('id_agenda', $id_agenda);
		$this->db->update('tb_agenda', $object);
	}

	public function update_agenda($id_agenda, $nama_agenda, $konten, $slug, $image, $tgl_pelaksanaan, $durasi, $deskripsi)
	{
		$tgl_update = date('Y-m-d H:i:s');
		$object = array(
			'nama_agenda' 		=> $nama_agenda,
			'konten_agenda' 	=> $konten,
			'deskripsi_agenda' 	=> $deskripsi,
			'gambar_agenda' 	=> $image,
			'tgl_pelaksanaan' 	=> $tgl_pelaksanaan,
			'slug_agenda' 		=> $slug,
			'durasi' 			=> $durasi,
			'agenda_update'		=> $tgl_update
		);
		$this->db->where('id_agenda', $id_agenda);
		$this->db->update('tb_agenda', $object);
	}

	public function hapus_agenda($id_agenda)
	{
		$this->db->where('id_agenda', $id_agenda);
		$this->db->delete('tb_agenda');
	}

	public function get_agenda_by_id($id_agenda)
	{
		$result = $this->db->query("SELECT * FROM tb_agenda WHERE id_agenda = '$id_agenda'");
		return $result;
	}

	public function simpan_agenda($nama_agenda, $konten, $slug, $image, $tgl_pelaksanaan, $durasi, $deskripsi)
	{
		$object = array(
			'nama_agenda' 		=> $nama_agenda,
			'konten_agenda' 	=> $konten,
			'deskripsi_agenda' 	=> $deskripsi,
			'gambar_agenda' 	=> $image,
			'tgl_pelaksanaan' 	=> $tgl_pelaksanaan,
			'slug_agenda' 		=> $slug,
			'durasi' 			=> $durasi
		);
		$this->db->insert('tb_agenda', $object);
	}

	public function get_all_agenda()
	{
		$query = $this->db->query("SELECT * FROM tb_agenda ORDER BY arsip ASC");
		return $query;
	}

}

/* End of file Agenda_model.php */
/* Location: ./application/models/admin/Agenda_model.php */

?>