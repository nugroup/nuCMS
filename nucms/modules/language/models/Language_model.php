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
    public $fillable = [];
    public $protected = [];
    public $rules = [
        'insert' => [
            'name'        => ['field' => 'name', 'label' => 'lang:language.form.name', 'rules' => 'required|trim|xss_clean'],
            'locale'      => ['field' => 'locale', 'label' => 'lang:language.form.locale', 'rules' => 'required|trim|xss_clean'],
            'folder_name' => ['field' => 'folder_name', 'label' => 'lang:language.form.folder_name', 'rules' => 'required|trim|xss_clean'],
            'active'      => ['field' => 'active', 'label' => 'lang:language.form.active', 'rules' => 'trim|xss_clean'],
            'default'     => ['field' => 'default', 'label' => 'lang:language.form.default', 'rules' => 'trim|xss_clean'],
        ],
        'update' => [
            'name'        => ['field' => 'name', 'label' => 'lang:language.form.name', 'rules' => 'required|trim|xss_clean'],
            'locale'      => ['field' => 'locale', 'label' => 'lang:language.form.locale', 'rules' => 'required|trim|xss_clean'],
            'folder_name' => ['field' => 'folder_name', 'label' => 'lang:language.form.folder_name', 'rules' => 'required|trim|xss_clean'],
            'active'      => ['field' => 'active', 'label' => 'lang:language.form.active', 'rules' => 'trim|xss_clean'],
            'default'     => ['field' => 'default', 'label' => 'lang:language.form.default', 'rules' => 'trim|xss_clean'],
        ],
    ];

    function __construct()
    {
        parent::__construct();

        $this->timestamps = FALSE;
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