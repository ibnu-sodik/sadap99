<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Halaman_model extends CI_Model {
	public function get_data_by_slug($slug)
	{		
		$this->db->select('*');
		$this->db->from('tb_halaman');
		$this->db->where('slug_halaman', $slug);
		$query = $this->db->get();
		return $query;
	}	
	public function get_all_halaman($limit = '')
	{
		if ($limit == '') {
			$this->db->select('*');
			$this->db->from('tb_halaman');
			$this->db->order_by('id_halaman', 'desc');
			$query = $this->db->get();
			return $query;
		}else{
			$this->db->select('*');
			$this->db->from('tb_halaman');
			$this->db->order_by('id_halaman', 'desc');
			$this->db->limit($limit);
			$query = $this->db->get();
			return $query;
		}
	}
}
/* End of file Halaman_model.php */

/* Location: ./application/models/Halaman_model.php */
?>