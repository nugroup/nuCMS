<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class Frontend_Controller
 */
class Frontend_Controller extends NU_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();

        // Load needed config
        $this->load->config('app');

        // Set default languages data
        $this->set_language();

        // Set default setting data
        $this->set_setting();

        // Check profiler status
        if ($this->config->item('profiler') && ENVIRONMENT == 'development') {
            $this->output->enable_profiler();
        }

        $this->config->set_item('first_run', false);
    }

    /**
     * Set default setting from db
     */
    private function set_setting()
    {
        $this->load->model('setting/setting_model', 'setting');

        $this->data['settings'] = $this->setting->get_settings_for_front(config_item('selected_locale'));
    }

    /**
     * Set default language from db
     */
    private function set_language()
    {
        $this->load->model('language/language_model', 'language');

        // Get list of languages
        $languages = $this->language->get_all();
        if ($languages) {
            foreach ($languages as $language) {
                $locales[$language->locale] = $language;
                if ($language->default == 1) {
                    $this->config->set_item('default_locale', $language->locale);
                    $this->config->set_item('selected_locale', $language->locale);
                }
            }

            $this->config->set_item('languages', $languages);
            $this->config->set_item('languages_by_locale', $locales);
        }

        // Change languages config if session checked
        if ($this->session->selected_locale && $this->session->selected_locale != config_item('default_locale')) {
            $this->config->set_item('selected_locale', $this->session->selected_locale);
            $this->config->set_item('home_url', site_url($this->session->selected_locale));
        }

        // Load language file
        $this->lang->load('www', config_item('selected_locale'));
    }
}
