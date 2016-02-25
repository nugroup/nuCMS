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
     * Prepare parent array for tree
     *
     * @param array $items
     * @return type
     */
    public function prepare_parent_array($items)
    {
        $result = array();

        if ($items) {
            foreach ($items as $item) {
                $item->id_parent = (int) $item->id_parent; // Convert NULL to INT
                $result[$item->id_parent][] = $item;
            }
        }

        return $result;
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
}

/* End of file Menu_items_model.php */
/* Location: ./application/modules/menu/models/Menu_items_model.php */