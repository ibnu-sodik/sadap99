<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Site_model', 'site_model');
    	if ($this->site_model->get_site_data()->num_rows() > 0) {
        	if ($this->session->userdata('access')!=1) {
        	$text = 'Terdapat batasan hak akses pada halaman ini.';
        	$this->session->set_flashdata('pesan_error', $text);
        	redirect('admin', 'refresh');
    		}
		}
	}

	public function add_website()
	{
		$data['form_action'] = site_url('admin/settings/save_first');

		$this->load->view('admin/add_website_v', $data);
	}

	public function save_first()
	{
		$this->load->helper(array('form', 'html'));

		if ($this->site_model->get_site_data()->num_rows() > 0) {
			$url = site_url('admin');
			$text = "Anda tidak berhak berada dihalaman ini.";
			$this->session->set_flashdata('pesan', $text);
			redirect($url, 'refresh');
		}else{
			$this->form_validation->set_rules('site_name', 'Nama Website', 'trim|required|min_length[3]|max_length[20]');
			$this->form_validation->set_rules('site_title', 'Judul Website', 'trim|required|min_length[3]|max_length[20]');

			$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
			$this->form_validation->set_message('required', 'Masukkan %s');

			if ($this->form_validation->run() === FALSE) {
				$this->add_website();
			} else {			
				$site_name 			= $this->input->post('site_name', TRUE);
				$site_title 		= $this->input->post('site_title', TRUE);
				$site_keywords 		= $this->input->post('site_keywords', TRUE);
				$site_description 	= $this->input->post('site_description', TRUE);

				$this->site_model->save_first($site_name, $site_title, $site_keywords, $site_description);

				$url 	= site_url('admin');
				$text 	= "Website baru berhasil disimpan";
				$this->session->set_flashdata('pnotify_error', $text);
				redirect($url, 'refresh');

			}

		}
	}

}

/* End of file Settings.php */
/* Location: ./application/controllers/admin/Settings.php */

?>