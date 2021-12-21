<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Background_model extends CI_Model {

	public function get_data_by_id($id_background)
	{
		$query = $this->db->query("SELECT * FROM tb_background WHERE id_background = '$id_background'");
		return $query;
	}

	public function simpan($bg_umum)
	{
		$object = array(
			'bg_umum' => $bg_umum);
		$this->db->insert('tb_background', $object);
	}

	public function get_data()
	{
		$query = $this->db->query("SELECT * FROM tb_background");
		return $query;
	}	

}

/* End of file Background_model.php */
/* Location: ./application/models/admin/Background_model.php */

?>