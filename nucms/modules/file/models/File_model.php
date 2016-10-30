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
    public $fillable = [];
    public $protected = [];
    public $before_delete = ['delete_file', 'delete_files_from_folder'];
    public $after_get = ['get_extension'];
    public $rules = [];

    function __construct()
    {
        parent::__construct();

        $this->timestamps = true;
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
     * Get file extension
     *
     * @param array $data
     * @return array
     */
    public function get_extension($data)
    {
        if (isset($data[0])) {

            $i = 0;
            foreach ($data as $row) {
                $data[$i]['extension'] = extension($row['filename']);

                $i++;
            }
        } else {

            $data['extension'] = extension($data['filename']);
        }

        return $data;
    }

    /**
     * Get all files by ids
     * 
     * @param array $filesIds
     * 
     * @return array/boolean
     */
    public function get_files_by_ids($filesIds)
    {
        $this->db->where_in($this->primary_key, $filesIds);
        
        return $this->get_all();
    }

    /**
     * Delete file from server (BEFORE_DELETE EVENT)
     *
     * @param array $data
     */
    protected function delete_file($data)
    {
        if (isset($data['id'])) {
            $file = $this
                ->where(['id' => (int) $data['id'], 'type' => 0])
                ->get();

            if ($file && file_exists(FCPATH.config_item('upload_folder').'/'.$file->filename)) {
                unlink(FCPATH.config_item('upload_folder').'/'.$file->filename);
            }
        }

        return $data;
    }

    /**
     * Delete files from server by parent_id (BEFORE_DELETE EVENT)
     *
     * @param array $data
     */
    protected function delete_files_from_folder($data)
    {
        if (isset($data['id'])) {
            $files = $this
                ->where(['parent_id' => (int) $data['id'], 'type' => 0])
                ->get_all();

            if ($files) {
                foreach ($files as $file) {
                    if (file_exists(FCPATH.config_item('upload_folder').'/'.$file->filename)) {
                        unlink(FCPATH.config_item('upload_folder').'/'.$file->filename);
                    }
                }
            }
        }

        return $data;
    }
}

/* End of file File_model.php */
/* Location: ./application/modules/file/models/File_model.php */