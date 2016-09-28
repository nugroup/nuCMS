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
        $this->lang->load('copythis', config_item('selected_locale'));
    }

    public function index()
    {

        // Load the view
        $this->render('copythis/index', $this->data);
    }
}

/* End of file Admin_copythis.php */
/* Location: ./application/modules/copythis/controllers/admin/Admin_copythis.php */