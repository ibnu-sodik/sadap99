<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Kontak extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Beranda_model', 'beranda_model');
		$this->load->model('Kategori_model', 'kategori_model');
		$this->load->model('admin/Kontak_model', 'kontak_model');
		$this->visitor_model->hitung_visitor();
		$this->load->helper('email');
	}

	public function kirim_pesan()
	{
		$this->load->helper(array('form', 'html'));
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('subjek', 'Subjek', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('pesan', 'Pesan', 'trim|required');
		$this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');

		if ($this->form_validation->run() == FALSE) {
			$text = "Mohon periksa kembali pesan anda.";
			$this->session->set_flashdata('swalWarning', $text);
			$this->index();
		} else {

			$this->load->model('admin/Pesan_model', 'pesan_model');

			$nama 	= $this->input->post('nama', TRUE);
			$email 	= $this->input->post('email', TRUE);
			$subjek = $this->input->post('subjek', TRUE);
			$pesan 	= $this->input->post('pesan', TRUE);

			$this->pesan_model->simpan($nama, $email, $subjek, $pesan);

			$text = "Pesan anda terkirim.!";
			$this->session->set_flashdata('swalSukses', $text);
			redirect('kontak','refresh');
		}

	}

	public function index()
	{
		$data['timestamp'] 			= strtotime(date('Y-m-d H:i:s'));
		$site 						= $this->site_model->get_site_data()->row_array();
		$data['url'] 				= site_url('kontak');
		$data['canonical'] 			= site_url('kontak');
		$data['site_title'] 		= $site['site_title'];
		$data['site_name'] 			= $site['site_name'];
		$data['site_keywords'] 		= $site['site_keywords'];
		$data['site_author'] 		= $site['site_author'];
		$data['site_logo'] 			= $site['site_logo'];
		$data['site_description'] 	= $site['site_description'];
		$data['site_favicon'] 		= $site['site_favicon'];
		$data['site_email'] 		= $site['site_email'];
		$data['site_telp'] 			= $site['site_telp'];
		$data['site_nowa'] 			= $site['site_nowa'];
		$data['site_pesanTeks'] 	= $site['site_pesanTeks'];
		$data['tahun_buat'] 		= $site['tahun_buat'];
		$data['limit_post']			= $site['limit_post'];
		$data['title']				= "Kontak";

		$data['berita_terbaru'] 	= $this->beranda_model->get_berita_baru($site['limit_post']);
		$data['berita_populer'] 	= $this->beranda_model->get_berita_populer(4);
		$data['berita_random'] 		= $this->beranda_model->get_berita_random(1);
		$data['data_kategori'] 		= $this->kategori_model->get_kategori(3);
		$data['berita_review'] 		= $this->beranda_model->get_berita_review(1);
		
		$berita_review 				= $this->beranda_model->get_berita_review(1)->row();
		$id_berita 					= $berita_review->id_berita;
		$data['berita_refiew_follow'] = $this->beranda_model->get_berita_review_not_in($id_berita, $site['limit_post'] - 1);

		$data['data_konten'] 		= $this->kontak_model->get_kontak_data();
		$data['form_action']		= site_url("kontak/kirim-pesan");		
		$this->load->view('website/part/_head', $data);
		$this->load->view('website/kontak_v', $data);
		$this->load->view('website/part/footer', $data);
	}

}

/* End of file Kontak.php */
/* Location: ./application/controllers/Kontak.php */

 ?>