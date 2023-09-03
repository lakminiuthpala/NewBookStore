<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library(array('ion_auth'));
		$this->load->model('auth_model');
		$this->load->model('book_model');
	}

	public function login() {
		if ($this->ion_auth->login($this->input->post('username'), $this->input->post('password'), $this->input->post('remember'))) {
			$user_id = $this->ion_auth->user()->row()->user_id;
			$user = $this->auth_model->get_user_info($user_id);
			$user->group = $this->ion_auth->get_users_groups($user_id)->row()->name;

			$this->output->set_content_type('application/json')->set_output(json_encode(array('message' => $this->ion_auth->messages(), 'code' => 'success', 'data' => $user)));
		}
		else {
			$this->output->set_content_type('application/json')->set_output(json_encode(array('message' => $this->ion_auth->errors(), 'code' => 'error')));
		}
	}

	public function register() {
		$user_info = array(
			"first_name" => $this->input->post('first_name') ? $this->input->post('first_name') : "",
			"last_name" => $this->input->post('last_name') ? $this->input->post('last_name') : "",
			"phone" => $this->input->post('phone') ? $this->input->post('phone') : ""
		);

		$user_group = array($this->input->post('user_type'));

		$result = $this->ion_auth->register($this->input->post('username'), $this->input->post('password'), $this->input->post('email'), $user_info, $user_group);

		if ($result != false) {
			$this->output->set_content_type('application/json')->set_output(json_encode(array('message' => $this->ion_auth->messages(), 'code' => 'success')));
		} else {
			$this->output->set_content_type('application/json')->set_output(json_encode(array('message' => $this->ion_auth->errors(), 'code' => 'error')));
		}
	}

	public function update() {
		$user_info = array(
			"first_name" => $this->input->post('first_name') ? $this->input->post('first_name') : "",
			"last_name" => $this->input->post('last_name') ? $this->input->post('last_name') : "",
			"phone" => $this->input->post('phone') ? $this->input->post('phone') : ""
		);

		$result = $this->ion_auth->update($this->input->post('id'), $user_info);

		if ($result) {
			$this->output->set_content_type('application/json')->set_output(json_encode(array('message' => $this->ion_auth->messages(), 'code' => 'success')));
		} else {
			$this->output->set_content_type('application/json')->set_output(json_encode(array('message' => $this->ion_auth->errors(), 'code' => 'error')));
		}
	}

	public function info() {
		$user_id = $this->input->post('id');
		$user = $this->auth_model->get_user_info($user_id);
		$user->group = $this->ion_auth->get_users_groups($user_id)->row()->name;
		$this->output->set_content_type('application/json')->set_output(json_encode(array('code' => 'success', 'data' => $user)));
	}

	public function userInfo(){
		$user = $this->auth_model->get_all_user_info();
		$this->output->set_content_type('application/json')->set_output(json_encode(array('code' => 'success', 'data' => $user)));

	}

	public function addBook() { 
		$book_info = array(
			"book_name" => $this->input->post('book_name') ? $this->input->post('book_name') : "",
			"description" => $this->input->post('description') ? $this->input->post('description') : "",
			'user_id' => $this->session->userdata['user_id']
		);

		//$user_group = array($this->input->post('user_type'));

		$result = $this->book_model->add_Book($book_info);

		if ($result != false) {
			$this->output->set_content_type('application/json')->set_output(json_encode(array('message' => $this->ion_auth->messages(), 'code' => 'success')));
		} else {
			$this->output->set_content_type('application/json')->set_output(json_encode(array('message' => $this->ion_auth->errors(), 'code' => 'error')));
		}
	}

	public function book_name(){
		$book_info = array(
			"book_name" => $this->input->post('book_name') ? $this->input->post('book_name') : "",
		);

		$result = $this->book_model->search_book($book_info);

		if ($result != false) {
			$this->output->set_content_type('application/json')->set_output(json_encode(array('message' => $this->ion_auth->messages(), 'code' => 'success')));
		} else {
			$this->output->set_content_type('application/json')->set_output(json_encode(array('message' => $this->ion_auth->errors(), 'code' => 'error')));
		}
	}
}
