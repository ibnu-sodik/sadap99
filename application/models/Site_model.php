<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Site_model extends CI_Model
{
	public function cek_kesediaan_email($email)
	{
		$query = $this->db->query("SELECT * FROM tb_users WHERE email = '$email'");
		return $query;
	}
	public function save_first($site_name, $site_title, $site_keywords, $site_description)
	{
		$object = array(
			'site_name' => $site_name,
			'site_title' => $site_title,
			'site_keywords' => $site_keywords,
			'site_description' => $site_description,
			'tahun_buat'		=> date('Y')
		);
		$this->db->insert('tb_site', $object);
	}
	public function get_site_data()
	{
		$query = $this->db->get('tb_site');
			return $query;
	}
}
/* End of file Site_model.php */
/* Location: ./application/models/Site_model.php */
