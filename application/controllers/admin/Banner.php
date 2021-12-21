<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Banner extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/Banner_model', 'banner_model');
		$this->load->library('upload');
		$this->load->helper('text');
		if ($this->session->userdata('access')!=1) {
			$text = 'Terdapat batasan hak akses pada halaman ini.';
			$this->session->set_flashdata('pesan_error', $text);
			redirect('admin', 'refresh');
		}
	}

	public function hapus($id_banner)
	{
		$data_banner = $this->banner_model->get_banner_by_id($id_banner)->row_array();

		if ($data_banner['status_aktif'] == 1) {
			$text = "Banner yang tampil awal tidak bisa dihapus.";
			$this->session->set_flashdata('pesan_error', $text);
			redirect('admin/banner');
		}else{
			$data 				= $this->banner_model->get_banner_by_id($id_banner)->row();		
			$images 			= "./uploads/images/".$data->gambar_banner;
			$img_agenda 		= "./uploads/banner/".$data->gambar_banner;
			unlink($images);
			unlink($img_agenda);

			// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
			$id_author = $this->session->userdata('id');
			$judul_banner = $data_banner['judul_banner'];
			$this->log_model->save_log($id_author, 4, 'Menghapus Banner dengan judul '.$judul_banner);
			$this->banner_model->hapus($id_banner);

			$text = "Banner berhasil dihapus.";
			$this->session->set_flashdata('pnotify', $text);
			redirect('admin/banner');
		}
	}

	public function active($id_banner)
	{
		$this->banner_model->inactive_all_banner();
		$this->banner_model->active_banner($id_banner);
		$text = 'Banner Berhasil Diaktifkan.!';
		$this->session->set_flashdata('pnotify', $text);
		redirect('admin/banner');
	}

	public function update()
	{
		error_reporting(0);
		$id_banner = $this->input->post('id_banner', TRUE);

		$config['upload_path'] = './uploads/images/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
		$config['encrypt_name'] = TRUE;

		$this->upload->initialize($config);

		if (!empty($_FILES['filefoto']['name'])) {
			$data 		= $this->banner_model->get_banner_by_id($id_banner)->row();
			$images 	= "./uploads/images/".$data->gambar_banner;
			$img_banner = "./uploads/banner/".$data->gambar_banner;
			unlink($images);
			unlink($img_banner);

			if ($this->upload->do_upload('filefoto')) {
				$img = $this->upload->data();
				$config['image_library'] = 'gd2';
				$config['source_image'] = './uploads/images/'.$img['file_name'];
				$config['create_thumb'] = false;
				$config['maintain_ratio'] = false;
				$config['quality'] = '100%';
				$config['width'] = 1500;
				$config['height'] = 844;
				$config['new_image'] = './uploads/images/'.$img['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();

				$image 				= $img['file_name'];
				$judul_banner 		= strip_tags(htmlspecialchars($this->input->post('judul_banner2', true), ENT_QUOTES));
				$konten_banner 		= $this->input->post('konten_banner2');

				$this->banner_model->update_banner_image($id_banner, $image, $judul_banner, $konten_banner);
				$this->compress_tinify($image);
				$foto_lama = "./uploads/images/".$image;
				unlink($foto_lama);
				// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
				$id_author = $this->session->userdata('id');
				$this->log_model->save_log($id_author, 3, 'Update Banner dengan judul '.$judul_banner);

				$text = $judul_banner.' Berhasil Diupdate.!';
				$this->session->set_flashdata('pnotify', $text);
				redirect('admin/banner');

			} else {
				redirect('admin/banner','refresh');
			}

		} else {
			$id_banner 			= $this->input->post('id_banner', TRUE);
			$judul_banner 		= strip_tags(htmlspecialchars($this->input->post('judul_banner2', true), ENT_QUOTES));
			$konten_banner 		= $this->input->post('konten_banner2');

			$this->banner_model->update_banner($id_banner, $judul_banner, $konten_banner);
				// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
			$id_author = $this->session->userdata('id');
			$this->log_model->save_log($id_author, 3, 'Update Banner dengan judul '.$judul_banner);

			$text = $judul_banner.' Berhasil Diupdate.!';
			$this->session->set_flashdata('pnotify', $text);
			redirect('admin/banner');
		}
	}

	public function simpan()
	{
		$config['upload_path'] = './uploads/images/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
		$config['encrypt_name'] = TRUE;

		$this->upload->initialize($config);

		if (!empty($_FILES['filefoto']['name'])) {
			if ($this->upload->do_upload('filefoto')) {
				$img = $this->upload->data();
				$config['image_library'] = 'gd2';
				$config['source_image'] = './uploads/images/'.$img['file_name'];
				$config['create_thumb'] = false;
				$config['maintain_ratio'] = false;
				$config['quality'] = '100%';
				$config['width'] = 1500;
				$config['height'] = 844;
				$config['new_image'] = './uploads/images/'.$img['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();

				$this->compress_tinify($img['file_name']);

				$image 				= $img['file_name'];
				$judul_banner 		= strip_tags(htmlspecialchars($this->input->post('judul_banner', true), ENT_QUOTES));
				$konten_banner 		= $this->input->post('konten_banner');

				$this->banner_model->simpan($image, $judul_banner, $konten_banner);

				$foto_lama = "./uploads/images/".$image;
				unlink($foto_lama);
				
				// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
				$id_author = $this->session->userdata('id');
				$this->log_model->save_log($id_author, 2, 'Menambah Banner dengan judul '.$judul_banner);

				$text = $judul_banner.' Berhasil Dipublish.!';
				$this->session->set_flashdata('pnotify', $text);
				redirect('admin/banner');

			} else {
				redirect('admin/banner','refresh');
			}

		} else {
			redirect('admin/banner','refresh');
		}
	}

	public function compress_tinify($gambar_asli)
	{
		$site = $this->site_model->get_site_data()->row_array();
		$this->load->library('tiny_png', array('api_key' => $site['api_tinify']));

		$sumber = './uploads/images/'.$gambar_asli;
		$menuju = './uploads/banner/'.$gambar_asli;

		$this->tiny_png->fileCompress($sumber, $menuju);
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
		$data['bc_menu'] 			= "Pengaturan";
		$data['bc_aktif'] 			= "Banner";
		$data['title'] 				= "Banner";

		$data['data_banner']		= $this->banner_model->get_all_data();

		$this->template->load('admin/template', 'admin/banner/data_v', $data);
	}

}

/* End of file Banner.php */
/* Location: ./application/controllers/admin/Banner.php */
?>