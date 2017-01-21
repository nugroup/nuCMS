<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class Main_nu
 */
class Main_nu extends MY_Controller
{
    private $sessionName = 'main';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Start admin page
     */
    public function homepage($locale = null)
    {
        if ($this->uri->segment(2) == 'homepage') {
            redirect(site_url(), 'location  ', 301);
        }

        // Check if langauge is set correctly
        if (
                ($locale == null && config_item('default_locale') != config_item('selected_locale')) ||
                ($locale !== null && $locale != config_item('selected_locale'))
            ) {
            $this->change_locale($locale, true);
        }

        $homepageType = 'static';
        if (isset($this->data['settings']['main_homepage'])) {
            $homepageType = $this->data['settings']['main_homepage']->value;
        }

        if ($homepageType == 'page' && isset($this->data['settings']['main_homepage_page_id'])) {
            // Page as a homepage
            $this->load->library('page/page_widget');
            widget('Page_widget::render_page', [
                'id' => $this->data['settings']['main_homepage_page_id']->value,
                'locale' => $this->config->item('selected_locale'),
                'data' => $this->data
            ]);
        } else {
            // Static homepage
            $this->render('homepage', $this->data);
        }
    }

    /**
     * Change locale
     * 
     * @param string $locale
     */
    public function change_locale($locale, $suffix = true)
    {
        $this->session->set_userdata('selected_locale', $locale);

        if ($suffix && $locale != config_item('default_locale')) {
            redirect(site_url($locale));
        }

        redirect(site_url());
    }
}

/* End of file Main_nu.php */
/* Location: ./application/modules/main/controllers/Main_nu.php */
