<?php

/**
 * Widget class for help display news data
 *
 * @author nugato
 */
class News_widget
{
    /**
     * Codeigniter instance
     * 
     * @var Controller
     */
    private $CI;

    /**
     * Copy of data array from controller
     * 
     * @var array
     */
    private $data;

    /**
     * Path to templates file
     * 
     * @var string 
     */
    private $templatesPath;

    public function __construct($data = array())
    {
        $this->CI = & get_instance();
        $this->data = $data;
        $this->templatesPath = config_item('app_theme_path') . config_item('app_theme') . '/views/news/templates/';

        $this->CI->load->helper('directory');
        $this->CI->load->model('news/news_model', 'news');
        $this->CI->load->model('news/news_category_model', 'news_category');
        $this->CI->load->model('news/news_translations_model', 'news_translations');
        $this->CI->load->model('route/route_model', 'route');
    }

    /**
     * Set metatada
     *
     * @param array $metatags
     */
    private function set_metatags($metatags)
    {
        if ($metatags->meta_title != '' && isset($this->data['settings']['meta_title'])) {
            $this->data['settings']['meta_title']->value = $this->data['settings']['meta_title']->value . ' | ' . $metatags->meta_title;
        }
        if ($metatags->meta_keywords != '' && isset($this->data['settings']['meta_keywords'])) {
            $this->data['settings']['meta_keywords']->value = $metatags->meta_keywords;
        }
        if ($metatags->meta_description != '' && isset($this->data['settings']['meta_description'])) {
            $this->data['settings']['meta_description']->value = $metatags->meta_description;
        }
    }

    /**
     * Render news by id and locale
     * 
     * @param int $id
     * @param string $locale
     * @param array $data
     */
    public function render_news($id, $locale, $data)
    {
        $this->data = $data;
        $dt = new DateTime();

        $news = $this->CI->news_translations->get([
            'news_id' => $id,
            'locale' => $locale,
        ]);
        if (!$news) {
            show_404();
        }

        $dtNews = new DateTime($news->publication_date);

        if ($this->CI->input->get('preview')) {
            if ($news->token != $this->CI->input->get('token')) {
                show_404();
            }
        } elseif ($news->active != 1 || $dtNews->format('Y-m-d') > $dt->format('Y-m-d')) {
            show_404();
        }

        // Set metadata
        $this->set_metatags($news);

        // Decode Page Content
        $news->content = $this->CI->block_lib->decode_content_for_front($news->content, $news->content_blocks);

        // Set view data
        $this->data['news'] = $news;

        $newsTemplateFilename = $this->templatesPath . $news->template;

        if ($news->template != '' && file_exists($newsTemplateFilename . '.html.twig')) {
            echo render_twig('news/templates/' . $news->template, $this->data);
        } else {
            echo render_twig('news/templates/' . 'default', $this->data);
        }
    }

    /**
     * Render news list by category id and locale
     * 
     * @param int $newsCategoryId
     * @param string $locale
     * @param boolean $partial
     * @param int $limit
     * @param int $offset
     * @param array $data
     */
    public function render_news_list(
    $newsCategoryId, $locale, $partial = false, $limit = null, $offset = null, $data = []
    )
    {
        $this->data = $data;

        $newsCategory = $this->CI->news_category_translations
            ->where('news_category_id', $newsCategoryId)
            ->where('locale', $locale)
            ->get();

        $newsList = $this->CI->news_category_news->get_news_list_by_category(
            $newsCategoryId, $locale, $limit, $offset
        );

        // Set metadata
        if (!$partial) {
            $this->set_metatags($newsCategory);
        }

        // Set view data
        $this->data['news_category'] = $newsCategory;
        $this->data['news_list'] = $newsList;

        echo render_twig('news/news_list', $this->data);
    }

    /**
     * Render news categories tree
     */
    public function render_category_menu()
    {
        $data['news_categories'] = $this->CI->news_category_translations
            ->get_categories_tree(config_item('selected_locale'));

        $data['active_slug'] = $this->CI->uri->uri_string();

        echo render_twig('news/news_category_menu', $data, true);
    }

    /**
     * Get news templates list for select
     * 
     * @return array
     */
    public function get_templates_list()
    {
        $this->CI->lang->load('templates', config_item('selected_locale'));

        $templates = [];
        $templatesDir = directory_map($this->templatesPath);

        if (is_array($templatesDir)) {
            foreach ($templatesDir as $tpl) {
                $filename = str_replace('.html.twig', '', $tpl);
                $translation = lang('templates.' . $filename);
                $value = ($translation != '') ? $translation : $filename;

                $templates[$filename] = $value;
            }
        }

        return $templates;
    }
}
