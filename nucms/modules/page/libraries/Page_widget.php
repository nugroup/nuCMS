<?php

/**
 * Widget class for help display page data
 *
 * @author nugato
 */
class Page_widget
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
        $this->templatesPath = config_item('app_theme_path').config_item('app_theme').'/views/page/templates/';

        $this->CI->load->helper('directory');
        $this->CI->load->model('page/page_model', 'page');
        $this->CI->load->model('page/page_translations_model', 'page_translations');
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
     * Render page by id and locale
     * 
     * @param int $id
     * @param string $locale
     * @param array $data
     */
    public function render_page($id, $locale, $data)
    {
        $this->data = $data;

        $page = $this->CI->page_translations
            ->with('file')
            ->where('page_id', $id)
            ->where('locale', $locale)
            ->get();
        if (!$page) {
            show_404();
        }

        if ($this->CI->input->get('preview')) {
            if ($page->token != $this->CI->input->get('token')) {
                show_404();
            }
        } elseif ($page->active != 1) {
            show_404();
        }

        // Set metadata
        $this->set_metatags($page);

        // Decode Page Content
        $page->content = $this->CI->block_lib->decode_content_for_front($page->content, $page->content_blocks);

        // Set view data
        $this->data['page'] = $page;
        
        $pageTemplateFilename = $this->templatesPath.$page->template;

        if ($page->template != '' && file_exists($pageTemplateFilename.'.html.twig')) {
            echo render_twig('page/templates/'.$page->template, $this->data);
        } else {
            echo render_twig('page/templates/'.'default', $this->data);
        }
    }
    
    /**
     * Get page templates list for select
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
