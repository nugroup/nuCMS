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

        // Add action
        if ($this->input->post('add')) {
            $this->add();
        }

        // Edit action
        if ($this->input->post('edit')) {
            $this->edit_action();
        }

        $newsCategoryList = $this->news_category_translations->get_categories_tree($locale);

        // Set view data
        $this->data['news_categories'] = $newsCategoryList;
        $this->data['locale'] = $locale;
        $this->data['subnav_active'] = 'index';
        $this->data['selected_language'] = $this->config->item($locale, 'system_languages_by_locale')->name;

        // Load the view
        $this->render('news/category/index', $this->data);
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

    /**
     * Add news category action
     */
    private function add()
    {
        // Validate form
        $this->form_validation->set_rules($this->news_category_translations->rules['insert']);
        $inserted_id = false;

        // Insert news root
        if ($this->form_validation->run() == true) {
            $data = [
                'parent_id' => ($this->input->post('parent_id')) ?: null,
                'active' => ($this->input->post('active')) ? 1 : 0
            ];
            $inserted_id = $this->news_category->insert($data);
        }

        if ($inserted_id) {
            // Insert all translations
            $insertedTranslate = $this->news_category_translations->insert_all_translations($inserted_id);

            // Set informations
            if ($insertedTranslate) {
                $this->session->set_flashdata('success', lang('news_category.alert.success.add'));
            }

            // Redirect
            redirect(current_full_url());
        }
    }

    /**
     * Edit view action run by AJAX
     * 
     * @param int $id
     * @param string $locale
     */
    public function edit($id, $locale)
    {
        $newsCategory = $this->news_category_translations
            ->with_root()
            ->with_route()
            ->where('locale', $locale)
            ->where('news_category_id', $id)
            ->get();
        
        $newsCategoryList = $this->news_category_translations->get_categories_tree($locale);

        // Set view data
        $this->data['news_category'] = prepare_join_data($newsCategory, 'root');
        $this->data['news_categories'] = $newsCategoryList;

        // Load the view
        $this->render('news/category/edit', $this->data);
    }

    /**
     * Edit post action
     */
    public function edit_action()
    {
        if (!$this->input->post('news_category_id')) {
            show_404();
        }

        // Validate form
        $this->form_validation->set_rules($this->news_category_translations->rules['insert']);
        $inserted_id = false;

        // Insert news root
        if ($this->form_validation->run() == true) {
            try {
                $this->db->trans_start();
                $data = [
                    'parent_id' => ($this->input->post('parent_id')) ?: null,
                ];
                $this->news_category->update($data, $this->input->post('news_category_id'));

                $result = $this->news_category_translations
                    ->from_form(
                        $this->news_category_translations->rules['insert'], [
                        'active' => (int) $this->input->post('active'),
                        ], [
                        'news_category_id' => $this->input->post('news_category_id'),
                        'locale' => $this->input->post('locale'),
                        ]
                    )
                    ->update();

                // Update route
                $this->form_validation->set_rules($this->route->rules['update']);
                if ($this->form_validation->run() === FALSE) {
                    throw new Exception();
                }
                $routeData = [
                    'slug' => $this->route->prepare_unique_slug($this->input->post('slug'), $this->input->post('route_id')),
                ];
                $this->route->update($routeData, $this->input->post('route_id'));

                $this->db->trans_complete();

                // Set informations
                $this->session->set_flashdata('success', lang('alert.success.saved_changes'));
            } catch (Exception $ex) {
                
            }

            // Redirect
            redirect(current_full_url());
        }
    }
}

/* End of file News_category_nu.php */
/* Location: ./nucms/modules/news/controllers/admin/News_category_nu.php */