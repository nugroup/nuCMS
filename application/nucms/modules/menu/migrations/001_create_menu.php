<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Migration_Create_menu
 */
class Migration_Create_menu extends CI_Migration
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
            'position' => array(
                'type' => 'TINYINT',
                'constraint' => 2,
                'null' => TRUE,
                'unsigned' => TRUE
            ),
            'active' => array(
                'type' => 'BOOLEAN',
                'default' => 0
            ),
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('nu_menu');
    }

    public function down()
    {
        $this->dbforge->drop_table('nu_menu_items');
    }
}

/* End of file 001_create_menu.php */
/* Location: ./application/modules/menu/migrations/001_create_menu.php */