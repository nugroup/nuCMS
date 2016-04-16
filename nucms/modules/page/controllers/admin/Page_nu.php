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
        $this->lang->load('page/page', $this->config->item('selected_lang'));
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
        $locale = ($this->input->get('locale')) ? $this->input->get('locale') : config_item('default_locale');
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
        $paginationLimits = $this->initPagination($numberOfItems, $page);

        $this->page_translations->generate_like_query($this->input->get('string'));
        $pages = $this->page_translations
            ->where('locale', $locale)
            ->limit($paginationLimits['limit'], $paginationLimits['limit_offset'])
            ->with_root('order_by:created_at,desc')
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
        $locale = ($this->input->get('locale')) ? $this->input->get('locale') : config_item('default_locale');
        $where = [
            'page_id' => $id,
            'locale' => $locale
        ];

        // If post is send
        if ($this->input->post()) {

            // Update page translation
            $result = $this->page_translations
                ->from_form($this->page_translations->get_rules('update'), [], $where)
                ->update();

            // Update route
            $pageUrl = $this->config->item('pages_route_controller').$id.'/'.$locale;
            $routeData = [
                'slug' => $this->route->prepare_unique_slug($this->input->post('slug'), $pageUrl),
            ];
            $resultRoute = $this->route->update($routeData, ['url' => $pageUrl]);

            if ($result || $resultRoute) {

                // Set informations
                $this->session->set_flashdata('success', lang('alert.success.saved_changes'));
            }

            // Redirect
            redirect(admin_url('page/edit/'.$id));
        }

        $page = $this->page_translations->where($where)->get();
        if (!$page) {
            show_404();
        }

        // Set view data
        $this->data['page'] = $page;
        $this->data['subnav_active'] = 'edit';
        $this->data['return_link'] = $this->getReturnLink($this->sessionName);
        $this->data['selected_language'] = $this->config->item($locale, 'system_languages_by_locale')->name;
        $this->data['locale'] = $locale;

        // Load the view
        $this->render('page/edit', $this->data);
    }

    /**
     * Add new language
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
                $inserted_id = $this->page->insert([]);
            }

            if ($inserted_id) {
                // Insert all translations
                $insertedTranslate = $this->page_translations->insert_all_translations($inserted_id);

                // Set informations
                if ($insertedTranslate) {
                    $this->session->set_flashdata('success', lang('page.alert.success.add'));
                }

                // Redirect
                redirect(admin_url('page'));
            }
        }

        // Set view data
        $this->data['subnav_active'] = 'add';
        $this->data['return_link'] = $this->getReturnLink($this->sessionName);

        // Load the view
        $this->render('page/add', $this->data);
    }

    /**
     * Update active by AJAX (onclick)
     *
     * @param int $id
     * @param string $field
     * @return boolean
     */
    public function update_active($id)
    {
        $name = $this->input->post('name');
        $value = (int) $this->input->post('value');

        // Set data view to checked or not checked
        $data[$name] = $value;

        // Update the view
        if ($this->page_translations->update($data, (int) $id)) {
            echo $this->db->last_query();
            $result = ['result' => 1];
        } else {
            $result = ['result' => 0];
        }

        header('Content-Type: application/json');
        echo json_encode($result);

        return FALSE;
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

/* End of file Admin_page.php */
/* Location: ./application/modules/page/controllers/admin/Admin_page.php */