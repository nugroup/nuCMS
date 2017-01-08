<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Migration_Create_news_category
 */
class Migration_Create_news_category extends CI_Migration
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
            'parent_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'default' => NULL
            ),
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('nu_news_category');

        $this->db->query('ALTER TABLE `nu_news_category` ADD CONSTRAINT `nu_news_category_parent_id_FK` FOREIGN KEY (`parent_id`) REFERENCES `nu_news_category` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;');
    }

    public function down()
    {
        $this->dbforge->drop_table('nu_news_category');
    }
}

/* End of file 003_create_news_category.php */
/* Location: ./nucms/modules/news/migrations/003_create_news_category.php */