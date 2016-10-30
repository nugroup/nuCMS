<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class Block_model
 * 
 * Remember to run json_encode on form CONTENT data
 */
class Block_model extends MY_Model
{
    public $table = 'nu_block';
    public $primary_key = 'id';
    public $fillable = array();
    public $protected = array();
//    protected $after_get = array('decode_content');

    function __construct()
    {
        parent::__construct();

        $this->timestamps = true;
    }

    /**
     * Get validations rules
     *
     * @param string $action
     * @return array
     */
    public function get_rules($action = '', $id = 0)
    {
        $rules = array(
            'insert' => array(),
            'update' => array(),
        );

        if ($action == 'add') {
            
        } else {
            
        }

        return $rules;
    }

    /**
     * Generate query from search string
     *
     * @param string $string
     */
    public function generate_like_query($string)
    {
        if ($string) {
            $this->db->like('name', $string);
            $this->db->where('locale', $this->input->get('locale'));
        }

        if ($this->input->get('sort') && $this->input->get('sort_type')) {
            $this->db->order_by($this->input->get('sort'), $this->input->get('sort_type'));
        }
    }

    /**
     * Save blocks other modules views
     * 
     * @param array $blocks
     */
    public function save_blocks($blocks, $content)
    {
        $CI =& get_instance();
//        $blocksInMap = $CI->block_lib->decode_content_map($content);
//        dump($blocksInMap);
//        die();
        if ($blocks) {
            foreach ($blocks as $block) {
                $decodedBlock = json_decode($block);

                if (isset($decodedBlock->content)) {
                    $decodedBlock->content = $this->encode_content($decodedBlock->content);
                }
                if ((int) $decodedBlock->id > 0) {
                    $this->update($decodedBlock, $decodedBlock->id);
                } else {
                    $this->insert($decodedBlock);
                }
            }
        }
    }

    /**
     * Decode content json format to the object
     *
     * @param array $data
     * 
     * @return array/object
     */
    public function decode_content($data)
    {
        $CI =& get_instance();

        if (isset($data[0])) {
            $i = 0;
            foreach ($data as $row) {
                $data[$i] = $CI->block_lib->prepare_block_data($row, true);
                $i++;
            }
        } else {
            $data = $CI->block_lib->prepare_block_data($data, true);
        }
        
        return $data;
    }

    /**
     * Encode content to the json_format
     *
     * @param array $content
     * @return string
     */
    public function encode_content($content)
    {
        return json_encode($content);
    }
}

/* End of file Block_model.php */
/* Location: ./application/modules/block/models/Block_model.php */