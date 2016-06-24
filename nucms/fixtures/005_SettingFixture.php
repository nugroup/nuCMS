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
//        $CI = & get_instance();
//        $CI->load->model('setting/setting_model', 'setting');
////        $CI->load->model('page/page_translations_model', 'page_translations');
//        $CI->load->model('language/language_model', 'language');
//        $CI->load->config('nucms');
//        $faker = Faker\Factory::create();
//
//        // Get all languages
//        $languages = $CI->language->get_all();
//
//        if ($languages) {
//
//            // Delete page
//            $CI->db->query('SET FOREIGN_KEY_CHECKS = 0');
//            $CI->db->query('TRUNCATE TABLE nu_setting');
//            $CI->db->query('TRUNCATE TABLE nu_setting_translations');
//            $CI->db->query('SET FOREIGN_KEY_CHECKS = 1');
//
//            $dataSetting = [
//                'admin_locale' => 'pl',
//            ];
//            $insertedId = $CI->setting->insert($dataSetting);
//
//            if ($insertedId) {
//                // Insert all translations
//                foreach ($languages as $language) {
//
//                    $dataTranslation = [
//                        'meta_title'       => $faker->text(50),
//                        'meta_keywords'    => str_replace(' ', ',', $faker->sentence(5)),
//                        'meta_description' => $faker->text(160),
//                        'social_facebook' => 'https://www.facebook.com/',
//                        'social_twitter'   => 'https://twitter.com/',
//                        'social_youtube'  => 'https://www.youtube.com/',
//                        'social_google'   => 'https://plus.google.com/',
//                        'locale'           => $language->locale,
//                        'setting_id'       => $insertedId,
//                    ];
//                    $CI->setting_translations->insert($dataTranslation);
//
//                }
//            }

    }
}