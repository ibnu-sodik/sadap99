<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Berita_model extends CI_Model {

	public function get_berita_rekomendasi($id_kategori, $id_berita)
	{
		$query = $this->db->query("SELECT * FROM tb_berita WHERE id_kategori_berita = $id_kategori AND id_berita NOT IN($id_berita) AND publish_berita = 1 ORDER BY rand() LIMIT 3");
		return $query;
	}

	public function get_komentar_berita($id_berita)
	{
		$query = $this->db->query("SELECT * FROM tb_komentar WHERE id_komentar_berita = '$id_berita' AND status_komentar = '1' AND parent_komentar = '0' ORDER BY id_komentar DESC");
		return $query;
	}
	public function get_data_selanjutnya($id_berita)
	{
		$query = $this->db->query("SELECT * FROM tb_berita WHERE id_berita = (select min(id_berita) FROM tb_berita WHERE id_berita > '$id_berita')");
		return $query;
	}
	public function get_data_sebelumnya($id_berita)
	{
		$query = $this->db->query("SELECT * FROM tb_berita WHERE id_berita = (select max(id_berita) FROM tb_berita WHERE id_berita < '$id_berita')");
		return $query;
	}

	public function get_berita()
	{
		$query = $this->db->get_where('tb_berita', array('publish_berita' => '1'));
		return $query;
	}

	public function hitung_views($id_berita)
	{
		$visitor_ip = $_SERVER['REMOTE_ADDR'];
		$cek_ip 	= $this->db->query("SELECT * FROM tb_berita_views WHERE view_ip = '$visitor_ip' AND view_berita_id = '$id_berita' AND DATE(view_date) = CURDATE() ");
		if ($cek_ip->num_rows() <= 0) {
			$this->db->trans_start();
			$this->db->query("INSERT INTO tb_berita_views SET view_ip = '$visitor_ip', view_berita_id = '$id_berita'");
			$this->db->query("UPDATE tb_berita SET views_berita = views_berita+1, terakhir_dilihat = NOW() WHERE id_berita = '$id_berita'");
			$this->db->trans_complete();
			if ($this->db->trans_status() == TRUE) {
				return TRUE;
			}else{
				return FALSE;
			}
		}
	}

	public function get_data_by_slug($slug)
	{
		$query = $this->db->query("SELECT tb_berita.*, tb_users.*, count(id_komentar) AS jumlah_komentar, tb_kategori_berita.* FROM tb_berita 
			LEFT JOIN tb_users ON id_author = id 
			LEFT JOIN tb_komentar ON id_berita = id_komentar_berita 
			LEFT JOIN tb_kategori_berita ON id_kategori_berita = id_kategori 
			where slug_berita = '$slug' AND publish_berita = '1' GROUP BY id_berita LIMIT 1");
		return $query;
	}

	public function get_data_perpage($offset, $limit)
	{		
		$this->db->select('tb_berita.*, full_name, username, foto, tb_kategori_berita.*, count(id_komentar) AS jumlah_komentar');
		$this->db->from('tb_berita');
		$this->db->join('tb_users', 'id_author = id', 'left');
		$this->db->join('tb_kategori_berita', 'id_kategori_berita = id_kategori', 'left');
		$this->db->join('tb_komentar', 'id_berita = id_komentar_berita', 'left');
		$this->db->where('publish_berita', 1);
		$this->db->group_by('id_berita');
		$this->db->order_by('id_berita', 'desc');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query;
	}

	public function simpan_komentar($id_komentar_berita, $id_author_berita, $nama_komentar, $email_komentar, $website, $konten_komentar, $id_komentar = '')
	{
		$object = array(
			'id_komentar_berita' 	=> $id_komentar_berita,
			'id_author_berita' 		=> $id_author_berita,
			'nama_komentar'			=> $nama_komentar,
			'email_komentar'		=> $email_komentar,
			'website_komentar'		=> $website,
			'konten_komentar'		=> $konten_komentar,
			'parent_komentar'		=> $id_komentar
		);
		$this->db->insert('tb_komentar', $object);
	}

}

/* End of file Berita_model.php */
/* Location: ./application/models/Berita_model.php */

?>