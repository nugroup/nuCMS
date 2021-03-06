<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class Copythis_model
 */
class Copythis_model extends MY_Model
{
    public $table = 'nu_copythis';
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

        if ($action == 'add') {
            $rules['name'] = array('field' => 'name', 'label' => lang('copythis.form.name'), 'rules' => 'required|trim|xss_clean');
        } else {

        }

        return $rules;
    }
}

/* End of file Copythis_model.php */
/* Location: ./application/modules/copythis/models/Copythis_model.php */