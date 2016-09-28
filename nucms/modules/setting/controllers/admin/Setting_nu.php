<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class Setting_nu
 */
class Setting_nu extends Backend_Controller
{
    private $sessionName = 'setting';

    public function __construct()
    {
        parent::__construct();

        // Load classes
        $this->load->model('setting/setting_model', 'setting');
        $this->load->model('setting/setting_groups_model', 'setting_groups');
        $this->load->model('page/page_translations_model', 'page_translations');
        $this->load->helper('setting/setting');
        $this->lang->load('setting', config_item('selected_locale'));
    }

    /**
     * Default setting for website
     */
    public function index()
    {
        $locale = ($this->input->get('locale')) ? $this->input->get('locale') : config_item('default_locale');

        // Get setting and preare array for view
        $setting_groups = $this->setting_groups->get_all();
        $settings_by_keys = array();
        $settings_by_groups = array();
        $settings = $this->setting
            ->get_all();
        $settings_translations = $this->setting_translations
            ->where('locale', $locale)
            ->get_all();

        // Get pages list
        $pages = $this->page_translations
            ->where('locale', $locale)
            ->where('active', 1)
            ->get_all();

        if ($settings) {
            $settings = array_to_array_by_key_single($settings, 'id');
            $settings_by_keys = array_to_array_by_key_single($settings, 'key');
            $settings_by_groups = array_to_array_by_key($settings, 'group_id');

            if ($settings_translations) {
                $settings_translations = array_to_array_by_key_single($settings_translations, 'setting_id');
                foreach ($settings_translations as $translation) {
                    $settings[$translation->setting_id]->value = $translation->value;
                }
            }
        }

        if ($this->input->post()) {
            $this->save_settings($locale);
        }

        // Set view data
        $this->data['settings'] = $settings;
        $this->data['settings_by_keys'] = $settings_by_keys;
        $this->data['settings_by_groups'] = $settings_by_groups;
        $this->data['settings_groups'] = $setting_groups;
        $this->data['subnav_active'] = 'index';
        $this->data['selected_locale'] = $this->config->item($locale, 'system_languages_by_locale')->locale;
        $this->data['pages_options'] = obj_to_options_array($pages, 'page_id', 'title');

        // Load the view
        $this->render('setting/index', $this->data);
    }

    /**
     * Update or insert settings action
     * 
     * @throws Exception
     */
    private function save_settings($locale)
    {
        try {
            foreach ($this->input->post('settings') as $key => $setting) {

                // Check if settings exist
                $setting_exist = $this->setting->get(array('key' => $key));

                if ($setting['global'] == 1) {
                    // Global variable
                    $new_data = array(
                        'key' => $key,
                        'value' => $setting['value'],
                        'type' => $setting['type'],
                        'global' => $setting['global'],
                        'name' => $setting['name'],
                    );

                    if ($setting_exist) {
                        // var exists
                        $this->setting->update($new_data, array('key' => $key));
                    } else {
                        // var no exists
                        $inserted_id = $this->setting->insert($new_data);
                        if (!$inserted_id) {
                            throw new Exception(lang('setting.alert.error.update'));
                        }
                    }
                } else {
                    // Language variable
                    if ($setting_exist) {
                        // var exists
                        $update_data = array(
                            'value' => $setting['value'],
                        );
                        $this->setting_translations->update($update_data, array('setting_id' => $setting_exist->id, 'locale' => $locale));
                    } else {

                        // var no exists
                        $new_data = array(
                            'key' => $key,
                            'type' => $setting['type'],
                            'global' => $setting['global'],
                            'name' => $setting['name'],
                        );

                        $inserted_id = $this->setting->insert($new_data);
                        if (!$inserted_id) {
                            throw new Exception(lang('setting.alert.error.update'));
                        }

                        foreach (config_item('system_languages') as $lang) {
                            $new_data_lang = array(
                                'value' => $setting['value'],
                                'locale' => $lang->locale,
                                'setting_id' => $inserted_id,
                            );
                            if (!$this->setting_translations->insert($new_data_lang)) {
                                throw new Exception(lang('setting.alert.error.update'));
                            }
                        }
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
}

/* End of file Setting_nu.php */
/* Location: ./application/modules/setting/controllers/admin/Setting_nu.php */