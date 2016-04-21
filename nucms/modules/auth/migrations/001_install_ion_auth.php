<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Migration_Install_ion_auth
 */
class Migration_Install_ion_auth extends CI_Migration
{
    public function up()
    {
        // Drop table 'groups' if it exists
        $this->dbforge->drop_table('nu_group', TRUE);

        // Table structure for table 'groups'
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'MEDIUMINT',
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
        $this->dbforge->create_table('nu_group');

        // Dumping data for table 'groups'
        $data = array(
            array(
                'id' => '1',
                'name' => 'admin',
                'description' => 'Administrator'
            ),
            array(
                'id' => '2',
                'name' => 'editors',
                'description' => 'Edytor'
            )
        );
        $this->db->insert_batch('nu_group', $data);

        // Drop table 'users' if it exists
        $this->dbforge->drop_table('nu_user', TRUE);

        // Table structure for table 'users'
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'MEDIUMINT',
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
            'salt' => array(
                'type' => 'VARCHAR',
                'constraint' => '40'
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
            'active' => array(
                'type' => 'TINYINT',
                'constraint' => '1',
                'unsigned' => TRUE,
                'null' => TRUE
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
            'company' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE
            ),
            'phone' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => TRUE
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('nu_user');

        // Dumping data for table 'users'
        $data = array(
            'id' => '1',
            'ip_address' => '127.0.0.1',
            'username' => 'admin',
            'password' => '$2y$08$XBYkjVL2h6fhm0oeOXP4TOwBu4x6rmKH.UT2u4VhtQRnb0tY297By', // admin#123
            'salt' => '',
            'email' => 'admin@nucms.com',
            'activation_code' => '',
            'forgotten_password_code' => NULL,
            'created_on' => '1268889823',
            'last_login' => '1268889823',
            'active' => '1',
            'first_name' => 'Admin',
            'last_name' => 'istrator',
            'company' => 'ADMIN',
            'phone' => '0',
        );
        $this->db->insert('nu_user', $data);

        // Drop table 'users_groups' if it exists
        $this->dbforge->drop_table('nu_user_group', TRUE);

        // Table structure for table 'users_groups'
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'MEDIUMINT',
                'constraint' => '8',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'user_id' => array(
                'type' => 'MEDIUMINT',
                'constraint' => '8',
                'unsigned' => TRUE
            ),
            'group_id' => array(
                'type' => 'MEDIUMINT',
                'constraint' => '8',
                'unsigned' => TRUE
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('nu_user_group');

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
        $this->db->insert_batch('nu_user_group', $data);


        // Drop table 'login_attempts' if it exists
        $this->dbforge->drop_table('nu_login_attempt', TRUE);

        // Table structure for table 'login_attempts'
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'MEDIUMINT',
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
                'null', TRUE
            ),
            'time' => array(
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => TRUE,
                'null' => TRUE
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('nu_login_attempt');

        // foreign key for user_group
        $this->db->query('ALTER TABLE `nu_user_group` ADD CONSTRAINT `nu_user_group_user_id_FK` FOREIGN KEY (`user_id`) REFERENCES `nu_user` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;');
        $this->db->query('ALTER TABLE `nu_user_group` ADD CONSTRAINT `nu_user_group_group_id_FK` FOREIGN KEY (`group_id`) REFERENCES `nu_group` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;');
    }

    public function down()
    {
        $this->dbforge->drop_table('nu_user', TRUE);
        $this->dbforge->drop_table('nu_group', TRUE);
        $this->dbforge->drop_table('nu_users_group', TRUE);
        $this->dbforge->drop_table('nu_login_attempt', TRUE);
    }
}

/* End of file 001_install_ion_auth.php */
/* Location: ./application/modules/auth/migrations/001_install_ion_auth.php */