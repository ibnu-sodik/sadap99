<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Partner extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/Partner_model', 'partner_model');
		$this->load->library('upload');
		$this->load->helper('text');
		$this->load->helper('form');
	}

	public function hapus($id_partner)
	{
		$data 				= $this->partner_model->get_partner_by_id($id_partner)->row();		
		$images 			= "./uploads/images/".$data->logo_partner;
		$img_partner 		= "./uploads/partner/".$data->logo_partner;
		unlink($images);
		unlink($img_partner);
		$text = $data->nama_partner.' Berhasil dihapus dari partner.!';
		$this->partner_model->hapus_partner($id_partner);
			// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
		$this->log_model->save_log($this->session->userdata('id'), 4, 'Menghapus partner '.$data->nama_partner);
		$this->session->set_flashdata('pnotify', $text);
		redirect('admin/partner');
	}
	public function save()
	{
		$config['upload_path'] = './uploads/images/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['encrypt_name'] = TRUE;
		$this->upload->initialize($config);
		if (!empty($_FILES['filefoto']['name'])) {
			if ($this->upload->do_upload('filefoto')) {
				$img = $this->upload->data();
				$config['image_library'] 	= 'gd2';
				$config['source_image'] 	= './uploads/images/'.$img['file_name'];
				$config['create_thumb'] 	= false;
				$config['maintain_ratio'] 	= false;
				$config['quality'] 			= '100%';
				// $config['width'] 			= 900;
				// $config['height'] 			= 900;
				$config['new_image'] = './uploads/images/'.$img['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				$this->compress_tinify($img['file_name']);
				$image 				= $img['file_name'];
				$nama_partner 		= strip_tags(htmlspecialchars($this->input->post('nama_partner', true), ENT_QUOTES));
				$link_partner 		= $this->input->post('link_partner');
				$kategori_partner 		= $this->input->post('kategori_partner');
				$this->partner_model->simpan($image, $nama_partner, $link_partner, $kategori_partner);
				$foto_lama = "./uploads/images/".$image;
				unlink($foto_lama);
				// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
				$id_author = $this->session->userdata('id');
				$this->log_model->save_log($id_author, 2, 'Menambah Data Partner - '.$nama_partner);
				$text = $nama_partner.' Berhasil Dipublish.!';
				$this->session->set_flashdata('pnotify', $text);
				redirect('admin/partner');
			} else {
				redirect('admin/partner','refresh');
			}
		} else {
			redirect('admin/partner','refresh');
		}
	}
	public function index()
	{
		$data['timestamp'] 			= strtotime(date('Y-m-d H:i:s'));
		$site = $this->site_model->get_site_data()->row_array();
		$data['site_title'] 		= $site['site_title'];
		$data['site_name'] 			= $site['site_name'];
		$data['site_keywords'] 		= $site['site_keywords'];
		$data['site_author'] 		= $site['site_author'];
		$data['site_logo'] 			= $site['site_logo'];
		$data['site_description'] 	= $site['site_description'];
		$data['site_favicon'] 		= $site['site_favicon'];
		$data['tahun_buat'] 		= $site['tahun_buat'];
		$data['bc_aktif'] 			= "Partner";
		$data['title'] 				= "Partner";
		$data['data_partner']		= $this->partner_model->get_all_data();
		$this->template->load('admin/template', 'admin/partner/data_v', $data);		
	}
	public function compress_tinify($gambar_asli)
	{
		$site = $this->site_model->get_site_data()->row_array();
		$this->load->library('tiny_png', array('api_key' => $site['api_tinify']));
		$sumber = './uploads/images/'.$gambar_asli;
		$menuju = './uploads/partner/'.$gambar_asli;
		$this->tiny_png->fileCompress($sumber, $menuju);
	}

}

/* End of file Partner.php */
/* Location: .//C/laragon/www/stt-pomosda/goblog-prosite/controllers/admin/Partner.php */

?>