<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Galeri_model extends CI_Model {

	public function hapus($id_galeri)
	{
		$this->db->where('id_galeri', $id_galeri);
		$this->db->delete('tb_galeri');
	}

	public function update_no_img($id_galeri, $id_album, $nama_galeri)
	{
		$object = array(
			'id_album_galeri' 	=> $id_album,
			'nama_galeri' 		=> $nama_galeri
		);
		$this->db->where('id_galeri', $id_galeri);
		$this->db->update('tb_galeri', $object);
	}

	public function update($id_galeri, $id_album, $nama_galeri, $image)
	{
		$object = array(
			'id_album_galeri' 	=> $id_album,
			'nama_galeri' 		=> $nama_galeri,
			'foto_galeri' 		=> $image
		);
		$this->db->where('id_galeri', $id_galeri);
		$this->db->update('tb_galeri', $object);
	}

	public function simpan($id_album, $nama_galeri, $image)
	{
		$object = array(
			'id_album_galeri' 	=> $id_album,
			'nama_galeri' 		=> $nama_galeri,
			'foto_galeri' 		=> $image
		);
		$this->db->insert('tb_galeri', $object);
	}

	public function buat_query($album)
	{
		$query = "SELECT tb_album.*, tb_galeri.* FROM tb_galeri LEFT JOIN tb_album ON tb_galeri.id_album_galeri = tb_album.id_album ";

		if (isset($album) && !empty($album)) {
			$album_filter = implode("','", $album);
			$query .= " WHERE id_album_galeri IN('".$album_filter."') ";
		}

		return $query;
	}

	public function hitung_data($album)
	{
		$query 	= $this->buat_query($album);
		$data 	= $this->db->query($query);
		return $data->num_rows();
	}

	public function gabungkan_data($offset, $limit, $album)
	{
		$query = $this->buat_query($album);
		$query .= ' LIMIT '.$offset.', ' .$limit;
		$data = $this->db->query($query);

		$hasil = '';
		if ($data->num_rows() > 0) {
		foreach ($data->result() as $row) {
				$file = file_exists('uploads/galeri/'.$row->slug_album.'/'.$row->foto_galeri);
				if ($file && !empty($row->foto_galeri)) {
					$src = base_url('uploads/galeri/'.$row->slug_album.'/'.$row->foto_galeri);
				}else{
					$src = base_url('dists/images/no-img.png');
				}
				$hasil .= '
					<li>
						<a id="show_foto" data-toggle="modal" data-target="#img" href="javascript:void(0)" data-id="'.$row->id_galeri.'" data-album="'.$row->nama_album.'" data-nama="'.$row->nama_galeri.'" data-foto="'.$row->foto_galeri.'" title="'.$row->nama_galeri.'">
							<img width="150" height="150" alt="'.$row->nama_galeri.'" src="'.$src.'" />
							<div class="tags">';
								if (isset($row->nama_galeri)) {								
									$hasil .= '
									<span class="label-holder">
										<span class="label label-warning arrowed-in">'.$row->nama_galeri.'</span>
									</span>';
								}
								$hasil .='
								<span class="label-holder">
									<span class="label label-info arrowed">'.$row->nama_album.'</span>
								</span>';
								$hasil .= '
							</div>
						</a>';

						$hasil .= '<div class="tools tools-top">

							<a href="'.site_url('admin/galeri/edit/'.$row->id_galeri).'" title="Edit">
								<i class="ace-icon fa fa-pencil"></i>
							</a>

							<a id="tombolHapus" href="'.site_url('admin/galeri/hapus/'.$row->id_galeri).'" onclick="conf_hapus()">
								<i class="ace-icon fa fa-times red"></i>
							</a>

						</div>
					</li>
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

	public function hapus_album($id_album)
	{
		$this->db->where('id_album', $id_album);
		$this->db->delete('tb_album');
	}

	public function get_galeri_by_id($id_galeri)
	{
		$this->db->select('*');
		$this->db->from('tb_galeri');
		$this->db->where('id_galeri', $id_galeri);
		$query = $this->db->get();
		return $query;
	}

	public function get_galeri_by_album($id_album)
	{
		$this->db->select('*');
		$this->db->from('tb_galeri');
		$this->db->where('id_album_galeri', $id_album);
		$query = $this->db->get();
		return $query;
	}

	public function get_album_by_id($id_album)
	{
		$this->db->select('*');
		$this->db->from('tb_album');
		$this->db->where('id_album', $id_album);
		$query = $this->db->get();
		return $query;
	}

	public function _update_album($id_album, $album, $slug)
	{
		$object = array(
			'nama_album' => $album,
			'slug_album' => $slug
		);
		$this->db->where('id_album', $id_album);
		$this->db->update('tb_album', $object);
	}

	public function _simpan_album($album, $slug)
	{
		$object = array(
			'nama_album' => $album,
			'slug_album' => $slug
		);
		$this->db->insert('tb_album', $object);
	}

	public function get_album()
	{
		$this->db->select('*');
		$this->db->from('tb_album');
		$this->db->order_by('id_album', 'desc');
		$query = $this->db->get();
		return $query;
	}

}

/* End of file Galeri_model.php */
/* Location: ./application/models/admin/Galeri_model.php */

?>