<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class Backend_Controller
 */
class Backend_Controller extends NU_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();

        // Set admin language
        $this->setLanguage();

        // Load needed config
        $this->load->config('app');
        $this->load->config('nucms');

        // Check profiler status
        if ($this->config->item('profiler') && ENVIRONMENT == 'development') {
            $this->output->enable_profiler();
        }

        // Get languages list
        if ($this->config->item('first_run')) {
            $this->getSystemLanguagesList();
        }

        // Load block module
        $this->lang->load('block/block', config_item('selected_locale'));
        $this->load->config('block/block', TRUE);
        
        // Load sitemap library
        $this->load->library('sitemap_nu', [], 'sitemap');

        // Url exceptions
        $exception_uris = array(
            config_item('admin_folder') . '/auth/login',
            config_item('admin_folder') . '/auth/logout',
            config_item('admin_folder') . '/auth/remember'
        );

        if (in_array(uri_string(), $exception_uris) == false) {
            // Check if login
            if (!$this->ion_auth->logged_in()) {
                redirect(admin_url('auth/login'));
            }
        }

        $this->config->set_item('first_run', false);
    }

    /**
     * Initialize default pagination
     * 
     * @param int $numberOfItems number of all items for pagination
     * @param int $page
     * @param int $perPage
     * @param string $base_url
     * @return array return array with keys: 'limit' and 'limit_offset'
     */
    public function initPagination($numberOfItems, $page = 1, $perPage = 0, $base_url = '')
    {
        if ($perPage == 0) {
            $perPage = $this->config->item('default_admin_per_page');
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
            'query_string_segment' => 'page',
            'reuse_query_string' => TRUE,
            'full_tag_open' => '<ul class="pagination pagination-lg">'
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
        $this->session->set_userdata($controllerName . '_return_link', config_item('base_url_301') . $this->input->server('REQUEST_URI'));
    }

    /**
     * Get return link from session to the view
     *
     * @param string $controllerName
     * @return string
     */
    public function getReturnLink($controllerName)
    {
        if ($this->session->{$controllerName . '_return_link'}) {
            return $this->session->{$controllerName . '_return_link'};
        }

        return $this->config->item('admin_url') . '/' . $controllerName;
    }

    /**
     * Get all languages created in language model
     */
    public function getSystemLanguagesList()
    {
        $languages = $this->language->get_all();
        if ($languages) {
            foreach ($languages as $language) {
                $locales[$language->locale] = $language;
                if ($language->default == 1) {
                    $this->config->set_item('default_locale', $language->locale);
                }
            }

            $this->config->set_item('system_languages', $languages);
            $this->config->set_item('system_languages_by_locale', $locales);
        }
    }

    /**
     * Set admin laguage by session
     */
    public function setLanguage()
    {
        // Set session if not exist
        if (!$this->session->admin_language) {
            $this->session->set_userdata('admin_language', 1);
        }

        // Set config
        $this->config->set_item('selected_locale', 'pl');

        // Load language file
        $this->lang->load('nucms', config_item('selected_locale'));
        $this->lang->load('language/language', config_item('selected_locale'));
        $this->load->model('language/language_model', 'language');
    }
}
