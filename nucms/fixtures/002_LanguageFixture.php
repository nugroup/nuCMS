<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class LanguageFixture
 */
class LanguageFixture implements FixturesInterface
{
    public function load()
    {
        $CI = & get_instance();
        $CI->load->model('language/language_model', 'language');

        $CI->db->query('SET FOREIGN_KEY_CHECKS = 0');
        $CI->db->query('TRUNCATE TABLE nu_language');
        $CI->db->query('SET FOREIGN_KEY_CHECKS = 1');

        $data = [
            [
                'name'        => 'Polski',
                'locale'      => 'pl',
                'active'      => 1,
                'default'     => 1,
            ],
            [
                'name'        => 'Angielski',
                'locale'      => 'en',
                'active'      => 1,
                'default'     => 0,
            ],
        ];

        foreach ($data as $item) {
            $CI->language->insert($item);
        }
    }
}