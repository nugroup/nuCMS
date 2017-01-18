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
    
    /**
     * Initialize default pagination
     * 
     * @param int $numberOfItems number of all items for pagination
     * @param int $page
     * @param int $perPage
     * @param string $base_url
     * 
     * @return array return array with keys: 'limit' and 'limit_offset'
     */
    public function initPagination($numberOfItems, $page = 1, $perPage = 0, $base_url = '')
    {
        if ($perPage == 0) {
            $perPage = $this->config->item('default_per_page');
        }

        $pager_url = ($base_url != '') ? $base_url : current_url();

        // Load pagination library
        $this->load->library('pagination');

        // Set paginaton config
        $config = [
            'base_url' => $pager_url,
            'total_rows' => $numberOfItems,
            'per_page' => $perPage,
            'page_query_string' => TRUE,
            'query_string_segment' => 'p',
            'reuse_query_string' => TRUE,
        ];

        // Initialize pagination
        $this->pagination->initialize($config);

        $params['limit_offset'] = ($page * $config["per_page"]) - $config["per_page"];
        $params['limit'] = $config["per_page"];

        return $params;
    }
}
