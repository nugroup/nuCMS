<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Migration_Create_setting
 */
class Migration_Create_setting_translations extends CI_Migration
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
            'value' => array(
                'type' => 'TEXT',
                'default' => NULL
            ),
            'locale' => array(
                'type' => 'VARCHAR',
                'constraint' => '10',
                'default' => NULL
            ),
            'setting_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'default' => NULL
            ),
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('nu_setting_translations');
        $this->db->query('ALTER TABLE `nu_setting_translations` ADD CONSTRAINT `nu_setting_translations_locale_FK` FOREIGN KEY (`locale`) REFERENCES `nu_language` (`locale`) ON UPDATE CASCADE ON DELETE CASCADE;');
        $this->db->query('ALTER TABLE `nu_setting_translations` ADD CONSTRAINT `nu_setting_translations_setting_id_FK` FOREIGN KEY (`setting_id`) REFERENCES `nu_setting` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;');
    }

    public function down()
    {
        $this->dbforge->drop_table('nu_setting_translations');
    }
}

/* End of file 003_create_setting_translations.php */
/* Location: ./nucms/modules/setting/migrations/003_create_setting_translations.php */