<?php 



defined('BASEPATH') OR exit('No direct script access allowed');



class Calltoaction_model extends CI_Model {


	public function update_cta($id_cta, $konten_cta)
	{		
		$object = array(
			'konten_cta' => $konten_cta, 
		);
		$this->db->where('id_cta', $id_cta);
		$this->db->update('tb_cta', $object);
	}


	public function update_cta_no_img($id_cta, $konten_cta)
	{		
		$object = array(
			'konten_cta' => $konten_cta, 
		);
		$this->db->where('id_cta', $id_cta);
		$this->db->update('tb_cta', $object);
	}


	public function get_cta_data_by_id($id_cta)
	{
		$this->db->select('*');
		$this->db->from('tb_cta');
		$this->db->where('id_cta', $id_cta);
		$result = $this->db->get();
		return $result;
	}


	public function simpan_konten($konten_cta)
	{
		$object = array(
			'konten_cta' => $konten_cta, 
		);
		$this->db->insert('tb_cta', $object);
	}


	public function get_cta_data()
	{
		$this->db->select('*');
		$this->db->from('tb_cta');
		$this->db->limit(1);
		$result = $this->db->get();
		return $result;
	}



}



/* End of file Calltoaction_model.php */

/* Location: ./application/models/admin/Calltoaction_model.php */



?>