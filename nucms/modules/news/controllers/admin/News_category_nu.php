<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class News_category_nu
 */
class News_category_nu extends Backend_Controller
{
    private $sessionName = 'news_category_admin';

    public function __construct()
    {
        parent::__construct();

        // Load classes
        $this->lang->load('news/news', $this->config->item('selected_locale'));
        $this->load->model('news/news_category_model', 'news');
        $this->load->model('route/route_model', 'route');
    }

    /**
     * List of news categories
     */
    public function index()
    {
        // Set default variables
        $news = ($this->input->get('page')) ? $this->input->get('page') : 1;
        $per_page = ($this->input->get('per_page')) ? $this->input->get('per_page') : $this->config->item('default_admin_per_page');
        $locale = ((bool) $this->input->get('locale')) ? $this->input->get('locale') : config_item('default_locale');
        $this->setReturnLink($this->sessionName);
        
        $this->news_category_translations->generate_like_query($this->input->get('string'));
        $newsCategoryList = $this->news_category_translations
            ->with_root()
            ->with_route()
            ->where('locale', $locale)
            ->order_by('sort', 'asc')
            ->get_all();
        
        // Set view data
        $this->data['news_categories'] = prepare_join_data($newsCategoryList, 'root');
        $this->data['locale'] = $locale;
        $this->data['subnav_active'] = 'index';
        $this->data['selected_language'] = $this->config->item($locale, 'system_languages_by_locale')->name;

        // Load the view
        $this->render('news/category_list', $this->data);
    }
}

/* End of file News_category_nu.php */
/* Location: ./nucms/modules/news/controllers/admin/News_category_nu.php */