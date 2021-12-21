<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Berita extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Berita_model', 'berita_model');
		$this->load->model('Kategori_model', 'kategori_model');
		$this->load->model('Beranda_model', 'beranda_model');
		$this->visitor_model->hitung_visitor();
	}

	public function kirim_komentar()
	{
		$this->load->helper(array('form', 'html'));
		$this->form_validation->set_rules('nama_komentar', 'Nama', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('email_komentar', 'Alamat Email', 'trim|required');
		$this->form_validation->set_rules('konten_komentar', 'Isi Komentar', 'trim|required');
		$this->form_validation->set_error_delimiters('<span class="required">', '</span>');
		$slug = $this->input->post('slug', TRUE);
		if ($this->form_validation->run() === FALSE) {
			$this->detail($slug);
		}else{
			$id_komentar_berita 	= $this->input->post('id_komentar_berita', TRUE);
			$id_komentar 			= $this->input->post('id_komentar', TRUE);
			$id_author_berita 		= $this->input->post('id_author_berita', TRUE);
			$nama_komentar 			= $this->input->post('nama_komentar', TRUE);
			$email_komentar 		= $this->input->post('email_komentar', TRUE);
			$website 				= $this->input->post('website', TRUE);
			$konten_komentar 		= $this->input->post('konten_komentar', TRUE);
			$this->berita_model->simpan_komentar($id_komentar_berita, $id_author_berita, $nama_komentar, $email_komentar, $website, $konten_komentar, $id_komentar);
			$text = "Komentar terkirim.";
			$this->session->set_flashdata('swalSukses', $text);
			redirect(site_url('berita/'.$slug), 'refresh');
		}
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
		$data['bc_title']			= "Berita";
		$data['_title']				= "Berita";
		$data['bc_link']			= site_url('berita');
		$data['url'] 				= site_url('berita/detail/'.$slug);
		$data['canonical'] 			= site_url('berita/detail/'.$slug);
		$query = $this->berita_model->get_data_by_slug($slug);
		if ($query->num_rows() > 0) {
			$value = $query->row();

			$id_berita 		= $value->id_berita;
			$this->berita_model->hitung_views($id_berita);
			$data['id_berita'] = $value->id_berita;
			$data['url'] 		= site_url('berita/'.$value->slug_berita);
			$data['canonical'] 	= site_url('berita/'.$value->slug_berita);
			$data['title'] 		= $value->judul_berita;
			$data['konten']		= $value->konten_berita;
			$data['slug']		= $value->slug_berita;
			$data['bc_aktif']	= $value->judul_berita;
			if (!empty($value->deskripsi_berita)) {
				$data['description'] = strip_tags(word_limiter($value->deskripsi_berita), 15);
			}else{
				$data['description'] 	= strip_tags(word_limiter($value->konten_berita), 15);
			}
			$data['gambar'] 			= base_url('uploads/berita/'.$value->gambar_berita);
			$data['post_date'] 			= $value->tanggal_up_berita;
			$data['post_update'] 		= $value->terakhir_update_berita;
			$data['jumlah_komentar'] 	= $value->jumlah_komentar;
			$data['views_berita'] 		= $value->views_berita;
			$data['id_author']			= $value->id_author;

			$data['author']				= $value->full_name;
			$data['username']			= $value->username;
			$data['foto']				= $value->foto;
			$data['nama_kategori']		= $value->nama_kategori;
			$data['slug_kategori']		= $value->slug_kategori;
			$data['labels']				= $value->label_berita;
			$data['komentar']			= $value->jumlah_komentar;
			$data['data_komentar']		= $this->berita_model->get_komentar_berita($id_berita);
			$data['berita_sebelumnya'] 	= $this->berita_model->get_data_sebelumnya($id_berita);
			$data['berita_selanjutnya'] = $this->berita_model->get_data_selanjutnya($id_berita);
			$data['berita_rekomendasi']	= $this->berita_model->get_berita_rekomendasi($value->id_kategori_berita, $id_berita);

			$data['berita_terbaru'] 	= $this->beranda_model->get_berita_baru($site['limit_post']);
			$data['berita_random'] 		= $this->beranda_model->get_berita_random(1);
			$data['berita_review'] 		= $this->beranda_model->get_berita_review(1);
			$berita_review 				= $this->beranda_model->get_berita_review(1)->row();
			$id_berita 					= $berita_review->id_berita;
			$data['berita_refiew_follow'] = $this->beranda_model->get_berita_review_not_in($id_berita, $site['limit_post'] - 1);

			$this->template->load('website/template', 'website/berita/detail_v', $data);
		}else{
			redirect('berita','refresh');
		}
	}

	public function index()
	{
		$link 						= $this->uri->segment(1);
		$data['timestamp'] 			= strtotime(date('Y-m-d H:i:s'));
		$site 						= $this->site_model->get_site_data()->row_array();

		$jumlah 					= $this->berita_model->get_berita();
		$halaman 					= $this->uri->segment(3);
		if (!$halaman) {
			$mati = 0;
		}else{
			$mati = $halaman;
		}
		$limit 						= $site['limit_post'];
		$offset						= $mati > 0 ? (($mati - 1) * $limit) : $mati;
		$config['base_url'] 		= base_url().'berita/halaman/';		
		$config['total_rows'] 		= $jumlah->num_rows();
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
		$data['berita']				= $this->berita_model->get_data_perpage($offset, $limit);
		if (empty($this->uri->segment(3))) {
			$next_page = 2;
			$data['canonical'] 	= site_url('berita');
			$data['url'] 		= site_url('berita');
			$data['url_prev'] 	= "";
		}elseif ($this->uri->segment(3)=='1') {
			$next_page = 2;
			$data['canonical'] 	= site_url('berita');
			$data['url'] 		= site_url('berita');
			$data['url_prev'] 	= site_url('berita');
		}elseif ($this->uri->segment(3)=='2') {
			$next_page 			= $this->uri->segment(3)+1;
			$data['canonical'] 	= site_url('berita/halaman/'.$this->uri->segment(3));
			$data['url'] 		= site_url('berita/halaman/'.$this->uri->segment(3));
			$data['url_prev'] 	= site_url('berita');
		}else{
			$next_page 			= $this->uri->segment(3)+1;
			$prev_page 			= $this->uri->segment(3)-1;
			$data['canonical'] 	= site_url('berita/halaman/'.$this->uri->segment(3));
			$data['url'] 		= site_url('berita/halaman/'.$this->uri->segment(3));
			$data['url_prev'] 	= site_url('berita/halaman/'.$prev_page);
		}
		$data['url_next'] 		= site_url('berita/halaman/'.$next_page);

		$data['url'] 				= site_url($link);
		$data['canonical'] 			= site_url($link);
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
		$data['bc_title']			= "Berita";
		$data['bc_link']			= site_url('berita');
		$data['title']				= "Berita";

		$data['berita_terbaru'] 	= $this->beranda_model->get_berita_baru($site['limit_post']);
		$data['berita_random'] 		= $this->beranda_model->get_berita_random(1);
		$data['berita_review'] 		= $this->beranda_model->get_berita_review(1);
		$berita_review 				= $this->beranda_model->get_berita_review(1)->row();
		$id_berita 					= $berita_review->id_berita;
		$data['berita_refiew_follow'] = $this->beranda_model->get_berita_review_not_in($id_berita, $site['limit_post'] - 1);

		$this->template->load('website/template', 'website/berita/data_v', $data);
	}

}

/* End of file Berita.php */
/* Location: ./application/controllers/Berita.php */

?>