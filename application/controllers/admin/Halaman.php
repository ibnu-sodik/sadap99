<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Halaman extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/Halaman_model', 'halaman_model');
		$this->load->library('upload');
		$this->load->helper('text');
	}
	public function hapus($id_halaman)
	{
		$data 				= $this->halaman_model->get_halaman_by_id($id_halaman)->row();
		$text = $data->nama_halaman.' Berhasil dihapus dari halaman.!';
		$this->halaman_model->hapus_halaman($id_halaman);
		// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
		$this->log_model->save_log($this->session->userdata('id'), 4, 'Menghapus halaman '.$data->nama_halaman);
		$this->session->set_flashdata('pnotify', $text);
		redirect('admin/halaman');
	}
	public function update($id_halaman)
	{
		$this->load->helper(array('form', 'html'));
		$this->form_validation->set_rules('nama_halaman', 'Nama Agenda', 'trim|required|min_length[5]');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() === FALSE) {
			$this->edit($id_halaman);
		} else {
			$id_halaman 			= $this->input->post('id_halaman', TRUE);
			$nama_halaman 		= strip_tags(htmlspecialchars($this->input->post('nama_halaman', true), ENT_QUOTES));
			$konten 	= $this->input->post('konten');
			$preslug 	= strip_tags(htmlspecialchars($this->input->post('slug', true), ENT_QUOTES));
			$string   	= preg_replace('/[^a-zA-Z0-9 \&%|{.}=,?!*()"-_+$@;<>\']/', '', $preslug);
			$trim 		= trim($string);
			$praslug 	= strtolower(str_replace(" ", "-", $trim));
			$query 		= $this->db->query("SELECT * FROM tb_halaman WHERE slug_halaman = '$praslug' AND id_halaman != '$id_halaman' ");
			if ($query->num_rows() > 0) {
				$unique_string = rand();
				$slug = $praslug.'-'.$unique_string;
			}else{
				$slug = $praslug;
			}
			$deskripsi 			= htmlspecialchars($this->input->post('deskripsi', true));
			$this->halaman_model->update_halaman($id_halaman, $nama_halaman, $konten, $slug, $deskripsi);
							// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
			$id_author = $this->session->userdata('id');
			$this->log_model->save_log($id_author, 3, 'Update halaman dengan judul '.$nama_halaman);
			$text = $nama_halaman.' Berhasil Disimpan.!';
			$this->session->set_flashdata('pnotify', $text);
			redirect('admin/halaman');
		}
	}
	public function edit($id_halaman)
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
		$data['bc_menu'] 			= "Halaman";
		$data['bc_aktif'] 			= "Edit Halaman";
		$data['title'] 				= "Edit Halaman";
		$data['form_action'] 		= site_url('admin/halaman/update');
		$data['data']				= $this->halaman_model->get_halaman_by_id($id_halaman);
		$this->template->load('admin/template', 'admin/halaman/edit_v', $data);
	}
	public function simpan()
	{
		$this->load->helper(array('form', 'html'));
		$this->form_validation->set_rules('nama_halaman', 'Judul Halaman', 'trim|required|min_length[5]');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() === FALSE) {
			$this->tambah();
		} else {
			$nama_halaman 	= strip_tags(htmlspecialchars($this->input->post('nama_halaman', true), ENT_QUOTES));
			$konten 		= $this->input->post('konten');
			$preslug 		= strip_tags(htmlspecialchars($this->input->post('slug', true), ENT_QUOTES));
			$string   		= preg_replace('/[^a-zA-Z0-9 \&%|{.}=,?!*()"-_+$@;<>\']/', '', $preslug);
			$trim 			= trim($string);
			$praslug 		= strtolower(str_replace(" ", "-", $trim));
			$query 			= $this->db->get_where('tb_halaman', array('slug_halaman'=>$praslug));
			if ($query->num_rows() > 0) {
				$unique_string = rand();
				$slug = $praslug.'-'.$unique_string;
			}else{
				$slug = $praslug;
			}
			$deskripsi 			= htmlspecialchars($this->input->post('deskripsi', true));
			$this->halaman_model->simpan_halaman($nama_halaman, $konten, $slug, $deskripsi);
						// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
			$id_author = $this->session->userdata('id');
			$this->log_model->save_log($id_author, 2, 'Menambah halaman '.$nama_halaman);
			$text = $nama_halaman.' Berhasil Dipublish.!';
			$this->session->set_flashdata('pnotify', $text);
			redirect('admin/halaman');
		}
	}
	public function tambah()
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
		$data['bc_menu'] 			= "Halaman";
		$data['bc_aktif'] 			= "Tambah Halaman";
		$data['title'] 				= "Tambah Halaman";
		$data['form_action'] 		= site_url('admin/halaman/simpan');
		$this->template->load('admin/template', 'admin/halaman/tambah_v', $data);
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
		$data['bc_aktif'] 			= "Halaman";
		$data['title'] 				= "Halaman";
		$data['data_halaman'] 		= $this->halaman_model->get_all_halaman();
		$this->template->load('admin/template', 'admin/halaman/data_v', $data);
	}
}
/* End of file Halaman.php */

/* Location: ./application/controllers/admin/Halaman.php */
?>