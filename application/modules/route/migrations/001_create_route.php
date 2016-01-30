<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_route extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(array(
            'slug' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => NULL
            ),
            'url' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => NULL
            ),
            'locale' => array(
                'type' => 'VARCHAR',
                'constraint' => '10',
                'default' => NULL
            ),
        ));

        $this->dbforge->create_table('nu_route');
        $this->dbforge->add_key('slug');
        $this->dbforge->add_key('url');
        $this->db->query('ALTER TABLE `nu_route` ADD CONSTRAINT `nu_route_locale_FK` FOREIGN KEY (`locale`) REFERENCES `nu_language` (`locale`) ON UPDATE CASCADE ON DELETE CASCADE;');
    }

    public function down()
    {
        $this->dbforge->drop_table('nu_route');
    }
}
