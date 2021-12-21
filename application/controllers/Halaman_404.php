<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Halaman_404 extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Beranda_model', 'beranda_model');
		$this->load->model('admin/Kontak_model', 'kontak_model');
		$this->visitor_model->hitung_visitor();
		$this->load->helper('email');
	}

	public function index()
	{
		$site 						= $this->site_model->get_site_data()->row_array();
		$data['url'] 				= site_url('halaman_404');
		$data['canonical'] 			= site_url('halaman_404');
		$data['site_title'] 		= $site['site_title'];
		$data['site_name'] 			= $site['site_name'];
		$data['site_keywords'] 		= $site['site_keywords'];
		$data['site_author'] 		= $site['site_author'];
		$data['site_email'] 		= $site['site_email'];
		$data['site_logo'] 			= $site['site_logo'];
		$data['site_description'] 	= $site['site_description'];
		$data['site_favicon'] 		= $site['site_favicon'];
		$data['tahun_buat'] 		= $site['tahun_buat'];
		$data['limit_post'] 		= $site['limit_post'];
		$data['bc_aktif'] 			= "Halaman 404";
		$data['title']				= "Halaman 404";
		$data['bc_link']			= site_url('halaman_404');

		$data['berita_terbaru'] 	= $this->beranda_model->get_berita_baru($site['limit_post']);
		$data['berita_populer'] 	= $this->beranda_model->get_berita_populer(4);
		$data['berita_random'] 		= $this->beranda_model->get_berita_random(1);
		
		$berita_review 				= $this->beranda_model->get_berita_review(1)->row();
		$id_berita 					= $berita_review->id_berita;
		$data['berita_refiew_follow'] = $this->beranda_model->get_berita_review_not_in($id_berita, $site['limit_post'] - 1);
		
		$this->load->view('website/part/_head', $data);
		$this->load->view('errors/404_page', $data);
		$this->load->view('website/part/footer', $data);
	}

}

/* End of file Halaman_404.php */
/* Location: ./application/controllers/Halaman_404.php */

 ?>