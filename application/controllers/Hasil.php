<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Hasil extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Hasil_model', 'hasil_model');
		$this->load->model('Beranda_model', 'beranda_model');
		$this->visitor_model->hitung_visitor();
	}

	public function index()
	{
		redirect('berita','refresh');
	}

	public function pencarian()
	{
		$q_cari 		= $this->input->get('kata', TRUE);	

		$build_query 	= http_build_query($_GET, '', "&");
		$hasil_cari 	=  $this->hasil_model->hitung_jumlah_cari($q_cari);
		$jumlah 		= $hasil_cari->num_rows();
		if ($q_cari) $config['suffix'] = '?' . $build_query;
		$page = $this->uri->segment(2);
		if (!$page) {
			$mati = 0;
		}else{
			$mati = $page;
		}
		$site 					= $this->site_model->get_site_data()->row_array();
		$limit 					= $site['limit_post'];
		$offset 				= $mati > 0 ? (($mati - 1) * $limit) : $mati;
		$config['base_url'] 	= site_url('pencarian/');
		$config['first_url'] 	= $config['base_url'].'?'.$build_query;
		$config['total_rows'] 	= $jumlah;
		$config['per_page'] 	= $limit;
		$config['uri_segment'] 	= 2;
		$config['use_page_numbers'] = TRUE;
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

		$data['pencarian'] = $this->hasil_model->get_pencarian_perpage($limit, $offset, $q_cari);
		$data['pagination'] = $this->pagination->create_links();
		if (empty($this->uri->segment(2))) {
			$next_page = 2;
			$data['canonical'] = site_url('pencarian');
			$data['url_prev'] = "";
		}elseif ($this->uri->segment(2)=='1') {
			$next_page = 2;
			$data['canonical'] = site_url('pencarian/page/'.$this->uri->segment(3));
			$data['url_prev'] = site_url('pencarian');
		}elseif ($this->uri->segment(2)=='2') {
			$next_page = $this->uri->segment(2)+1;
			$data['canonical'] = site_url('pencarian/page/'.$this->uri->segment(2));
			$data['url_prev'] = site_url('pencarian/page/ikilho');
		}else{
			$next_page = $this->uri->segment(2)+1;
			$prev_page = $this->uri->segment(2)-1;
			$data['canonical'] = site_url('pencarian/page/'.$this->uri->segment(2));
			$data['url_prev'] = site_url('pencarian/page/'.$prev_page);
		}
		$data['url_next'] = site_url('pencarian/page/'.$next_page);


		if ($hasil_cari->num_rows() > 0) {
			$data['cari'] 		= $hasil_cari;
			$data['bc_title'] 	= "Pencarian : ".$hasil_cari->num_rows().' berita dari kata <i>'.$q_cari.'</i>';
			$data['isi'] 		= $q_cari;
		}else{
			$data['cari'] 		= $hasil_cari;
			$data['bc_title'] 	= "Pencarian : tidak ada berita dari kata <i>$q_cari</i>";
			$data['isi'] 		= $q_cari;
		}
		$data['timestamp'] 			= strtotime(date('Y-m-d H:i:s'));
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
		$data['url'] 				= $config['base_url'].'?'.$build_query;

		$data['berita_terbaru'] 	= $this->beranda_model->get_berita_baru($site['limit_post']);
		$data['berita_random'] 		= $this->beranda_model->get_berita_random(1);
		$data['berita_review'] 		= $this->beranda_model->get_berita_review(1);
		$berita_review 				= $this->beranda_model->get_berita_review(1)->row();
		$id_berita 					= $berita_review->id_berita;
		$data['berita_refiew_follow'] = $this->beranda_model->get_berita_review_not_in($id_berita, $site['limit_post'] - 1);

		$this->template->load('website/template', 'website/search_blog_v', $data);
	}

}

/* End of file Hasil.php */
/* Location: ./application/controllers/Hasil.php */

?>