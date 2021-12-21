<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {
	
	public function update_last_login($id_users)

	{

		$tanggal = date('Y-m-d H:i:s');

		$object = array('last_login' => $tanggal);

		$this->db->where('id', $id_users);

		$this->db->update('tb_users', $object);

	}

	public function validasi($username)

	{

		$result = $this->db->query("SELECT * FROM tb_users WHERE (email = '$username' OR username='$username')");

		return $result;

	}

}

/* End of file Login_model.php */

/* Location: ./application/models/admin/Login_model.php */
