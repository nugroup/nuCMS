<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH.'/interfaces/RouteTranslationsModelInterface.php';

/**
 * Class Page_translations_model
 */
class Page_translations_model extends MY_Model implements RouteTranslationsModelInterface
{
    public $table = 'nu_page_translations';
    public $primary_key = 'id';
    public $fillable = array();
    public $protected = array();
    public $after_get = ['get_route'];

    function __construct()
    {
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

        parent::__construct();
        $this->timestamps = FALSE;
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

        $rules['title'] = array('field' => 'title', 'label' => lang('page.form.title'), 'rules' => 'required|trim|xss_clean');
        $rules['content'] = array('field' => 'content', 'label' => lang('page.form.content'), 'rules' => 'xss_clean');
        $rules['active'] = array('field' => 'active', 'label' => lang('page.form.active'), 'rules' => 'trim|xss_clean');
        $rules['meta_title'] = array('field' => 'meta_title', 'label' => lang('page.form.meta_title'), 'rules' => 'max_length[50]|trim|xss_clean');
        $rules['meta_keywords'] = array('field' => 'meta_keywords', 'label' => lang('page.form.meta_keywords'), 'rules' => 'trim|xss_clean');
        $rules['meta_description'] = array('field' => 'meta_description', 'label' => lang('page.form.meta_description'), 'rules' => 'max_length[160]|trim|xss_clean');

        return $rules;
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
    }

    /**
     * Insert translation for all languages with slug
     *
     * @param int $page_id
     */
    public function insert_all_translations($page_id)
    {
        // Load routes model
        $CI = & get_instance();
        $CI->load->model('route/route_model', 'route');

        $i = 1;
        foreach (config_item('system_languages') as $language) {

            // Insert translate
            $insertedTranslate = $this->from_form(
                    $this->get_rules('add'),
                    [
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
            $pageUrl = $this->config->item('pages_route_controller').$page_id.'/'.$language->locale;
            $slug = ($this->input->post('slug')) ? $this->input->post('slug') : $this->input->post('title');

            if ($i > 1) {
                $slug .= '-'.$language->locale;
            }

            // Add route
            $routeData = [
                'slug' => $CI->route->prepare_unique_slug($slug),
                'url' => $pageUrl,
                'locale' => $language->locale,
                'module' => 'page',
                'primary_key' => $page_id,
            ];
            $CI->route->insert($routeData);

            $i++;
        }

        return $insertedTranslate;
    }

    /**
     * Generate token for page preview
     *
     * @param object $page
     * @return string
     */
    public function generate_token($page)
    {
        $pageObject = (object) $page;
        return md5($pageObject->slug);
    }

    /**
     * Get page route
     *
     * @param array $data
     * @return array
     */
    public function get_route($data)
    {
        // Load routes model
        $CI = & get_instance();
        $CI->load->model('route/route_model', 'route');

        if (!isset($data[0])) {

            $pageUrl = config_item('pages_route_controller').$data['page_id'].'/'.$data['locale'];
            $route = $CI->route
                ->fields('slug')
                ->where(['url' => $pageUrl])
                ->get();

            if ($route) {
                $data['slug'] = $route->slug;
                $data['token'] = $this->generate_token($data);
            }

        }

        return $data;
    }
}

/* End of file Page_translations_model.php */
/* Location: ./application/modules/page/models/Page_translations_model.php */