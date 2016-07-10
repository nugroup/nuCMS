<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Migration_Create_setting
 */
class Migration_Create_setting extends CI_Migration
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
            'key' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => NULL
            ),
            'value' => array(
                'type' => 'TEXT',
                'default' => NULL
            ),
            'type' => array( // (input, select, textarea, checkbox, radio)
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => 'input',
                'null' => false
            ),
            'global' => array( // 1 - global, 0 - locale
                'type' => 'BOOLEAN',
                'default' => 1
            ),
            'group_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'default' => NULL
            ),
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('key');
        $this->dbforge->create_table('nu_setting');
        $this->db->query('ALTER TABLE `nu_setting` ADD CONSTRAINT `nu_setting_group_id_FK` FOREIGN KEY (`group_id`) REFERENCES `nu_setting_groups` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;');
        $this->db->query('ALTER TABLE `nu_setting` ADD UNIQUE(`key`);');
    }

    public function down()
    {
        $this->dbforge->drop_table('nu_setting');
    }
}

/* End of file 002_create_setting.php */
/* Location: ./nucms/modules/setting/migrations/002_create_setting.php */