<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Visitor_model extends CI_Model {
	function hitung_visitor()
	{
		$visitor_ip = $_SERVER['REMOTE_ADDR'];
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
		$cek_ip = $this->db->query("SELECT * FROM tb_visitors WHERE visit_ip = '$visitor_ip' AND DATE(visit_date)=CURDATE()");
		if ($cek_ip->num_rows() <= 0) {
			$hasil = $this->db->query("INSERT INTO tb_visitors (visit_ip, visitor_browser, visitor_platform) VALUES ('$visitor_ip', '$agent', '$platform')");
			return $hasil;
		}
	}
}
/* End of file Visitor_model.php */

/* Location: ./application/models/Visitor_model.php */
?>