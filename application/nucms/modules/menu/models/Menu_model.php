<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class Menu_model
 */
class Menu_model extends MY_Model
{
    public $table = 'nu_menu';
    public $primary_key = 'id';
    public $fillable = ['name', 'active', 'position'];
    public $protected = [];

    function __construct()
    {
        parent::__construct();

        $this->timestamps = FALSE;

        // rules
        $this->rules = [
            'insert' => [
                'name'     => ['field' => 'name', 'label' => lang('menu.form.name'), 'rules' => 'required|trim|xss_clean'],
                'active'   => ['field' => 'active', 'label' => lang('menu.form.active'), 'rules' => 'trim|xss_clean'],
                'position' => ['field' => 'position', 'label' => lang('menu.form.position'), 'rules' => 'trim|xss_clean'],
            ],
            'update' => [
                'name'     => ['field' => 'name', 'label' => lang('menu.form.name'), 'rules' => 'required|trim|xss_clean'],
                'active'   => ['field' => 'active', 'label' => lang('menu.form.active'), 'rules' => 'trim|xss_clean'],
                'position' => ['field' => 'position', 'label' => lang('menu.form.position'), 'rules' => 'trim|xss_clean'],
            ]
        ];
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
        }
    }
}

/* End of file Menu_model.php */
/* Location: ./application/modules/menu/models/Menu_model.php */