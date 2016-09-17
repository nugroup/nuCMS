<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class Block_lib
 */
class Block_lib
{
    private $CI;
    private $config;
    private $fontFilePath = 'fonts/fontawesome/font-awesome.txt';

    public function __construct()
    {
        $this->CI = & get_instance();

        $this->CI->load->helper('file');
        $this->CI->load->helper('block/block');
        $this->CI->load->model('block/block_model', 'block');
        $this->config = $this->CI->config->item('block');
    }

    /**
     * get and explode text file with fontsize list
     * 
     * @return array
     */
    public function get_fonts_file()
    {
        return explode(',', str_replace("'", '', read_file(asset($this->fontFilePath))));
    }

    /**
     * Decode content map json to the blocks array
     * 
     * @param string $map
     * @return array
     */
    public function decode_content_map($map)
    {
        $blocks = array();
        $result = array();
        $decodedMap = json_decode($map);

        if (!empty($decodedMap)) {
            $iterator = new RecursiveArrayIterator($decodedMap);
            iterator_apply($iterator, 'traverseStructure', array($iterator, &$blocks));
        }

        if (!empty($blocks)) {
            $this->CI->db->where_in('hash_id', $blocks);
            $result = $this->CI->block->get_all();
            if ($result) {
                foreach ($result as $row) {
                    $row->json_format = json_encode($row);
                }
            }
        }

        return $result;
    }

    /**
     * Dispay list of blocks
     * 
     * @param array $blocks
     */
    public function display_blocks_list($blocks)
    {
        $fontawesome_list = $this->get_fonts_file();

        foreach ($blocks as $block) {
            if ($block->type != '') {
                $data = [
                    'block' => $block,
                    'fontawesome_list' => $fontawesome_list
                ];
                echo render_twig('block/types/block_' . $block->type, $data, true);
            }
        }
    }
}

/* End of file Block_lib.php */
/* Location: ./application/modules/block/libraries/admin/Block_lib.php */