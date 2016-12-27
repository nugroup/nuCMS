<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class News_nu
 */
class News_nu extends Frontend_Controller
{
    private $sessionName = 'news';

    public function __construct()
    {
        parent::__construct();

        // Load classes
        $this->load->model('news/news_model', 'news');
        $this->load->model('news/news_translations_model', 'news_translations');
        $this->load->model('route/route_model', 'route');
    }

    /**
     * Show news by slug in uri segment
     */
    public function show()
    {
        $slug = $this->uri->segment(2);

        // Find news_id in route
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

        // Load news
        widget('News_widget::render_news', [
            'id' => $route->primary_key,
            'locale' => $route->locale,
            'data' => $this->data
        ]);
    }
}

/* End of file News_nu.php */
/* Location: ./nucms/modules/news/controllers/News_nu.php */