<?php 



defined('BASEPATH') OR exit('No direct script access allowed');



class Homepage extends CI_Controller {



	public function __construct()

	{

		parent::__construct();

		$this->load->model('admin/Homepage_model', 'homepage_model');

		$this->load->helper('text');

		if ($this->session->userdata('access')!=1) {

			$text = 'Terdapat batasan hak akses pada halaman ini.';

			$this->session->set_flashdata('pesan_error', $text);

			redirect('admin', 'refresh');

		}		

	}



	public function ubah_status($id_hp)

	{

		$data 		= $this->homepage_model->get_data_by_id($id_hp);

		$status 	= $this->input->get('status', TRUE);

		$nama 		= $this->input->get('nama', TRUE);



		$this->homepage_model->ubah_status($id_hp, $nama, $status);

		$pilihan = array(

			'hp_fasilitas' 	=> 'Fasilitas',

			'hp_sambutan' 	=> 'Sambutan',

			'hp_fakta' 		=> 'Fakta',
			'hp_cta' 		=> 'Call to Action',

			'hp_testimoni' 	=> 'Testimoni',

			'hp_video' 		=> 'Video',

		);

		foreach ($pilihan as $key => $value) {

			if ($key == $nama) {

				$keterangan = $value;



				if ($status == 1) {

					$text = "Konten $keterangan berhasil ditampilkan.";

					$tipe = "success";

					$notif = "Berhasil..!";

				} else {

					$text = "Konten $keterangan tidak ditampilkan.";

					$tipe = "info";

					$notif = "Perhatian..!";

				}

			}

		}

		$data = array(

			'pesan' => $text, 

			'tipe' 	=> $tipe,

			'notif' => $notif

		);

		echo json_encode($data);

	}



	public function simpan()

	{

		$this->load->helper(array('form', 'html'));



		$this->form_validation->set_rules('hp_sambutan', 'Konten Sambutan', 'trim|required|is_numeric');

		$this->form_validation->set_rules('hp_fakta', 'Konten Fakta', 'trim|required|is_numeric');
		$this->form_validation->set_rules('hp_cta', 'Konten Call to Action', 'trim|required|is_numeric');

		$this->form_validation->set_rules('hp_fasilitas', 'Konten Fasilitas', 'trim|required|is_numeric');

		$this->form_validation->set_rules('hp_testimoni', 'Konten Testimoni', 'trim|required|is_numeric');

		$this->form_validation->set_rules('hp_video', 'Konten Video', 'trim|required|is_numeric');

		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');



		if ($this->form_validation->run() === FALSE) {

			$this->tambah_data();

		} else {

			$hp_sambutan 	= $this->input->post('hp_sambutan', TRUE);

			$hp_fasilitas 	= $this->input->post('hp_fasilitas', TRUE);

			$hp_fakta 		= $this->input->post('hp_fakta', TRUE);
			$hp_cta 		= $this->input->post('hp_cta', TRUE);

			$hp_testimoni 	= $this->input->post('hp_testimoni', TRUE);

			$hp_video 		= $this->input->post('hp_video', TRUE);



			// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply

			$this->log_model->save_log($this->session->userdata('id'), 2, 'Menambah Data Baru Pengaturan Tampilan Konten');

			$this->homepage_model->simpan($hp_sambutan, $hp_fasilitas, $hp_testimoni, $hp_fakta, $hp_cta, $hp_video);



			$text = "Data baru konten tampilan berhasil disimpan.";

			$this->session->set_flashdata('pnotify', $text);

			redirect('admin/homepage');

		}

	}



	public function tambah_data()

	{	

		$data_homepage 				= $this->homepage_model->get_data();

		if ($data_homepage->num_rows() > 0) {

			$text = "Dilarang mengakses halaman ini.";

			$this->session->set_flashdata('pesan_error', $text);

			redirect('admin/homepage');

		}	

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

		$data['bc_menu'] 			= "Homepege";

		$data['bc_aktif'] 			= "Pengaturan Homepege";

		$data['title'] 				= "Pengaturan Homepege";



		$data['form_action'] 		= site_url('admin/homepage/simpan');



		$this->template->load('admin/template', 'admin/website/tambah_hp_v', $data);

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

		$data['bc_menu'] 			= "Homepege";

		$data['bc_aktif'] 			= "Pengaturan Homepage";

		$data['title'] 				= "Pengaturan Homepege";





		$data_homepage 		= $this->homepage_model->get_data();

		if ($data_homepage->num_rows() == 0) {

			$this->tambah_data();

		}else{

			$data['form_action'] 		= site_url('admin/homepage/update');

			$data['data_homepage'] 		= $this->homepage_model->get_data();



			$this->template->load('admin/template', 'admin/website/set_homepage_v', $data);

		}



	}



}



/* End of file Homepage.php */

/* Location: ./application/controllers/admin/Homepage.php */



?>