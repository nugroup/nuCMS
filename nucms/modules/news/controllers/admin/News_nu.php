<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class News_nu
 */
class News_nu extends Backend_Controller
{
    private $sessionName = 'news_admin';

    public function __construct()
    {
        parent::__construct();

        // Load classes
        $this->load->library('news/news_widget');
        $this->lang->load('news/news', $this->config->item('selected_locale'));
        $this->load->model('news/news_model', 'news');
        $this->load->model('route/route_model', 'route');
        $this->load->model('news/news_category_model', 'news_category');
        $this->load->model('news/news_category_news_model', 'news_category_news');
        $this->load->model('news/news_category_translations_model', 'news_category_translations');
    }

    /**
     * List of news
     */
    public function index()
    {
        // Set default variables
        $page = ($this->input->get('page')) ? $this->input->get('page') : 1;
        $per_page = ($this->input->get('per_page')) ? $this->input->get('per_page') : $this->config->item('default_admin_per_page');
        $locale = ((bool) $this->input->get('locale')) ? $this->input->get('locale') : config_item('default_locale');
        $this->setReturnLink($this->sessionName);

        // Delete checked item
        if ($this->input->post('action') == 'delete_checked') {
            foreach ($this->input->post('check_item') as $item => $value) {
                // Delete news
                $this->news->delete($item);
            }

            // Set message and refresh the page
            $this->session->set_flashdata('success', lang('alert.success.delete_checked'));
            redirect(current_url());
        }

        // Get number of items for pager
        $this->news_translations->generate_like_query($this->input->get('string'));
        $numberOfItems = $this->news_translations
            ->where('locale', $locale)
            ->count_rows();

        // Init pagination
        $paginationLimits = $this->initPagination($numberOfItems, $page, $per_page);

        $this->news_translations->generate_like_query($this->input->get('string'));
        $newsList = $this->news_translations
            ->with_root()
            ->with_route()
            ->where('locale', $locale)
            ->order_by('id', 'desc')
            ->limit($paginationLimits['limit'], $paginationLimits['limit_offset'])
            ->get_all();

        // Set view data
        $this->data['news_list'] = prepare_join_data($newsList, 'root');
        $this->data['pager'] = $this->pagination->create_links();
        $this->data['locale'] = $locale;
        $this->data['subnav_active'] = 'index';
        $this->data['selected_language'] = $this->config->item($locale, 'system_languages_by_locale')->name;

        // Load the view
        $this->render('news/index', $this->data);
    }

    /**
     * Edit single news
     *
     * @param int $id
     */
    public function edit($id)
    {
        $locale = ((bool) $this->input->get('locale')) ? $this->input->get('locale') : config_item('default_locale');
        $where = [
            'news_id' => $id,
            'locale' => $locale
        ];

        $news = $this->news_translations
            ->with_file()
            ->with_route()
            ->where($where)
            ->get();

        if (!$news) {
            show_404();
        }

        // If post is send
        if ($this->input->post()) {
            // Additional data
            $additionalData = array(
                'file_id' => ($this->input->post('file_id')) ? (int) $this->input->post('file_id') : NULL
            );

            try {
                $this->db->trans_start();

                // Update news translation
                $result = $this->news_translations
                    ->from_form($this->news_translations->get_rules('update'), $additionalData, $where)
                    ->update();

                if ((bool) $result === false) {
                    throw new Exception();
                }

                // Save categories
                $this->news_category_news->save_news_categories($this->input->post('categories'), $news->news_id);

                // Save blocks
                $this->block->save_blocks($this->input->post('blocks'), $this->input->post('content'), $news->content_blocks);

                // Update route
                $this->form_validation->set_rules($this->route->rules['update']);
                if ($this->form_validation->run() === FALSE) {
                    throw new Exception();
                }
                $routeData = [
                    'slug' => $this->route->prepare_unique_slug($this->input->post('slug'), $news->route_id),
                ];
                $this->route->update($routeData, $news->route_id);

                $this->db->trans_complete();

                $this->session->set_flashdata('success', lang('alert.success.saved_changes'));
                redirect(current_full_url());
            } catch (Exception $ex) {
                
            }
        }

        // Get seo progress message
        $news->seo_progress_msg = $this->news_translations->get_seo_progress_msg($news);

        // Get templates list
        $templates = $this->news_widget->get_templates_list();

        // Get categories list
        $selectedCategories = $this->news_category_news->get_selected_categories($news->news_id);
        $newsCategoryList = $this->news_category_translations->get_categories_tree($locale);

        // Set view data
        $this->data['news'] = $news;
        $this->data['news_categories'] = $newsCategoryList;
        $this->data['selected_categories'] = $selectedCategories;
        $this->data['templates'] = $templates;
        $this->data['subnav_active'] = 'edit';
        $this->data['return_link'] = $this->getReturnLink($this->sessionName);
        $this->data['selected_locale'] = $this->config->item($locale, 'system_languages_by_locale')->locale;
        $this->data['locale'] = $locale;

        // Load the view
        $this->render('news/edit', $this->data);
    }

    /**
     * Add new news
     */
    public function add()
    {
        $tmpFile = false;

        // If post is send
        if ($this->input->post()) {
            // Validate form
            $this->form_validation->set_rules($this->news_translations->get_rules('add'));
            $inserted_id = false;

            // Insert news root
            if ($this->form_validation->run() == true) {
                $inserted_id = $this->news->insert(['id' => null]);
            }

            if ($inserted_id) {
                // Insert all translations
                $insertedTranslate = $this->news_translations->insert_all_translations($inserted_id);

                // Save categories
                $this->news_category_news->save_news_categories($this->input->post('categories'), $inserted_id);

                // Set informations
                if ($insertedTranslate) {
                    $this->session->set_flashdata('success', lang('news.alert.success.add'));
                }

                // Redirect
                redirect(admin_url('news/edit/' . $inserted_id));
            }
            
            $tmpFile = $this->file->get($this->input->post('file_id'));
        }

        $newsCategoryList = $this->news_category_translations->get_categories_tree(config_item('default_locale'));
        $templates = $this->news_widget->get_templates_list();

        // Set view data
        $this->data['news_categories'] = $newsCategoryList;
        $this->data['templates'] = $templates;
        $this->data['subnav_active'] = 'add';
        $this->data['return_link'] = $this->getReturnLink($this->sessionName);
        if ($tmpFile) {
            $this->data['tmp_file'] = $tmpFile;
        }
        
        // Load the view
        $this->render('news/add', $this->data);
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
                    if (!$this->news->delete($id)) {
                        throw new Exception(lang('news.alert.error.delete'));
                    }

                    // Set response data
                    $result['message'] = lang('news.alert.success.delete');
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

/* End of file News_nu.php */
/* Location: ./nucms/modules/news/controllers/admin/News_nu.php */