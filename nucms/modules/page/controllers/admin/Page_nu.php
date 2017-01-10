<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class Page_nu
 */
class Page_nu extends Backend_Controller
{
    private $sessionName = 'page';

    public function __construct()
    {
        parent::__construct();

        // Load classes
        $this->load->library('page/page_widget');
        $this->lang->load('page/page', $this->config->item('selected_locale'));
        $this->load->model('page/page_model', 'page');
        $this->load->model('route/route_model', 'route');
    }

    /**
     * List of pages
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
                // Delete page
                $this->page->delete($item);
            }

            // Set message and refresh the page
            $this->session->set_flashdata('success', lang('alert.success.delete_checked'));
            redirect(current_url());
        }

        // Get number of items for pager
        $this->page_translations->generate_like_query($this->input->get('string'));
        $numberOfItems = $this->page_translations
            ->where('locale', $locale)
            ->count_rows();

        // Init pagination
        $paginationLimits = $this->initPagination($numberOfItems, $page, $per_page);

        $this->page_translations->generate_like_query($this->input->get('string'));
        $pages = $this->page_translations
            ->with_root()
            ->with_route()
            ->where('locale', $locale)
            ->order_by('id', 'desc')
            ->limit($paginationLimits['limit'], $paginationLimits['limit_offset'])
            ->get_all();

        // Set view data
        $this->data['pages'] = prepare_join_data($pages, 'root');
        $this->data['pager'] = $this->pagination->create_links();
        $this->data['locale'] = $locale;
        $this->data['subnav_active'] = 'index';
        $this->data['selected_language'] = $this->config->item($locale, 'system_languages_by_locale')->name;

        // Load the view
        $this->render('page/index', $this->data);
    }

    /**
     * Edit single page
     *
     * @param int $id
     */
    public function edit($id)
    {
        $locale = ((bool) $this->input->get('locale')) ? $this->input->get('locale') : config_item('default_locale');
        $where = [
            'page_id' => $id,
            'locale' => $locale
        ];

        $page = $this->page_translations
            ->with_file()
            ->with_route()
            ->where($where)
            ->get();

        if (!$page) {
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

                // Update page translation
                $result = $this->page_translations
                    ->from_form($this->page_translations->get_rules('update'), $additionalData, $where)
                    ->update();
                
                if ((bool) $result === false) {
                    throw new Exception();
                }
                
                // Save blocks
                $this->block->save_blocks($this->input->post('blocks'), $this->input->post('content'), $page->content_blocks);
                
                // Update route
                $this->form_validation->set_rules($this->route->rules['update']);
                if ($this->form_validation->run() === FALSE) {
                    throw new Exception();
                }
                $routeData = [
                    'slug' => $this->route->prepare_unique_slug($this->input->post('slug'), $page->route_id),
                ];
                $this->route->update($routeData, $page->route_id);
                
                $this->db->trans_complete();

                $this->session->set_flashdata('success', lang('alert.success.saved_changes'));
                redirect(current_full_url());
            } catch (Exception $ex) {
                
            }
        }

        $page->seo_progress_msg = $this->page_translations->get_seo_progress_msg($page);
        $templates = $this->page_widget->get_templates_list();

        // Set view data
        $this->data['page'] = $page;
        $this->data['templates'] = $templates;
        $this->data['subnav_active'] = 'edit';
        $this->data['return_link'] = $this->getReturnLink($this->sessionName);
        $this->data['selected_locale'] = $this->config->item($locale, 'system_languages_by_locale')->locale;
        $this->data['locale'] = $locale;

        // Load the view
        $this->render('page/edit', $this->data);
    }

    /**
     * Add new page
     */
    public function add()
    {
        // If post is send
        if ($this->input->post()) {
            // Validate form
            $this->form_validation->set_rules($this->page_translations->get_rules('add'));
            $inserted_id = false;

            // Insert page root
            if ($this->form_validation->run() == true) {
                $inserted_id = $this->page->insert(['id' => null]);
            }
            
            if ($inserted_id) {
                // Insert all translations
                $insertedTranslate = $this->page_translations->insert_all_translations($inserted_id);

                // Set informations
                if ($insertedTranslate) {
                    $this->session->set_flashdata('success', lang('page.alert.success.add'));
                }

                // Redirect
                redirect(admin_url('page/edit/' . $inserted_id));
            }
        }

        $templates = $this->page_widget->get_templates_list();

        // Set view data
        $this->data['templates'] = $templates;
        $this->data['return_link'] = $this->getReturnLink($this->sessionName);

        // Load the view
        $this->render('page/add', $this->data);
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
                    if (!$this->page->delete($id)) {
                        throw new Exception(lang('page.alert.error.delete'));
                    }

                    // Set response data
                    $result['message'] = lang('page.alert.success.delete');
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

/* End of file Page_nu.php */
/* Location: ./nucms/modules/page/controllers/admin/Page_nu.php */