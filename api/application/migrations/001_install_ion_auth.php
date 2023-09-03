<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Install_ion_auth extends CI_Migration {

	public function up()
	{
		// Drop table 'groups' if it exists
		$this->dbforge->drop_table('groups', TRUE);

		// Table structure for table 'groups'
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => '8',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => '20',
			),
			'description' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('groups');

		// Dumping data for table 'groups'
		$data = array(
			array(
				'id' => '1',
				'name' => 'admin',
				'description' => 'Administrator'
			),
			array(
				'id' => '2',
				'name' => 'members',
				'description' => 'General User'
			)
		);
		$this->db->insert_batch('groups', $data);


		// Drop table 'users' if it exists
		$this->dbforge->drop_table('users', TRUE);

		// Table structure for table 'users'
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => '8',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'ip_address' => array(
				'type' => 'VARCHAR',
				'constraint' => '16'
			),
			'username' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
			),
			'password' => array(
				'type' => 'VARCHAR',
				'constraint' => '80',
			),
			'email' => array(
				'type' => 'VARCHAR',
				'constraint' => '100'
			),
			'activation_code' => array(
				'type' => 'VARCHAR',
				'constraint' => '40',
				'null' => TRUE
			),
			'forgotten_password_code' => array(
				'type' => 'VARCHAR',
				'constraint' => '40',
				'null' => TRUE
			),
			'forgotten_password_time' => array(
				'type' => 'INT',
				'constraint' => '11',
				'unsigned' => TRUE,
				'null' => TRUE
			),
			'remember_code' => array(
				'type' => 'VARCHAR',
				'constraint' => '40',
				'null' => TRUE
			),
			'created_on' => array(
				'type' => 'INT',
				'constraint' => '11',
				'unsigned' => TRUE,
			),
			'last_login' => array(
				'type' => 'INT',
				'constraint' => '11',
				'unsigned' => TRUE,
				'null' => TRUE
			),
			'status' => array(
				'type' => 'ENUM("ACTIVE","INACTIVE")',
				'unsigned' => TRUE,
				'null' => FALSE,
				'default' => "ACTIVE"
			),
			'first_name' => array(
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE
			),
			'last_name' => array(
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE
			),
			
			'phone' => array(
				'type' => 'VARCHAR',
				'constraint' => '20',
				'null' => TRUE
			),
			'salt' => array(
				'type' => 'VARCHAR',
				'constraint' => '40',
				'null' => TRUE
			),

		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('users');

		// Dumping data for table 'users'
		$data = array(
			'id' => '1',
			'ip_address' => '127.0.0.1',
			'username' => 'administrator',
			'password' => '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36',
			'email' => 'admin@admin.com',
			'activation_code' => '',
			'forgotten_password_code' => NULL,
			'created_on' => '1268889823',
			'last_login' => '1268889823',
			'status' => 'ACTIVE',
			'first_name' => 'Admin',
			'last_name' => 'istrator',
			'phone' => '0',
		);
		$this->db->insert('users', $data);


		// Drop table 'users_groups' if it exists
		$this->dbforge->drop_table('users_groups', TRUE);

		// Table structure for table 'users_groups'
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => '8',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'user_id' => array(
				'type' => 'INT',
				'constraint' => '8',
				'unsigned' => TRUE
			),
			'group_id' => array(
				'type' => 'INT',
				'constraint' => '8',
				'unsigned' => TRUE
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('users_groups');

		// Dumping data for table 'users_groups'
		$data = array(
			array(
				'id' => '1',
				'user_id' => '1',
				'group_id' => '1',
			),
			array(
				'id' => '2',
				'user_id' => '1',
				'group_id' => '2',
			)
		);
		$this->db->insert_batch('users_groups', $data);

		// Drop table 'books' if it exists
		$this->dbforge->drop_table('books', TRUE);



		// Table structure for table 'books'
		$this->dbforge->add_field(array(
			'book_id' => array(
				'type' => 'INT',
				'constraint' => '8',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'user_id' => array(
				'type' => 'INT',
				'constraint' => '8',
				'unsigned' => TRUE
			),
			'book_category' => array(
				'type' => 'INT',
				'constraint' => '11' ,
				'null' => FALSE
			),
			'book_name' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE
			),
			'description' => array(
				'type' => 'TEXT',
				'constraint' => '',
				'null' => TRUE
			),
			
			'status' => array(
				'type' => 'ENUM("ACTIVE","INACTIVE")',
				'unsigned' => TRUE,
				'null' => FALSE,
				'default' => "ACTIVE"
			),
			
		));
		$this->dbforge->add_key('book_id', TRUE);
		$this->dbforge->create_table('books');

		// Dumping data for table 'books'
		$data = array(
			array(
				'book_id' => '1',
				'user_id' => '2',
				'book_category' => '1',
				'book_name' => 'Java',
				'description' => 'Java',
				'status' => 'ACTIVE'
			),
			array(
				'book_id' => '2',
				'user_id' => '2',
				'book_category' => '1',
				'book_name' => 'Mysql',
				'description' => 'Mysql',
				'status' => 'ACTIVE'
			)
		);
		$this->db->insert_batch('books', $data);

				// Drop table 'book_categories' if it exists
				$this->dbforge->drop_table('book_categories', TRUE);

				// Table structure for table 'login_attempts'
				$this->dbforge->add_field(array(
					'cat_id' => array(
						'type' => 'INT',
						'constraint' => '8',
						'unsigned' => TRUE,
						'auto_increment' => TRUE
					),
					'category' => array(
						'type' => 'VARCHAR',
						'constraint' => '100',
						'null' => TRUE
					),
					'status' => array(
						'type' => 'ENUM("ACTIVE","INACTIVE")',
						'default' => "ACTIVE"
					)
				));
				$this->dbforge->add_key('cat_id', TRUE);
				$this->dbforge->create_table('book_categories');


				// Dumping data for table 'book_categories'
				$data = array(
					array(
						'cat_id' => '1',
						'category' => 'novel',
						'status' => 'ACTIVE',
					),
					array(
						'cat_id' => '2',
						'category' => 'educational',
						'status' => 'ACTIVE',
					)
				);
				$this->db->insert_batch('book_categories', $data);
















		// Drop table 'login_attempts' if it exists
		$this->dbforge->drop_table('login_attempts', TRUE);

		// Table structure for table 'login_attempts'
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => '8',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'ip_address' => array(
				'type' => 'VARCHAR',
				'constraint' => '16'
			),
			'login' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE
			),
			'time' => array(
				'type' => 'INT',
				'constraint' => '11',
				'unsigned' => TRUE,
				'null' => TRUE
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('login_attempts');

	}

	public function down()
	{
		$this->dbforge->drop_table('users', TRUE);
		$this->dbforge->drop_table('groups', TRUE);
		$this->dbforge->drop_table('users_groups', TRUE);
		$this->dbforge->drop_table('login_attempts', TRUE);
	}
}
