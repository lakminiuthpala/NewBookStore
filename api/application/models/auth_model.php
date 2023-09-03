<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Auth_model extends CI_Model {

	public function __construct() {
		$this->load->database();
	}

	public function get_user_info($id) {
		$query = $this->db->select("id, username, email, first_name, last_name, phone")
											->where("id", $id)
											->limit(1)
											->get("users");

		$user = $query->row();
		return $user;
	}

	public function get_all_user_info(){
		$query = $this->db->select("id, username, email, first_name, last_name, phone")
											->get("users");

		$user = $query->row();
		return $user;
	}

}