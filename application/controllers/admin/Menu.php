<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Menu extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/Menu_model', 'menu_model');
		$this->load->model('admin/Berita_model', 'berita_model');
		$this->load->model('admin/Halaman_model', 'halaman_model');
			// $this->load->model('Model File');
		if ($this->session->userdata('access')!=1) {
			$text = 'Terdapat batasan hak akses pada halaman ini.';
			$this->session->set_flashdata('pesan_error', $text);
			redirect('admin', 'refresh');
		}
	}
	public function delete($id_menu)
	{
		$query = $this->db->query("SELECT * FROM tb_menu WHERE parent_id = '$id_menu' ");
		$jumlah = $query->num_rows();
		$data = $this->menu_model->get_menu_by_id($id_menu)->row_array();
		if ($jumlah > 0) {
			$text = "Terdapat ".$jumlah." Submenu pada menu ".$data['judul'];
			$this->session->set_flashdata('pesan_error', $text);
			redirect('admin/menu');
		}else{
			if ($data['kategori_menu'] == 'main') {
				$url = 'admin/menu';
			}else{
				$url = 'admin/menu/second';
			}
					// kurang hapus
			$this->menu_model->hapus($id_menu);
					// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
			$this->log_model->save_log($this->session->userdata('id'), 4, 'Menghapus menu '.$data['judul']);
			$text = $data['judul']." berhasil dihapus.";
			$this->session->set_flashdata('pnotify', $text);
			redirect($url);
		}
	}
	public function update($id_menu)
	{
		$this->load->helper(array('form', 'html'));
		$this->form_validation->set_rules('judul', 'Judul Menu', 'trim|required');
		$this->form_validation->set_rules('urut', 'Nomor Urut Menu', 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() === FALSE) {
			$this->tambah();
		} else {
			$judul 			= $this->input->post('judul', true);
			$induk 			= $this->input->post('induk', true);
			$kategori_menu 	= $this->input->post('kategori_menu', true);
			$jenis_link 	= $this->input->post('jenis_link', true);
			$link_halaman 	= $this->input->post('link_halaman', true);
			$link_agenda 	= $this->input->post('link_agenda', true);
			$link_berita 	= $this->input->post('link_berita', true);
			$link_kategori 	= $this->input->post('link_kategori', true);
			$link_url1 		= $this->input->post('link_url1', true);
			$link_url2		= $this->input->post('link_url2', true);
			$urut 			= $this->input->post('urut', true);
			$target 		= $this->input->post('target', true);

			if ($jenis_link=="halaman") {
				$data_link = base_url('halaman/').$link_halaman;
			}elseif ($jenis_link=="kategori") {
				$data_link = base_url('kategori/').$link_kategori;
			}elseif ($jenis_link=="berita") {
				$data_link = base_url('berita/').$link_berita;
			}else{
				$data_link = $link_url1.$link_url2;
			}
			if ($kategori_menu == 'main') {
				$ket = "Header";
				$url = 'admin/menu';
			}else{
				$ket = "Footer";
				$url = 'admin/menu/second';
			}
						// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
			$this->log_model->save_log($this->session->userdata('id'), 3, 'Update menu '.$judul);
			$this->menu_model->update($id_menu, $judul, $induk, $kategori_menu, $jenis_link, $urut, $data_link, $target);
			$text = $judul.' berhasil diupdate';
			$this->session->set_flashdata('pnotify', $text);
			redirect($url);
		}
	}
	public function edit_second($id_menu)
	{		
		$data['timestamp'] 			= strtotime(date('Y-m-d H:i:s'));
		$site = $this->site_model->get_site_data()->row_array();
		$data['site_title'] 		= $site['site_title'];
		$data['site_name'] 			= $site['site_name'];
		$data['site_keywords'] 		= $site['site_keywords'];
		$data['site_author'] 		= $site['site_author'];
		$data['site_logo'] 			= $site['site_logo'];
		$data['site_description'] 	= $site['site_description'];
		$data['site_favicon'] 		= $site['site_favicon'];
		$data['tahun_buat'] 		= $site['tahun_buat'];
		$data['bc_menu'] 			= "Menu";
		$data['bc_aktif'] 			= "Edit Footer Menu";
		$data['title'] 				= "Menu";
		$data['data']				= $this->menu_model->get_menu_by_id($id_menu);
		$data['pil_induk']			= $this->menu_model->get_second_menu_kecuali_id($id_menu);
		$data['form_aksi']			= site_url('admin/menu/update');
		$user_id 					= $this->session->userdata('id');
		$data['pil_kategori'] 		= $this->berita_model->get_kategori_berita_by_user_id($user_id);
		$data['pil_berita']			= $this->berita_model->get_all_berita();
		$data['pil_halaman']		= $this->halaman_model->get_all_halaman();
		$data['url_kategori']		= base_url('kategori/');
		$data['url_agenda']			= base_url('agenda/');
		$data['url_berita']			= base_url('berita/');
		$data['url_halaman']		= base_url('halaman/');
		$data['url_biasa']			= base_url();
		$this->template->load('admin/template', 'admin/menu/edit_second_v', $data);
	}
	public function edit($id_menu)
	{		
		$data['timestamp'] 			= strtotime(date('Y-m-d H:i:s'));
		$site = $this->site_model->get_site_data()->row_array();
		$data['site_title'] 		= $site['site_title'];
		$data['site_name'] 			= $site['site_name'];
		$data['site_keywords'] 		= $site['site_keywords'];
		$data['site_author'] 		= $site['site_author'];
		$data['site_logo'] 			= $site['site_logo'];
		$data['site_description'] 	= $site['site_description'];
		$data['site_favicon'] 		= $site['site_favicon'];
		$data['tahun_buat'] 		= $site['tahun_buat'];
		$data['bc_menu'] 			= "Menu";
		$data['bc_aktif'] 			= "Edit Menu";
		$data['title'] 				= "Menu";
		$data['data']				= $this->menu_model->get_menu_by_id($id_menu);
		$data['pil_induk']			= $this->menu_model->get_main_menu_kecuali_id($id_menu);
		$data['form_aksi']			= site_url('admin/menu/update');
		$user_id 					= $this->session->userdata('id');
		$data['pil_kategori'] 		= $this->berita_model->get_kategori_berita_by_user_id($user_id);
		$data['pil_berita']			= $this->berita_model->get_all_berita();
		$data['pil_halaman']		= $this->halaman_model->get_all_halaman();
		$data['url_kategori']		= base_url('kategori/');
		$data['url_agenda']			= base_url('agenda/');
		$data['url_berita']			= base_url('berita/');
		$data['url_halaman']		= base_url('halaman/');
		$data['url_biasa']			= base_url();
		$this->template->load('admin/template', 'admin/menu/edit_v', $data);
	}
	public function simpan()
	{
		$this->load->helper(array('form', 'html'));
		$this->form_validation->set_rules('judul', 'Judul Menu', 'trim|required');
		$this->form_validation->set_rules('urut', 'Nomor Urut Menu', 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() === FALSE) {
			$this->tambah();
		} else {
			$judul 			= $this->input->post('judul', true);
			$induk 			= $this->input->post('induk', true);
			$kategori_menu 	= $this->input->post('kategori_menu', true);
			$jenis_link 	= $this->input->post('jenis_link', true);
			$link_halaman 	= $this->input->post('link_halaman', true);
			$link_agenda 	= $this->input->post('link_agenda', true);
			$link_berita 	= $this->input->post('link_berita', true);
			$link_kategori 	= $this->input->post('link_kategori', true);
			$link_url1 		= $this->input->post('link_url1', true);
			$link_url2		= $this->input->post('link_url2', true);
			$urut 			= $this->input->post('urut', true);
			$target 		= $this->input->post('target', true);
			
			if ($jenis_link=="halaman") {
				$data_link = base_url('halaman/').$link_halaman;
			}elseif ($jenis_link=="kategori") {
				$data_link = base_url('kategori/').$link_kategori;
			}elseif ($jenis_link=="berita") {
				$data_link = base_url('berita/').$link_berita;
			}else{
				$data_link = $link_url1.$link_url2;
			}
			if ($kategori_menu == 'main') {
				$ket = "Header";
				$url = 'admin/menu';
			}else{
				$ket = "Footer";
				$url = 'admin/menu/second';
			}
						// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
			$this->log_model->save_log($this->session->userdata('id'), 2, 'Menambah menu '.$judul. ' kategori '.$ket);
			$this->menu_model->simpan($judul, $induk, $kategori_menu, $jenis_link, $urut, $data_link, $target);
			$text = 'Berhasil Menambah '.$judul.' Ke '.$ket.' Menu';
			$this->session->set_flashdata('pnotify', $text);
			redirect($url, 'refresh');
		}
	}
	public function tambah_second()
	{

		$data['timestamp'] 			= strtotime(date('Y-m-d H:i:s'));
		$site = $this->site_model->get_site_data()->row_array();
		$data['site_title'] 		= $site['site_title'];
		$data['site_name'] 			= $site['site_name'];
		$data['site_keywords'] 		= $site['site_keywords'];
		$data['site_author'] 		= $site['site_author'];
		$data['site_logo'] 			= $site['site_logo'];
		$data['site_description'] 	= $site['site_description'];
		$data['site_favicon'] 		= $site['site_favicon'];
		$data['tahun_buat'] 		= $site['tahun_buat'];
		$data['bc_menu'] 			= "Menu";
		$data['bc_aktif'] 			= "Tambah Menu Footer";
		$data['title'] 				= "Menu";
		$data['second_menu']		= $this->menu_model->get_second_menu();
		$data['form_aksi']			= site_url('admin/menu/simpan');
		$user_id 					= $this->session->userdata('id');
		$data['pil_kategori'] 		= $this->berita_model->get_kategori_berita_by_user_id($user_id);
		$data['pil_berita']			= $this->berita_model->get_all_berita();
		$data['pil_halaman']		= $this->halaman_model->get_all_halaman();
		$this->template->load('admin/template', 'admin/menu/tambah_second_v', $data);
	}
	public function tambah()
	{		
		$data['timestamp'] 			= strtotime(date('Y-m-d H:i:s'));
		$site = $this->site_model->get_site_data()->row_array();
		$data['site_title'] 		= $site['site_title'];
		$data['site_name'] 			= $site['site_name'];
		$data['site_keywords'] 		= $site['site_keywords'];
		$data['site_author'] 		= $site['site_author'];
		$data['site_logo'] 			= $site['site_logo'];
		$data['site_description'] 	= $site['site_description'];
		$data['site_favicon'] 		= $site['site_favicon'];
		$data['tahun_buat'] 		= $site['tahun_buat'];
		$data['bc_menu'] 			= "Menu";
		$data['bc_aktif'] 			= "Tambah Menu";
		$data['title'] 				= "Menu";
		$data['main_menu']			= $this->menu_model->get_main_menu();
		$data['form_aksi']			= site_url('admin/menu/simpan');
		$user_id 					= $this->session->userdata('id');
		$data['pil_kategori'] 		= $this->berita_model->get_kategori_berita_by_user_id($user_id);
		$data['pil_berita']			= $this->berita_model->get_all_berita();
		$data['pil_halaman']		= $this->halaman_model->get_all_halaman();
		$this->template->load('admin/template', 'admin/menu/tambah_v', $data);
	}
	public function second()
	{

		$data['timestamp'] 			= strtotime(date('Y-m-d H:i:s'));
		$site = $this->site_model->get_site_data()->row_array();
		$data['site_title'] 		= $site['site_title'];
		$data['site_name'] 			= $site['site_name'];
		$data['site_keywords'] 		= $site['site_keywords'];
		$data['site_author'] 		= $site['site_author'];
		$data['site_logo'] 			= $site['site_logo'];
		$data['site_description'] 	= $site['site_description'];
		$data['site_favicon'] 		= $site['site_favicon'];
		$data['tahun_buat'] 		= $site['tahun_buat'];
		$data['bc_menu'] 			= "Menu";
		$data['bc_aktif'] 			= "Menu Footer";
		$data['title'] 				= "Menu Footer";
		$data['second_menu']		= $this->menu_model->get_second_menu();
		$this->template->load('admin/template', 'admin/menu/data_second_v', $data);
	}
	public function index()
	{
		$data['timestamp'] 			= strtotime(date('Y-m-d H:i:s'));
		$site = $this->site_model->get_site_data()->row_array();
		$data['site_title'] 		= $site['site_title'];
		$data['site_name'] 			= $site['site_name'];
		$data['site_keywords'] 		= $site['site_keywords'];
		$data['site_author'] 		= $site['site_author'];
		$data['site_logo'] 			= $site['site_logo'];
		$data['site_description'] 	= $site['site_description'];
		$data['site_favicon'] 		= $site['site_favicon'];
		$data['tahun_buat'] 		= $site['tahun_buat'];
		$data['bc_menu'] 			= "Pengaturan";
		$data['bc_aktif'] 			= "Menu";
		$data['title'] 				= "Menu";
		$data['main_menu']			= $this->menu_model->get_main_menu();
		$this->template->load('admin/template', 'admin/menu/data_v', $data);
	}
}
/* End of file Menu.php */

/* Location: ./application/controllers/admin/Menu.php */
?>