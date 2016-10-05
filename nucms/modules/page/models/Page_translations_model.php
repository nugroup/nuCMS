<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class Page_translations_model
 */
class Page_translations_model extends MY_Model {

    public $table = 'nu_page_translations';
    public $primary_key = 'id';
    public $fillable = [];
    public $after_get = ['get_token', 'get_seo_progress', 'decode_content'];

    function __construct() {
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
            'foreign_model' => 'Page_model',
            'foreign_table' => 'nu_page',
            'foreign_key' => 'id',
            'local_key' => 'page_id'
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
    protected function decode_content($data) {
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
     * Get validations rules
     *
     * @param string $action
     * @return array
     */
    public function get_rules($action = '', $id = 0) {
        $rules = array();

        $rules['title'] = array('field' => 'title', 'label' => lang('page.form.title'), 'rules' => 'required|trim|xss_clean|min_length[3]');
        $rules['content'] = array('field' => 'content', 'label' => lang('page.form.content'), 'rules' => 'xss_clean');
        $rules['active'] = array('field' => 'active', 'label' => lang('page.form.active'), 'rules' => 'trim|xss_clean');
        $rules['meta_title'] = array('field' => 'meta_title', 'label' => lang('page.form.meta_title'), 'rules' => 'max_length[50]|trim|xss_clean');
        $rules['meta_keywords'] = array('field' => 'meta_keywords', 'label' => lang('page.form.meta_keywords'), 'rules' => 'trim|xss_clean');
        $rules['meta_description'] = array('field' => 'meta_description', 'label' => lang('page.form.meta_description'), 'rules' => 'max_length[160]|trim|xss_clean');

        return $rules;
    }

    /**
     * Insert translation for all languages with slug
     *
     * @param int $page_id
     */
    public function insert_all_translations($page_id) {
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
                            'page_id' => $page_id,
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
                'module' => 'page',
                'primary_key' => $page_id,
            ];
            
            $insertedRouteId = $CI->route->insert($routeData);

            if ($insertedRouteId) {
                $this->where([
                    'locale' => $language->locale,
                    'page_id' => $page_id,
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
     * @param object $page
     * @return string
     */
    public function generate_token($page) {
        $pageObject = (object) $page;

        return md5($pageObject->title . $pageObject->id);
    }

    /**
     * Create route from pages
     */
    public function update_routes() {
        $CI = & get_instance();
        $CI->load->model('route/route_model', 'route_model');

        $pages = $this->get_all();
        if ($pages) {
            foreach ($pages as $page) {
                $routeData = $CI->route->where(['id' => $page->route_id])->count_rows();
                if ($page->locale != config_item('default_locale')) {
                    $pageSlug = $CI->route->prepare_unique_slug($page->title . '-' . $page->locale);
                } else {
                    $pageSlug = $CI->route->prepare_unique_slug($page->title);
                }

                if ($routeData <= 0) {
                    $routesData = [
                        'slug' => $pageSlug,
                        'locale' => $page->locale,
                        'module' => 'page',
                        'primary_key' => $page->page_id,
                    ];
                    $insertedId = $CI->route->insert($routesData);

                    $this
                        ->where([
                            'locale' => $page->locale,
                            'page_id' => $page->page_id,
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
    public function get_seo_progress($data) {
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
     * @param object $page
     * @return string
     */
    public function get_seo_progress_msg($page) {
        $message = '';

        if (isset($page->seo_progress) && $page->seo_progress == 100.00) {
            $message = '<p>' . lang('page.seo_progress_100') . '</p>';
        } else {
            if (isset($page->meta_title) && $page->meta_title && $page->meta_title == '') {
                $message .= '<p>' . lang('page.seo_progress.no_title') . '</p>';
            }
            if (isset($page->meta_keywords) && $page->meta_keywords == '') {
                $message .= '<p>' . lang('page.seo_progress.no_keywords') . '</p>';
            }
            if (isset($page->meta_description) && $page->meta_description == '') {
                $message .= '<p>' . lang('page.seo_progress.no_description') . '</p>';
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
     * @param object $page
     * @return float
     */
    public function calculate_seo_progress($page) {
        $progress = 0;

        if (isset($page->meta_title) && $page->meta_title != '') {
            $progress += 33.33;
        }
        if (isset($page->meta_keywords) && $page->meta_keywords != '') {
            $progress += 33.33;
        }
        if (isset($page->meta_description) && $page->meta_description != '') {
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
    public function generate_like_query($string) {
        if ($string) {
            $this->db->like('title', $string);
        }

        if ($this->input->get('sort') && $this->input->get('sort_type')) {
            $this->db->order_by($this->input->get('sort'), $this->input->get('sort_type'));
        }
    }

}

/* End of file Page_translations_model.php */
/* Location: ./application/modules/page/models/Page_translations_model.php */