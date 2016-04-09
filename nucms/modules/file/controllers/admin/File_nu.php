<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class File_nu
 */
class File_nu extends Backend_Controller
{
    private $sessionName = 'file';

    public function __construct()
    {
        parent::__construct();

        // Load classes
        $this->load->model('file/file_model', 'file');
        $this->load->helper('file/file');
        $this->lang->load('file', config_item('selected_lang'));
    }

    public function index()
    {
        // Get folder list and prepare html tree
        $folders = $this->file->get_folders();
        $files_folders_tree = generate_files_folder_tree($folders, 0, [], 100, 0);

        // Set view data
        $this->data['folders'] = $folders;
        $this->data['files_folders_tree'] = $files_folders_tree;

        // Load the view
        $this->render('file/index', $this->data);
    }

    /**
     * Import photos by AJAX - DROPZONE
     */
    public function upload()
    {
        // Run upload data method from upload controller
        $this->load->library('upload_nu');
        $upload_data = $this->upload_nu->do_upload($this->config->item('upload_folder'));

        if ($upload_data) {
            // Set data to insert
            $data = array(
                'real_file_name' => $upload_data['orig_name'],
                'file_name'      => $upload_data['file_name'],
                'size'           => $upload_data['file_size'],
                'description'    => $upload_data['client_name'],
                'alt'            => $upload_data['client_name'],
                'title'          => $upload_data['client_name'],
            );

            // Insert data
            if ($this->file->insert($data)) {
                $result = ['result' => 1];
            }
        } else {
            $result = [
                'result' => 0,
                'errors'  => strip_tags($this->upload->display_errors()),
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($result);
    }
}

/* End of file File_nu.php */
/* Location: ./application/modules/file/controllers/admin/File_nu.php */