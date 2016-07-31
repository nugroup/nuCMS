<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class Block_lib
 */
class Block_lib
{
    private $CI;
    private $fontFilePath = 'fonts/fontawesome/font-awesome.txt';

    public function __construct()
    {
        $this->CI = & get_instance();

        $this->CI->load->helper('file');
        $this->CI->load->model('block/block_model', 'block');
    }
    
    /**
     * get and explode text file with fontsize list
     * 
     * @return array
     */
    public function getFontsFile()
    {
        return explode(',', str_replace("'", '', read_file(asset($this->fontFilePath))));
    }
}

/* End of file Block_lib.php */
/* Location: ./application/modules/block/libraries/admin/Block_lib.php */