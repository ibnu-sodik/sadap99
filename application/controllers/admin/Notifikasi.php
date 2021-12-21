<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Notifikasi extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/Pesan_model', 'pesan_model');
		$this->load->model('admin/Testimoni_model', 'testimoni_model');
		$this->load->model('admin/Komentar_model', 'komentar_model');
		$this->load->model('admin/Berita_model', 'berita_model');
	}
	public function komentar()
	{
		$limit = 3;
		$id_author = $this->session->userdata('id');
		$data = $this->komentar_model->get_unview_komentar_by_id_author($id_author);
		$hasil = '';
		if ($data->num_rows() > 0) {
			foreach ($data->result() as $row) {
				$datar = $this->berita_model->get_berita_by_id($row->id_komentar_berita)->row();
				$q_author = $this->db->get_where('tb_users', array('email' => $row->email_komentar));
				$data_users = $q_author->row();
				if ($q_author->num_rows() > 0 && !empty($data_users->foto) && file_exists('uploads/users/'.$data_users->foto)) {
					$link_foto = base_url('uploads/users/'.$data_users->foto);
				}else{
					$link_foto = get_gravatar($row->email_komentar);
				}
				$hasil .= '
				<li>
				<a class="clearfix">
				<img src="'.$link_foto.'" class="msg-photo" alt="'.$row->nama_komentar.'" />
				<span class="msg-body">
				<span class="msg-title">
				<span class="blue">'.$row->nama_komentar.'</span><br>
				<span class="green">
				'.$datar->judul_berita.'
				</span>
				</span>
				<span></span>
				<span class="msg-time">
				<i class="ace-icon fa fa-clock"></i>
				<span> '.waktu_berlalu($row->tanggal_komentar).'</span>
				</span>
				</span>
				</a>
				</li>
				';
			}
		}else{
			$hasil .= '<li>Belum ada komentar masuk</li>';
		}
		if ($data->num_rows() > 0) {
			$jmlKom = $data->num_rows();
		}else{
			$jmlKom = '';
		}
		$lihatKomentar = '';
		if ($jmlKom > $limit) {
			$lihatKomentar .= '
			<a href="'.site_url('admin/komentar').'">
			Lihat semua komentar
			<i class="ace-icon fa fa-arrow-right"></i>
			</a>';
		}
		if($jmlKom == 0){
			$jumlah = "Tidak ada komentar.";
		}else{
			$jumlah = '<i class="ace-icon fa fa-comment-o"></i> '.$jmlKom.' Komentar baru';
		}
		$data = array(
			'komentar' => $hasil,
			'lihatSemuaKomentar' => $lihatKomentar,
			'jumlah' => $jumlah,
			'jmlKom' => $jmlKom
		);
		echo json_encode($data);
	}
	public function testimoni()
	{
		$limit = 3;
		$data = $this->testimoni_model->get_data_unview();
		$hasil = '';
		if ($data->num_rows() > 0 ) {
			foreach ($data->result() as $row) {
				$thumbs = base_url('uploads/testimoni/thumbs/'.$row->foto_testimoni);
				$hasil .= '
				<li>
				<a class="clearfix">
				<img src="'.$thumbs.'" class="msg-photo" alt="'.$row->nama_testimoni.'" />
				<span class="msg-body">
				<span class="msg-title">
				<span class="blue">'.$row->nama_testimoni.':</span>
				'.$row->profesi_testimoni.'
				</span>
							<span class="msg-time">
							<i class="ace-icon fa fa-clock"></i>
							<span> '.waktu_berlalu($row->tgl_kirim).'</span>
							</span>
							</span>
							</a>
							</li>';
						}
					} else {
						$hasil .= '<li>Belum ada testimoni masuk</li>';
					}
		if ($data->num_rows() > 0) {
			$jmlTestiUnview = $data->num_rows();
		}else{
			$jmlTestiUnview = '';
		}
		$lihatAllTesti = '';
		if ($jmlTestiUnview > $limit) {
			$lihatAllTesti .= '
			<a href="'.site_url('admin/testimoni').'">
			Lihat semua testimoni
			<i class="ace-icon fa fa-arrow-right"></i>
			</a>
			';
		}
		if ($jmlTestiUnview == 0) {
			$jumlah = " Tidak ada testimoni";
		}else{
			$jumlah = '<i class="ace-icon fa fa-rss"></i> '.$jmlTestiUnview.' Testimoni belum dilihat.';
		}
		$data = array(
			'testimoni'			=> $hasil,
			'jumlah'			=> $jumlah,
			'lihatSemuaTesti' 	=> $lihatAllTesti,
			'jmlTestiUnview'	=> $jmlTestiUnview,
		);
		echo json_encode($data);
	}
	public function pesan_web()
	{
		$limit = 3;
		$data = $this->pesan_model->get_unread_pesan();
		$pesan = '';
		if ($data->num_rows() > 0) {
			foreach ($data->result() as $row) {
				$pesan .= '
				<li>
				<a href="'.site_url('admin/pesan/detail/').$row->id_pesan.'" class="clearfix">
				<img src="'.get_gravatar($row->alamat_email).'" class="msg-photo" alt="'.$row->nama_depan.'" />
				<span class="msg-body">
				<span class="msg-title">
				<span class="blue">'.$row->nama_depan.':</span>
				'.batasi_kata($row->subjek_pesan, 15).'
				</span>
							<span class="msg-time">
							<i class="ace-icon fa fa-clock"></i>
							<span> '.waktu_berlalu($row->dikirim_pada).'</span>
							</span>
							</span>
							</a>
							</li>
							';
						}
					}else{
						$pesan .= '<li>Belum ada pesan masuk</li>';
					}
		if ($data->num_rows() > 0) {
			$jmlPesanBlmDibaca = $data->num_rows();
		}else{
			$jmlPesanBlmDibaca = '';
		}
		$lihatPesan = '';
		if ($jmlPesanBlmDibaca > $limit) {
			$lihatPesan .= '
			<a href="'.site_url('admin/pesan').'">
			Lihat semua pesan
			<i class="ace-icon fa fa-arrow-right"></i>
			</a>
			';
		}
		if ($jmlPesanBlmDibaca == 0) {
			$jumlah = " Tidak ada pesan";
		}else{
			$jumlah = '<i class="ace-icon fa fa-envelope-o"></i> '.$jmlPesanBlmDibaca.' Pesan baru';
		}
		$data = array(
			'pesanMasuk'		=> $pesan,
			'lihatSemuaPesan'	=> $lihatPesan,
			'jmlAngka'			=> $jmlPesanBlmDibaca,
			'jmlPesanBlmDibaca' => $jumlah
		);
		echo json_encode($data);
	}
}
/* End of file Notifikasi.php */

/* Location: ./application/controllers/admin/Notifikasi.php */
?>