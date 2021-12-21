<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Reset extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/Reset_model', 'reset_model');
		$this->load->model('admin/Log_model', 'log_model');
		$this->load->model('Site_model', 'site_model');
		$this->load->helper('text');		
	}
	public function index($reset_code)
	{
		if ($this->reset_model->get_reset_code($reset_code)->num_rows() == 0) {
			$text = "Token reset password tidak ditemukan.";
			$this->session->set_flashdata('pesan_error', $text);
			$url = site_url('admin');
			redirect($url,'refresh');
		}else{
			$site 						= $this->site_model->get_site_data()->row_array();
			$data['url'] 				= site_url('login');
			$data['canonical'] 			= site_url('login');
			$data['site_name'] 			= $site['site_name'];
			$data['site_title'] 		= $site['site_title'];
			$data['token']				= $reset_code;
			$data['site_title'] 		= $site['site_title'];
			$data['site_name'] 			= $site['site_name'];
			$data['site_keywords'] 		= $site['site_keywords'];
			$data['site_author'] 		= $site['site_author'];
			$data['site_logo'] 			= $site['site_logo'];
			$data['site_description'] 	= $site['site_description'];
			$data['site_favicon'] 		= $site['site_favicon'];
			$data['tahun_buat'] 		= $site['tahun_buat'];
			$data['bc_aktif'] 			= "Reset Password";
			$data['title'] 				= "Reset Password";
			$data['form_act_reset'] = site_url('admin/update-password');
			$this->load->view('admin/reset_password_v', $data);
		}
	}
	public function update_password($token)
	{
		$this->load->helper(array('form', 'html'));
		$this->form_validation->set_rules('pass_baru', 'Password Baru', 'trim|required|min_length[6]|max_length[15]');
		$this->form_validation->set_rules('pass_conf', 'Konfirmasi Password', 'required|matches[pass_baru]');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		$this->form_validation->set_message('matches', '%s harus sama dengan Password Baru');
		if ($this->form_validation->run() === FALSE) {
			$reset_code = $this->input->post('token', TRUE);
			$this->index($reset_code);
		} else {
			$pass_baru 	= $this->input->post('pass_baru', TRUE);
			$token 		= $this->input->post('token', TRUE);
			$data = $this->reset_model->get_reset_code($token)->row_array();
			$email = $data['reset_email'];
			$this->reset_model->update_password($pass_baru, $email);
			$this->reset_model->_delete_token($token);
						// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
			$data2 = $this->log_model->get_data_user_by_email($email)->row_array();
			$this->log_model->save_log($data2['id'], 5, 'Reset Password');
			$text = "Password baru berhasil disimpan. Silahkan Login.";
			$this->session->set_flashdata('pesanSukses', $text);
			$url = site_url('admin');
			redirect($url,'refresh');
		}
	}
	public function send_reset_code()
	{
		$this->load->helper(array('form', 'html'));
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
			// $this->form_validation->set_message('required', 'Masukkan %s');
		if ($this->form_validation->run() === FALSE) {
			$text = "Terjadi kesalahan saat mengirim email.";
			$this->session->set_flashdata('pesan', $text);
			$url = site_url('admin');
			redirect($url,'refresh');
		} else {
			$email = $this->input->post('email');
					// cek apakah email ada pada database
			$cek = $this->site_model->cek_kesediaan_email($email);
			if ($cek->num_rows() == 0) {
				$text = "Email yang anda masukkan tidak ditemukan";
				$this->session->set_flashdata('pesan', $text);
				$url = site_url('admin');
				redirect($url,'refresh');
			} else {
				$reset_code 	= $this->get_code();
				$kirim_email 	= $this->send_code_to_email($email, $reset_code);
				if ($kirim_email == TRUE) {
					$this->reset_model->save_reset($email, $reset_code);
				}
			}
		}
	}
	public function send_code_to_email($email, $reset_code)
	{
		$this->load->config('email');
		$this->load->library('email');
		$site = $this->site_model->get_site_data()->row_array();
		$dareq = $this->log_model->get_data_user_by_email($email)->row_array();
		$data['nama'] 			= $dareq['full_name'];
		$data['reset_code'] 	= $reset_code;
		$data['url_reset']		= site_url('admin/reset-password/'.$reset_code);
		$data['site_name']		= $site['site_name'];
		$subjek 				= "Reset Password";
		$data['subjek']			= $subjek;
		$this->email->from($this->config->item('smtp_user'), 'admin@'.$site['site_name']);
		$this->email->to($email);
		$this->email->subject($subjek);
			// $this->email->message("Email isi disini");
		$this->email->message($this->load->view('email/reset_password_v', $data, TRUE));
		if ($this->email->send()) {
					// simpan data pada db
			$this->reset_model->save_reset($email, $reset_code);
			$text = "Token reset password telaha dikirim ke ".$email;
			$text.= " Silahkan periksa email anda!.";
			$this->session->set_flashdata('pesanSukses', $text);
			$url = site_url('admin');
			redirect($url);
		}else{
					// echo $this->email->print_debugger();
					// die();
			$text = "Gagal mengirim token reset password ke ".$email;
			$this->session->set_flashdata('pesan', $text);
			$url = site_url('admin');
			redirect($url);
		}
		echo $this->email->print_debugger();
	}
	public function get_code()
	{
		$this->load->helper('string');
		$string = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		return substr(str_shuffle($string), 0, 43);
			// return random_string('alnum', 42);
	}
}
/* End of file Reset.php */

/* Location: ./application/controllers/admin/Reset.php */
?>