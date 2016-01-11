<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Copythis extends Backend_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        $this->load->view('themes/' . config_item('theme') . '/index', $this->data);
    }
    
}

/* End of file Copythis.php */
/* Location: ./application/modules/shop/copythis/controllers/Copythis.php */

