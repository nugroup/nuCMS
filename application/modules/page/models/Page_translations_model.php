<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class Page_translations_model
 */
class Page_translations_model extends MY_Model
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
            'foreign_model'=>'Language_model',
            'foreign_table'=>'nu_language',
            'foreign_key'=>'locale',
            'local_key'=>'locale'
        );
        $this->has_one['root'] = array(
            'foreign_model'=>'Page_model',
            'foreign_table'=>'nu_page',
            'foreign_key'=>'id',
            'local_key'=>'page_id'
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

        if ($action == 'add') {
        } else {

        }

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
     * Get page route
     *
     * @param type $data
     * @return type
     */
    public function get_route($data)
    {
        // Load routes model
        $CI =& get_instance();
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
}

/* End of file Page_translations_model.php */
/* Location: ./application/modules/page/models/Page_translations_model.php */