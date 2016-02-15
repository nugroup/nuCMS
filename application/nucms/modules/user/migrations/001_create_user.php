<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Migration_Create_user
 */
class Migration_Create_user extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'login' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => NULL
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => NULL
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => NULL
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'default' => NULL
            ),
            'type' => array(
                'type' => 'TINYINT',
                'constraint' => '1',
                'default' => 0,
                'unsigned' => TRUE
            )
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('nu_user');

        // Hash default password
        $pass = hash('sha512', 'admin#123'.config_item('encryption_key'));

        // Add default user
        $this->db->query('INSERT INTO `nu_user` (login, email, name, password) VALUES ("admin", "admin@nucms.com", "Admin", "'.$pass.'")');

        // Add unique keys on email and login
        $this->db->query('ALTER TABLE `nu_user` ADD UNIQUE INDEX (`login`)');
        $this->db->query('ALTER TABLE `nu_user` ADD UNIQUE INDEX (`email`)');
    }

    public function down()
    {
        $this->dbforge->drop_table('nu_user');
    }
}

/* End of file 001_create_user.php */
/* Location: ./application/modules/user/migrations/001_create_user.php */