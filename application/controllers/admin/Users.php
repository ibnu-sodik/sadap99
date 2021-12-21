<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
	
	public function __construct()

	{
		parent::__construct();
		$this->load->model('Site_model', 'site_model');
		$this->load->model('admin/Users_model', 'users_model');
		$this->load->model('admin/Berita_model', 'berita_model');
		$this->load->model('admin/Log_model', 'log_model');
		$this->load->helper('text');
	}

	public function hapus($id)

	{
		error_reporting(0);
		$data_p = $this->users_model->get_data_by_id($id);
		if ($data_p->num_rows() > 0) {
			$data = $data_p->row();
			$foto_p = "uploads/Users/" . $data->foto;
			chmod('uploads/Users/', 0777);
			unlink($foto_p);
		}
		$data_a = $this->berita_model->get_data_by_author($id);
		if ($data_a->num_rows() > 0) {
			$data = $data_a->row();
			$jumlah = $data_a->num_rows();
			foreach ($data_a->result() as $row) {
				$foto_a = "uploads/berita/" . $row->gambar_berita;
				chmod($foto_a, 0777);
				unlink($foto_a);
			}
		}


		$pilihan = array(
			'tb_users' 			=> 'id',
			'tb_berita' 			=> 'id_author',
			'tb_label_berita' 		=> 'user_id_label',
			'tb_kategori_berita' 	=> 'user_id_kategori',
			'tb_log' 				=> 'log_userid',
			'tb_sosmed_users' 	=> 'id_users_sosmed',
		);
		foreach ($pilihan as $table => $kolom) {
			$this->users_model->hapus_multi($id, $table, $kolom);
		}


		// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
		$id_author = $this->session->userdata('id');
		$this->log_model->save_log($id_author, 4, 'Hapus seluruh data ' . $data_p->full_name);


		$text = "Data Berita, Label, Kategori dan Profil $full_name berhasil dihapus.";
		$this->session->set_flashdata('pnotify', $text);
		redirect('admin/Users', 'refresh');
	}

	public function update($id)

	{
		$this->load->library('form_validation');
		$this->load->helper(array('form', 'html'));
		$this->form_validation->set_rules('full_name', 'Nama Lengkap', 'required|strip_tags|min_length[3]');
		$this->form_validation->set_rules('jenis_fungsi', 'Fungsi/ Jabatan', 'required|strip_tags|trim');


		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');


		if ($this->form_validation->run() === FALSE) {
			$this->edit($id);
		} else {
			$errors = array();
			$username 		= $this->input->post('username', TRUE);
			$email 			= $this->input->post('email', TRUE);
			$full_name 		= $this->input->post('full_name', TRUE);
			$jenis_fungsi 	= $this->input->post('jenis_fungsi', TRUE);
			$level 	= $this->input->post('level', TRUE);


			if (empty($username)) {
				$errors[] = "Username harus diisi.";
			}
			$cek_us = $this->db->query("SELECT * FROM tb_users WHERE username = '$username' AND id != '$id'");
			if ($cek_us->num_rows() > 0) {
				$errors[] = "Username $username sudah digunakan.";
			}
			if (empty($email)) {
				$errors[] = "Email harus diisi.";
			}
			$cek_us = $this->db->query("SELECT * FROM tb_users WHERE email = '$email' AND id != '$id'");
			if ($cek_us->num_rows() > 0) {
				$errors[] = "Email $email sudah digunakan.";
			}


			if (!empty($errors)) {
				foreach ($errors as $error) {
					$this->session->set_flashdata('pesan_error', $error);
					redirect('admin/Users/edit/' . $id, 'refresh');
				}
			} else {
				$this->users_model->update($id, $full_name, $username, $email, $jenis_fungsi, $level);
				// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
				$id_author = $this->session->userdata('id');
				$this->log_model->save_log($id_author, 3, 'Update data Users ' . $full_name);
				$text = "Data $full_name berhasil disimpan.";
				$this->session->set_flashdata('pnotify', $text);
				redirect('admin/Users', 'refresh');
			}
		}
	}

	public function edit($id)

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
		$data['bc_menu'] 			= "Users";
		$data['bc_aktif'] 			= "Edit Users";
		$data['title'] 				= "Users";
		$data['data'] 				= $this->users_model->get_data_by_id($id);
		$data['form_action'] 		= site_url('admin/Users/update');


		$this->template->load('admin/template', 'admin/Users/edit_v', $data);
	}

	public function lock($id)

	{
		$data = $this->users_model->get_data_by_id($id);
		if ($data->num_rows() < 0) {
			$text = "Data tidak ditemukan.";
			$this->session->set_flashdata('pesan_error', $text);
			redirect('admin/Users');
		} else {
			$row = $data->row();
			$this->users_model->lock($id);


			$text = $row->full_name . " berhasil di nonaktifkan.";
			$this->session->set_flashdata('pnotify', $text);
			redirect('admin/Users');
		}
	}

	public function unlock($id)

	{
		$data = $this->users_model->get_data_by_id($id);
		if ($data->num_rows() < 0) {
			$text = "Data tidak ditemukan.";
			$this->session->set_flashdata('pesan_error', $text);
			redirect('admin/Users');
		} else {
			$row = $data->row();
			$this->users_model->unlock($id);


			$text = $row->full_name . " berhasil aktif.";
			$this->session->set_flashdata('pnotify', $text);
			redirect('admin/Users');
		}
	}

	public function save()

	{
		$this->form_validation->set_rules('full_name', 'Nama Lengkap', 'required|strip_tags|min_length[3]');
		$this->form_validation->set_rules('email', 'Email', 'required|strip_tags|valid_email|min_length[3]|is_unique[tb_users.email]');
		$this->form_validation->set_rules('username', 'Username', 'required|strip_tags|is_unique[tb_users.username]|min_length[3]');
		$this->form_validation->set_rules('password', 'Password', 'required|strip_tags|min_length[6]');


		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
		$this->form_validation->set_message('username', 'Username %s sudah digunakan.');
		$this->form_validation->set_message('email', 'Email %s sudah terdaftar.');


		if ($this->form_validation->run() === FALSE) {
			$this->index();
		} else {

			$username = $this->input->post('username', true);
			$password 	= sha1(md5($this->input->post('password', true)));
			$full_name 	= $this->input->post('full_name', true);
			$email 		= $this->input->post('email', true);


			$password_text = $this->input->post('password', true);


			$kode_aktivasi = $this->get_code();
			$this->send_email_notif($email, $kode_aktivasi, $full_name, $username, $password_text);


			$simpan = $this->users_model->tambah_data($username, $password, $full_name, $email);


			// $this->users_model->save_aktivasi($email, $kode_aktivasi);


			$text = $full_name . " berhasil disimpan pada data Users. Silahkan cek email untuk mengaktifkan akun.";
			$this->session->set_flashdata('pesan', $text);
			redirect('admin/Users');
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
		$data['bc_aktif'] 			= "Users";
		$data['title'] 				= "Users";


		$data['data_users']		= $this->users_model->get_all_data();


		$this->template->load('admin/template', 'admin/users/data_v', $data);
	}

	public function send_email_notif($email, $kode_aktivasi, $full_name, $username, $password_text)

	{
		$this->load->config('email');
		$this->load->library('email');
		$site = $this->site_model->get_site_data()->row_array();


		$subjek 				= "Users Baru Pada " . $site['site_name'];
		$data['subjek'] 		= $subjek;
		$data['url_aktivasi']	= site_url('admin/aktivasi/' . $kode_aktivasi);
		$data['site_name']		= $site['site_name'];
		$data['tahun_buat'] 	= $site['tahun_buat'];
		$data['kode_aktivasi']	= $kode_aktivasi;
		$data['full_name']		= $full_name;
		$data['username']		= $username;
		$data['password']		= $password_text;
		$this->email->from($this->config->item('smtp_user'), 'admin@' . $site['site_name']);
		$this->email->to($email);


		$this->email->subject($subjek);
		$this->email->message($this->load->view('email/aktivasi_user_v', $data, TRUE));
		// $this->email->message("Email isi disini");


		if ($this->email->send()) {
			// simpan data pada db
			$this->users_model->save_aktivasi($email, $kode_aktivasi);
			// echo $this->email->print_debugger();
			// $text = "Kode aktivasi akun telaha dikirim ke ".$email;
			// $this->session->set_flashdata('pnotify', $text);
			// $url = site_url('admin/Users');
			// redirect($url);
		} else {
			// echo $this->email->print_debugger();
			$text = "Gagal mengirim email";
			$this->session->set_flashdata('pesan_error', $text);
			$url = site_url('admin/Users');
			redirect($url);
		}
	}

	public function get_code()

	{
		$this->load->helper('string');
		$string = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		return substr(str_shuffle($string), 0, 43);
		// return random_string('alnum', 42);

	}

	public function konfigurasi_user()
	{
		$data['form_action'] 	= site_url('admin/users/simpan_user');
		$data['csrf_token'] 	= $this->security->get_csrf_hash();

		$this->load->view('admin/konfigurasi_user_v', $data);
	}

	public function simpan_user()
	{
		$this->form_validation->set_rules('full_name', 'Nama', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('conf_password', 'Konfimasi Password', 'trim|required|matches[password]');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

		if ($this->form_validation->run() == FALSE) {
			$text = 'Periksa kembali data yang anda masukkan.!';
			$this->session->set_flashdata('swalError', $text);
			$this->konfigurasi_user();
		} else {
			$full_name 		= $this->input->post('full_name', TRUE);
			$username 		= $this->input->post('username', TRUE);
			$email 			= $this->input->post('email', TRUE);
			$password 		= $this->input->post('password', TRUE);

			$hash = sha1(md5($password));

			$this->users_model->_simpan($full_name, $username, $email, $hash);

			$url = base_url('admin');
			$text = 'User baru berhasil disimpan.!';
			$this->session->set_flashdata('swalSukses', $text);
			redirect($url);
		}
	}
}

/* End of file Users.php */

/* Location: ./application/controllers/admin/Users.php */
