<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class News_nu
 */
class News_nu extends MY_Controller
{
    private $sessionName = 'news';

    public function __construct()
    {
        parent::__construct();

        // Load classes
        $this->load->model('news/news_model', 'news');
        $this->load->model('news/news_translations_model', 'news_translations');
        $this->load->model('news/news_category_news_model', 'news_category_news');
        $this->load->model('route/route_model', 'route');
    }

    /**
     * Show news by slug in uri segment
     */
    public function show()
    {
        $slug = $this->uri->uri_string();
        $slug = str_replace($this->config->item('news', 'prefix'), '', $slug);

        // Find news_id in route
        $route = $this->route
            ->where('slug', $slug)
            ->where('module', 'news')
            ->get();
        
        if (!$route) {
            show_404();
        }

        // Check selected lang
        if (config_item('selected_locale') != $route->locale) {
            redirect(site_url('main/change_locale/' . $route->locale));
        }
        
        if ($this->session->news_list_return_link) {
            $this->data['return_link'] = $this->session->news_list_return_link;
        }

        // Load news
        widget('News_widget::render_news', [
            'id' => $route->primary_key,
            'locale' => $route->locale,
            'data' => $this->data
        ]);
    }
    
    /**
     * Show news list by slug
     */
    public function show_list()
    {
        $this->session->set_userdata('news_list_return_link', current_full_url());

        $page = ($this->input->get('p')) ? $this->input->get('p') : 1;
        $slug = $this->uri->uri_string();
        $slug = str_replace($this->config->item('news_category', 'prefix'), '', $slug);
        
        // Find news_category_id in route
        $route = $this->route
            ->where('slug', $slug)
            ->where('module', 'news_category')
            ->get();
        
        if (!$route) {
            show_404();
        }

        // Check selected lang
        if (config_item('selected_locale') != $route->locale) {
            redirect(site_url('main/change_locale/' . $route->locale));
        }
        
        $numberOfItems = $this->news_category_news
            ->get_number_of_news_list_by_category($route->primary_key, $route->locale);
        $paginationLimits = $this->initPagination($numberOfItems, $page);
        $this->data['pager'] = $this->pagination->create_links();

        // Load news
        widget('News_widget::render_news_list', [
            'newsCategoryId' => $route->primary_key,
            'locale' => $route->locale,
            'partial' => false,
            'limit' => $paginationLimits['limit'],
            'offset' => $paginationLimits['limit_offset'],
            'data' => $this->data,
        ]);
    }
}

/* End of file News_nu.php */
/* Location: ./nucms/modules/news/controllers/News_nu.php */