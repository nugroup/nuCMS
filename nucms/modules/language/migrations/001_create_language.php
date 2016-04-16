<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Migration_Create_user
 */
class Migration_Create_language extends CI_Migration
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
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => NULL
            ),
            'locale' => array(
                'type' => 'VARCHAR',
                'constraint' => '10',
                'default' => NULL
            ),
            'folder_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '10',
                'default' => NULL
            ),
            'active' => array(
                'type' => 'BOOLEAN',
                'default' => 0
            ),
            'default' => array(
                'type' => 'BOOLEAN',
                'default' => 0
            ),
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('locale');

        $this->dbforge->create_table('nu_language');
    }

    public function down()
    {
        $this->dbforge->drop_table('nu_language');
    }
}

/* End of file 001_create_language.php */
/* Location: ./application/modules/language/migrations/001_create_language.php */