<?php 



defined('BASEPATH') OR exit('No direct script access allowed');



class Website extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/Website_model', 'website_model');
		$this->load->model('admin/Sosmed_model', 'sosmed_model');
		$this->load->library('upload');
		$this->load->helper('text');
		if ($this->session->userdata('access')!=1) {
			$text = 'Terdapat batasan hak akses pada halaman ini.';
			$this->session->set_flashdata('pesan_error', $text);
			redirect('admin', 'refresh');
		}
	}


	public function update_sosmed()
	{
		$this->form_validation->set_rules('nama_sosmed2', 'Nama Sosmed', 'trim|required');
		$this->form_validation->set_rules('link_sosmed2', 'Link Sosmed', 'trim|required');
		$this->form_validation->set_rules('ikon_sosmed2', 'Ikon Sosmed', 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() === FALSE) {
			$url 	= site_url('admin/website');
			$text 	= "Terjadi kesalahan saat akan mengupdate Sosmed Website.";
			$this->session->set_flashdata('pesan_error', $text);
			redirect($url, 'refresh');
		}else{
			$id_sosmed 	 	= $this->input->post('id_sosmed', TRUE);
			$nama_sosmed  	= $this->input->post('nama_sosmed2', TRUE);
			$link_sosmed  	= $this->input->post('link_sosmed2', TRUE);
			$ikon_sosmed  	= $this->input->post('ikon_sosmed2', TRUE);
			$simpan = $this->sosmed_model->update_sosmed($id_sosmed, $nama_sosmed, $link_sosmed, $ikon_sosmed);
			if ($simpan) {
						// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
				$id_author = $this->session->userdata('id');
				$this->log_model->save_log($id_author, 3, 'Mengupdate Akun Sosial Media '.$nama_sosmed.' pada Website');
			}
			$url 	= site_url('admin/website');
			$text 	= $nama_sosmed." Pada Website berhasil diupdate.";
			$this->session->set_flashdata('pnotify', $text);
			redirect($url, 'refresh');
		}


	}


	public function simpan_sosmed()
	{
		$this->form_validation->set_rules('nama_sosmed', 'Nama Sosmed', 'trim|required');
		$this->form_validation->set_rules('link_sosmed', 'Link Sosmed', 'trim|required');
		$this->form_validation->set_rules('ikon_sosmed', 'Ikon Sosmed', 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() === FALSE) {
			$this->index();
		}else{
			$nama_sosmed 		= $this->input->post('nama_sosmed', TRUE);
			$link_sosmed 		= $this->input->post('link_sosmed', TRUE);
			$ikon_sosmed 		= $this->input->post('ikon_sosmed', TRUE);
			$simpan = $this->sosmed_model->simpan_sosmed($nama_sosmed, $link_sosmed, $ikon_sosmed);
			if ($simpan) {
						// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
				$id_author = $this->session->userdata('id');
				$this->log_model->save_log($id_author, 1, 'Menambah Akun Sosial Media '.$nama_sosmed.' pada Website');
			}
			$url 	= site_url('admin/website');
			$text 	= "Berhasil menambahkan akun ".$nama_sosmed." pada Website.";
			$this->session->set_flashdata('pnotify', $text);
			redirect($url, 'refresh');
		}
	}


	public function update_api()
	{
		$this->form_validation->set_rules('api_tinify', 'API Tinify', 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() === FALSE) {
			$this->index();
		}else{
			$api_tinify 		= $this->input->post('api_tinify', TRUE);
			$simpan = $this->website_model->simpan_api($api_tinify);
			if ($simpan) {
						// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
				$id_author = $this->session->userdata('id');
				$this->log_model->save_log($id_author, 3, 'Update API Tinify website');
			}
			$url 	= site_url('admin/website');
			$text 	= "API Tinify Website berhasil diperbarui";
			$this->session->set_flashdata('pnotify', $text);
			redirect($url, 'refresh');
		}
	}


	public function update_kontak()
	{
		$this->form_validation->set_rules('site_email', 'Email Website', 'trim|required');
		$this->form_validation->set_rules('site_telp', 'Nomor Telepon', 'trim|required|min_length[9]|max_length[15]');
		$this->form_validation->set_rules('site_nowa', 'Nomor WhatsApp', 'trim|required|min_length[9]|max_length[15]');
		$this->form_validation->set_rules('site_pesanTeks', 'Teks Pesan', 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() === FALSE) {
			$this->index();
		}else{
			$site_telp 		= $this->input->post('site_telp', TRUE);
			$site_email 	= $this->input->post('site_email', TRUE);
			$site_nowa 		= $this->input->post('site_nowa', TRUE);
			$site_pesanTeks = $this->input->post('site_pesanTeks', TRUE);
			$simpan = $this->website_model->simpan_kontak($site_telp, $site_email, $site_nowa, $site_pesanTeks);
			if ($simpan) {
						// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
				$id_author = $this->session->userdata('id');
				$this->log_model->save_log($id_author, 3, 'Update data email website');
			}
			$url 	= site_url('admin/website');
			$text 	= "Email Website berhasil diperbarui";
			$this->session->set_flashdata('pnotify', $text);
			redirect($url, 'refresh');
		}
	}


	public function update_logo()
	{
		$data 		= $this->site_model->get_site_data()->row();
		$site_name 	= $data->site_name;
		$f_sf 		= "./assets/images/".$data->site_favicon;
		$f_sl 		= "./assets/images/".$data->site_logo;
		$config['upload_path'] 		= './assets/images/';
		$config['allowed_types'] 	= 'gif|jpg|png|bmp|jpeg|ico';
		$config['encrypt_name'] 	= TRUE;

		$this->upload->initialize($config);
		$site_favicon 	= $_FILES['site_favicon']['name'];
		$site_logo 		= $_FILES['site_logo']['name'];
		if (!empty($site_favicon) && !empty($site_logo)) {
			unlink($f_sf);
			unlink($f_sl);
				// Upload semua gambar
			if ($this->upload->do_upload('site_favicon')) {
				$sf = $this->upload->data();
				$site_favicon = $sf['file_name'];
				$this->compress_tinify($site_favicon);
			}
			if ($this->upload->do_upload('site_logo')) {
				$sl = $this->upload->data();
				$site_logo = $sl['file_name'];
				$this->compress_tinify($site_logo);
			}
			$update = $this->website_model->update_img($site_favicon, $site_logo);
			if($update){
						// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
				$id_author = $this->session->userdata('id');
				$this->log_model->save_log($id_author, 3, 'Update Logo dan Ikon website');
			}
			$text = 'Logo dan Ikon '.$site_name.' Berhasil Diubah.!';
			$this->session->set_flashdata('pnotify', $text);
			redirect('admin/website');
		} elseif (!empty($site_favicon) && empty($site_logo)) {
				// hanya upload favicon
			unlink($f_sf);
			if ($this->upload->do_upload('site_favicon')) {
				$sf = $this->upload->data();
				$site_favicon = $sf['file_name'];
				$this->compress_tinify($site_favicon);
			}
			$update = $this->website_model->update_img_icon($site_favicon);
			if($update){
						// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
				$id_author = $this->session->userdata('id');
				$this->log_model->save_log($id_author, 3, 'Update Ikon website');
			}
			$text = 'Ikon '.$site_name.' Berhasil Diubah.!';
			$this->session->set_flashdata('pnotify', $text);
			redirect('admin/website');
		} elseif (empty($site_favicon) && !empty($site_logo)) {
				// hanya upload logo
			unlink($f_sl);
			if ($this->upload->do_upload('site_logo')) {
				$sl = $this->upload->data();
				$site_logo = $sl['file_name'];
				$this->compress_tinify($site_logo);
			}
			$update = $this->website_model->update_img_logo($site_logo);
			if($update){
						// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
				$id_author = $this->session->userdata('id');
				$this->log_model->save_log($id_author, 3, 'Update Logo website');
			}
			$text = 'Logo '.$site_name.' Berhasil Diubah.!';
			$this->session->set_flashdata('pnotify', $text);
			redirect('admin/website');			
		} else {
				// tidak berubah			
			$text = 'Logo dan Ikon '.$site_name.' Tidak Diubah.!';
			$this->session->set_flashdata('pesan_error', $text);
			redirect('admin/website');			
		}
		// compress tinify
	}


	public function compress_tinify($gambar_asli='d62c4bff6c2710deec6d4053c551a65c.png')
	{
		$site = $this->site_model->get_site_data()->row_array();
		$this->load->library('tiny_png', array('api_key' => $site['api_tinify']));
		$sumber = './assets/images/'.$gambar_asli;
		$menuju = './assets/images/'.$gambar_asli;
		$this->tiny_png->fileCompress($sumber, $menuju);
	}


	public function update()
	{
		$this->form_validation->set_rules('site_title', 'Judul Website', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('site_name', 'Nama Website', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('site_keywords', 'Keywirds Website', 'trim|required');
		$this->form_validation->set_rules('site_description', 'Deskripsi Website', 'trim|required');
		$this->form_validation->set_rules('tahun_buat', 'Tahun Pembuatan', 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() === FALSE) {
			$this->index();
		}else{
			$site_name 			= $this->input->post('site_name', TRUE);
			$site_title 		= $this->input->post('site_title', TRUE);
			$site_keywords 		= $this->input->post('site_keywords', TRUE);
			$site_description 	= $this->input->post('site_description', TRUE);
			$tahun_buat 		= $this->input->post('tahun_buat', TRUE);
			$limit_post 		= $this->input->post('limit_post', TRUE);
			$simpan = $this->website_model->simpan_basic($site_name, $site_title, $site_keywords, $site_description, $tahun_buat, $limit_post);
			if ($simpan) {
						// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
				$id_author = $this->session->userdata('id');
				$this->log_model->save_log($id_author, 3, 'Update data profil website');
			}
			$url 	= site_url('admin/website');
			$text 	= "Pengaturan berhasil disimpan";
			$this->session->set_flashdata('pnotify', $text);
			redirect($url, 'refresh');
		}
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
		$data['bc_aktif'] 			= "Website";
		$data['title'] 				= "Website";
		$data['aksi_basic'] 		= site_url('admin/website/update');
		$data['aksi_logo'] 			= site_url('admin/website/update_logo');
		$data['aksi_kontak'] 		= site_url('admin/website/update_kontak');
		$data['aksi_api'] 			= site_url('admin/website/update_api');
		$data['aksi_sosmed'] 		= site_url('admin/website/simpan_sosmed');
		$data['data']				= $this->website_model->get_data();
		$data['data_sosmed']		= $this->sosmed_model->get_data();
		$this->template->load('admin/template', 'admin/website/data_v', $data);		
	}



}



/* End of file Website.php */

/* Location: ./application/controllers/admin/Website.php */



?>