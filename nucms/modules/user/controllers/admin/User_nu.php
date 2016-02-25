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
        $this->lang->load('user', config_item('selected_lang'));
        $this->load->model('user/user_model', 'user');
    }

    /**
     * List of all users
     */
    public function index()
    {
        // Set page
        $page = ($this->input->get('page')) ? $this->input->get('page') : 1;
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
        $numberOfItems = $this->user->count();

        // Init pagination
        $paginationLimits = $this->initPagination($numberOfItems, $page);

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
    public function edit($id, $test=0, $test2=0)
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
                    $this->session->set_flashdata('success', lang('alert.success.saved_changes'));

                    // Redirect
                    redirect(admin_url('user/edit/'.$id));
                }
            }
        }

        // Set view data
        $this->data['user'] = $user;
        $this->data['subnav_active'] = 'edit';
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
            $inserted_id = $this->user->from_form($this->user->get_rules('insert'))->insert();

            if ($inserted_id) {
                // Set informations
                $this->session->set_flashdata('success', lang('user.alert.success.add'));

                // Redirect
                redirect(admin_url('user'));
            }
        }

        // Set view data
        $this->data['subnav_active'] = 'add';
        $this->data['return_link'] = $this->getReturnLink($this->sessionName);

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
                    $result['message'] = $ex->getMessage();
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