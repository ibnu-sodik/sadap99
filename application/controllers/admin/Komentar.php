<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Komentar extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/Komentar_model', 'komentar_model');
	}
	public function hapus($id_komentar)
	{
		$cekParent = $this->db->query("SELECT * FROM tb_komentar WHERE parent_komentar = '$id_komentar'");
		$jumlah = $cekParent->num_rows();
		$data = $this->komentar_model->get_data_by_id($id_komentar)->row();
		if ($jumlah > 0) {
			$text = "Terdapat $jumlah sub komentar dari $data->nama_komentar.";
			$this->session->set_flashdata('pesan_error', $text);
			redirect('admin/komentar');
		}else{
			$this->komentar_model->hapus($id_komentar);
				// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
			$this->log_model->save_log($this->session->userdata('id'), 4, 'Menghapus komentar dari '.$data->nama_komentar);
			$text = "Komentar berhasil dihapus.";
			$this->session->set_flashdata('pnotify', $text);
			redirect('admin/komentar');
		}
	}
	public function balas()
	{		
		$this->load->helper(array('form', 'html'));
		$this->form_validation->set_rules('konten_komentar', 'Komentar', 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() === FALSE) {
			$text = "Komentar harus diisi.";
			$this->session->set_flashdata('pesan_error', $text);
			$this->index();
		}else{
			$this->load->model('admin/Users_model', 'users_model');
			$id_komentar 			= $this->input->post('id_kom_balas', TRUE);
			$id_komentar_berita 	= $this->input->post('id_komar_blas', TRUE);
			$id_author 				= $this->input->post('id_author', TRUE);
			$website_komentar 		= $this->input->post('website_komentar', TRUE);
			$konten_komentar 		= $this->input->post('konten_komentar', TRUE);
			$id_users 	= $this->session->userdata('id');
			$daper 			= $this->users_model->get_data_by_id($id_users)->row();
			$nama_komentar 	= $daper->full_name;
			$email_komentar = $daper->email;
			$this->komentar_model->balas($id_komentar, $nama_komentar, $email_komentar, $id_komentar_berita, $id_author, $website_komentar, $konten_komentar);
			$this->komentar_model->dibaca($id_komentar);
			$data = $this->komentar_model->get_data_by_id($id_komentar)->row();
				// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
			$this->log_model->save_log($this->session->userdata('id'), 6, 'Membalas komentar dari '.$data->nama_komentar);
			$text = "Balasan komentar untuk $data->nama_komentar berhasil dikirim.";
			$this->session->set_flashdata('pnotify', $text);
			redirect('admin/komentar');
		}
	}
	public function update()
	{
		$this->load->helper(array('form', 'html'));
		$this->form_validation->set_rules('konten_komentar', 'Komentar', 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() === FALSE) {
			$text = "Komentar harus diisi.";
			$this->session->set_flashdata('pesan_error', $text);
			$this->index();
		}else{
			$id_komentar 		= $this->input->post('id_komentar', TRUE);
			$website_komentar 	= $this->input->post('website_komentar', TRUE);
			$konten_komentar 	= $this->input->post('konten_komentar', TRUE);
			$data = $this->komentar_model->get_data_by_id($id_komentar)->row();
			$this->komentar_model->update($id_komentar, $website_komentar, $konten_komentar);
			$this->komentar_model->dibaca($id_komentar);

				// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
			$this->log_model->save_log($this->session->userdata('id'), 3, 'Edit komentar dari '.$data->nama_komentar);
			$text = "Komentar dari $data->nama_komentar berhasil diubah.";
			$this->session->set_flashdata('pnotify', $text);
			redirect('admin/komentar');
		}
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
		$data['limit_post'] 		= $site['limit_post'];
		$data['bc_aktif'] 			= "Komentar";
		$data['title'] 				= "Komentar";
		$id_users = $this->session->userdata('id');
		$query = $this->db->get_where('tb_komentar', array('id_author_berita' => $id_users));
		$page = $this->uri->segment(4);
		if (!$page) {
			$mati = 0;
		}else{
			$mati = $page;
		}
		$limit 					= $site['limit_post'];
		$offset 				= $mati > 0 ? (($mati - 1) * $limit) : $mati;
		$config['base_url'] 	= base_url('admin/komentar/index/');
		$config['total_rows'] 	= $query->num_rows();
		$config['per_page'] 	= $limit;
		$config['uri_segment'] 	= 4;
		$config['use_page_numbers'] = TRUE;
		$config["full_tag_open"] 	= '<ul class="pagination">';
		$config["full_tag_close"]	= '</ul>';
		$config["first_tag_open"] 	= '<li>';
		$config["first_tag_close"] 	= '</li>';
		$config["last_tag_open"] 	= '<li>';
		$config["last_tag_close"] 	= '</li>';
		$config['next_link'] 		= '&gt;';
		$config["next_tag_open"] 	= '<li>';
		$config["next_tag_close"] 	= '</li>';
		$config["prev_link"] 		= "&lt;";
		$config["prev_tag_open"] 	= "<li>";
		$config["prev_tag_close"] 	= "</li>";
		$config["cur_tag_open"] 	= "<li class='active'><a href='#'>";
		$config["cur_tag_close"] 	= "</a></li>";
		$config["num_tag_open"] 	= "<li>";
		$config["num_tag_close"] 	= "</li>";
		$config['prev_link'] 		= 'Sebelumnya';
		$config['next_link'] 		= 'Selanjutnya';
		$config['last_link'] 		= 'Terakhir';
		$config['first_link'] 		= 'Pertama';
		$data['id']					= $id_users;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['komentar'] 	= $this->komentar_model->get_all_komentar($offset, $limit, $id_users);
		$this->template->load('admin/template', 'admin/komentar/data_v', $data);
	}
}
/* End of file Komentar.php */

/* Location: ./application/controllers/admin/Komentar.php */
?>