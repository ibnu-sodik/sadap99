<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Pesan_model extends CI_Model {
	public function multi_hapus_keluar($id_pesan)
	{
		$this->db->where('id_pesan', $id_pesan);
		$this->db->delete('tb_pesan_keluar');
	}
	public function multi_hapus_masuk($id_pesan)
	{
		$this->db->where('id_pesan', $id_pesan);
		$this->db->delete('tb_pesan');
	}
	public function get_related_pk_by_id($id_pesanMasuk)
	{
		$query = $this->db->query("SELECT * FROM tb_pesan_keluar WHERE id_pesanMasuk = '$id_pesanMasuk' GROUP BY id_pesanMasuk ");
		return $query;
	}
	public function get_pesan_keluar()
	{
		$this->db->select('*');
		$this->db->from('tb_pesan_keluar');
		$this->db->order_by('dikirim_pada', 'desc');
		$result = $this->db->get();
		return $result;
	}
	public function hapus_keluar($id_pesan)
	{
		$this->db->where('id_pesan', $id_pesan);
		$this->db->delete('tb_pesan_keluar');
	}
	public function hapus($id_pesan)
	{
		$this->db->where('id_pesan', $id_pesan);
		$this->db->delete('tb_pesan');
	}
	public function balas($id_pesanMasuk, $nama_penerima, $email_penerima, $subjek_pesan, $isi_pesan, $attachment)
	{
		$object = array(
			'id_pesanMasuk' 	=> $id_pesanMasuk,
			'nama_penerima' 	=> $nama_penerima,
			'email_penerima' 	=> $email_penerima,
			'subjek_pesan' 		=> $subjek_pesan,
			'isi_pesan' 		=> $isi_pesan,
			'attachment' 		=> $attachment,
		);
		$this->db->insert('tb_pesan_keluar', $object);
	}
	public function balas_no_file($id_pesanMasuk, $nama_penerima, $email_penerima, $subjek_pesan, $isi_pesan)
	{
		$object = array(
			'id_pesanMasuk' 	=> $id_pesanMasuk,
			'nama_penerima' 	=> $nama_penerima,
			'email_penerima' 	=> $email_penerima,
			'subjek_pesan' 		=> $subjek_pesan,
			'isi_pesan' 		=> $isi_pesan,
		);
		$this->db->insert('tb_pesan_keluar', $object);
	}
	public function dibaca($id_pesan)
	{
		$object = array('dibaca' => 1 );
		$this->db->where('id_pesan', $id_pesan);
		$this->db->update('tb_pesan', $object);
	}
	public function get_pk_by_id($id_pesanKeluar)
	{
		$this->db->select('*');
		$this->db->from('tb_pesan_keluar');
		$this->db->where('id_pesan', $id_pesanKeluar);
		$result = $this->db->get();
		return $result;
	}
	public function get_pesan_by_id($id_pesan)
	{
		$this->db->select('*');
		$this->db->from('tb_pesan');
		$this->db->where('id_pesan', $id_pesan);
		$result = $this->db->get();
		return $result;
	}
	public function get_unread_pesan()
	{
		$result = $this->db->query("SELECT * FROM tb_pesan WHERE dibaca = 0 ORDER BY id_pesan DESC ");
		return $result;
	}	
	public function get_all_data()
	{
		$result = $this->db->query("SELECT * FROM tb_pesan ORDER BY id_pesan, dikirim_pada DESC ");
		return $result;
	}	

	public function simpan($nama, $email, $subjek, $pesan)
	{
		$object = array(
			'nama_depan' 		=> $nama,
			'alamat_email' 	=> $email,
			'subjek_pesan' 		=> $subjek,
			'isi_pesan' 		=> $pesan,
		);
		$this->db->insert('tb_pesan', $object);
	}	
}
/* End of file Pesan_model.php */

/* Location: ./application/models/admin/Pesan_model.php */
?>