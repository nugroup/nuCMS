<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class Admin_copythis
 */
class Admin_copythis extends Backend_Controller
{
    private $sessionName = 'copythis';

    public function __construct()
    {
        parent::__construct();

        // Load classes
        $this->load->model('copythis/copythis_model', 'copythis');
        $this->lang->load('copythis', config_item('selected_lang'));
    }
}

/* End of file Admin_copythis.php */
/* Location: ./application/modules/c/controllers/admin/Admin_copythis.php */

