<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Migration_Create_page
 */
class Migration_Create_page_translations extends CI_Migration
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
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => NULL
            ),
            'content' => array(
                'type' => 'TEXT',
                'default' => NULL
            ),
            'meta_title' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => NULL
            ),
            'meta_keywords' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => NULL
            ),
            'meta_description' => array(
                'type' => 'TEXT',
                'default' => NULL
            ),
            'template' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => NULL
            ),
            'active' => array(
                'type' => 'BOOLEAN',
                'default' => 0
            ),
            'created_at' => array(
                'type' => 'DATETIME',
                'null' => TRUE
            ),
            'updated_at' => array(
                'type' => 'DATETIME',
                'null' => TRUE
            ),
            'page_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'default' => NULL
            ),
            'file_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'default' => NULL
            ),
            'route_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'default' => NULL
            ),
            'locale' => array(
                'type' => 'VARCHAR',
                'constraint' => '10',
                'default' => NULL
            ),
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('route_id');
        $this->dbforge->create_table('nu_page_translations');
        $this->db->query('ALTER TABLE `nu_page_translations` ADD CONSTRAINT `nu_page_translations_page_id_FK` FOREIGN KEY (`page_id`) REFERENCES `nu_page` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;');
        $this->db->query('ALTER TABLE `nu_page_translations` ADD CONSTRAINT `nu_page_translations_file_id_FK` FOREIGN KEY (`file_id`) REFERENCES `nu_file` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;');
        $this->db->query('ALTER TABLE `nu_page_translations` ADD CONSTRAINT `nu_page_translations_locale_FK` FOREIGN KEY (`locale`) REFERENCES `nu_language` (`locale`) ON UPDATE CASCADE ON DELETE CASCADE;');
    }

    public function down()
    {
        $this->dbforge->drop_table('nu_page_translations');
    }
}

/* End of file 002_create_page_translations.php */
/* Location: ./application/modules/page/migrations/002_create_page_translations.php */