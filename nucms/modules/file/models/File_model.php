<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class File_model
 */
class File_model extends MY_Model
{
    public $table = 'nu_file';
    public $primary_key = 'id';
    public $fillable = array();
    public $protected = array();

    function __construct()
    {
        parent::__construct();

        $this->timestamps = true;
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
            $rules['name'] = array('field' => 'name', 'label' => lang('file.form.name'), 'rules' => 'required|trim|xss_clean');
        } else {

        }

        return $rules;
    }

    /**
     * Get folder lists
     *
     * @param int $id_parent
     * @return type1
     */
    public function get_folders()
    {
        $where = [
            'type'      => 1
        ];
        $folders = $this->get_all($where);

        if ($folders) {
            return prepare_parent_array($folders);
        }

        return false;
    }
}

/* End of file File_model.php */
/* Location: ./application/modules/file/models/File_model.php */