<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Kontak_model extends CI_Model {
	public function update_konten($id_kontak, $image, $konten_kontak, $konten_peta)
	{		
		$object = array(
			'konten_kontak' => $konten_kontak, 
			'konten_peta' 	=> $konten_peta, 
			'gambar_kontak' => $image, 
		);
		$this->db->where('id_kontak', $id_kontak);
		$this->db->update('tb_konten_kontak', $object);
	}
	public function update_konten_no_img($id_kontak, $konten_kontak, $konten_peta)
	{		
		$object = array(
			'konten_kontak' => $konten_kontak, 
			'konten_peta' 	=> $konten_peta, 
		);
		$this->db->where('id_kontak', $id_kontak);
		$this->db->update('tb_konten_kontak', $object);
	}
	public function get_kontak_data_by_id($id_kontak)
	{
		$this->db->select('*');
		$this->db->from('tb_konten_kontak');
		$this->db->where('id_kontak', $id_kontak);
		$result = $this->db->get();
		return $result;
	}
	public function simpan_konten($konten_kontak, $konten_peta)
	{
		$object = array(
			'konten_kontak' => $konten_kontak, 
			'konten_peta' 	=> $konten_peta, 
		);
		$this->db->insert('tb_konten_kontak', $object);
	}
	public function get_kontak_data()
	{
		$this->db->select('*');
		$this->db->from('tb_konten_kontak');
		$this->db->limit(1);
		$result = $this->db->get();
		return $result;
	}
}
/* End of file Kontak_model.php */

/* Location: ./application/models/admin/Kontak_model.php */

?>