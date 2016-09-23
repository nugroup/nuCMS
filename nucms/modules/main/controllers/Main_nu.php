<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class Main_nu
 */
class Main_nu extends Frontend_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Start admin page
     */
    public function homepage()
    {
        if ($this->uri->segment(2) == 'homepage') {
            redirect(site_url(), 'location  ', 301);
        }

        $homepageType = 'static';
        if (isset($this->data['settings']['main_homepage'])) {
            $homepageType = $this->data['settings']['main_homepage']->value;
        }

        if ($homepageType == 'page' && isset($this->data['settings']['main_homepage_page_id'])) {
            // Page as a homepage
            $this->load->library('page/page_widget', $this->data);

            widget('Page_widget::render_page', [
                'id' => $this->data['settings']['main_homepage_page_id']->value,
                'locale' => $this->config->item('selected_locale')
            ]);
        } else {
            // Static homepage
            $this->render('homepage', $this->data);
        }
    }
}

/* End of file Main_nu.php */
/* Location: ./application/modules/main/controllers/Main_nu.php */
