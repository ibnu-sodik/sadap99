<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Log_model extends CI_Model {
	public function get_data_hari_ini($id_user='')
	{
		if (!empty($id_user)) {
			$query = $this->db->query("SELECT tb_users.*, tb_log.* FROM tb_users LEFT JOIN tb_log ON log_userid = id WHERE DATE(tb_log.log_time) = CURDATE() AND log_userid = '$id_user' ORDER BY tb_log.log_time DESC");
		}else{
			$query = $this->db->query("SELECT tb_users.*, tb_log.* FROM tb_users LEFT JOIN tb_log ON log_userid = id WHERE DATE(tb_log.log_time) = CURDATE() ORDER BY tb_log.log_time DESC");
		}
		return $query;
	}
	public function get_data_by_id($id_user, $limit = '')
	{
		if (!empty($limit)) {
			$query = $this->db->query("SELECT tb_users.*, tb_log.* FROM tb_users LEFT JOIN tb_log ON log_userid = id WHERE log_userid = '$id_user' ORDER BY tb_log.log_time DESC LIMIT $limit");
			return $query;
		}else{
			$query = $this->db->query("SELECT tb_users.*, tb_log.* FROM tb_users LEFT JOIN tb_log ON log_userid = id WHERE log_userid = '$id_user' ORDER BY tb_log.log_time DESC");
			return $query;
		}
	}
	public function get_data_user_by_email($email)
	{
		$this->db->select('*');
		$this->db->from('tb_users');
		$this->db->where('email', $email);
		$query = $this->db->get();
		return $query;
	}
	public function save_log($id_user, $log_tipe, $log_description)
	{
		$log_ip = $_SERVER['REMOTE_ADDR'];

		if ($this->agent->is_browser())
		{
			$agent = $this->agent->browser();
		}
		elseif ($this->agent->is_robot())
		{
			$agent = $this->agent->robot();
		}
		elseif ($this->agent->is_mobile())
		{
			$agent = $this->agent->mobile();
		}
		else
		{
			$agent = 'Unidentified User Agent';
		}
		$platform = $this->agent->platform();
		$object = array(
			'log_ip' 				=> $log_ip, 
			'log_browser' 			=> $agent, 
			'log_platform' 			=> $platform, 
			'log_userid' 			=> $id_user, 
			'log_tipe' 				=> $log_tipe, 
			'log_description' 		=> $log_description
		);
		$this->db->insert('tb_log', $object);
	}	
}
/* End of file Log_model.php */

/* Location: ./application/models/admin/Log_model.php */
?>