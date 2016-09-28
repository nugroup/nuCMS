<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class User_nu
 */
class User_nu extends Backend_Controller
{
    private $sessionName = 'user';

    public function __construct()
    {
        parent::__construct();

        // Load classes
        $this->lang->load('user', config_item('selected_locale'));
        $this->load->model('user/user_model', 'user');
    }

    /**
     * List of all users
     */
    public function index()
    {
        // Set page
        $page = ($this->input->get('page')) ? $this->input->get('page') : 1;
        $per_page = ($this->input->get('per_page')) ? $this->input->get('per_page') : $this->config->item('default_admin_per_page');
        $this->setReturnLink($this->sessionName);

        // Delete checked item
        if ($this->input->post('action') == 'delete_checked') {
            foreach ($this->input->post('check_item') as $item => $value) {
                // Delete action
                $this->user->delete($item);
            }

            // Set message and refresh the page
            $this->session->set_flashdata('success', lang('alert.success.delete_checked'));
            redirect(current_url());
        }

        // Get number of items for pager
        $this->user->generate_like_query($this->input->get('string'));
        $numberOfItems = $this->user->count_rows();

        // Init pagination
        $paginationLimits = $this->initPagination($numberOfItems, $page, $per_page);

        // Get users
        $this->user->generate_like_query($this->input->get('string'));
        $users = $this->user->limit($paginationLimits['limit'], $paginationLimits['limit_offset'])->get_all();

        // Set view data
        $this->data['page'] = $page;
        $this->data['users'] = $users;
        $this->data['pager'] = $this->pagination->create_links();
        $this->data['subnav_active'] = 'index';

        // Load the view
        $this->render('user/index', $this->data);
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

        // Get groups
        $groups = $this->ion_auth->groups()->result_array();
        $current_groups = $this->ion_auth->get_users_groups($id)->result();

        // If post is send
        if ($this->input->post()) {

            // Valid csrf tokken
            if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id')) {
                show_error($this->lang->line('error_csrf'));
            }

            // Set the validation rules
            $this->form_validation->set_rules($this->user->get_rules('edit', $id));

            if ($this->form_validation->run() == TRUE) {
                // Set data to insert
                $data_update = array(
                    'first_name' => $this->input->post('first_name', true),
                    'last_name'  => $this->input->post('last_name', true),
                    'email'      => $this->input->post('email', true),
                );

                // If password is not empty
                if ($this->input->post('password')) {
                    $data_update['password'] = $this->input->post('password');
                }

                // Update the groups user belongs to
                $group_data = $this->input->post('groups');

                $this->ion_auth->remove_from_group('', $id);
                if (isset($group_data) && !empty($group_data)) {

                    foreach ($group_data as $group) {
                        $this->ion_auth->add_to_group($group, $id);
                    }
                }

                // Update
                if ($this->ion_auth->update($user->id, $data_update)) {
                    // Set informations
                    $this->session->set_flashdata('success', lang('alert.success.saved_changes'));

                    // Redirect
                    redirect(admin_url('user/edit/'.$id));
                }
            }
        }

        // Get csrf tokken
        $csrf = $this->_get_csrf_nonce();

        // Set view data
        $this->data['user'] = $user;
        $this->data['groups'] = $groups;
        $this->data['current_groups'] = $current_groups;
        $this->data['csrf'] = $csrf;
        $this->data['return_link'] = $this->getReturnLink($this->sessionName);

        // Load the view
        $this->render('user/edit', $this->data);
    }

    /**
     * Add new user
     */
    public function add()
    {
        // If post is send
        if ($this->input->post()) {

            $this->form_validation->set_rules($this->user->get_rules('insert'));
            if ($this->form_validation->run() == true)
            {
                $additional_data = [
                    'first_name' => $this->input->post('first_name', true),
                    'last_name' => $this->input->post('last_name', true),
                ];

                $inserted_id = $this->ion_auth->register($this->input->post('email'), $this->input->post('password'), $this->input->post('email'), $additional_data, array());

                if ($inserted_id) {
                    // Set informations
                    $this->session->set_flashdata('success', lang('user.alert.success.add'));

                    // Update the groups user belongs to
                    $group_data = $this->input->post('groups');

                    if (isset($group_data) && !empty($group_data)) {
                        $this->ion_auth->remove_from_group('', $inserted_id);

                        foreach ($group_data as $group) {
                            $this->ion_auth->add_to_group($group, $inserted_id);
                        }
                    }

                    // Redirect
                    redirect(admin_url('user'));
                }
            }
        }

        // Get groups list
        $groups = $this->ion_auth->groups()->result_array();

        // Set view data
        $this->data['return_link'] = $this->getReturnLink($this->sessionName);
        $this->data['groups'] = $groups;

        // Load the view
        $this->render('user/add', $this->data);
    }

    /**
     * Delete action (by AJAX)
     *
     * @throws Exception
     */
    public function delete()
    {
        if ($this->input->post('id_item')) {
            $id = $this->input->post('id_item');
            if ($id > 0) {
                try {
                    // Check if not logged in
                    if ($id == $this->session->user_id) {
                        throw new Exception(lang('user.alert.error.self_delete'));
                    }
                    // Delete user
                    if (!$this->user->delete($id)) {
                        throw new Exception(lang('user.alert.error.delete'));
                    }

                    // Set response data
                    $result['message'] = lang('user.alert.success.delete');
                    $result['status'] = 1;
                } catch (Exception $ex) {
                    // Log error message
                    $this->set_log($ex->getMessage());

                    // Set response data
                    $result['errors'] = $ex->getMessage();
                    $result['status'] = 0;
                }
            }
        }

        // Send header and response data
        header('Content-Type: application/json');
        echo json_encode(array('results' => $result));
        exit;
    }

    /**
     * Create CSRF tokken
     *
     * @return array
     */
    private function _get_csrf_nonce()
    {
        $this->load->helper('string');
        $key = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);

        return array($key => $value);
    }

    /**
     * Valid CSRF tokken
     *
     * @return boolean
     */
    private function _valid_csrf_nonce()
    {
        if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
            $this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue')) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}

/* End of file Admin_users.php */
/* Location: ./application/modules/user/controllers/admin/Admin_users.php */