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

        $CI = & get_instance();
        $CI->load->model('menu/menu_items_model', 'menu_items');

        // Relations
        $this->has_many['items'] = array(
            'foreign_model' => 'Menu_items_model',
            'foreign_table' => 'nu_menu_items',
            'foreign_key' => 'menu_id',
            'local_key' => 'id'
        );

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
     * Prepare like and order_by query from $_GET
     *
     * @param string $string
     */
    public function generate_like_query($string)
    {
        if ($string) {
            $this->db->like('name', $string);
        }

        if ($this->input->get('sort') && $this->input->get('sort_type')) {
            $this->db->order_by($this->input->get('sort'), $this->input->get('sort_type'));
        }
    }
}

/* End of file Menu_model.php */
/* Location: ./application/modules/menu/models/Menu_model.php */