<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Profil extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/Users_model', 'users_model');
		$this->load->model('admin/Sosmed_model', 'sosmed_model');
		$this->load->library('upload');
	}
	public function update_pass()
	{
		$this->load->helper(array('form', 'html'));
		$this->form_validation->set_rules('pass_baru', 'Password Baru', 'trim|required|min_length[6]|max_length[15]');
		$this->form_validation->set_rules('pass_conf', 'Konfirmasi Password', 'required|matches[pass_baru]');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		$this->form_validation->set_message('matches', '%s harus sama dengan Password Baru');
		if ($this->form_validation->run() === FALSE) {
			$text = "Gagal memperbarui password. Silahkan ulangi.";
			$this->session->set_flashdata('pesan_error', $text);
			$this->pengaturan();
		}else{
			$pass_baru 		= $this->input->post('pass_baru', TRUE);
			$id_users 	= $this->input->post('id_users', TRUE);
			$password = sha1(md5($pass_baru));
			$this->users_model->update_profil($id_users, "password", $password);
					// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
			$this->log_model->save_log($id_users, 3, 'Mengupdate password login.');
			$url 	= site_url('admin/profil/pengaturan');
			$text 	= "Password baru berhasil disimpan.";
			$this->session->set_flashdata('pnotify', $text);
			redirect($url, 'refresh');
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
			$simpan = $this->sosmed_model->update_sosmed_users($id_sosmed, $nama_sosmed, $link_sosmed, $ikon_sosmed);
						// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
			$id_author = $this->session->userdata('id');
			$this->log_model->save_log($id_author, 3, 'Mengupdate Akun Sosial Media '.$nama_sosmed.' pribadi.');
			$url 	= site_url('admin/profil/pengaturan');
			$text 	= $nama_sosmed." pribadi berhasil diupdate.";
			$this->session->set_flashdata('pnotify', $text);
			redirect($url, 'refresh');
		}
	}
	public function simpan_sosmed()
	{
		$this->form_validation->set_rules('nama_sosmed', 'Nama Sosmed', 'trim|required');
		$this->form_validation->set_rules('link_sosmed', 'Link Sosmed', 'trim|required');
		$this->form_validation->set_rules('ikon_sosmed', 'Ikon Sosmed', 'trim|required');
		$this->form_validation->set_rules('id_users', 'Pemilik Sosmed', 'trim|required|is_numeric');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() === FALSE) {
			$this->pengaturan();
		}else{
			$id_users 		= $this->input->post('id_users', TRUE);
			$nama_sosmed 		= $this->input->post('nama_sosmed', TRUE);
			$link_sosmed 		= $this->input->post('link_sosmed', TRUE);
			$ikon_sosmed 		= $this->input->post('ikon_sosmed', TRUE);
			$this->sosmed_model->simpan_sosmed_users($id_users, $nama_sosmed, $link_sosmed, $ikon_sosmed);
							// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
			$this->log_model->save_log($id_users, 1, 'Menambah Akun Sosial Media '.$nama_sosmed.' pribadi.');
			$url 	= site_url('admin/profil/pengaturan');
			$text 	= "Berhasil menambahkan akun ".$nama_sosmed." pribadi.";
			$this->session->set_flashdata('pnotify', $text);
			redirect($url, 'refresh');
		}
	}
	public function pengaturan()
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
		$data['bc_aktif'] 			= "Pengaturan";
		$data['bc_menu'] 			= "Profil";
		$data['title'] 				= "Pengaturan";
		$id_users = $this->session->userdata('id');
		$profil = $this->users_model->get_data_by_id($id_users);
		foreach ($profil->result() as $row) {
			$data['id_users'] 	= $row->id;
			$data['aksi_sosmed']	= site_url('admin/profil/simpan_sosmed');
			$data['aksi_upPass']	= site_url('admin/profil/update_pass');
			$data['data_sosmed']	= $this->sosmed_model->get_users_sosmed($id_users);
		}
		$this->template->load('admin/template', 'admin/users/pengaturan_v', $data);
	}
	public function update_foto()
	{
		error_reporting(0);
		$id = $this->input->post('id', TRUE);
		$profil = $this->users_model->get_data_by_id($id)->row();
		$foto_lama = "uploads/users/".$profil->foto;
		unlink($foto_lama);
		$config['upload_path'] 		= './uploads/images/';
		$config['allowed_types'] 	= 'jpg|png|jpeg';
		$config['encrypt_name'] 	= TRUE;
		$this->upload->initialize($config);
		if ($this->upload->do_upload('filefoto')) {
			$img 	= $this->upload->data();
			$image 	= $img['file_name'];
			$this->compress_tinify($image);
			$foto_lama2 = './uploads/images/'.$image;
			unlink($foto_lama2);
			$this->users_model->update_profil($id, "foto", $image);
					// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
			$this->log_model->save_log($this->session->userdata('id'), 3, "Update Foto Profil.");
			$text = "Foto profil berhasil disimpan.";
			$this->session->set_flashdata('pnotify', $text);
			redirect('admin/profil');
		}else{
			$text = $this->upload->display_errors();
			$this->session->set_flashdata('pesan_error', $text);
			redirect('admin/profil');
		}
	}


	public function compress_tinify($gambar_asli)
	{
		$site = $this->site_model->get_site_data()->row_array();
		$this->load->library('tiny_png', array('api_key' => $site['api_tinify']));


		$sumber = './uploads/images/'.$gambar_asli;
		$menuju = './uploads/users/'.$gambar_asli;


		$this->tiny_png->fileCompress($sumber, $menuju);
	}


	public function update_usemail()
	{
		$id 	= $this->input->get('id', TRUE); 
		if ($id != $this->session->userdata('id')) {
			$text 	= "Id tidak ditemukan.";
			$this->session->set_flashdata('pesan_error', $text);
			redirect('admin/profil');
		}
		$field = $this->input->get('field', TRUE);
		$value = $this->input->get('value', TRUE);


		$pilihan = array(
			'username' 	=> 'Username',
			'email' => 'Email',
		);


		$cek = $this->users_model->cek($field, $value, $id);


		if ($cek->num_rows() > 0) {
			foreach ($pilihan as $key => $val) {
				if ($key == $field) {
					$ket = $val;
				}
			}	
			$text 	= "$ket $value sudah digunakan.";
			$tipe 	= "info";
			$notif 	= "Perhatian..!";
		}else{
			$this->users_model->update_profil($id, $field, $value);
			foreach ($pilihan as $key => $val) {
				if ($key == $field) {
					$ket = $val;


					$text 	= "$ket berhasil diubah.";
					$tipe 	= "success";
					$notif 	= "Berhasil..!";
				}
			}
					// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
			$this->log_model->save_log($this->session->userdata('id'), 3, "Update profil kolom $ket.");
		}


		$data = array(
			'pesan' => $text,
			'tipe' => $tipe,
			'notif' => $notif
		);


		echo json_encode($data);	
	}


	public function update()
	{
		$id 	= $this->input->get('id', TRUE); 
		if ($id != $this->session->userdata('id')) {
			$text 	= "Id tidak ditemukan.";
			$this->session->set_flashdata('pesan_error', $text);
			redirect('admin/profil');
		}
		$field = $this->input->get('field', TRUE);
		$value = $this->input->get('value', TRUE);
		$this->users_model->update_profil($id, $field, $value);


		$pilihan = array(
			'full_name' 	=> 'Nama',
			'users_info' => 'About me',
		);
		foreach ($pilihan as $key => $val) {
			if ($key == $field) {
				$ket = $val;


				$text 	= "$ket berhasil diubah.";
				$tipe 	= "success";
				$notif 	= "Berhasil..!";
			}
		}
			// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
		$this->log_model->save_log($this->session->userdata('id'), 3, "Update profil kolom $ket.");


		$data = array(
			'pesan' => $text,
			'tipe' => $tipe,
			'notif' => $notif
		);


		echo json_encode($data);
	}


	public function aktivitas($username)
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
		$data['bc_aktif'] 			= "Aktivitas";
		$data['title'] 				= "Aktivitas";


		$data_users = $this->users_model->get_data_users_by_username($username)->row();


		if ($this->session->userdata('id') == $data_users->id) {
			$data['sm_text'] = "Aktivitas Saya";
		}else{
			$data['sm_text'] = $data_users->full_name;
		}
		$data['log_users'] = $this->log_model->get_data_by_id($data_users->id);


		$this->template->load('admin/template', 'admin/users/aktivitas_v', $data);
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
		$data['bc_aktif'] 			= "Profil";
		$data['title'] 				= "Profil";


		$id_users = $this->session->userdata('id');
		$profil = $this->users_model->get_data_by_id($id_users);
		foreach ($profil->result() as $row) {
			$data['id'] 			= $row->id;
			$data['full_name'] 		= $row->full_name;
			$data['username'] 		= $row->username;
			$data['email'] 			= $row->email;
			$data['jenis_fungsi'] 	= $row->jenis_fungsi;
			$data['users_info'] 	= $row->user_info;
			$data['foto'] 			= $row->foto;
			$data['status'] 		= $row->status;
			$data['last_login'] 	= $row->last_login;
			$query2 = $this->db->query("SELECT COUNT(*) as jumlah_berita FROM tb_berita WHERE id_author = '$row->id'")->row();
			$data['jml_berita'] = $query2->jumlah_berita;
		}


		$data['log_users'] = $this->log_model->get_data_hari_ini($id_users);


		$this->template->load('admin/template', 'admin/users/profil_v', $data);		
	}



}



/* End of file Profil.php */

/* Location: ./application/controllers/admin/Profil.php */



?>