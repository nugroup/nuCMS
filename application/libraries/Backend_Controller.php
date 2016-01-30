<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class Backend_Controller
 */
class Backend_Controller extends MY_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();

        // Set admin language
        $this->setLanguage();

        // Load needed config
        $this->load->config('nucms');

        // Check profiler status
        if ($this->config->item('profiler') && ENVIRONMENT == 'development') {
            $this->output->enable_profiler();
        }

        // Load needed models
        $this->load->model('auth/auth_model', 'auth');

        // Set number of elements per page
        if (!$this->session->admin_per_page) {
            $this->session->set_userdata('admin_per_page', $this->config->item('default_admin_per_page'));
        }

        // Get languages list
        $this->getSystemLanguagesList();

        // Url exceptions
        $exception_uris = array(
            config_item('admin_folder').'/auth/login',
            config_item('admin_folder').'/auth/logout',
            config_item('admin_folder').'/auth/remember'
        );

        if (in_array(uri_string(), $exception_uris) == false) {
            // Check if login
            if ($this->auth->logged_in() == false) {
                redirect(admin_url('auth/login'));
            }
        }

        // Get nublox templatet into variable
        $this->data['nublox'] = $this->load->view('nublox/nu-blox.tpl.php', [], true);
    }

    /**
     * Initialize default pagination
     *
     * @param int $numberOfItems number of all items for pagination
     * @return array return array with keys: 'limit' and 'limit_offset'
     */
    public function initPagination($numberOfItems, $page = 1, $perPage = 0, $suffixUrl = '')
    {
        if ($this->session->userdata('admin_per_page') && $perPage == 0) {
            $perPage = $this->session->userdata('admin_per_page');
        }

        // Load pagination library
        $this->load->library('pagination');

        // Set paginaton config
        $config = [
            'base_url' => current_url().$suffixUrl,
            'total_rows' => $numberOfItems,
            'per_page' => $perPage,
            'page_query_string' => TRUE,
            'query_string_segment' => 'page',
            'reuse_query_string' => TRUE,
        ];

        // Initialize pagination
        $this->pagination->initialize($config);

        $params['limit_offset'] = ($page * $config["per_page"]) - $config["per_page"];
        $params['limit'] = $config["per_page"];

        return $params;
    }

    /**
     * Set return link from list view
     *
     * @param string $controllerName
     */
    public function setReturnLink($controllerName)
    {
        $this->session->set_userdata($controllerName.'_return_link', config_item('base_url_301').$this->input->server('REQUEST_URI'));
    }

    /**
     * Get return link from session to the view
     *
     * @param string $controllerName
     * @return string
     */
    public function getReturnLink($controllerName)
    {
        if ($this->session->{$controllerName.'_return_link'}) {
            return $this->session->{$controllerName.'_return_link'};
        }

        return $this->config->item('admin_url').'/'.$controllerName;
    }

    /**
     * Get all languages created in language model
     */
    public function getSystemLanguagesList()
    {
        $this->load->model('language/language_model', 'language');
        $languages = $this->language->get_all();
        if ($languages) {
            foreach ($languages as $language) {
                $locales[$language->locale] = $language;
            }

            $this->data['system_languages'] = $languages;
            $this->data['system_languages_by_locale'] = $locales;
        } else {
            $this->data['system_languages'] = false;
            $this->data['system_languages_by_locale'] = false;
        }
    }

    /**
     * Set admin laguage by session
     */
    public function setLanguage()
    {
        $this->load->model('language/language_model', 'language');

        // Set session if not exist
        if (!$this->session->admin_language) {
            $this->session->set_userdata('admin_language', 1);
        }

        // Set config
        $this->config->set_item('selected_lang', 'polish');
        $this->config->set_item('selected_locale', 'pl');

        // Load language file
        $this->lang->load('nucms', config_item('selected_lang'));
    }
}

/* End of file Backend_controller.php */
/* Location: ./application/libraries/Backend_controller.php */