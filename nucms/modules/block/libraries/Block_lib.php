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
     * Decode map
     * 
     * @param string $map
     * 
     * @return string
     */
    public function decode_map($map)
    {
        return json_decode($map);
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
        $decodedMap = $this->decode_map($map);

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

        if ($result) {
            $result = array_to_array_by_key_single($result, 'hash_id');
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
                echo render_twig('block/types/block_'.$block->type, $data, true);
            }
        }
    }

    /**
     * Complatly decode content for frontend
     *
     * @param string $map
     * @param array $blocks
     * 
     * @return string
     */
    public function decode_content_for_front($map, $blocks = NULL)
    {
        if (is_null($blocks)) {
            $blocks = $this->decode_content_map($map);
        }

        if ($blocks) {
            foreach ($blocks as $block) {
                $block->content = $this->prepare_block_data($block->content, $block->type);
            }
        }

        $decodedMap = $this->decode_map($map);

        return $this->decode_map_to_html($decodedMap, $blocks);
    }

    /**
     * Decode array map to html format
     * 
     * @param array $decodedMap
     * @param array $blocks
     * 
     * @return string
     */
    private function decode_map_to_html($decodedMap, $blocks)
    {
        $html = '';

        foreach ($decodedMap->_children as $box) {
            if ($box->type == 'module') {
                $data = [
                    'block' => $blocks->{$box->id},
                ];
                $html .= render_twig('block/block_'.$box->moduleType, $data, true);
            } else {
                $data = [
                    'col_lg' => isset($box->size_lg) ? $box->size_lg : 0
                ];
                $html .= render_twig('block/block_'.$box->type, $data, true);
            }

            if (isset($box->_children)) {
                $html = str_replace('##INSIDE##', $this->decode_map_to_html($box, $blocks), $html);
            }
        }

        return $html;
    }

    /**
     * Prepare block data by type
     * 
     * @param array $content
     * @param string $type
     * 
     * @return array
     */
    public function prepare_block_data($content, $type)
    {
        if ($type == 'html') {
            return $content;
        } elseif ($type == 'text') {
            return $content;
        } elseif ($type == 'icon') {
            return $content;
        }
    }
}

/* End of file Block_lib.php */
/* Location: ./application/modules/block/libraries/admin/Block_lib.php */