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

    /**
     * File manager index view
     */
    public function index()
    {
        // Get folder list and prepare html tree
        $filesInHomeFolder = $this->file
            ->where(['parent_id' => null, 'type' => 0])
            ->count();
        $folders = $this->file->get_folders();
        $files_folders_tree = generate_files_folder_tree($folders, 0, [0], 100, 0, ['files_in_home_folder' => $filesInHomeFolder]);

        // Set view data
        $this->data['folders'] = $folders;
        $this->data['files_list'] = $this->files_list(0, 1);
        $this->data['files_folders_tree'] = $files_folders_tree;

        // Load the view
        $this->render('file/index', $this->data);
    }

    /**
     * Files list in file manager (subview, loaded by AJAX)
     *
     * @param int $parent_id
     */
    public function files_list($parent_id = 0, $return = 0)
    {
        // Set default variables
        $page = ($this->input->get('page')) ? $this->input->get('page') : 1;

        // Get files list
        $where = [
            'type' => 0,
        ];

        if ($this->input->get('string')) {
            $this->file->generate_like_query($this->input->get('string'));
        } else {
            $where['parent_id'] = ($parent_id != 0) ? (int) $parent_id : null;
        }

        $numberOfItems = $this->file
            ->where($where)
            ->count();
        $paginationLimits = $this->initPagination($numberOfItems, $page, 9, admin_url('file/files_list/'.$parent_id));

        $this->file->generate_like_query($this->input->get('string'));
        $files = $this->file
            ->where($where)
            ->order_by('created_at', 'DESC')
            ->limit($paginationLimits['limit'], $paginationLimits['limit_offset'])
            ->get_all();

        // Set view data
        $data['files'] = $files;
        $data['pager'] = $this->pagination->create_links();

        // Load the view
        if ($return == 1) {
            return $this->render('file/list', $data, true);
        } else {
            $this->render('file/list', $data);
        }
    }

    /**
     * Import photos by AJAX - DROPZONE
     */
    public function upload()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        // Run upload data method from upload controller
        $this->load->library('upload_nu');
        $upload_data = $this->upload_nu->do_upload($this->config->item('upload_folder'));

        if ($upload_data) {
            // Set data to insert
            $data = array(
                'name'           => $upload_data['file_name'],
                'filename'       => $upload_data['file_name'],
                'size'           => $upload_data['file_size'],
                'description'    => $upload_data['client_name'],
                'alt'            => $upload_data['client_name'],
                'title'          => $upload_data['client_name'],
            );

            if ((int) $this->input->post('parent_id')) {
                $data['parent_id'] = (int) $this->input->post('parent_id');
            }

            // Insert data
            if ($this->file->insert($data)) {
                $result = [
                    'result' => 1,
                    'parent_id' => (int) $this->input->post('parent_id')
                ];
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