<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Migration_Create_file
 */
class Migration_Create_file extends CI_Migration
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
            'filename' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => NULL
            ),
            'type' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => TRUE,
                'unsigned' => TRUE
            ),
            'size' => array(
                'type' => 'decimal',
                'constraint' => '10,2',
                'default' => NULL
            ),
            'description' => array(
                'type' => 'TEXT',
                'default' => NULL
            ),
            'alt' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => NULL
            ),
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => NULL
            ),
            'created_at' => array(
                'type' => 'DATETIME',
                'null' => TRUE
            ),
            'updated_at' => array(
                'type' => 'DATETIME',
                'null' => TRUE
            ),
            'parent_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'default' => NULL
            ),
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('nu_file');
        $this->db->query('ALTER TABLE `nu_file` ADD CONSTRAINT `nu_file_parent_id_FK` FOREIGN KEY (`parent_id`) REFERENCES `nu_file` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;');
    }

    public function down()
    {
        $this->dbforge->drop_table('nu_file');
    }
}

/* End of file 001_create_file.php */
/* Location: ./application/modules/file/migrations/001_create_file.php */