<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/Login_model', 'login_model');
		$this->load->model('admin/Users_model', 'users_model');

		if ($this->session->userdata('login_goblog') == TRUE) {
			$url = base_url('admin/dashboard');
			redirect($url);
		}
	}
	public function index()
	{
		$data_web = $this->site_model->get_site_data()->num_rows();
		$data_user = $this->users_model->get_user_data()->num_rows();
		if ($data_web == 0) {
			$text = "Mohon atur website terlebih dahulu.!";
			$this->session->set_flashdata('swalInfo', $text);
			$url = base_url('admin/konfigurasi-website');
			redirect($url);
		}elseif ($data_user == 0) {			
			$text = "Mohon buat user terlebih dahulu.!";
			$this->session->set_flashdata('swalInfo', $text);
			$url = base_url('admin/konfigurasi-user');
			redirect($url);
		}else {
			$site 						= $this->site_model->get_site_data()->row_array();
			$data['csrf_token'] 		= $this->security->get_csrf_hash();
			$data['url'] 				= site_url('admin/login');
			$data['canonical'] 			= site_url('admin/login');
			$data['site_title'] 		= $site['site_title'];
			$data['site_name'] 			= $site['site_name'];
			$data['site_keywords'] 		= $site['site_keywords'];
			$data['site_author'] 		= $site['site_author'];
			$data['site_logo'] 			= $site['site_logo'];
			$data['site_description'] 	= $site['site_description'];
			$data['site_favicon'] 		= $site['site_favicon'];
			$data['tahun_buat'] 		= $site['tahun_buat'];

			$data['title']				= "Login";
			$data['judul']				= "Login";

			$data['form_act_login'] 	= site_url('admin/login/auth');
			$data['form_act_forget'] 	= site_url('admin/send-reset-code');
			// $data['swalInfo'] 			= $this->session->flashdata('swalInfo');

			$this->load->view('admin/login_v', $data);
			
		}
	}
	public function auth()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Email/ Password', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$text = 'Mohon cek kembali data anda.!';
			$this->session->set_flashdata('pesan', $text);
			$this->index();
		} else {
			$username = sanitize($this->input->post('username', True));
			$password = sanitize($this->input->post('password', True));
			$validasi = $this->login_model->validasi($username);
			if ($validasi->num_rows() > 0) {
				$user_data = $validasi->row_array();
				$password = sha1(md5($password));
				if ($password != $user_data['password']) {				
					$url = base_url('admin');
					$text = 'Password Salah.!';
					$this->session->set_flashdata('pesan', $text);
					redirect($url, 'refresh');
				}else if($user_data['status'] == 0) {
					$url = base_url('admin');
					$text = 'Akun anda dikunci. Silahkan Hubungi admin!';
					$this->session->set_flashdata('pesan', $text);
					redirect($url, 'refresh');
				}else{
					$this->session->set_userdata('login_goblog', TRUE);
					$date = date('Y-m-d H:i:s');
					if ($user_data['level']==1) {
									// Admin
						$this->session->set_userdata('access', '1');
						$id = $user_data['id'];
					// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
						$this->log_model->save_log($id, 0, 'Login Website');

						$last_login = $user_data['last_login'];
						$this->session->set_userdata('id', $id);
						redirect('admin/dashboard');
					} else {
									// Other access
						$this->session->set_userdata('access', '2');
						$id = $user_data['id'];
					// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
						$this->log_model->save_log($id, 0, 'Login Website');

						$last_login = $user_data['last_login'];
						$this->session->set_userdata('id', $id);
						redirect('admin/dashboard');
					}
				}
			}else{
				$url = base_url('admin');
				$text = 'Username tidak terdaftar.!';
				$this->session->set_flashdata('pesan', $text);
				redirect($url, 'refresh');
			}
		}
	}
}
/* End of file Login.php */

/* Location: ./application/controllers/admin/Login.php */
?>