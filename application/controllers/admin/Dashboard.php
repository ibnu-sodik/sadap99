<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/Visitors_model', 'visitors_model');
	}
	public function get_aktivitas()
	{
		$query = $this->log_model->get_data_hari_ini();
		$hasil = '';
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$hasil .= '
				<tr>
				<td class="text-left">'.$row->full_name.'</td>
				<td class="text-center">'.tanggal_indo($row->log_time).'</td>
				<td class="text-center">'.hanya_jam($row->log_time).'</td>
				<td class="text-justify">'.$row->log_description.'</td>
				</tr>
				';
			}
		}else{
			$hasil .= '<tr>
			<td class="text-center" colspan="4">Tidak ada data ditemukan</td>
			</tr>';
		}
		$data['data_aktivitas'] = $hasil;
		echo json_encode($data);
	}
	public function index()
	{
		$data['timestamp'] 			= strtotime(date('Y-m-d H:i:s'));
		$site = 					$this->site_model->get_site_data()->row_array();
		$data['site_title'] 		= $site['site_title'];
		$data['site_name'] 			= $site['site_name'];
		$data['site_keywords'] 		= $site['site_keywords'];
		$data['site_author'] 		= $site['site_author'];
		$data['site_logo'] 			= $site['site_logo'];
		$data['site_description'] 	= $site['site_description'];
		$data['site_favicon'] 		= $site['site_favicon'];
		$data['tahun_buat'] 		= $site['tahun_buat'];
		$data['bc_aktif'] 			= "Dashboard";
		$data['title'] 				= "Dashboard";
		$this->visitors_model->set_global_sql();
		$data['statistik_visitor']				= $this->visitors_model->statistik_visitor();
		$data['statistik_visitor_per_bulan']	= $this->visitors_model->statistik_visitor_per_bulan();
		$data['statistik_visitor_per_tahun']	= $this->visitors_model->statistik_visitor_per_tahun();
		$data['statistik_browser']				= $this->visitors_model->statistik_browser();
		$data['statistik_platform']				= $this->visitors_model->statistik_platform();
		$data_stat = $this->visitors_model->statistik_visitor_per_bulan();
		foreach ($data_stat as $value) {
			$bulan[] = $value->bulan;
		}
		$data['bulan_ini'] = json_encode($bulan);
		$this->template->load('admin/template', 'admin/dashboard_v', $data);
	}
}
/* End of file Dashboard.php */

/* Location: ./application/controllers/admin/Dashboard.php */

?>