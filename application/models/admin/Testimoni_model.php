<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Testimoni_model extends CI_Model {

	public function ubah_tampil($id_testimoni, $status)
	{
		$object = array('tampil' => $status);
		$this->db->where('id_testimoni', $id_testimoni);
		$this->db->update('tb_testimoni', $object);
	}

	public function hapus($id_testimoni)
	{
		$this->db->where('id_testimoni', $id_testimoni);
		$this->db->delete('tb_testimoni');
	}

	public function get_data_by_id($id_testimoni)
	{
		$query = $this->db->query("SELECT * FROM tb_testimoni WHERE id_testimoni = '$id_testimoni'");
		return $query;
	}	

	public function get_data_unview()
	{
		$query = $this->db->query("SELECT * FROM tb_testimoni WHERE dilihat = 0 ORDER BY tgl_kirim DESC");
		return $query;
	}		

	public function get_data()
	{
		$query = $this->db->query("SELECT * FROM tb_testimoni ORDER BY tgl_kirim DESC");
		return $query;
	}		

	public function get_data_baru()
	{
		$query = $this->db->query("SELECT * FROM tb_testimoni WHERE dilihat = 0 ORDER BY tgl_kirim DESC");
		return $query;
	}	

}

/* End of file Testimoni_model.php */
/* Location: ./application/models/admin/Testimoni_model.php */

?>