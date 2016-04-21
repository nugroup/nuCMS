<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class Main_nu
 */
class Main_nu extends Backend_Controller
{
    public function __construct()
    {
        parent::__construct();

        // View data
        $this->data['nu_title'] = lang('desktop');
    }

    /**
     * Start admin page
     */
    public function index()
    {
        $this->render('main/dashboard', $this->data);
    }
}

/* End of file Admin.php */
/* Location: ./application/modules/main/controllers/admin/Admin_main.php */