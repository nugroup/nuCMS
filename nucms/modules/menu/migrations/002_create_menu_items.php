<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Migration_Create_menu_items
 */
class Migration_Create_menu_items extends CI_Migration
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
            'icon' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => NULL
            ),
            'type' => array(
                'type' => 'TINYINT',
                'constraint' => 2,
                'null' => TRUE,
                'unsigned' => TRUE
            ),
            'module' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => NULL
            ),
            'url' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => NULL
            ),
            'primary_key' => array(
                'type' => 'INT',
                'constraint' => 5,
                'null' => TRUE,
                'unsigned' => TRUE
            ),
            'target' => array(
                'type' => 'VARCHAR',
                'constraint' => '10',
                'default' => NULL
            ),
            'sort' => array(
                'type' => 'INT',
                'constraint' => 5,
                'null' => TRUE,
                'unsigned' => TRUE
            ),
            'locale' => array(
                'type' => 'VARCHAR',
                'constraint' => '10',
                'default' => NULL
            ),
            'menu_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'null' => TRUE,
                'unsigned' => TRUE
            ),
            'id_parent' => array(
                'type' => 'INT',
                'constraint' => 5,
                'null' => TRUE,
                'unsigned' => TRUE
            ),
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('nu_menu_items');
        $this->dbforge->add_key('module');
        $this->dbforge->add_key('primary_key');

        $this->db->query('ALTER TABLE `nu_menu_items` ADD CONSTRAINT `nu_menu_items_menu_id_FK` FOREIGN KEY (`menu_id`) REFERENCES `nu_menu` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;');
        $this->db->query('ALTER TABLE `nu_menu_items` ADD CONSTRAINT `nu_menu_items_id_parent_FK` FOREIGN KEY (`id_parent`) REFERENCES `nu_menu_items` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;');
        $this->db->query('ALTER TABLE `nu_menu_items` ADD CONSTRAINT `nu_menu_items_locale_FK` FOREIGN KEY (`locale`) REFERENCES `nu_language` (`locale`) ON UPDATE CASCADE ON DELETE CASCADE;');
    }

    public function down()
    {
        $this->dbforge->drop_table('nu_menu_items');
    }
}

/* End of file 002_create_menu_items.php */
/* Location: ./application/modules/menu/migrations/002_create_menu_items.php */