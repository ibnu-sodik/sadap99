<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Kontak extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/Kontak_model', 'kontak_model');
		$this->load->library('upload');
		$this->load->helper('text');
		if ($this->session->userdata('access')!=1) {
			$text = 'Terdapat batasan hak akses pada halaman ini.';
			$this->session->set_flashdata('pesan_error', $text);
			redirect('admin', 'refresh');
		}
	}
	public function update($id_kontak)
	{
		$this->load->helper(array('form', 'html'));
		$this->form_validation->set_rules('konten_kontak', 'Konten Kontak', 'trim|required');
		$this->form_validation->set_rules('konten_peta', 'Konten Peta', 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() === FALSE) {
			$this->index();
		} else {
			$konten_kontak 	= $this->input->post('konten_kontak');
			$konten_peta 	= $this->input->post('konten_peta');
			$this->kontak_model->update_konten_no_img($id_kontak, $konten_kontak, $konten_peta);
									// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
			$this->log_model->save_log($this->session->userdata('id'), 3, 'Update Data Konten Kotak');
			$text = "Update data berhasil.";
			$this->session->set_flashdata('pnotify', $text);
			redirect('admin/kontak');
		}
	}

	public function simpan()
	{
		$this->load->helper(array('form', 'html'));
		$this->form_validation->set_rules('konten_kontak', 'Konten Kontak', 'trim|required');
		$this->form_validation->set_rules('konten_peta', 'Konten Peta', 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() === FALSE) {
			$this->tambah_data_kontak();
		} else {
			$konten_kontak 	= $this->input->post('konten_kontak');
			$konten_peta 	= $this->input->post('konten_peta');
			$this->kontak_model->simpan_konten($konten_kontak, $konten_peta);
					// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
			$this->log_model->save_log($this->session->userdata('id'), 2, 'Menambah Data Baru Konten Kotak');
			$text = "Detail konten kontak berhasil disimpan.";
			$this->session->set_flashdata('pnotify', $text);
			redirect('admin/kontak');
		}
	}

	public function tambah_data_kontak()
	{	
		$data_kontak 				= $this->kontak_model->get_kontak_data();
		if ($data_kontak->num_rows() > 0) {
			$text = "Dilarang mengakses halaman ini.";
			$this->session->set_flashdata('pesan_error', $text);
			redirect('admin/kontak');
		}	
		$data['timestamp'] 			= strtotime(date('Y-m-d H:i:s'));
		$site 						= $this->site_model->get_site_data()->row_array();
		$data['site_title'] 		= $site['site_title'];
		$data['site_name'] 			= $site['site_name'];
		$data['site_keywords'] 		= $site['site_keywords'];
		$data['site_author'] 		= $site['site_author'];
		$data['site_logo'] 			= $site['site_logo'];
		$data['site_description'] 	= $site['site_description'];
		$data['site_favicon'] 		= $site['site_favicon'];
		$data['tahun_buat'] 		= $site['tahun_buat'];
		$data['bc_menu'] 			= "Konten Kontak";
		$data['bc_aktif'] 			= "Tambah Konten Kontak";
		$data['title'] 				= "Tambah Konten Kontak";
		$data['form_action'] 		= site_url('admin/kontak/simpan');
		$this->template->load('admin/template', 'admin/kontak/tambah_v', $data);
	}
	public function index()
	{
		$data['timestamp'] 			= strtotime(date('Y-m-d H:i:s'));
		$site 						= $this->site_model->get_site_data()->row_array();
		$data['site_title'] 		= $site['site_title'];
		$data['site_name'] 			= $site['site_name'];
		$data['site_keywords'] 		= $site['site_keywords'];
		$data['site_author'] 		= $site['site_author'];
		$data['site_logo'] 			= $site['site_logo'];
		$data['site_description'] 	= $site['site_description'];
		$data['site_favicon'] 		= $site['site_favicon'];
		$data['tahun_buat'] 		= $site['tahun_buat'];
		$data['bc_aktif'] 			= "Konten Kontak";
		$data['title'] 				= "Konten Kontak";
		$data_kontak 				= $this->kontak_model->get_kontak_data();
		if ($data_kontak->num_rows() == 0) {
			$this->tambah_data_kontak();
		} else {
			$data['form_action'] 		= site_url('admin/kontak/update');
			$data['data_kontak'] = $this->kontak_model->get_kontak_data();
			$this->template->load('admin/template', 'admin/kontak/data_v', $data);		
		}
	}
}
/* End of file Kontak.php */

/* Location: ./application/controllers/admin/Kontak.php */
?>