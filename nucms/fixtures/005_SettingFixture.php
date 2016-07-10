<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class SettingFixture
 */
class SettingFixture implements FixturesInterface
{
    public function load()
    {
        $CI = & get_instance();
        $CI->load->model('setting/setting_groups_model', 'setting_groups');
        $CI->load->model('setting/setting_model', 'setting');
        $CI->load->model('setting/setting_translations_model', 'setting_translations');
        $CI->load->model('language/language_model', 'language');
        $CI->load->config('nucms');
        $faker = Faker\Factory::create();

        // Get all languages
        $languages = $CI->language->get_all();

        if ($languages) {

            // Delete setting
            $CI->db->query('SET FOREIGN_KEY_CHECKS = 0');
            $CI->db->query('TRUNCATE TABLE nu_setting_groups');
            $CI->db->query('TRUNCATE TABLE nu_setting');
            $CI->db->query('TRUNCATE TABLE nu_setting_translations');
            $CI->db->query('SET FOREIGN_KEY_CHECKS = 1');
            
        }
    }
}