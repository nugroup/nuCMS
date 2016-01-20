<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class Language_model
 */
class Language_model extends MY_Model
{
    public $table = 'nu_language';
    public $primary_key = 'id';
    public $fillable = array();
    public $protected = array();

    function __construct()
    {
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

        $rules['name'] = array('field' => 'name', 'label' => lang('language.form.name'), 'rules' => 'required|trim|xss_clean');
        $rules['locale'] = array('field' => 'locale', 'label' => lang('language.form.locale'), 'rules' => 'required|trim|xss_clean');
        $rules['folder_name'] = array('field' => 'folder_name', 'label' => lang('language.form.folder_name'), 'rules' => 'required|trim|xss_clean');
        $rules['active'] = array('field' => 'active', 'label' => lang('language.form.active'), 'rules' => 'trim|xss_clean');

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
            $this->db->like('name', $string);
            $this->db->or_like('locale', $string);
        }
    }
}

/* End of file Language_model.php */
/* Location: ./application/modules/language/models/Language_model.php */