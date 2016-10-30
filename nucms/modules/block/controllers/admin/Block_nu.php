<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class Block_nu
 */
class Block_nu extends Backend_Controller
{
    private $sessionName = 'block';

    public function __construct()
    {
        parent::__construct();

        // Load classes
        $this->load->model('block/block_model', 'block');
        $this->lang->load('block', config_item('selected_locale'));

        $this->data['fontawesome_list'] = $this->block_lib->get_fonts_file();
    }

    /**
     * List of blocks
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
                // Delete action
                $this->block->delete($item);
            }

            // Set message and refresh the page
            $this->session->set_flashdata('success', lang('alert.success.delete_checked'));
            redirect(current_full_url());
        }

        // Add block
        if ($this->input->post('add')) {
            $data = array(
                'name' => $this->input->post('name', true),
                'type' => $this->input->post('type'),
                'locale' => $locale,
            );

            // Insert block
            $inserted_id = $this->block->insert($data);

            if ($inserted_id) {
                $this->session->set_flashdata('success', lang('block.alert.success.add'));

                // Redirect
                redirect(current_full_url());
            }
        }

        // Get number of items for pager
        $this->block->generate_like_query($this->input->get('string'));
        $numberOfItems = $this->block->count_rows();

        // Init pagination
        $paginationLimits = $this->initPagination($numberOfItems, $page, $per_page);

        $this->block->generate_like_query($this->input->get('string'));
        $blocks = $this->block
            ->where('locale', $locale)
            ->where('global', 1)
            ->order_by('id', 'desc')
            ->limit($paginationLimits['limit'], $paginationLimits['limit_offset'])
            ->get_all();

        // Set view data
        $this->data['blocks'] = $blocks;
        $this->data['pager'] = $this->pagination->create_links();
        $this->data['locale'] = $locale;
        $this->data['selected_language'] = $this->config->item($locale, 'system_languages_by_locale')->name;

        // Load the view
        $this->render('block/index', $this->data);
    }

    /**
     * Edit single block
     * 
     * @param int $id
     */
    public function edit($id)
    {
        $block = $this->block->get($id);
        if (!$block || !$id) {
            show_404();
        }

        // Update
        if ($this->input->post()) {
            $update_data = array(
                'name' => $this->input->post('name', true),
                'content' => $this->block->encode_content($this->input->post('content')),
            );

            $result = $this->block->update($update_data, $id);
            if ($result) {
                // Set informations
                $this->session->set_flashdata('success', lang('alert.success.saved_changes'));

                // Redirect
                redirect(admin_url('block/edit/'.$id));
            }
        }
        
        // Set view data
        $this->data['block'] = $this->block_lib->prepare_block_data($block);
        $this->data['subnav_active'] = 'edit';
        $this->data['return_link'] = $this->getReturnLink($this->sessionName);

        // Load the view
        $this->render('block/edit', $this->data);
    }

    /**
     * Load block edit view by AJAX
     * 
     * @param int $id
     */
    public function load_block_ajax($id)
    {
        $block = $this->block->get($id);
        if (!$block || !$this->input->is_ajax_request()) {
            show_404();
        }

        // Set view data
        $data['block'] = $this->block_lib->prepare_block_data($block);
        $data['fontawesome_list'] = $this->data['fontawesome_list'];
        
        // Load the view
        $this->render('block/types/block_'.$block->type, $data);
    }

    /**
     * Load edit block view for nuBlox
     */
    public function edit_from_json()
    {
        $postJson = $this->input->post('blockJson');
        if (!$postJson || !$this->input->is_ajax_request()) {
            show_404();
        }

        $block = json_decode($postJson);

        // Set view data
        $data = [
            'block' => $this->block_lib->prepare_block_data($block),
            'fontawesome_list' => $this->data['fontawesome_list'],
            'show_buttons' => true,
        ];

        // Load the view
        $html = $this->render('block/types/block_'.$block->type, $data, true);

        header('Content-Type: application/json');
        echo json_encode([
            'html' => $html,
        ]);
    }

    /**
     * Update json in block hidden input for nuBlox
     */
    public function update_from_json()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        header('Content-Type: application/json');
        echo json_encode([
            'json' => json_encode($this->input->post()),
            'hash_id' => $this->input->post('hash_id'),
            'success_msg' => lang('alert.success.blocks_save_changes')
        ]);
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
                    // Delete menu
                    if (!$this->block->delete($id)) {
                        throw new Exception(lang('block.alert.error.delete'));
                    }

                    // Set response data
                    $result['message'] = lang('block.alert.success.delete');
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

/* End of file Block_nu.php */
/* Location: ./application/modules/block/controllers/admin/Block_nu.php */