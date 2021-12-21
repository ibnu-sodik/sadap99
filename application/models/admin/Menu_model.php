<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Menu_model extends CI_Model {
	public function hapus($id_menu)
	{
		$this->db->where('id_menu', $id_menu);
		$this->db->delete('tb_menu');
	}
	function simpan($judul, $induk, $kategori_menu, $jenis_link, $urut, $data_link, $target)
	{
		$object = array(
			'judul' 		=> $judul,
			'parent_id' 	=> $induk,
			'kategori_menu' => $kategori_menu,
			'jenis_link' 	=> $jenis_link,
			'urut' 			=> $urut,
			'link' 			=> $data_link,
			'target' 		=> $target
		);
		$this->db->insert('tb_menu', $object);
	}
	function update($id_menu, $judul, $induk, $kategori_menu, $jenis_link, $urut, $data_link, $target)
	{
		$object = array(
			'judul' 		=> $judul,
			'parent_id' 	=> $induk,
			'kategori_menu' => $kategori_menu,
			'jenis_link' 	=> $jenis_link,
			'urut' 			=> $urut,
			'link' 			=> $data_link,
			'target' 		=> $target

		);
		$this->db->where('id_menu', $id_menu);
		$this->db->update('tb_menu', $object);
	}
	public function get_main_menu_kecuali_id($id_menu)
	{
		$result = $this->db->query("SELECT * FROM tb_menu WHERE kategori_menu = 'main' AND parent_id = '0' AND id_menu NOT IN($id_menu) ORDER BY urut");
		return $result;
	}
	public function get_second_menu_kecuali_id($id_menu)
	{
		$result = $this->db->query("SELECT * FROM tb_menu WHERE kategori_menu = 'second' AND parent_id = '0' AND id_menu NOT IN($id_menu) ORDER BY urut");
		return $result;
	}
	public function get_menu_by_id($id_menu)
	{
		$result = $this->db->query("SELECT * FROM tb_menu WHERE id_menu = '$id_menu'");
		return $result;
	}
	public function get_main_menu()
	{
		$result = $this->db->query("SELECT * FROM tb_menu WHERE kategori_menu = 'main' AND parent_id = '0' ORDER BY urut");
		return $result;
	}
	public function get_second_menu()
	{
		$result = $this->db->query("SELECT * FROM tb_menu WHERE kategori_menu = 'second' AND parent_id = '0' ORDER BY urut");
		return $result;
	}
}
/* End of file Menu_model.php */

/* Location: ./application/models/admin/Menu_model.php */ 

?>