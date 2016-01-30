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
     * @param type $string
     */
    public function generate_like_query($string)
    {
        if ($string) {
            $this->db->like('title', $string);
        }
    }
}

/* End of file Page_translations_model.php */
/* Location: ./application/modules/page/models/Page_translations_model.php */