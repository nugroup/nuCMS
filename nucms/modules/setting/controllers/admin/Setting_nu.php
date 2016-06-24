<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class Setting_nu
 */
class Setting_nu extends Backend_Controller {

    private $sessionName = 'setting';

    public function __construct() {
        parent::__construct();

        // Load classes
        $this->load->model('setting/setting_model', 'setting');
        $this->load->model('setting/setting_groups_model', 'setting_groups');
        $this->lang->load('setting', config_item('selected_lang'));
    }

    /**
     * Default setting for website
     */
    public function index() {
        $locale = ($this->input->get('locale')) ? $this->input->get('locale') : config_item('default_locale');

        // Get setting and preare array for view
        $settings_by_groups = array();
        $settings = $this->setting
                ->get_all();
        $settings_translations = $this->setting_translations
                ->where('locale', $locale)
                ->get_all();

        if ($settings) {
            $settings = array_to_array_by_key_single($settings, 'id');
            $settings_translations = array_to_array_by_key_single($settings_translations, 'setting_id');
            $settings_by_groups = array_to_array_by_key($settings, 'group_id');
            
            foreach ($settings_translations as $translation) {
                $settings[$translation->setting_id]->key = $translation->key;
                $settings[$translation->setting_id]->value = $translation->value;
            }
        }
        
        // get settings groups
        $setting_groups = $this->setting_groups->get_all();

        if ($this->input->post()) {
            try {
                foreach ($this->input->post('settings') as $id => $setting) {
                    $update_data = array(
                        'value' => $setting['value']
                    );

                    if ($setting['global'] == 1) {
                        if (!$this->setting->update($update_data, $id)) {
                            throw new Exception(lang('setting.alert.error.update'));
                        }
                    } else {
                        if (!$this->setting_translations->update($update_data, array('setting_id' => $id, 'locale' => $locale))) {
                            throw new Exception(lang('setting.alert.error.update'));
                        }
                    }
                }

                $this->session->set_flashdata('success', lang('alert.success.saved_changes'));
            } catch (Exception $ex) {
                // Log error message
                $this->set_log($ex->getMessage());

                // Set flashdata
                $this->session->set_flashdata('error', $ex->getMessage());
            }

            // Redirect
            redirect(current_full_url());
        }

        // Set view data
        $this->data['settings'] = $settings;
        $this->data['settings_by_groups'] = $settings_by_groups;
        $this->data['settings_groups'] = $setting_groups;
        $this->data['subnav_active'] = 'index';
        $this->data['selected_locale'] = $this->config->item($locale, 'system_languages_by_locale')->locale;

        // Load the view
        $this->render('setting/index', $this->data);
    }

}

/* End of file Setting_nu.php */
/* Location: ./application/modules/setting/controllers/admin/Setting_nu.php */