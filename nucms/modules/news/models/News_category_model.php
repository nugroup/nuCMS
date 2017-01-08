<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class News_category_model
 */
class News_category_model extends MY_Model implements RouteModelInterface
{
    public $table = 'nu_news_category';
    public $primary_key = 'id';
    public $fillable = array();
    public $protected = array();
    public $before_delete = ['delete_route'];

    function __construct()
    {
        $CI = & get_instance();
        $CI->load->model('language/language_model', 'language');
        $CI->load->model('news/news_category_translations_model', 'news_category_translations');

        // Relations
        $this->has_one['translation'] = array(
            'foreign_model' => 'News_category_translations_model',
            'foreign_table' => 'nu_news_category_translations',
            'foreign_key' => 'news_category_id',
            'local_key' => 'id'
        );

        $this->has_many['translations'] = array(
            'foreign_model' => 'News_category_translations_model',
            'foreign_table' => 'nu_news_category_translations',
            'foreign_key' => 'news_category_id',
            'local_key' => 'id'
        );

        parent::__construct();
        $this->timestamps = false;
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
            'module' => 'news_category',
            'primary_key' => $data['id'],
        ]);
    }
}

/* End of file News_category_model.php */
/* Location: ./nucms/modules/news/models/News_category_model.php */