<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Migration_Create_block
 */
class Migration_Create_block extends CI_Migration
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
            'hash_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => NULL
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => NULL
            ),
            'content' => array(
                'type' => 'TEXT',
                'default' => '',
                'null' => false
            ),
            'type' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE,
                'unsigned' => TRUE
            ),
            'global' => array( // 1 - global, 0 - locale
                'type' => 'BOOLEAN',
                'default' => 1
            ),
            'created_at' => array(
                'type' => 'DATETIME',
                'null' => TRUE
            ),
            'updated_at' => array(
                'type' => 'DATETIME',
                'null' => TRUE
            ),
            'locale' => array(
                'type' => 'VARCHAR',
                'constraint' => '10',
                'default' => NULL
            ),
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('hash_id');
        $this->dbforge->create_table('nu_block');
        $this->db->query('ALTER TABLE `nu_block` ADD CONSTRAINT `nu_block_locale_FK` FOREIGN KEY (`locale`) REFERENCES `nu_language` (`locale`) ON UPDATE CASCADE ON DELETE CASCADE;');
    }

    public function down()
    {
        $this->dbforge->drop_table('nu_block');
    }
}

/* End of file 001_create_block.php */
/* Location: ./application/modules/block/migrations/001_create_block.php */