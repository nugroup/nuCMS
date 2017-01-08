<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Migration_Create_news_category_news
 */
class Migration_Create_news_category_news extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(array(
            'news_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'default' => NULL
            ),
            'news_category_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'default' => NULL
            ),
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('nu_news_category_news');
        
        $this->db->query('ALTER TABLE `nu_news_category_news` ADD CONSTRAINT `nu_news_category_news_news_id_FK` FOREIGN KEY (`news_id`) REFERENCES `nu_news` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;');
        $this->db->query('ALTER TABLE `nu_news_category_news` ADD CONSTRAINT `nu_news_category_news_news_category_id_FK` FOREIGN KEY (`news_category_id`) REFERENCES `nu_news_category` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;');
    }

    public function down()
    {
        $this->dbforge->drop_table('nu_news_category_news');
    }
}

/* End of file 005_create_news_category_news.php */
/* Location: ./nucms/modules/news/migrations/005_create_news_category_news.php */