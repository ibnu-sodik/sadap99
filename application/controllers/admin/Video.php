<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Video extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/Video_model', 'video_model');
		$this->load->helper('text');
		if ($this->session->userdata('access')!=1) {
			$text = 'Terdapat batasan hak akses pada halaman ini.';
			$this->session->set_flashdata('pesan_error', $text);
			redirect('admin');
		}
	}

	public function update()
	{				
		$this->load->helper(array('form', 'html'));

		$this->form_validation->set_rules('link_video2', 'Link Video', 'trim|required');
		$this->form_validation->set_rules('nama_video2', 'Judul Video', 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

		if ($this->form_validation->run() === FALSE) {
			$text = "Terjadi kesalahan, silahkan coba lagi.";
			$this->session->set_flashdata('pesan_error', $text);
			$this->index();
		}else{
			$id_video 	= $this->input->post('id_video', TRUE);
			$link_video = $this->input->post('link_video2', TRUE);
			$nama_video = $this->input->post('nama_video2', TRUE);
			$deskripsi_video = $this->input->post('deskripsi_video2', TRUE);

			$preslug 	= strip_tags(htmlspecialchars($this->input->post('slug2', true), ENT_QUOTES));
			$string   	= preg_replace('/[^a-zA-Z0-9 \&%|{.}=,?!*()"-_+$@;<>\']/', '', $preslug);
			$trim 		= trim($string);
			$praslug 	= strtolower(str_replace(" ", "-", $trim));
			$query 		= $this->db->get_where('tb_video', array('slug_video' => $praslug, 'id_video' => "!=$id_video"));

			if ($query->num_rows() > 0) {
				$unique_string = rand();
				$slug = $praslug.'-'.$unique_string;
			}else{
				$slug = $praslug;
			}

			$this->video_model->update($id_video, $link_video, $nama_video, $deskripsi_video, $slug);
			// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
			$this->log_model->save_log($this->session->userdata('id'), 3, "Mengubah video dengan judul $nama_video");

			$text = "Berhasil mengubah video dengan judul $nama_video";
			$this->session->set_flashdata('pnotify', $text);
			redirect('admin/video','refresh');
		}
	}

	public function simpan()
	{		
		$this->load->helper(array('form', 'html'));

		$this->form_validation->set_rules('link_video', 'Link Video', 'trim|required');
		$this->form_validation->set_rules('nama_video', 'Judul Video', 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

		if ($this->form_validation->run() === FALSE) {
			$this->index();
		}else{
			$link_video = $this->input->post('link_video', TRUE);
			$nama_video = $this->input->post('nama_video', TRUE);
			$deskripsi_video = $this->input->post('deskripsi_video', TRUE);

			$preslug 	= strip_tags(htmlspecialchars($this->input->post('slug', true), ENT_QUOTES));
			$string   	= preg_replace('/[^a-zA-Z0-9 \&%|{.}=,?!*()"-_+$@;<>\']/', '', $preslug);
			$trim 		= trim($string);
			$praslug 	= strtolower(str_replace(" ", "-", $trim));
			$query 		= $this->db->get_where('tb_video', array('slug_video'=>$praslug));

			if ($query->num_rows() > 0) {
				$unique_string = rand();
				$slug = $praslug.'-'.$unique_string;
			}else{
				$slug = $praslug;
			}

			$this->video_model->simpan($link_video, $nama_video, $deskripsi_video, $slug);
			// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
			$this->log_model->save_log($this->session->userdata('id'), 2, "Menambah video dengan judul $nama_video");

			$text = "Berhasil menambah video dengan judul $nama_video";
			$this->session->set_flashdata('pnotify', $text);
			redirect('admin/video','refresh');
		}
	}

	public function hapus($id_video)
	{
		$data = $this->video_model->get_data_by_id($id_video)->row();
		$query = $this->video_model->get_data_view($id_video);
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$id_video_view = $row->view_video_id;
				$this->video_model->hapus_views($id_video_view);
			}
			$this->video_model->hapus($id_video);
		}else{
			$this->video_model->hapus($id_video);
		}
		// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
		$this->log_model->save_log($this->session->userdata('id'), 4, 'Hapus video '.$data->nama_video);

		$text = $data->nama_video." berhasil dihapus.";
		$this->session->set_flashdata('pnotify', $text);
		redirect('admin/video','refresh');
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
		$data['bc_aktif'] 			= "Video";
		$data['title'] 				= "Video";
		
		$data['form_action']		= site_url('admin/video/simpan');

		$query = $this->video_model->get_data_video();
		$page = $this->uri->segment(4);
		if (!$page) {
			$mati = 0;
		}else{
			$mati = $page;
		}
		$limit 					= 4;
		// $limit 					= $site['limit_post'];
		$offset 				= $mati > 0 ? (($mati - 1) * $limit) : $mati;
		$config['base_url'] 	= base_url('admin/video/index/');
		$config['total_rows'] 	= $query->num_rows();
		$config['per_page'] 	= $limit;
		$config['uri_segment'] 	= 4;
		$config['use_page_numbers'] = TRUE;

		$config["full_tag_open"] 	= '<ul class="pagination">';
		$config["full_tag_close"]	= '</ul>';
		$config["first_tag_open"] 	= '<li>';
		$config["first_tag_close"] 	= '</li>';
		$config["last_tag_open"] 	= '<li>';
		$config["last_tag_close"] 	= '</li>';
		$config['next_link'] 		= '&gt;';
		$config["next_tag_open"] 	= '<li>';
		$config["next_tag_close"] 	= '</li>';
		$config["prev_link"] 		= "&lt;";
		$config["prev_tag_open"] 	= "<li>";
		$config["prev_tag_close"] 	= "</li>";
		$config["cur_tag_open"] 	= "<li class='active'><a href='#'>";
		$config["cur_tag_close"] 	= "</a></li>";
		$config["num_tag_open"] 	= "<li>";
		$config["num_tag_close"] 	= "</li>";

		$config['prev_link'] 		= 'Sebelumnya';
		$config['next_link'] 		= 'Selanjutnya';
		$config['last_link'] 		= 'Terakhir';
		$config['first_link'] 		= 'Pertama';

		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['data_video'] = $this->video_model->get_data_video_perpage($offset, $limit);

		$this->template->load('admin/template', 'admin/video/data_v', $data);
	}

}

/* End of file Video.php */
/* Location: ./application/controllers/admin/Video.php */

?>