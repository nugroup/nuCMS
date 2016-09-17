<?php

/**
 * Class Block_widget
 *
 * @author xprezesx
 */
class Block_widget
{
    private $CI;

    public function __construct()
    {
        $this->CI = & get_instance();

        $this->CI->load->helper('file');
        $this->CI->load->helper('block/block');
        $this->CI->load->model('block/block_model', 'block');
    }
}
