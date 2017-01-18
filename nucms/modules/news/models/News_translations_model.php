<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class News_translations_model
 */
class News_translations_model extends MY_Model
{
    public $table = 'nu_news_translations';
    public $primary_key = 'id';
    public $fillable = [];
    public $after_get = ['get_token', 'get_seo_progress', 'decode_content'];
    public $after_create = ['update_sort'];

    function __construct()
    {
        $CI = & get_instance();
        $CI->load->model('file/file_model', 'file');

        // Relationship
        $this->has_one['language'] = array(
            'foreign_model' => 'Language_model',
            'foreign_table' => 'nu_language',
            'foreign_key' => 'locale',
            'local_key' => 'locale'
        );
        $this->has_one['root'] = array(
            'foreign_model' => 'News_model',
            'foreign_table' => 'nu_news',
            'foreign_key' => 'id',
            'local_key' => 'news_id'
        );
        $this->has_one['file'] = array(
            'foreign_model' => 'File_model',
            'foreign_table' => 'nu_file',
            'foreign_key' => 'id',
            'local_key' => 'file_Id'
        );
        $this->has_one['route'] = array(
            'foreign_model' => 'Route_model',
            'foreign_table' => 'nu_route',
            'foreign_key' => 'id',
            'local_key' => 'route_Id'
        );

        parent::__construct();
        $this->timestamps = true;
    }

    /**
     * Decode content using block module
     * 
     * @param array $data
     */
    protected function decode_content($data)
    {
        if (isset($data[0])) {
            foreach ($data as &$row) {
                $row['content_blocks'] = array();

                if (isset($row['content'])) {
                    $row['content_blocks'] = $this->block_lib->decode_content_map($row['content']);
                }
            }
        } else {
            $data['content_blocks'] = array();

            if (isset($data['content'])) {
                $data['content_blocks'] = $this->block_lib->decode_content_map($data['content']);
            }
        }

        return $data;
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
     * Get validations rules
     *
     * @param string $action
     * @return array
     */
    public function get_rules($action = '', $id = 0)
    {
        $rules = array();

        $rules['title'] = array('field' => 'title', 'label' => lang('news.form.title'), 'rules' => 'required|trim|xss_clean|min_length[3]');
        $rules['content'] = array('field' => 'content', 'label' => lang('news.form.content'), 'rules' => 'xss_clean');
        $rules['content_preview'] = array('field' => 'content_preview', 'label' => lang('news.form.content_preview'), 'rules' => 'xss_clean');
        $rules['active'] = array('field' => 'active', 'label' => lang('news.form.active'), 'rules' => 'trim|xss_clean');
        $rules['meta_title'] = array('field' => 'meta_title', 'label' => lang('news.form.meta_title'), 'rules' => 'max_length[50]|trim|xss_clean');
        $rules['meta_keywords'] = array('field' => 'meta_keywords', 'label' => lang('news.form.meta_keywords'), 'rules' => 'trim|xss_clean');
        $rules['meta_description'] = array('field' => 'meta_description', 'label' => lang('news.form.meta_description'), 'rules' => 'max_length[160]|trim|xss_clean');
        $rules['template'] = array('field' => 'template', 'label' => lang('news.form.template'), 'rules' => 'trim|xss_clean');
        $rules['publication_date'] = array('field' => 'publication_date', 'label' => lang('news.form.publication_date'), 'rules' => 'required|trim|xss_clean');

        return $rules;
    }

    /**
     * Insert translation for all languages with slug
     *
     * @param int $news_id
     */
    public function insert_all_translations($news_id)
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
                    $this->get_rules('add'), [
                        'locale' => $language->locale,
                        'news_id' => $news_id,
                        'active' => (int) $this->input->post('active'),
                        'file_id' => ($this->input->post('file_id')) ? (int) $this->input->post('file_id') : NULL
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
                'module' => 'news',
                'primary_key' => $news_id,
            ];

            $insertedRouteId = $CI->route->insert($routeData);

            if ($insertedRouteId) {
                $this->where([
                        'locale' => $language->locale,
                        'news_id' => $news_id,
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

        return md5($newsObject->title . $newsObject->id);
    }

    /**
     * Create route from pages
     */
    public function update_routes()
    {
        $CI = & get_instance();
        $CI->load->model('route/route_model', 'route_model');

        $newsList = $this->get_all();
        if ($newsList) {
            foreach ($newsList as $news) {
                $routeData = $CI->route->where(['id' => $news->route_id])->count_rows();
                if ($news->locale != config_item('default_locale')) {
                    $newsSlug = $CI->route->prepare_unique_slug($news->title . '-' . $news->locale);
                } else {
                    $newsSlug = $CI->route->prepare_unique_slug($news->title);
                }

                if ($routeData <= 0) {
                    $routesData = [
                        'slug' => $newsSlug,
                        'locale' => $news->locale,
                        'module' => 'news',
                        'primary_key' => $news->news_id,
                    ];
                    $insertedId = $CI->route->insert($routesData);

                    $this
                        ->where([
                            'locale' => $news->locale,
                            'news_id' => $news->news_id,
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
    public function get_seo_progress_msg($news)
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
     * Generate query from search string
     *
     * @param string $string
     */
    public function generate_like_query($string)
    {
        if ($string) {
            $this->db->like('title', $string);
        }

        if ($this->input->get('sort') && $this->input->get('sort_type')) {
            $this->db->order_by($this->input->get('sort'), $this->input->get('sort_type'));
        }
    }
}

/* End of file News_translations_model.php */
/* Location: ./nucms/modules/news/models/News_translations_model.php */