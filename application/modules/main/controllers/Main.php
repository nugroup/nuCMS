<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class Main
 */
class Main extends Frontend_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Start admin page
     */
    public function homepage()
    {
        $this->render('homepage', $this->data);
    }
}

/* End of file Main.php */
/* Location: ./application/modules/main/controllers/Main.php */
