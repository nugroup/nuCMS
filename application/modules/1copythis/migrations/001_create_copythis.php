<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Migration_Create_user
 */
class Migration_Create_copythis extends CI_Migration
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
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('nu_copythis');
    }

    public function down()
    {
        $this->dbforge->drop_table('nu_copythis');
    }
}

/* End of file 001_create_copythis.php */
/* Location: ./application/modules/copythis/migrations/001_create_copythis.php */