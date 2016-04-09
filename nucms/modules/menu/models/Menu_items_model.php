<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class Menu_items_model
 */
class Menu_items_model extends MY_Model
{
    public $table = 'nu_menu_items';
    public $primary_key = 'id';
    public $fillable = [];
    public $protected = [];
    public $after_create = ['update_sort'];

    function __construct()
    {
        parent::__construct();

        $this->timestamps = FALSE;

        // rules
        $this->rules = [
            'insert' => [
                'name'     => ['field' => 'name', 'label' => lang('menu.form.name'), 'rules' => 'required|trim|xss_clean'],
                'locale'   => ['field' => 'locale', 'label' => lang('menu.form.locale'), 'rules' => 'required|trim|xss_clean'],
            ],
            'update' => [
                'name'     => ['field' => 'name', 'label' => lang('menu.form.name'), 'rules' => 'required|trim|xss_clean'],
            ]
        ];
    }

    /**
     * Update sort after insert
     *
     * @param int $insertedId
     * @return int
     */
    public function update_sort($insertedId)
    {
        $insertData = ['sort' => $insertedId];
        $this->update($insertData, $insertedId);

        return $insertedId;
    }

    /**
     * Save menu items orders with parents (AJAX)
     */
    public function save_sort($data)
    {
        if ($data) {
            if (count($data)) {
                $i = 1;
                foreach ($data as $key => $parent) {
                    $id_parent = ((int)$parent == 0) ? NULL : (int) $parent;

                    $data = array('id_parent' => $id_parent, 'sort' => $i);
                    $this->menu_items->update($data, $key);
                    $i++;
                }
            }
        }
    }

    /**
     * Get max menu items id
     *
     * @return boolean
     */
    public function get_max_id()
    {
        $result = $this->db->query('SELECT `AUTO_INCREMENT` as next_id FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME =  "'.$this->table.'"')->row();
        if ($result) {
            return $result->next_id;
        }

        return false;
    }

    /**
     * Get menu items with routes
     *
     * @param array $where
     * @return object/boolean
     */
    public function get_with_routes($where)
    {
        $this->db->select('nu_menu_items.*, nu_route.slug as route_slug');
        $this->db->join('nu_route', 'nu_route.primary_key = nu_menu_items.primary_key AND nu_route.module = nu_menu_items.module AND nu_menu_items.locale = nu_route.locale', 'left');
        $this->db->where($where);
        $this->db->order_by('sort', 'asc');

        return $this->db->get($this->table)->result_array();
    }
}

/* End of file Menu_items_model.php */
/* Location: ./application/modules/menu/models/Menu_items_model.php */