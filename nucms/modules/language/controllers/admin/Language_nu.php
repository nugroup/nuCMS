<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class Language_nu
 */
class Language_nu extends Backend_Controller
{
    private $sessionName = 'language';

    public function __construct()
    {
        parent::__construct();

        // Load classes
        $this->lang->load('language', config_item('selected_lang'));
        $this->load->model('language/language_model', 'language');
    }

    /**
     * List of languages
     */
    public function index()
    {
        // Set page
        $page = ($this->input->get('page')) ? $this->input->get('page') : 1;
        $this->setReturnLink($this->sessionName);

        // Delete checked item
        if ($this->input->post('action') == 'delete_checked') {
            try {
                foreach ($this->input->post('check_item') as $item => $value) {

                    $language = $this->language->get($item);

                    if ($language && $language->default == 1) {
                        throw new Exception(lang('language.alert.error.delete_default'));
                    }

                    // Delete action
                    $this->language->delete($item);
                }

                // Set message and refresh the page
                $this->session->set_flashdata('success', lang('alert.success.delete_checked'));
            } catch (Exception $ex) {
                // Log error message
                $this->set_log($ex->getMessage());
                $this->session->set_flashdata('error', $ex->getMessage());

            }

            redirect(current_url());
        }

        // Get number of items for pager
        $this->language->generate_like_query($this->input->get('string'));
        $numberOfItems = $this->language->count_rows();

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

            // Uncheck all language as default if default is checked in current
            if ($this->input->post('default')) {
                $this->language->update(['default' => 0]);
            }

            $result = $this->language->from_form(NULL, [], array('id' => $id))->update();

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
            // Uncheck all language as default if default is checked in current
            if ($this->input->post('default')) {
                $this->language->update(['default' => 0]);
            }

            // Additional data
            $additional_data = [
                'active'  => (int) $this->input->post('active'),
                'default' => (int) $this->input->post('default'),
            ];

            $inserted_id = $this->language->from_form(null, $additional_data)->insert();

            if ($inserted_id) {
                // Set informations
                $this->session->set_flashdata('success', lang('language.alert.success.add'));

                // Redirect
                redirect(admin_url('language/update_translations/'.$inserted_id));
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
        $name = $this->input->post('name');
        $value = (int) $this->input->post('value');

        // Set data view to checked or not checked
        $data[$name] = $value;

        // Update the view
        if ($this->language->update($data, (int) $id)) {
            $result = ['result' => 1];
        } else {
            $result = ['result' => 0];
        }

        header('Content-Type: application/json');
        echo json_encode($result);

        return FALSE;
    }

    /**
     * Update translations elements view
     *
     * @param int $id
     */
    public function update_translations($id)
    {
        $language = $this->language->get($id);
        if (!$language) {
            show_404();
        }

        // Set view data
        $this->data['language'] = $language;

        // Load the view
        $this->render('language/update_translations', $this->data);
    }

    /**
     * Update translations elements action
     * 50 items from 1 table on 1 reload
     *
     * @param int $id
     * @param int $limit
     */
    public function update_translations_action($id, $limit = 50)
    {
        $language = $this->language->get($id);
        if (!$language) {
            show_404();
        }

        $done = true;

        // Start update all translations table set in config
        foreach ($this->config->item('languages_tables') as $table) {
            $model_name = str_replace('nu_', '', $table);
            $this->load->model($model_name.'/'.$model_name.'_model', $model_name);
            $table_name = $table.'_translations';
            $model_translation_name = $model_name.'_translations';

            // Get empty elements
            $root_translations = $this->db
                ->select('A.*')
                ->from($table_name.' as A')
                ->where('locale', config_item('default_locale'))
                ->where('NOT EXISTS (SELECT `'.$model_name.'_id` FROM `'.$table_name.'` WHERE `locale` = "'.$language->locale.'" AND `'.$model_name.'_id` = `A`.`'.$model_name.'_id`)', null, false)
                ->limit($limit)
                ->get()
                ->result();

            try {

                if ($root_translations) {
                    $done = false;

                    foreach ($root_translations as $row) {
                        // Change needed values
                        $tmpRow = $row;
                        unset($tmpRow->id);
                        if (isset($tmpRow->active)) {
                            $tmpRow->active = 0;
                        }
                        $tmpRow->locale = $language->locale;

                        // Insert translation
                        if (!$this->{$model_translation_name}->insert($tmpRow)) {
                            throw new Exception(lang('language.alert.error.insert_translation'));
                        }
                    }

                }

            } catch (Exception $exc) {

                // Error
                $this->set_log($exc->getMessage());
                $result = [
                    'result' => 0,
                    'errors' => $exc->getMessage()
                ];

            }
        }

        if ($done) {
            // Success
            $result = [
                'result' => 1,
            ];
        } else {
            // In progress ...
            $result = [
                'result' => 2,
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($result);
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
                    $language = $this->language->get($id);

                    if ($language && $language->default == 1) {
                        throw new Exception(lang('language.alert.error.delete_default'));
                    }

                    // Delete language
                    if (!$this->language->delete($id)) {
                        throw new Exception(lang('language.alert.error.delete'));
                    }

                    // Set response data
                    $result = [
                        'status'  => 1,
                        'message' => lang('language.alert.success.delete')
                    ];
                } catch (Exception $ex) {
                    // Log error message
                    $this->set_log($ex->getMessage());

                    // Set response data
                    $result = [
                        'status' => 0,
                        'errors' => $ex->getMessage(),
                    ];
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
/* Location: ./application/modules/language/controllers/admin/Admin_language.php */