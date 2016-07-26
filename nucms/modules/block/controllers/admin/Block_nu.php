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
        $this->lang->load('block', config_item('selected_lang'));
    }

    /**
     * List of blocks
     */
    public function index()
    {
        // Set default variables
        $page = ($this->input->get('page')) ? $this->input->get('page') : 1;
        $per_page = ($this->input->get('per_page')) ? $this->input->get('per_page') : $this->config->item('default_admin_per_page');
        $locale = ((bool)$this->input->get('locale')) ? $this->input->get('locale') : config_item('default_locale');
        $this->setReturnLink($this->sessionName);

        // Add block
        if ($this->input->post('add')) {
            $data = array(
                'name'   => $this->input->post('name', true),
                'type'   => $this->input->post('type'),
                'locale' => $locale, 
            );
            
            // Validate form
            $this->form_validation->set_rules($this->block->get_rules('add'));

            // Insert page root
            if ($this->form_validation->run() == true) {
                $inserted_id = $this->block->insert($data);
                
                if ($inserted_id) {
                    $this->session->set_flashdata('success', lang('block.alert.success.add'));
                    
                    // Redirect
                    redirect(current_full_url());
                }
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
     * @param int $block_id
     */
    public function edit($block_id)
    {
        $block = $this->block->get($block_id);
        if (!$block) {
            show_404();
        }
        
        // Set view data
        $this->data['block'] = $block;
        $this->data['subnav_active'] = 'edit';
        $this->data['return_link'] = $this->getReturnLink($this->sessionName);
        
        // Load the view
        $this->render('block/edit', $this->data);
    }
}

/* End of file Block_nu.php */
/* Location: ./application/modules/block/controllers/admin/Block_nu.php */