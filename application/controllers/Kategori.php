<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Kategori_model', 'kategori_model');
		$this->load->model('Beranda_model', 'beranda_model');
		$this->visitor_model->hitung_visitor();
	}

	public function index()
	{
		redirect('berita','refresh');
	}

	public function detail($slug)
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
		$data['site_email'] 		= $site['site_email'];
		$data['site_telp'] 			= $site['site_telp'];
		$data['site_nowa'] 			= $site['site_nowa'];
		$data['site_pesanTeks'] 	= $site['site_pesanTeks'];
		$data['tahun_buat'] 		= $site['tahun_buat'];
		$data['limit_post']			= $site['limit_post'];
		$data['bc_title']			= "Kategori";
		$data['bc_link']			= site_url('kategori');
		$data_kategori 				= $this->kategori_model->get_berita_by_kategori($slug);
		if ($data_kategori->num_rows() > 0) {
			$value 						= $data_kategori->row();
			$id_kategori 				= $value->id_kategori;
			$jumlah 					= $data_kategori->num_rows();
			$halaman 					= $this->uri->segment(3);
			if (!$halaman) {
				$mati = 0;
			}else{
				$mati = $halaman;
			}
			$limit 						= $site['limit_post'];
			$offset 					= $mati > 0 ? (($mati - 1) * $limit) : $mati;
			$config['base_url'] 		= base_url().'kategori/'.$slug.'/';		
			$config['total_rows'] 		= $jumlah;
			$config['per_page'] 		= $limit;
			$config['uri_segment'] 		= 3;
			$config['use_page_numbers']	= TRUE;
			$config["full_tag_open"] 	= '<div class="pgntn-page-pagination pgntn-bottom"><div class="pgntn-page-pagination-block">';
			$config["full_tag_close"]	= '</div><div class="clear"></div></div>';

			$config['next_link'] 		= '&gt;';
			$config["prev_link"] 		= '&lt;';
			$config["cur_tag_open"] 	= '<span aria-current="page" class="page-numbers current">';
			$config["cur_tag_close"] 	= '</span>';
			$config['prev_link'] 		= 'Prev';
			$config['next_link'] 		= 'Next';
			$config['last_link'] 		= 'Last';
			$config['first_link'] 		= 'First';
			$config['attributes'] 		= array('class' => 'page-numbers');
			$this->pagination->initialize($config);
			$data['pagination']			= $this->pagination->create_links();
			$data['kategori']			= $this->kategori_model->get_kategori_berita_perpage($offset, $limit, $slug);
			$data['url'] 				= site_url('kategori/'.$slug);
			$data['canonical'] 			= site_url('kategori/'.$slug);
			$data['bc_link']			= site_url('berita');
			$data['bc_aktif']			= $value->nama_kategori;
			$data['title']				= "Kategori";
			$data['bc_title']			= "$value->nama_kategori";
			$data['sm_text'] 			= "$jumlah berita dari kategori";

			$data['berita_terbaru'] 	= $this->beranda_model->get_berita_baru($site['limit_post']);
			$data['berita_random'] 		= $this->beranda_model->get_berita_random(1);
			$data['berita_review'] 		= $this->beranda_model->get_berita_review(1);
			$berita_review 				= $this->beranda_model->get_berita_review(1)->row();
			$id_berita 					= $berita_review->id_berita;
			$data['berita_refiew_follow'] = $this->beranda_model->get_berita_review_not_in($id_berita, $site['limit_post'] - 1);

			$this->template->load('website/template', 'website/berita/kategori_v', $data);
		}else{
			redirect('berita','refresh');
		}
	}

}

/* End of file Kategori.php */
/* Location: ./application/controllers/Kategori.php */

?>