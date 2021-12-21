<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Video_model extends CI_Model {

	public function update($id_video, $link_video, $nama_video, $deskripsi_video, $slug)
	{
		$object = array(
			'nama_video' => $nama_video,
			'link_video' => $link_video,
			'deskripsi_video' => $deskripsi_video,
			'slug_video' => $slug,
		);
		$this->db->where('id_video', $id_video);
		$this->db->update('tb_video', $object);
	}

	public function simpan($link_video, $nama_video, $deskripsi_video, $slug)
	{
		$object = array(
			'nama_video' 		=> $nama_video,
			'link_video' 		=> $link_video,
			'deskripsi_video' 	=> $deskripsi_video,
			'slug_video' 		=> $slug,
		);
		$this->db->insert('tb_video', $object);
	}

	public function hapus($id_video)
	{
		$this->db->where('id_video', $id_video);
		$this->db->delete('tb_video');
	}

	public function hapus_views($id_video_view)
	{
		$this->db->where('view_video_id', $id_video_view);
		$this->db->delete('tb_video_views');
	}

	public function get_data_by_id($id_video)
	{
		$query = $this->db->query("SELECT * FROM tb_video WHERE id_video = '$id_video'");
		return $query;
	}

	public function get_data_view($id_video)
	{
		$this->db->select('*');
		$this->db->from('tb_video_views');
		$this->db->where('view_video_id', $id_video);
		$query = $this->db->get();
		return $query;
	}

	public function get_data_video_perpage($offset, $limit)
	{
		$this->db->select('*');
		$this->db->from('tb_video');
		$this->db->order_by('id_video', 'desc');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query;
	}	

	public function get_data_video()
	{
		$this->db->select('*');
		$this->db->from('tb_video');
		$this->db->order_by('id_video', 'desc');
		$query = $this->db->get();
		return $query;
	}	

}

/* End of file Video_model.php */
/* Location: ./application/models/admin/Video_model.php */

?>