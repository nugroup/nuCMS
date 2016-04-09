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
        $folders = $this->db
            ->select('*, id AS folder_id, (SELECT COUNT(*) FROM nu_file WHERE parent_id = folder_id AND type = 0) AS files_in_folder')
            ->where('parent_id IS NULL AND type = 1')
            ->get($this->table)
            ->result();

        if ($folders) {
            return prepare_parent_array($folders);
        }

        return false;
    }

    /**
     * Generate like query for search action
     *
     * @param string $string
     */
    public function generate_like_query($string)
    {
        if ($string) {
            $this->db->like('name', $string);
        }
    }
}

/* End of file File_model.php */
/* Location: ./application/modules/file/models/File_model.php */