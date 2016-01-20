<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class Admin_language
 */
class Admin_language extends Backend_Controller
{
    private $sessionName = 'language';

    public function __construct()
    {
        parent::__construct();

        // Load classes
        $this->load->model('language/language_model', 'language');
        $this->lang->load('language', config_item('selected_lang'));
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
                $this->language->delete($item);
            }

            // Set message and refresh the page
            $this->session->set_flashdata('success', lang('alert.success.delete_checked'));
            redirect(current_url());
        }

        // Get number of items for pager
        $this->language->generate_like_query($this->input->get('string'));
        $numberOfItems = $this->language->count();

        // Init pagination
        $paginationLimits = $this->initPagination($numberOfItems, $page);

        // Get languages
        $this->language->generate_like_query($this->input->get('string'));
        $languages = $this->language->limit($paginationLimits['limit'], $paginationLimits['limit_offset'])->get_all();

        // Set view data
        $this->data['languages'] = $languages;
        $this->data['pager'] = $this->pagination->create_links();
        $this->data['subnav_active'] = 'index';

        // Load the view
        $this->render('language/index', $this->data);
    }

    /**
     * Edit single language
     *
     * @param int $id
     */
    public function edit($id)
    {
        $language = $this->language->get($id);
        if (!$language) {
            show_404();
        }

        // If post is send
        if ($this->input->post()) {
            $result = $this->language->from_form($this->language->get_rules('update'), NULL, array('id' => $id))->update();

            if ($result) {
                // Set informations
                $this->session->set_flashdata('success', lang('alert.success.saved_changes'));

                // Redirect
                redirect(admin_url('language/edit/'.$id));
            }
        }

        // Set view data
        $this->data['language'] = $language;
        $this->data['subnav_active'] = 'edit';
        $this->data['return_link'] = $this->getReturnLink($this->sessionName);

        // Load the view
        $this->render('language/edit', $this->data);
    }

    /**
     * Add new language
     */
    public function add()
    {
        // If post is send
        if ($this->input->post()) {
            $inserted_id = $this->language->from_form($this->language->get_rules('add'))->insert();

            if ($inserted_id) {
                // Set informations
                $this->session->set_flashdata('success', lang('language.alert.success.add'));

                // Redirect
                redirect(admin_url('language'));
            }
        }

        // Set view data
        $this->data['subnav_active'] = 'add';
        $this->data['return_link'] = $this->getReturnLink($this->sessionName);

        // Load the view
        $this->render('language/add', $this->data);
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
        // unset template (we dont need to load footer)
        $this->output->unset_template();

        $name = $this->input->post('name');
        $value = (int) $this->input->post('value');

        // Set data view to checked or not checked
        $data[$name] = $value;

        // Update the view
        if ($this->language->update($data, (int) $id)) {
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
        // Unset template
        $this->output->unset_template();

        if ($this->input->post('id_item')) {
            $id = $this->input->post('id_item');
            if ($id > 0) {
                try {
                    // Delete language
                    if (!$this->language->delete($id)) {
                        throw new Exception(lang('language.alert.error.delete'));
                    }

                    // Set response data
                    $result['message'] = lang('language.alert.success.delete');
                    $result['status'] = 1;
                } catch (Exception $ex) {
                    // Log error message
                    log_message('error', "Line: ".__LINE__."\nFile: ".__FILE__."\n".$ex->getMessage());

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

/* End of file Admin_language.php */
/* Location: ./application/modules/controllers/admin/Admin_language.php */