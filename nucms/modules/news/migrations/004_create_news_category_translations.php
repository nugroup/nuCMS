<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Migration_Create_news_category_translations
 */
class Migration_Create_news_category_translations extends CI_Migration
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
            'active' => array(
                'type' => 'BOOLEAN',
                'default' => 0
            ),
            'sort' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => FALSE,
                'default' => 0,
                'null' => FALSE
            ),
            'news_category_id' => array(
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
        $this->dbforge->create_table('nu_news_category_translations');

        $this->db->query('ALTER TABLE `nu_news_category_translations` ADD CONSTRAINT `nu_news_category_translations_news_category_id_FK` FOREIGN KEY (`news_category_id`) REFERENCES `nu_news_category` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;');
        $this->db->query('ALTER TABLE `nu_news_category_translations` ADD CONSTRAINT `nu_news_category_translations_locale_FK` FOREIGN KEY (`locale`) REFERENCES `nu_language` (`locale`) ON UPDATE CASCADE ON DELETE CASCADE;');
    }

    public function down()
    {
        $this->dbforge->drop_table('nu_news_category_translations');
    }
}

/* End of file 004_create_news_category_translations.php */
/* Location: ./nucms/modules/news/migrations/004_create_news_category_translations.php */