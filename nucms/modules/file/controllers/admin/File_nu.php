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
        // Set view data
        $this->data['files_list'] = $this->files_list(0, 1);
        $this->data['folders_list'] = $this->folders_list(0, 1);

        // Check cutted files session
        $show_paste_button = false;

        if (isset($this->session->{$this->sessionName}['cutted'])) {
            $show_paste_button = true;
        }

        // Set view data
        $this->data['show_paste_button'] = $show_paste_button;

        // Load the view
        $this->render('file/index', $this->data);
    }

    /**
     * Files list in file manager (subview, loaded by AJAX)
     * 
     * @param int $parent_id
     * @param int $return (0, 1)
     * @return type
     */
    public function files_list($parent_id = 0, $return = 0)
    {
        // Set default variables
        $page = ($this->input->get('page')) ? $this->input->get('page') : 1;
        $per_page = ($this->input->get('per_page')) ? $this->input->get('per_page') : $this->config->item('default_admin_per_page');

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
            ->count_rows();
        $paginationLimits = $this->initPagination($numberOfItems, $page, $per_page, admin_url('file/files_list/'.$parent_id));

        $this->file->generate_like_query($this->input->get('string'));
        $files = $this->file
            ->where($where)
            ->order_by('created_at', 'DESC')
            ->limit($paginationLimits['limit'], $paginationLimits['limit_offset'])
            ->get_all();

        // Check cutted files session
        $cutted_files = array();

        if (isset($this->session->{$this->sessionName}['cutted'])) {
            $cutted_files = $this->session->{$this->sessionName}['cutted'];
        }

        // Set view data
        $data['files'] = $files;
        $data['pager'] = $this->pagination->create_links();
        $data['cutted_files'] = $cutted_files;

        // Load the view
        if ($return == 1) {
            return $this->render('file/list', $data, true);
        } else {
            $this->render('file/list', $data);
        }
    }

    /**
     * Folders list (subview, AJAX)
     *
     * @param type $active
     */
    public function folders_list($active = 0, $return = 0)
    {
        // Get folder list and prepare html tree
        $filesInHomeFolder = $this->file
            ->where(['parent_id' => null, 'type' => 0])
            ->count_rows();
        $folders = $this->file->get_folders();
        $files_folders_tree = generate_files_folder_tree($folders, 0, [$active], 100, 0, ['files_in_home_folder' => $filesInHomeFolder]);

        // Set view data
        $data['files_folders_tree'] = $files_folders_tree;

        // Load the view
        if ($return == 1) {
            return $this->render('file/folders', $data, true);
        } else {
            $this->render('file/folders', $data);
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
                'name' => $upload_data['file_name'],
                'filename' => $upload_data['file_name'],
                'size' => $upload_data['file_size'],
                'description' => $upload_data['client_name'],
                'alt' => $upload_data['client_name'],
                'title' => $upload_data['client_name'],
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
            $this->set_log(strip_tags($this->upload->display_errors()));
            $result = [
                'result' => 0,
                'errors' => strip_tags($this->upload->display_errors()),
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    /**
     * Delete checked files (AJAX)
     *
     * @throws Exception
     */
    public function delete_checked()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        if ($this->input->post('files')) {
            try {

                foreach ($this->input->post('files') as $file) {
                    if (!$this->file->delete($file)) {
                        throw new Exception(lang('file.alert.error.delete'));
                    }
                }

                $result = [
                    'result' => 1,
                ];
            } catch (Exception $exc) {

                $this->set_log($exc->getMessage());
                $result = [
                    'result' => 0,
                    'errors' => $exc->getMessage()
                ];
            }
        }

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    /**
     * Add folder by parent_id (AJAX)
     *
     * @param int $parent_id
     */
    public function add_folder($parent_id = 0)
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $data = [
            'type' => 1,
            'name' => lang('file.text.new_folder'),
            'parent_id' => ($parent_id > 0) ? (int) $parent_id : null,
        ];

        if ($this->file->insert($data)) {
            $result = [
                'result' => 1,
            ];
        } else {
            $this->set_log(lang('file.alert.error.add_folder'));
            $result = [
                'result' => 0,
                'errors' => lang('file.alert.error.add_folder')
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    /**
     * Save folder name (AJAX)
     *
     * @param int $id
     */
    public function save_folder($id)
    {
        if (!$this->input->is_ajax_request() || !$this->input->post()) {
            show_404();
        }

        $data = [
            'name' => $this->input->post('name'),
        ];

        if ($this->file->update($data, (int) $id)) {
            $result = [
                'result' => 1,
            ];
        } else {
            $this->set_log(lang('file.alert.error.save_folder'));
            $result = [
                'result' => 0,
                'errors' => lang('file.alert.error.save_folder')
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    /**
     * Delete folder by id (AJAX)
     *
     * @param int $id
     */
    public function delete_folder($id)
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        if ($this->file->delete($id)) {
            $result = [
                'result' => 1,
            ];
        } else {
            $this->set_log(lang('file.alert.error.delete_folder'));
            $result = [
                'result' => 0,
                'errors' => lang('file.alert.error.delete_folder')
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    /**
     * Cut the file
     *
     * @param int $id
     */
    public function cut($id, $ajax = 1)
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $current_session = $this->session->{$this->sessionName};

        if (!isset($current_session['cutted'][$id])) {
            $current_session['cutted'][$id] = $id;
        }

        $this->session->set_userdata($this->sessionName, $current_session);

        if ($ajax) {

            $result = [
                'result'  => 1,
                'message' => lang('file.alert.success.cut')
            ];

            header('Content-Type: application/json');
            echo json_encode($result);
        }
    }

    /**
     * Cut checked files (AJAX)
     *
     * @throws Exception
     */
    public function cut_checked()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        if ($this->input->post('files')) {
            foreach ($this->input->post('files') as $file) {
                $this->cut($file, 0);
            }

            $result = [
                'result' => 1,
                'files' => $this->input->post('files'),
                'message' => lang('file.alert.success.cut_checked'),
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    /**
     * Paste cutted files
     */
    public function paste($parent_id)
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $current_files_session = $this->session->{$this->sessionName};
        $cutted_files = false;

        if (isset($current_files_session['cutted'])) {
            $cutted_files = $current_files_session['cutted'];
            unset($current_files_session['cutted']);
        }

        if ($cutted_files) {

            try {

                foreach ($cutted_files as $file) {
                    $update_data = array(
                        'parent_id' => ($parent_id != 0) ? (int) $parent_id : null
                    );

                    if (!$this->file->update($update_data, $file)) {
                        throw new Exception(lang('file.alert.error.paste'));
                    }
                }

                // unset cutted files session
                $this->session->set_userdata($this->sessionName, $current_files_session);

                $result = [
                    'result'  => 1,
                    'message' => lang('file.alert.success.paste')
                ];
            } catch (Exception $exc) {

                $this->set_log($exc->getMessage());
                $result = [
                    'result' => 0,
                    'errors' => $exc->getMessage()
                ];
            }

        }

        header('Content-Type: application/json');
        echo json_encode($result);
    }
    
    public function modal()
    {
        // Set view data
        $this->data['files_list'] = $this->files_list(0, 1);
        $this->data['folders_list'] = $this->folders_list(0, 1);

        // Check cutted files session
        $show_paste_button = false;

        if (isset($this->session->{$this->sessionName}['cutted'])) {
            $show_paste_button = true;
        }

        // Set view data
        $this->data['show_paste_button'] = $show_paste_button;

        // Load the view
        $this->render('file/modal', $this->data);
    }
}

/* End of file File_nu.php */
/* Location: ./application/modules/file/controllers/admin/File_nu.php */