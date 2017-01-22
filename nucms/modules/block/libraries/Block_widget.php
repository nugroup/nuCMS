<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Widget class for block
 *
 * @author nugato
 */
class Block_widget
{
    /**
     * Codeigniter instance
     * 
     * @var Controller
     */
    private $CI;

    public function __construct()
    {
        $this->CI = & get_instance();

        $this->CI->load->helper('file');
        $this->CI->load->helper('block/block');
        $this->CI->load->model('block/block_model', 'block');
        $this->CI->load->model('file/file_model', 'file');
        $this->config = $this->CI->config->item('block');
    }

    /**
     * Display block by id and template
     * 
     * @param type $blockId
     * @param type $template
     */
    public function display($id, $template)
    {
        $block = $this->CI->block->get($id);
        if (!$block || !$id) {
            return false;
        }
        
        $blockData = $this->CI->block_lib->prepare_block_data($block);
        
        $data = [
            'block' => $blockData,
        ];

        echo render_twig($template, $data, true);
    }
}