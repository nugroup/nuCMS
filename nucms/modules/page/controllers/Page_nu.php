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
        $page = $this->page_translations->get([
            'page_id' => $id,
            'locale' => $locale
        ]);
        if (!$page) {
            show_404();
        }

        if ($this->input->get('preview')) {
            if ($page->token != $this->input->get('token')) {
                show_404();
            }
        } elseif ($page->active != 1) {
            show_404();
        }

        // Set metadata
        $this->set_metatags($page);

        // Decode Page Content
        $page->content = $this->block_lib->decode_content_for_front($page->content, $page->content_blocks);

        // Set view data
        $this->data['page'] = $page;

        $this->render('page/show', $this->data);
    }
}

/* End of file Page.php */
/* Location: ./application/modules/page/controllers/Page.php */