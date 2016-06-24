<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Migration_Create_setting_groups
 */
class Migration_Create_setting_groups extends CI_Migration
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
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('nu_setting_groups');
    }

    public function down()
    {
        $this->dbforge->drop_table('nu_setting_groups');
    }
}

/* End of file 001_create_setting_groups.php */
/* Location: ./nucms/modules/setting/migrations/001_create_setting_groups.php */