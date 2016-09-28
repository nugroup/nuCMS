<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class Admin_page
 */
class Page_nu extends Frontend_Controller
{
    private $sessionName = 'page';

    public function __construct()
    {
        parent::__construct();

        // Load classes
        $this->load->model('page/page_model', 'page');
        $this->load->model('page/page_translations_model', 'page_translations');
        $this->load->model('route/route_model', 'route');
    }

    /**
     * Show page by slug in uri segment
     */
    public function show()
    {
        $slug = $this->uri->segment(1);

        // Find page_id in route
        $route = $this->route
            ->where('slug', $slug)
            ->get();

        if (!$route) {
            show_404();
        }

        // Check selected lang
        if (config_item('selected_locale') != $route->locale) {
            redirect(site_url('main/change_locale/' . $route->locale));
        }

        // Load page
        widget('Page_widget::render_page', [
            'id' => $route->primary_key,
            'locale' => $route->locale,
            'data' => $this->data
        ]);
    }
}

/* End of file Page.php */
/* Location: ./application/modules/page/controllers/Page.php */
