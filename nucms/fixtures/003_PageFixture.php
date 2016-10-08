<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class PageFixture
 */
class PageFixture implements FixturesInterface
{
    public function load()
    {
        $CI =& get_instance();
        $CI->load->model('page/page_model', 'page');
        $CI->load->model('page/page_translations_model', 'page_translations');
        $CI->load->model('language/language_model', 'language');
        $CI->load->model('route/route_model', 'route');
        $CI->load->config('nucms');
        $faker = Faker\Factory::create();

        // Get all languages
        $languages = $CI->language->get_all();

        if ($languages) {
            // Delete page
            $CI->db->query('SET FOREIGN_KEY_CHECKS = 0');
            $CI->db->query('TRUNCATE TABLE nu_page');
            $CI->db->query('TRUNCATE TABLE nu_page_translations');
            $CI->db->query('SET FOREIGN_KEY_CHECKS = 1');

            // Delete page routes
            $CI->route->delete([
                'module' => 'page',
            ]);

            for ($i = 1; $i < 6; $i++) {
                $title = substr($faker->unique()->sentence(1), 0, -1);

                $insertedId = $CI->page->insert(['id' => NULL]);

                if ($insertedId) {
                    // Insert all translations
                    foreach ($languages as $language) {
                        $dataTranslation = [
                            'title' => $title,
                            'meta_title' => $title,
                            'meta_keywords' => $faker->sentence(3),
                            'meta_description' => $faker->text(100),
                            'template' => 'default',
                            'active' => 1,
                            'locale' => $language->locale,
                            'page_id' => $insertedId
                        ];
                        $CI->page_translations->insert($dataTranslation);
                    }
                }
            }
        }

        $CI->page_translations->update_routes();
    }
}