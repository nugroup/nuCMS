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
    public $before_delete = array('delete_file');

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
            ->where('type', 1)
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

    /**
     * Delete file from server (BEFORE_DELETE EVENT)
     *
     * @param array $data
     */
    protected function delete_file($data)
    {
        if (isset($data['id'])) {
            $file = $this->get((int) $data['id']);

            if ($file && file_exists(FCPATH.config_item('upload_folder').'/'.$file->filename)) {
                unlink(FCPATH.config_item('upload_folder').'/'.$file->filename);
            }
        }
    }
}

/* End of file File_model.php */
/* Location: ./application/modules/file/models/File_model.php */