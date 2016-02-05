<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class Admin_menu
 */
class Admin_menu extends Backend_Controller
{
    private $sessionName = 'menu';

    public function __construct()
    {
        parent::__construct();

        // Load classes
        $this->lang->load('menu', config_item('selected_lang'));
        $this->config->load('menu/menu', TRUE);
        $this->load->model('menu/menu_model', 'menu');
    }

    public function index()
    {
        // Set page
        $page = ($this->input->get('page')) ? $this->input->get('page') : 1;
        $this->setReturnLink($this->sessionName);

        // Delete checked item
        if ($this->input->post('action') == 'delete_checked') {
            foreach ($this->input->post('check_item') as $item => $value) {
                // Delete action
                $this->menu->delete($item);
            }

            // Set message and refresh the page
            $this->session->set_flashdata('success', lang('alert.success.delete_checked'));
            redirect(current_url());
        }

        // Get number of items for pager
        $this->menu->generate_like_query($this->input->get('string'));
        $numberOfItems = $this->menu->count();

        // Init pagination
        $paginationLimits = $this->initPagination($numberOfItems, $page);

        // Get menus
        $this->menu->generate_like_query($this->input->get('string'));
        $menus = $this->menu->limit($paginationLimits['limit'], $paginationLimits['limit_offset'])->get_all();

        // Set view data
        $this->data['menus'] = $menus;
        $this->data['pager'] = $this->pagination->create_links();
        $this->data['subnav_active'] = 'index';

        // Load the view
        $this->render('menu/index', $this->data);
    }

    /**
     * Edit single menu
     *
     * @param int $id
     */
    public function edit($id)
    {
        $menu = $this->menu->get($id);
        if (!$menu) {
            show_404();
        }

        // If post is send
        if ($this->input->post()) {

            $result = $this->menu->from_form(NULL, [], array('id' => $id))->update();

            if ($result) {
                // Set informations
                $this->session->set_flashdata('success', lang('alert.success.saved_changes'));

                // Redirect
                redirect(admin_url('menu/edit/'.$id));
            }
        }

        // Set view data
        $this->data['menu'] = $menu;
        $this->data['subnav_active'] = 'edit';
        $this->data['return_link'] = $this->getReturnLink($this->sessionName);

        // Load the view
        $this->render('menu/edit', $this->data);
    }

    /**
     * Add new menu
     */
    public function add()
    {
        // If post is send
        if ($this->input->post()) {
            $inserted_id = $this->menu->from_form()->insert();

            if ($inserted_id) {
                // Set informations
                $this->session->set_flashdata('success', lang('menu.alert.success.add'));

                // Redirect
                redirect(admin_url('menu'));
            }
        }

        // Set view data
        $this->data['subnav_active'] = 'add';
        $this->data['return_link'] = $this->getReturnLink($this->sessionName);

        // Load the view
        $this->render('menu/add', $this->data);
    }

    /**
     * Update active by AJAX (onclick)
     *
     * @param int $id
     * @param string $field
     * @return boolean
     */
    public function update_active($id)
    {
        $name = $this->input->post('name');
        $value = (int) $this->input->post('value');

        // Set data view to checked or not checked
        $data[$name] = $value;

        // Update the view
        if ($this->menu->update($data, (int) $id)) {
            echo $this->db->last_query();
            $result = ['result' => 1];
        } else {
            $result = ['result' => 0];
        }

        header('Content-Type: application/json');
        echo json_encode($result);

        return FALSE;
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
                    // Delete menu
                    if (!$this->menu->delete($id)) {
                        throw new Exception(lang('menu.alert.error.delete'));
                    }

                    // Set response data
                    $result['message'] = lang('menu.alert.success.delete');
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

/* End of file Admin_menu.php */
/* Location: ./application/modules/menu/controllers/admin/Admin_menu.php */