<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Calltoaction extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/Calltoaction_model', 'cta_model');
		if ($this->session->userdata('access')!=1) {
			$text = 'Terdapat batasan hak akses pada halaman ini.';
			$this->session->set_flashdata('pesan_error', $text);
			redirect('admin', 'refresh');
		}
	}
	public function update($id_cta)
	{
		$this->load->helper(array('form', 'html'));
		$this->form_validation->set_rules('konten_cta', 'Konten CTA', 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() === FALSE) {
			$this->index();
		} else {
			$konten_cta 	= $this->input->post('konten_cta');
			$this->cta_model->update_cta($id_cta, $konten_cta);
			// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
			$this->log_model->save_log($this->session->userdata('id'), 3, 'Update Data Kata cta');

			$text = "Update data berhasil.";
			$this->session->set_flashdata('pnotify', $text);
			redirect('admin/calltoaction');
		}
	}
	public function simpan()
	{
		$this->load->helper(array('form', 'html'));
		$this->form_validation->set_rules('konten_cta', 'Konten CTA', 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() === FALSE) {
			$this->tambah_data_cta();
		} else {
			
			$konten_cta 	= $this->input->post('konten_cta');
			$this->cta_model->simpan_konten($konten_cta);
			// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
			$this->log_model->save_log($this->session->userdata('id'), 2, 'Menambah Data Baru Kata cta');
			$text = "Data baru konten cta berhasil disimpan.";
			$this->session->set_flashdata('pnotify', $text);
			redirect('admin/calltoaction');
		}
	}
	public function tambah_data_cta()
	{	
		$data_cta 				= $this->cta_model->get_cta_data();
		if ($data_cta->num_rows() > 0) {
			$text = "Dilarang mengakses halaman ini.";
			$this->session->set_flashdata('pesan_error', $text);
			redirect('admin/calltoaction');
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
		$data['bc_menu'] 			= "CalltoAction";
		$data['bc_aktif'] 			= "Tambah Call to Action";
		$data['title'] 				= "Tambah Call to Action";
		$data['form_action'] 		= site_url('admin/calltoaction/simpan');
		$this->template->load('admin/template', 'admin/calltoaction/tambah_v', $data);
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
		$data['bc_aktif'] 			= "Call to Action";
		$data['title'] 				= "Call to Action";
		$data_cta 				= $this->cta_model->get_cta_data();
		if ($data_cta->num_rows() == 0) {
			$this->tambah_data_cta();
		} else {
			$data['form_action'] 	= site_url('admin/calltoaction/update');
			$data['data_cta'] 	= $this->cta_model->get_cta_data();
			$this->template->load('admin/template', 'admin/calltoaction/data_v', $data);			
		}
	}

}

/* End of file Calltoaction.php */
/* Location: .//C/laragon/www/stt-pomosda/goblog-prosite/controllers/admin/Calltoaction.php */

?>