<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class Setting_model
 */
class Setting_model extends MY_Model
{
    public $table = 'nu_setting';
    public $primary_key = 'id';
    public $fillable = array();
    public $protected = array();

    function __construct()
    {
        $CI = & get_instance();
        $CI->load->model('language/language_model', 'language');
        $CI->load->model('setting/setting_translations_model', 'setting_translations');

        $this->has_many['translations'] = array(
            'foreign_model' => 'Page_translations_model',
            'foreign_table' => 'nu_page_translations',
            'foreign_key' => 'page_id',
            'local_key' => 'id'
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
            $rules['name'] = array('field' => 'name', 'label' => lang('setting.form.name'), 'rules' => 'required|trim|xss_clean');
        } else {

        }

        return $rules;
    }
}

/* End of file Setting_model.php */
/* Location: ./application/modules/setting/models/Setting_model.php */