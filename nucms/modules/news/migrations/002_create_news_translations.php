<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Migration_Create_news
 */
class Migration_Create_news_translations extends CI_Migration
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
            'priority' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'unsigned' => FALSE,
                'default' => 0,
                'null' => FALSE
            ),
            'sort' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => FALSE,
                'default' => 0,
                'null' => FALSE
            ),
            'publication_date' => array(
                'type' => 'TIMESTAMP',
                'null' => TRUE,
            ),
            'created_at' => array(
                'type' => 'DATETIME',
                'null' => TRUE
            ),
            'updated_at' => array(
                'type' => 'DATETIME',
                'null' => TRUE
            ),
            'news_id' => array(
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
        $this->dbforge->create_table('nu_news_translations');
        $this->db->query('ALTER TABLE `nu_news_translations` ADD CONSTRAINT `nu_news_translations_news_id_FK` FOREIGN KEY (`news_id`) REFERENCES `nu_news` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;');
        $this->db->query('ALTER TABLE `nu_news_translations` ADD CONSTRAINT `nu_news_translations_file_id_FK` FOREIGN KEY (`file_id`) REFERENCES `nu_file` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;');
        $this->db->query('ALTER TABLE `nu_news_translations` ADD CONSTRAINT `nu_news_translations_locale_FK` FOREIGN KEY (`locale`) REFERENCES `nu_language` (`locale`) ON UPDATE CASCADE ON DELETE CASCADE;');
    }

    public function down()
    {
        $this->dbforge->drop_table('nu_news_translations');
    }
}

/* End of file 002_create_news_translations.php */
/* Location: ./nucms/modules/news/migrations/002_create_news_translations.php */