<?php 



defined('BASEPATH') OR exit('No direct script access allowed');



class Background extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/Background_model', 'background_model');
		$this->load->library('upload');
		$this->load->helper('text');
		if ($this->session->userdata('access')!=1) {
			$text = 'Terdapat batasan hak akses pada halaman ini.';
			$this->session->set_flashdata('pesan_error', $text);
			redirect('admin', 'refresh');
		}
	}


	public function update()
	{
error_reporting(0);
$config['upload_path'] = './uploads/images/';
$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
$config['encrypt_name'] = TRUE;
$this->upload->initialize($config);
$bg_arr = array(
	'bg_umum' 		=> 'bg_umum',
	'bg_berita' 	=> 'bg_berita',
	'bg_agenda' 	=> 'bg_agenda',
	'bg_berita' 	=> 'bg_berita',
	'bg_halaman' 	=> 'bg_halaman',
	'bg_testimoni' 	=> 'bg_testimoni',
	'bg_personil' 	=> 'bg_personil',
	'bg_tentang' 	=> 'bg_tentang',
	'bg_galeri' 	=> 'bg_galeri',
);
foreach ($bg_arr as $key => $value) {
	if (!empty($_FILES[$key]['name'])) {
		$maxId = $this->db->query("SELECT MAX(id_background) AS 'maxId' FROM tb_background ")->row()->maxId;
		$data = $this->background_model->get_data_by_id($maxId)->row();
		$keys = './uploads/background/'.$data->$key;
		unlink($keys);
		if ($this->upload->do_upload($value)) {
			$img[$key] 	= $this->upload->data();
			$key 		= $img[$value]['file_name'];
			$this->compress_tinify($key);
			$this->db->query("UPDATE tb_background SET $value = '$key' WHERE id_background = '$maxId'");
							// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
			$this->log_model->save_log($this->session->userdata('id'), 3, "Merubah data background.");
			$value = './uploads/images/'.$key;
			unlink($value);
		}
	}
}
$text = "Data background berhasil diubah.";
$this->session->set_flashdata('pnotify', $text);
redirect('admin/background');
}


public function simpan()
{
	$config['upload_path'] = './uploads/images/';
	$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
	$config['encrypt_name'] = TRUE;
	$this->upload->initialize($config);
	if ($this->upload->do_upload('bg_umum')) {
		$img 			= $this->upload->data();
		$bg_umum 		= $img['file_name'];
		$this->compress_tinify($bg_umum);
		$this->background_model->simpan($bg_umum);
			// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
		$this->log_model->save_log($this->session->userdata('id'), 2, 'Menambah Background Utama');
		$bg_umum_lama = './uploads/images/'.$bg_umum;
		unlink($bg_umum_lama);
		$text = "Background utama berhasil disimpan.";
		$this->session->set_flashdata('pnotify', $text);
		redirect('admin/background');
	}else{
		$text = "Gagal menyimpan data.";
		$this->session->set_flashdata('pesan_error', $text);
		redirect('admin/background');
	}
}


public function tambah_data_bg()
{
	$data_bg 				= $this->background_model->get_data();
	if ($data_bg->num_rows() > 0) {
		$text = "Dilarang mengakses halaman ini.";
		$this->session->set_flashdata('pesan_error', $text);
		redirect('admin/background');
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
	$data['bc_menu'] 			= "Background";
	$data['bc_aktif'] 			= "Tambah Background";
	$data['sm_text'] 			= "Gambar ini akan digunakan sebagai latar belakang pada setiap halaman website.";
	$data['title'] 				= "Background";
	$data['form_action'] 		= site_url('admin/background/simpan');
	$this->template->load('admin/template', 'admin/background/tambah_v', $data);
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
	$data['bc_aktif'] 			= "Background";
	$data['title'] 				= "Background";
	$data['sm_text'] 			= "Gambar ini akan digunakan sebagai latar belakang pada setiap halaman website.";
	$data_bg 				= $this->background_model->get_data();
	if ($data_bg->num_rows() == 0) {
		$this->tambah_data_bg();
	} else {
		$data['form_action'] 		= site_url('admin/background/update');
		$data['data_bg'] 			= $this->background_model->get_data();
		$this->template->load('admin/template', 'admin/background/data_v', $data);			
	}
}


public function compress_tinify($gambar_asli)
{
	$site = $this->site_model->get_site_data()->row_array();
	$this->load->library('tiny_png', array('api_key' => $site['api_tinify']));
	$sumber = './uploads/images/'.$gambar_asli;
	$menuju = './uploads/background/'.$gambar_asli;
	$this->tiny_png->fileCompress($sumber, $menuju);
}



}



/* End of file Background.php */

/* Location: ./application/controllers/admin/Background.php */



?>