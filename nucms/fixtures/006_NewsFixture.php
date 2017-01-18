<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class NewsFixture
 */
class NewsFixture implements FixturesInterface
{
    public function load()
    {
        $CI = & get_instance();
        $CI->load->model('news/news_model', 'news');
        $CI->load->model('news/news_translations_model', 'news_translations');
        $CI->load->model('language/language_model', 'language');
        $CI->load->model('route/route_model', 'route');
        $CI->load->config('nucms');
        $faker = Faker\Factory::create();
        $dt = new DateTime();

        // Get all languages
        $languages = $CI->language->get_all();

        if ($languages) {
            // Delete news
            $CI->db->query('SET FOREIGN_KEY_CHECKS = 0');
            $CI->db->query('TRUNCATE TABLE nu_news');
            $CI->db->query('TRUNCATE TABLE nu_news_translations');
            $CI->db->query('SET FOREIGN_KEY_CHECKS = 1');

            // Delete news routes
            $CI->route->delete([
                'module' => 'news',
            ]);

            for ($i = 1; $i < 6; $i++) {
                $title = substr($faker->unique()->sentence(1), 0, -1);

                $insertedId = $CI->news->insert(['id' => NULL]);

                if ($insertedId) {
                    // Insert all translations
                    foreach ($languages as $language) {
                        $dataTranslation = [
                            'title' => $title,
                            'content_preview' => $faker->text(150),
                            'meta_title' => $title,
                            'meta_keywords' => $faker->sentence(3),
                            'meta_description' => $faker->text(100),
                            'template' => 'default',
                            'active' => 1,
                            'locale' => $language->locale,
                            'publication_date' => $dt->format('Y-m-d'),
                            'sort' => $i,
                            'news_id' => $insertedId
                        ];
                        $CI->news_translations->insert($dataTranslation);
                    }
                }
            }
        }

        $CI->news_translations->update_routes();
    }
}
