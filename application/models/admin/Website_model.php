<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Website_model extends CI_Model {
	public function simpan_api($api_tinify)
	{
		$object = array(
			'api_tinify' 		=> $api_tinify
		);
		$this->db->update('tb_site', $object);
	}
	public function simpan_kontak($site_telp, $site_email, $site_nowa, $site_pesanTeks)
	{
		$object = array(
			'site_email' 		=> $site_email, 
			'site_telp' 		=> $site_telp,
			'site_nowa' 		=> $site_nowa,
			'site_pesanTeks' 	=> $site_pesanTeks
		);
		$this->db->update('tb_site', $object);
	}
	public function update_img_logo($site_logo)
	{
		$object = array('site_logo' => $site_logo);
		$this->db->update('tb_site', $object);
	}
	public function update_img_icon($site_favicon)
	{
		$object = array('site_favicon' => $site_favicon);
		$this->db->update('tb_site', $object);
	}
	public function update_img($site_favicon, $site_logo)
	{
		$object = array('site_logo' => $site_logo, 'site_favicon' => $site_favicon );
		$this->db->update('tb_site', $object);
	}
	public function simpan_basic($site_name, $site_title, $site_keywords, $site_description, $tahun_buat, $limit_post)
	{
		$object = array(
			'site_name' 		=> $site_name, 
			'site_title' 		=> $site_title, 
			'site_keywords' 	=> $site_keywords, 
			'site_description' 	=> $site_description,
			'tahun_buat'		=> $tahun_buat,
			'limit_post'		=> $limit_post
		);
		$this->db->update('tb_site', $object);
	}
	public function get_data()
	{
		$this->db->select('*');
		$this->db->from('tb_site');
		$this->db->limit(1);
		$query = $this->db->get();
		return $query;
	}
}
/* End of file Website_model.php */

/* Location: ./application/models/admin/Website_model.php */
?>