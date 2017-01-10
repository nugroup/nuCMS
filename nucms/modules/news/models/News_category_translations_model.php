<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class News_category_translations_model
 */
class News_category_translations_model extends MY_Model
{
    public $table = 'nu_news_category_translations';
    public $primary_key = 'id';
    public $fillable = [];
    public $after_get = ['get_token', 'get_seo_progress'];
    public $after_create = ['update_sort'];
    public $rules = [
        'insert' => [
            'name' => ['field' => 'name', 'label' => 'lang:news_category.form.name', 'rules' => 'required|trim|xss_clean|min_length[3]'],
            'meta_title' => ['field' => 'meta_title', 'label' => 'lang:news.form.meta_title', 'rules' => 'max_length[50]|trim|xss_clean'],
            'meta_keywords' => ['field' => 'meta_keywords', 'label' => 'lang:news.form.meta_keywords', 'rules' => 'trim|xss_clean'],
            'meta_description' => ['field' => 'meta_description', 'label' => 'lang:news.form.meta_description', 'rules' => 'max_length[160]|trim|xss_clean']
        ],
    ];

    function __construct()
    {
        $CI = & get_instance();

        // Relationship
        $this->has_one['language'] = array(
            'foreign_model' => 'Language_model',
            'foreign_table' => 'nu_language',
            'foreign_key' => 'locale',
            'local_key' => 'locale'
        );
        $this->has_one['root'] = array(
            'foreign_model' => 'News_category_model',
            'foreign_table' => 'nu_news_category',
            'foreign_key' => 'id',
            'local_key' => 'news_category_id'
        );
        $this->has_one['route'] = array(
            'foreign_model' => 'Route_model',
            'foreign_table' => 'nu_route',
            'foreign_key' => 'id',
            'local_key' => 'route_Id'
        );

        parent::__construct();
        $this->timestamps = false;
    }

    /**
     * Update sort after insert
     * 
     * @param int $insertedId
     * 
     * @return int
     */
    protected function update_sort($insertedId)
    {
        $this->update(['sort' => $insertedId], $insertedId);

        return $insertedId;
    }

    /**
     * Insert translation for all languages with slug
     *
     * @param int $news_category_id
     */
    public function insert_all_translations($news_category_id)
    {
        // Load routes model
        $CI = & get_instance();
        $CI->load->model('route/route_model', 'route');

        $this->db->trans_start();

        $i = 1;
        foreach (config_item('system_languages') as $language) {
            // Insert translate
            $insertedTranslate = $this
                ->from_form(
                    $this->rules['insert'], [
                        'locale' => $language->locale,
                        'news_category_id' => $news_category_id,
                        'active' => (int) $this->input->post('active'),
                    ]
                )
                ->insert();

            if (!$insertedTranslate) {
                break;
            }

            // Insert translate route
            $slug = ($this->input->post('slug')) ? $this->input->post('slug') : $this->input->post('title');

            if ($i > 1) {
                $slug .= '-' . $language->locale;
            }

            // Add route
            $routeData = [
                'slug' => $CI->route->prepare_unique_slug($slug),
                'locale' => $language->locale,
                'module' => 'news_category',
                'primary_key' => $news_category_id,
            ];

            $insertedRouteId = $CI->route->insert($routeData);

            if ($insertedRouteId) {
                $this->where([
                        'locale' => $language->locale,
                        'news_category_id' => $news_category_id,
                    ])
                    ->update(['route_id' => $insertedRouteId]);
            }

            $i++;
        }

        $this->db->trans_complete();

        return $insertedTranslate;
    }

    /**
     * Generate token for page preview
     *
     * @param object $news
     * @return string
     */
    public function generate_token($news)
    {
        $newsObject = (object) $news;

        return md5($newsObject->name . $newsObject->id);
    }

    /**
     * Create route from pages
     */
    public function update_routes()
    {
        $CI = & get_instance();
        $CI->load->model('route/route_model', 'route_model');

        $newsCategoryList = $this->get_all();
        if ($newsCategoryList) {
            foreach ($newsCategoryList as $newsCategory) {
                $routeData = $CI->route->where(['id' => $newsCategory->route_id])->count_rows();
                if ($newsCategory->locale != config_item('default_locale')) {
                    $newsCategorySlug = $CI->route->prepare_unique_slug($newsCategory->name . '-' . $newsCategory->locale);
                } else {
                    $newsCategorySlug = $CI->route->prepare_unique_slug($newsCategory->name);
                }

                if ($routeData <= 0) {
                    $routesData = [
                        'slug' => $newsCategorySlug,
                        'locale' => $newsCategory->locale,
                        'module' => 'news_category',
                        'primary_key' => $newsCategory->news_category_id,
                    ];
                    $insertedId = $CI->route->insert($routesData);

                    $this
                        ->where([
                            'locale' => $newsCategory->locale,
                            'news_category_id' => $newsCategory->news_category_id,
                        ])
                        ->update(['route_id' => $insertedId]);
                }
            }
        }
    }

    /**
     * Get seo progress for all get data
     *
     * @param array $data
     * @return array
     */
    public function get_seo_progress($data)
    {
        if (isset($data[0])) {
            foreach ($data as &$row) {
                $row['seo_progress'] = $this->calculate_seo_progress((object) $row);
            }
        } else {
            $data['seo_progress'] = $this->calculate_seo_progress((object) $data);
        }

        return $data;
    }

    /**
     * Preapare seo progress message
     *
     * @param object $news
     * @return string
     */
    public function get_seo_progress_msg($newsCategory)
    {
        $message = '';

        if (isset($news->seo_progress) && $news->seo_progress == 100.00) {
            $message = '<p>' . lang('news.seo_progress_100') . '</p>';
        } else {
            if (isset($news->meta_title) && $news->meta_title && $news->meta_title == '') {
                $message .= '<p>' . lang('news.seo_progress.no_title') . '</p>';
            }
            if (isset($news->meta_keywords) && $news->meta_keywords == '') {
                $message .= '<p>' . lang('news.seo_progress.no_keywords') . '</p>';
            }
            if (isset($news->meta_description) && $news->meta_description == '') {
                $message .= '<p>' . lang('news.seo_progress.no_description') . '</p>';
            }
        }

        return $message;
    }

    /**
     * Get page token for the preview
     *
     * @param array $data
     * 
     * @return array
     */
    public function get_token($data)
    {
        if (isset($data[0])) {
            foreach ($data as &$row) {
                $row['token'] = $this->generate_token($row);
            }
        } else {
            $data['token'] = $this->generate_token($data);
        }

        return $data;
    }

    /**
     * Calculate seo progress
     *
     * @param object $news
     * @return float
     */
    public function calculate_seo_progress($news)
    {
        $progress = 0;

        if (isset($news->meta_title) && $news->meta_title != '') {
            $progress += 33.33;
        }
        if (isset($news->meta_keywords) && $news->meta_keywords != '') {
            $progress += 33.33;
        }
        if (isset($news->meta_description) && $news->meta_description != '') {
            $progress += 33.33;
        }
        if ($progress == 99.99) {
            $progress = 100;
        }

        return (float) $progress;
    }
    
    /**
     * Get categories array tree
     * 
     * @param string $locale
     * 
     * @return array
     */
    public function get_categories_tree($locale)
    {
        $newsCategoryList = $this
            ->with_root()
            ->with_route()
            ->where('locale', $locale)
            ->order_by('sort', 'asc')
            ->get_all();

        if ($newsCategoryList) {
            $newsCategoryList = prepare_join_data($newsCategoryList, 'root');

            return array_to_array_by_key($newsCategoryList, 'parent_id');
        }
        
        return [];
    }    
}

/* End of file News_category_translations_model.php */
/* Location: ./nucms/modules/news/models/News_category_translations_model.php */