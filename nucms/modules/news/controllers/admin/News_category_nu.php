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
        $this->load->model('news/news_category_model', 'news_category');
        $this->load->model('news/news_category_translations_model', 'news_category_translations');
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
        
        // Delete checked item
        if ($this->input->post('action') == 'delete_checked') {
            foreach ($this->input->post('check_item') as $item => $value) {
                // Delete news
                $this->news_category->delete($item);
            }

            // Set message and refresh the page
            $this->session->set_flashdata('success', lang('alert.success.delete_checked'));
            redirect(current_url());
        }
        
        $this->news_category_translations->generate_like_query($this->input->get('string'));
        $newsCategoryList = $this->news_category_translations
            ->with_root()
            ->with_route()
            ->where('locale', $locale)
            ->order_by('sort', 'asc')
            ->get_all();
        
        if ($newsCategoryList) {
            $newsCategoryList = prepare_join_data($newsCategoryList, 'root');
            $newsCategoryList = array_to_array_by_key($newsCategoryList, 'parent_id');
        }
        
        // Set view data
        $this->data['news_categories'] = $newsCategoryList;
        $this->data['locale'] = $locale;
        $this->data['subnav_active'] = 'index';
        $this->data['selected_language'] = $this->config->item($locale, 'system_languages_by_locale')->name;

        // Load the view
        $this->render('news/category_list', $this->data);
    }
    
    /**
     * Delete action (by AJAX)
     *
     * @throws Exception
     */
    public function delete()
    {
        if ($this->input->post('id_item')) {
            $id = $this->input->post('id_item');
            if ($id > 0) {
                try {
                    // Delete language
                    if (!$this->news_category->delete($id)) {
                        throw new Exception(lang('news_category.alert.error.delete'));
                    }

                    // Set response data
                    $result['message'] = lang('news_category.alert.success.delete');
                    $result['status'] = 1;
                } catch (Exception $ex) {
                    // Log error message
                    $this->set_log($ex->getMessage());

                    // Set response data
                    $result['message'] = $ex->getMessage();
                    $result['status'] = 0;
                }
            }
        }

        // Send header and response data
        header('Content-Type: application/json');
        echo json_encode(array('results' => $result));
        exit;
    }
}

/* End of file News_category_nu.php */
/* Location: ./nucms/modules/news/controllers/admin/News_category_nu.php */