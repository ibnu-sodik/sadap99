<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
class Berita_model extends CI_Model {
	public function get_data_by_author($id_author)
	{
		$query = $this->db->get_where('tb_berita', array('id_author' => $id_author));
		return $query;
	}
	function hapus_berita($id_berita)
	{
		$this->db->where('id_berita', $id_berita);
		$this->db->delete('tb_berita');
	}
	function get_berita_by_id($id_berita)
	{
		$result = $this->db->query("SELECT * FROM tb_berita WHERE id_berita = '$id_berita'");
		return $result;
	}
	public function update_berita($id_berita, $judul, $konten, $kategori, $slug, $image, $labels, $deskripsi)
	{
		$tgl_update = date('Y-m-d H:i:s');
		$object = array(
			'judul_berita' 			=> $judul,
			'konten_berita' 			=> $konten,
			'deskripsi_berita' 		=> $deskripsi,
			'gambar_berita' 			=> $image,
			'label_berita' 			=> $labels,
			'slug_berita' 				=> $slug,
			'publish_berita' 			=> 1,
			'id_kategori_berita' 		=> $kategori,
			'terakhir_update_berita' 	=> $tgl_update,
			'id_author' 				=> $this->session->userdata('id')
		);
		$this->db->where('id_berita', $id_berita);
		$this->db->update('tb_berita', $object);
	}
	public function update_berita2($id_berita, $judul, $konten, $kategori, $slug, $labels, $deskripsi)
	{
		$tgl_update = date('Y-m-d H:i:s');
		$object = array(
			'judul_berita' 			=> $judul,
			'konten_berita' 			=> $konten,
			'deskripsi_berita' 		=> $deskripsi,
			'label_berita' 			=> $labels,
			'slug_berita' 				=> $slug,
			'publish_berita' 			=> 1,
			'id_kategori_berita' 		=> $kategori,
			'terakhir_update_berita' 	=> $tgl_update,
			'id_author' 				=> $this->session->userdata('id')
		);
		$this->db->where('id_berita', $id_berita);
		$this->db->update('tb_berita', $object);
	}
	public function simpan_berita($judul, $konten, $kategori, $slug, $image, $labels, $deskripsi)
	{
		$object = array(
			'judul_berita' 		=> $judul,
			'konten_berita' 		=> $konten,
			'deskripsi_berita' 	=> $deskripsi,
			'gambar_berita' 		=> $image,
			'label_berita' 		=> $labels,
			'slug_berita' 			=> $slug,
			'publish_berita' 		=> 1,
			'id_kategori_berita' 	=> $kategori,
			'id_author' 			=> $this->session->userdata('id')
		);
		$this->db->insert('tb_berita', $object);
	}
	public function hapus_label($id_label)
	{
		$this->db->where('id_label', $id_label);
		$this->db->delete('tb_label_berita');
	}
	public function _update_label($id, $label, $slug)
	{
		$object = array(
			'nama_label' => $label,
			'slug_label' => $slug
		);
		$this->db->where('id_label', $id);
		$this->db->update('tb_label_berita', $object);
	}
	public function _simpan_label($label, $slug, $user_id)
	{
		$object = array(
			'nama_label' => $label,
			'slug_label' => $slug,
			'user_id_label' => $user_id
		);
		$this->db->insert('tb_label_berita', $object);
	}
	public function get_label_berita_by_user_id($user_id)
	{
		$this->db->select('*');
		$this->db->from('tb_label_berita');
		$this->db->where('user_id_label', $user_id);
		$query = $this->db->get();
		return $query;
	}
	public function get_label_berita_by_id($id_label)
	{
		$this->db->select('*');
		$this->db->from('tb_label_berita');
		$this->db->where('id_label', $id_label);
		$query = $this->db->get();
		return $query;
	}
	function hapus_kategori($id_kategori)
	{
		$this->db->where('id_kategori', $id_kategori);
		$this->db->delete('tb_kategori_berita');
	}
	public function _update_kategori($id, $kategori, $slug)
	{
		$object = array(
			'nama_kategori' => $kategori,
			'slug_kategori' => $slug
		);
		$this->db->where('id_kategori', $id);
		$this->db->update('tb_kategori_berita', $object);
	}
	public function _simpan_kategori($kategori, $slug, $user_id)
	{
		$object = array(
			'nama_kategori' => $kategori,
			'slug_kategori' => $slug,
			'user_id_kategori' => $user_id
		);
		$this->db->insert('tb_kategori_berita', $object);
	}
	public function get_kategori_berita_by_user_id($user_id)
	{
		$this->db->select('*');
		$this->db->from('tb_kategori_berita');
		$this->db->where('user_id_kategori', $user_id);
		$query = $this->db->get();
		return $query;
	}
	public function get_kategori_berita_by_id($id_kategori)
	{
		$this->db->select('*');
		$this->db->from('tb_kategori_berita');
		$this->db->where('id_kategori', $id_kategori);
		$query = $this->db->get();
		return $query;
	}
	public function get_all_berita()
	{
		$this->db->select('*');
		$this->db->from('tb_berita');
		$this->db->order_by('id_berita', 'desc');
		$query = $this->db->get();
		return $query;
	}
	public function buat_query($id_author, $kategori)
	{
		$query = "SELECT tb_berita.*, tb_kategori_berita.* FROM tb_berita LEFT JOIN tb_kategori_berita ON tb_berita.id_kategori_berita = tb_kategori_berita.id_kategori WHERE id_author = '$id_author' AND publish_berita = '1' ";
		if (isset($kategori) && !empty($kategori)) {
			$kategori_filter = implode("','", $kategori);
			$query .= " AND id_kategori_berita IN('".$kategori_filter."') ";
		}
		return $query;
	}
	public function gabungkan_data($id_author, $offset, $limit, $kategori)
	{
		$query = $this->buat_query($id_author, $kategori);
		$query .= ' LIMIT '.$offset.', ' .$limit;
		$data = $this->db->query($query);
		$hasil = '';
		if ($data->num_rows() > 0) {
			foreach ($data->result() as $row) {
				$hasil .= '
				<div class="col-xs-12 col-sm-4 widget-container-col" id="widget-container-col-4">
				<div class="widget-box" id="widget-box-4">
				<div class="widget-header widget-header-large">
				<h5 class="widget-title">'.batasi_kata($row->judul_berita, 7).'...</h5>
				<div class="widget-toolbar">
				<a href="'.site_url('admin/berita/edit/'.$row->id_berita).'" title="Edit">
				<i class="ace-icon fa fa-pencil"></i>
				</a>
				<a href="#" data-action="collapse">
				<i class="ace-icon fa fa-chevron-up"></i>
				</a>
				<a href="'.site_url('admin/berita/hapus/'.$row->id_berita).'" id="tombolHapus" title="Hapus" onclick="conf_hapus()">
				<i class="ace-icon fa fa-times"></i>
				</a>
				</div>
				</div>
				<div class="widget-body">
				<div class="widget-main">
				<div class="col">
				<div class="card">
				';
				$file = file_exists(base_url('uploads/berita/'.$row->gambar_berita));
				if (!$file && !empty($row->gambar_berita)){
					$hasil .= '<img src="'. base_url('uploads/berita/'.$row->gambar_berita) .'" class="card-img-top img-thumbnail img-responsive" alt="'. $row->judul_berita .'">';
				} else {
					$hasil .= '<img src="'. base_url('dists/images/no-img.png') .'" class="card-img-top img-thumbnail img-responsive" alt="'. $row->judul_berita .'">';
				}
				$hasil .= '
				<div class="card-body">
				<p class="card-text">'. strip_tags(word_limiter($row->konten_berita, 15)) .'...</p>
				</div>
				<div class="card-footer">
				<label class="label label-info arrowed-right label-pink">'.$row->nama_kategori.'</label>
				';
				if ($row->terakhir_update_berita != NULL){
					$hasil .= '
					<small class="text-muted pull-right">Terakhir Update '. waktu_berlalu($row->terakhir_update_berita).'</small>
					';
				}
				$hasil .= '
				</div>
				</div>
				</div>
				</div>
				</div>
				</div>
				</div>
				';
			}
		}else{
			$hasil = '
			<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert">
			<i class="ace-icon fa fa-times"></i>
			</button>
			<strong>
			<i class="ace-icon fa fa-times"></i>
			Oops...!
			</strong>
			Data tidak ditemukan.
			<br />
			</div>
			';
		}
		return $hasil;
	}
	public function get_berita_per_page($id_author, $offset, $limit, $kategori)
	{
		$this->db->select('tb_berita.*, tb_kategori_berita.*');
		$this->db->from('tb_berita');
		$this->db->join('tb_kategori_berita', 'id_kategori_berita = id_kategori', 'left');
		$kon_arr = array('publish_berita' => 1, 'id_author' => $id_author);
		$this->db->where($kon_arr);
		$this->db->order_by('id_berita', 'desc');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query;
	}
	public function hitung_data($id_author, $kategori)
	{
		$query = $this->buat_query($id_author, $kategori);
		$data = $this->db->query($query);
		return $data->num_rows();
	}
}
/* End of file Berita_model.php */

/* Location: ./application/models/admin/Berita_model.php */

?>