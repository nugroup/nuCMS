<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class Admin_user
 */
class Admin_user extends Backend_Controller
{
    public function __construct()
    {
        parent::__construct();

        // View data
        $this->data['nu_title'] = lang('user');
        $this->data['subnav_active'] = array(
            'index' => FALSE,
            'add' => FALSE,
            'edit' => FALSE
        );

        // Load classes
        $this->load->model('user/user_model', 'user');
        $this->lang->load('user', config_item('selected_lang'));
    }

    /**
     * List of all users
     */
    public function index()
    {
        // Set page
        $page = ($this->input->get('page')) ? $this->input->get('page') : 1;
        $this->session->set_userdata('user_return_link', config_item('base_url_301').$this->input->server('REQUEST_URI'));

        // Delete checked item
        if ($this->input->post('action') == 'delete_checked') {
            foreach ($this->input->post('check_item') as $item => $value) {
                // Delete action
                $this->user->delete($item);
            }

            // Set message and refresh the page
            $this->session->set_flashdata('success', lang('delete_checked_items'));
            redirect(current_url());
        }

        // Get users
        $this->user->generate_like_query($this->input->get('string'));
        $numberOfUsers = $this->user->count();

        // Pagiation
        $this->load->library('pagination');
        $config['base_url'] = current_url();
        $config['total_rows'] = $numberOfUsers;
        $config['per_page'] = $this->session->userdata('admin_per_page');
        $config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'page';
        $config['reuse_query_string'] = TRUE;
        $this->pagination->initialize($config);

        // Set limits
        $params['limit_offset'] = ($page * $config["per_page"]) - $config["per_page"];
        $params['limit'] = $config["per_page"];

        // Get users
        $this->user->generate_like_query($this->input->get('string'));
        $users = $this->user->limit($params['limit'], $params['limit_offset'])
            ->get_all();

        // Set view data
        $this->data['page'] = $page;
        $this->data['users'] = $users;
        $this->data['subnav_active']['index'] = TRUE;

        // Load the view
        $this->load->view('user/index', $this->data);
    }

    /**
     * Edit single user
     *
     * @param int $id
     */
    public function edit($id)
    {
        $user = $this->user->get($id);
        if (!$user) {
            show_404();
        }

        // If post is send
        if ($this->input->post()) {
            // Set the validation rules
            $this->form_validation->set_rules($this->user->get_rules('edit', $id));

            if ($this->form_validation->run() == TRUE) {
                // Set data to insert
                $dataUpdate = array(
                    'name' => $this->security->xss_clean($this->input->post('name')),
                    'login' => $this->security->xss_clean($this->input->post('login')),
                    'email' => $this->security->xss_clean($this->input->post('email'))
                );

                // If password is not empty
                if ($this->input->post('password')) {
                    $dataUpdate['password'] = $this->auth->hash($this->input->post('password'));
                }

                // Update
                if ($this->user->update($dataUpdate, $id)) {
                    // Set informations
                    $this->session->set_flashdata('success', lang('save_changes'));

                    // Redirect
                    redirect(config_item('admin_url').'/user/edit/'.$id);
                }
            }
        }

        // Set view data
        $this->data['user'] = $user;
        $this->data['subnav_active']['edit'] = TRUE;
        $this->data['return_link'] = ($this->session->user_return_link) ? $this->session->user_return_link : config_item('admin_url').'users';

        // Load the view
        $this->load->view('user/edit', $this->data);
    }

    /**
     * Add new user
     */
    public function add()
    {
        // If post is send
        if ($this->input->post()) {
            $inserted_id = $this->user->from_form($this->user->get_rules('add'))->insert();
            if ($inserted_id) {
                // Set informations
                $this->session->set_flashdata('success', lang('success_add_user'));

                // Redirect
                redirect(config_item('admin_url').'/user');
            }
        }

        // Set view data
        $this->data['subnav_active']['add'] = TRUE;
        $this->data['return_link'] = ($this->session->user_return_link) ? $this->session->user_return_link : config_item('admin_url').'user';

        // Load the view
        $this->load->view('user/add', $this->data);
    }

    /**
     * Delete action (by AJAX)
     *
     * @throws Exception
     */
    public function delete()
    {
        // Unset template
        $this->output->unset_template();

        if ($this->input->post('id_item')) {
            $id = $this->input->post('id_item');
            if ($id > 0) {
                try {
                    // Delete user
                    if (!$this->user->delete($id)) {
                        throw new Exception(lang('user_delete_error'));
                    }

                    // Set response data
                    $result['message'] = lang('user_was_deleted');
                    $result['status'] = 1;
                } catch (Exception $ex) {
                    // Log error message
                    log_message('error', "Line: ".__LINE__."\nFile: ".__FILE__."\n".$ex->getMessage());

                    // Set response data
                    $result['message'] = lang('user_delete_error');
                    $result['status'] = 0;
                }
            }
        }

        // Send header and response data
        header('Content-Type: application/json');
        echo json_encode(array('results' => $result));
        exit;
    }
}

/* End of file Admin_users.php */
/* Location: ./application/modules/user/controllers/admin/Admin_users.php */

