<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class NewsCategoryFixture
 */
class NewsCategoryFixture implements FixturesInterface
{
    const NUMBER_OF_CATEGORIES = 10;

    /**
     * Codeigniter instance
     *
     * @var Controller
     */
    private $CI;

    /**
     * @var array
     */
    private $languages = [];

    /**
     * @var array
     */
    private $newsIds = [];

    /**
     * @var array
     */
    private $categoriesIds = [];

    /**
     *
     * @var Faker 
     */
    private $faker;

    public function __construct()
    {
        $this->faker = Faker\Factory::create();
        $this->CI = & get_instance();
        $this->CI->load->model('news/news_model', 'news');
        $this->CI->load->model('news/news_category_model', 'news_category');
        $this->CI->load->model('news/news_category_translations_model', 'news_category_translations');
        $this->CI->load->model('news/news_category_news_model', 'news_category_news');
        $this->CI->load->model('language/language_model', 'language');
        $this->CI->load->model('route/route_model', 'route');
        $this->CI->load->config('nucms');
    }

    public function load()
    {
        // Get all languages
        $this->languages = $this->CI->language->get_all();
        $this->newsIds = $this->CI->news
            ->fields('id')
            ->get_all();

        if ($this->newsIds) {
            $this->newsIds = array_to_array_by_key_single($this->newsIds, 'id');
            $this->newsIds = array_keys($this->newsIds);
        }

        if ($this->languages) {
            $this->createNewsCategory();
            $this->CI->news_category_translations->update_routes();
            $this->connectNewsToCategory();
        }
    }

    /**
     * Create news categories
     */
    private function createNewsCategory()
    {
        // Delete news_category
        $this->CI->db->query('SET FOREIGN_KEY_CHECKS = 0');
        $this->CI->db->query('TRUNCATE TABLE nu_news_category');
        $this->CI->db->query('TRUNCATE TABLE nu_news_category_translations');
        $this->CI->db->query('SET FOREIGN_KEY_CHECKS = 1');

        // Delete news routes
        $this->CI->route->delete([
            'module' => 'news_category',
        ]);

        for ($i = 1; $i <= self::NUMBER_OF_CATEGORIES; $i++) {
            $name = substr($this->faker->unique()->sentence(1), 0, -1);
            $parentId = null;
            
            if ($i % 2 == 0) {
                $parentId = $this->categoriesIds[array_rand($this->categoriesIds)];
            }
            
            $insertedId = $this->CI->news_category->insert([
                'id' => null,
                'parent_id' => $parentId
            ]);
            $this->categoriesIds[] = $insertedId;

            if ($insertedId) {
                // Insert all translations
                $langIndex = 1;
                foreach ($this->languages as $language) {
                    if ($langIndex > 1) {
                        $name .= ' - ' . $language->locale;
                    }
                    $dataTranslation = [
                        'name' => $name,
                        'meta_title' => $name,
                        'meta_keywords' => $this->faker->sentence(3),
                        'meta_description' => $this->faker->text(100),
                        'active' => 1,
                        'locale' => $language->locale,
                        'sort' => $i,
                        'news_category_id' => $insertedId
                    ];
                    $this->CI->news_category_translations->insert($dataTranslation);
                    
                    $langIndex++;
                }
            }
        }
    }

    /**
     * Create news to category connection
     */
    private function connectNewsToCategory()
    {
        // Delete news_category_news
        $this->CI->db->query('SET FOREIGN_KEY_CHECKS = 0');
        $this->CI->db->query('TRUNCATE TABLE nu_news_category_news');
        $this->CI->db->query('SET FOREIGN_KEY_CHECKS = 1');

        foreach ($this->newsIds as $news) {
            for ($i = 1; $i <= 2; $i++) {
                $randomCategory = array_rand($this->categoriesIds);
                $dataInsert = [
                    'news_id' => $news,
                    'news_category_id' => $this->categoriesIds[$randomCategory]
                ];
                $this->CI->news_category_news->insert($dataInsert);
            }
        }
    }
}
