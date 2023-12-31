<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class user_model extends CI_Model {

	public function __construct() {
		$this->load->database();
	}

    public function get_all_users($id) {
		$query = $this->db->select("id, username, email, first_name, last_name,  phone, status")
											->get("users");

		$user = $query->row();
		return $user;
	}
	public function get_user_info($id) {
		$query = $this->db->select("id, username, email, first_name, last_name, company, phone")
											->where("id", $id)
											->limit(1)
											->get("users");

		$user = $query->row();
		return $user;
	}

}