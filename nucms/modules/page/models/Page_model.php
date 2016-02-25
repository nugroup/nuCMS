<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class Page_model
 */
class Page_model extends MY_Model implements RouteModelInterface
{
    public $table = 'nu_page';
    public $primary_key = 'id';
    public $fillable = array();
    public $protected = array();
    public $before_delete = ['delete_route'];

    function __construct()
    {
        $CI = & get_instance();
        $CI->load->model('language/language_model', 'language');
        $CI->load->model('page/page_translations_model', 'page_translations');

        // Relations
        $this->has_one['translation'] = array(
            'foreign_model' => 'Page_translations_model',
            'foreign_table' => 'nu_page_translations',
            'foreign_key' => 'page_id',
            'local_key' => 'id'
        );

        $this->has_many['translations'] = array(
            'foreign_model' => 'Page_translations_model',
            'foreign_table' => 'nu_page_translations',
            'foreign_key' => 'page_id',
            'local_key' => 'id'
        );

        parent::__construct();
        $this->timestamps = TRUE;
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

        return $rules;
    }

    /**
     * Delete records from route table
     *
     * @param array $data
     */
    public function delete_route($data)
    {
        $CI = & get_instance();
        $CI->load->model('route/route_model', 'route');
        $CI->route->delete([
            'module' => 'page',
            'primary_key' => $data['id'],
        ]);
    }
}

/* End of file Page_model.php */
/* Location: ./application/modules/page/models/Page_model.php */