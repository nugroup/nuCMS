<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Migration_Create_setting
 */
class Migration_Create_setting extends CI_Migration
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
            'admin_locale' => array(
                'type' => 'VARCHAR',
                'constraint' => '10',
                'default' => NULL
            ),
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('nu_setting');
    }

    public function down()
    {
        $this->dbforge->drop_table('nu_setting');
    }
}

/* End of file 001_create_file.php */
/* Location: ./application/modules/copythis/migrations/001_create_file.php */