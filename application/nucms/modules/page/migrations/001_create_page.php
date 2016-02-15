<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Migration_Create_page
 */
class Migration_Create_page extends CI_Migration
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
            'created_at' => array(
                'type' => 'DATETIME',
                'null' => TRUE
            ),
            'updated_at' => array(
                'type' => 'DATETIME',
                'null' => TRUE
            ),
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('nu_page');
    }

    public function down()
    {
        $this->dbforge->drop_table('nu_page');
    }
}

/* End of file 001_create_page.php */
/* Location: ./application/modules/page/migrations/001_create_page.php */