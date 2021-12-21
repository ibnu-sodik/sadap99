<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Sosmed_model extends CI_Model {
	public function update_sosmed($id_sosmed, $nama_sosmed, $link_sosmed, $ikon_sosmed)
	{
		$object = array(
			'nama_sosmed' 		=> $nama_sosmed, 
			'link_sosmed' 		=> $link_sosmed, 
			'ikon_sosmed' 		=> $ikon_sosmed
		);
		$this->db->where('id_sosmed', $id_sosmed);
		$this->db->update('tb_sosmedweb', $object);
	}
	public function update_sosmed_users($id_sosmed, $nama_sosmed, $link_sosmed, $ikon_sosmed)
	{
		$object = array(
			'nama_sosmed' 		=> $nama_sosmed, 
			'link_sosmed' 		=> $link_sosmed, 
			'ikon_sosmed' 		=> $ikon_sosmed
		);
		$this->db->where('id_sosmed', $id_sosmed);
		$this->db->update('tb_sosmed_users', $object);
	}
	public function simpan_sosmed_users($id_users, $nama_sosmed, $link_sosmed, $ikon_sosmed)
	{
		$object = array(
			'nama_sosmed' 			=> $nama_sosmed, 
			'link_sosmed' 			=> $link_sosmed, 
			'ikon_sosmed' 			=> $ikon_sosmed,
			'id_users_sosmed' 	=> $id_users
		);
		$this->db->insert('tb_sosmed_users', $object);
	}
	public function simpan_sosmed($nama_sosmed, $link_sosmed, $ikon_sosmed)
	{
		$object = array(
			'nama_sosmed' 		=> $nama_sosmed, 
			'link_sosmed' 		=> $link_sosmed, 
			'ikon_sosmed' 		=> $ikon_sosmed
		);
		$this->db->insert('tb_sosmedweb', $object);
	}
	public function get_users_sosmed($id_users)
	{
		$this->db->select('*');
		$this->db->from('tb_sosmed_users');
		$this->db->where('id_users_sosmed', $id_users);
		$query = $this->db->get();
		return $query;
	}
	public function get_data()
	{
		$this->db->select('*');
		$this->db->from('tb_sosmedweb');
		$query = $this->db->get();
		return $query;
	}
}
/* End of file Sosmed_model.php */

/* Location: ./application/models/admin/Sosmed_model.php */
?>