<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Visitors_model extends CI_Model {
	public function set_global_sql()
	{
		$query = $this->db->query("SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))");
		return $query;
	}
	public function statistik_visitor_per_tahun()
	{
		$query = $this->db->query("SELECT DATE_FORMAT(visit_date, '%Y') AS tahun, COUNT(*) AS jumlah FROM tb_visitors GROUP BY YEAR(visit_date) ");
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $data) {
				$result[] = $data;
			}
			return $result;
		}else{
			return $query;
		}
	}
	public function statistik_visitor_per_bulan()
	{
		$query = $this->db->query("SELECT DATE_FORMAT(visit_date, '%m') AS bulan, DATE_FORMAT(visit_date, '%Y') AS tahun, COUNT(*) AS jumlah FROM tb_visitors WHERE YEAR(visit_date) = YEAR(CURDATE()) GROUP BY MONTH(visit_date) ");
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $data) {
				$result[] = $data;
			}
			return $result;
		}else{
			return $query;
		}
	}
	public function statistik_visitor()
	{
		$query = $this->db->query("SELECT DATE_FORMAT(visit_date, '%d') AS tanggal, DATE_FORMAT(visit_date, '%m') AS bulan, COUNT(*) AS jumlah FROM tb_visitors WHERE MONTH(visit_date) = MONTH(CURDATE()) GROUP BY DATE_FORMAT(visit_date, '%d') ");
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $data) {
				$result[] = $data;
			}
			return $result;
		}else{
			return $query;
		}
	}
	public function statistik_platform()
	{
		$query = $this->db->query("SELECT visitor_platform as platform, COUNT(*) as jumlah FROM tb_visitors GROUP BY visitor_platform");
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $data) {
				$result[] = $data;
			}
			return $result;
		}
	}
	public function statistik_browser()
	{
		$query = $this->db->query("SELECT visitor_browser as browser, COUNT(*) as jumlah FROM tb_visitors GROUP BY visitor_browser");
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $data) {
				$result[] = $data;
			}
			return $result;
		}
	}	
}
/* End of file Visitors_model.php */

/* Location: ./application/models/admin/Visitors_model.php */
?>