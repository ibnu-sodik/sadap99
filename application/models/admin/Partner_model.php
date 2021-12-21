<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Partner_model extends CI_Model {
	public function hapus_partner($id_partner)
	{
		$this->db->where('id_partner', $id_partner);
		$this->db->delete('tb_partner');
	}
	public function get_partner_by_id($id_partner)
	{
		$result = $this->db->query("SELECT * FROM tb_partner WHERE id_partner = '$id_partner'");
		return $result;
	}	
	public function simpan($image, $nama_partner, $link_partner, $kategori_partner)
	{
		$object = array(
			'nama_partner' => $nama_partner,
			'link_partner' => $link_partner,
			'kategori_partner' => $kategori_partner,
			'logo_partner' => $image
		);
		$this->db->insert('tb_partner', $object);
	}
	public function get_all_data()
	{
		$query = $this->db->query("SELECT * FROM tb_partner");
		return $query;
	}

}

/* End of file Partner_model.php */
/* Location: .//C/laragon/www/stt-pomosda/goblog-prosite/models/admin/Partner_model.php */

?>