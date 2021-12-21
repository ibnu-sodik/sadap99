<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Sambutan_model extends CI_Model {

	public function update_sambutan($id_sambutan, $image, $konten_sambutan)
	{		
		$object = array(
			'konten_sambutan' => $konten_sambutan, 
			'gambar_sambutan' => $image, 
		);
		$this->db->where('id_sambutan', $id_sambutan);
		$this->db->update('tb_sambutan', $object);
	}

	public function update_sambutan_no_img($id_sambutan, $konten_sambutan)
	{		
		$object = array(
			'konten_sambutan' => $konten_sambutan, 
		);
		$this->db->where('id_sambutan', $id_sambutan);
		$this->db->update('tb_sambutan', $object);
	}

	public function get_sambutan_data_by_id($id_sambutan)
	{
		$this->db->select('*');
		$this->db->from('tb_sambutan');
		$this->db->where('id_sambutan', $id_sambutan);
		$result = $this->db->get();
		return $result;
	}

	public function simpan_konten($image, $konten_sambutan)
	{
		$object = array(
			'konten_sambutan' => $konten_sambutan, 
			'gambar_sambutan' => $image, 
		);
		$this->db->insert('tb_sambutan', $object);
	}

	public function get_sambutan_data()
	{
		$this->db->select('*');
		$this->db->from('tb_sambutan');
		$this->db->limit(1);
		$result = $this->db->get();
		return $result;
	}

}

/* End of file Sambutan_model.php */
/* Location: ./application/models/admin/Sambutan_model.php */

?>