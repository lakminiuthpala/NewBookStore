<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Book_model extends CI_Model {

	public function __construct() {
		$this->load->database();

        // initialize db tables data
		$this->tables  = $this->config->item('tables', 'books');
	}

    public function add_Book($data)
	{
		$this->db->insert($data);

		$id = $this->db->insert_id();

		
	}

    public function search_book($data){
        $query = $this->db->select("id, book_name, price, description")->join('users', 'users.user_id = books.author_id')
                          ->where('users.user_id' == 'ACTIVE')
                          ->like('book.book_name',$data)
						  ->get("books");

		$user = $query->result();
		return $user;
    }

}