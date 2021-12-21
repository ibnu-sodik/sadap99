<?php 	

defined('BASEPATH') OR exit('No direct script access allowed');

class Sitemap extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Beranda_model', 'beranda_model');
		$this->load->model('Sitemap_model', 'sitemap_model');
		$this->load->model('Berita_model', 'berita_model');
		$this->load->model('Halaman_model', 'halaman_model');
		$this->load->model('Author_model', 'author_model');
		$this->load->model('Label_model', 'label_model');
		$this->load->model('kategori_model', 'kategori_model');
		$this->load->helper('xml');
		$this->visitor_model->hitung_visitor();
	}

	public function index()
	{
		$this->sitemap_model->add(base_url(), NULL, 'monthly', 1);
		$this->sitemap_model->add(base_url('beranda'), NULL, 'monthly', 1);
		$this->sitemap_model->add(base_url('sitemap'), NULL, 'monthly', 1);
		$this->sitemap_model->add(base_url('kontak'), NULL, 'monthly', 0.9);
		$this->berita();
		$this->halaman();
		$this->author();
		$this->label();
		$this->kategori();
		$this->sitemap_model->output('sitemapindex');
	}
	public function label()
	{
		$data_label = $this->label_model->get_label();
		foreach ($data_label->result_array() as $row) {
			$this->sitemap_model->add(site_url('label/'.$row['slug_label']), NULL, 'weekly', 1);
		}
		$this->sitemap_model->output();
	}
	public function kategori()
	{
		$data_kategori = $this->kategori_model->get_kategori();
		foreach ($data_kategori->result_array() as $row) {
			$this->sitemap_model->add(site_url('kategori/'.$row['slug_kategori']), NULL, 'weekly', 1);
		}
		$this->sitemap_model->output();
	}
	public function berita() {
		$this->sitemap_model->add(base_url('berita'), NULL, 'monthly', 1);
		$data_berita = $this->berita_model->get_berita();
		foreach ($data_berita->result_array() as $row) {
			$this->sitemap_model->add(site_url('berita/'.$row['slug_berita']), date('c', strtotime($row['tanggal_up_berita'])), 'weekly', 1);
		}
		$this->sitemap_model->output();
	}
	public function halaman() {	
		$data_halaman = $this->halaman_model->get_all_halaman();
		foreach ($data_halaman->result_array() as $row) {
			$this->sitemap_model->add(site_url('halaman/'.$row['slug_halaman']), date('c', strtotime($row['halaman_date'])), 'weekly', 1);
		}
		$this->sitemap_model->output();
	}
	public function author() {	
		$this->sitemap_model->add(base_url('author'), NULL, 'monthly', 1);
		$data_author = $this->author_model->get_users();
		foreach ($data_author->result_array() as $row) {
			$this->sitemap_model->add(site_url('author/'.$row['username']), date('c', strtotime($row['last_login'])), 'daily', 0.5);
		}
		$this->sitemap_model->output();
	}

}

/* End of file Sitemap.php */
/* Location: ./application/controllers/Sitemap.php */

?>