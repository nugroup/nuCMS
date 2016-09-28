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
     * Show single page
     *
     * @param int $id
     * @param string $locale
     */
    public function show($id, $locale)
    {
        widget('Page_widget::render_page', [
            'id' => $id,
            'locale' => $locale,
            'data' => $this->data
        ]);
    }
}

/* End of file Page.php */
/* Location: ./application/modules/page/controllers/Page.php */
