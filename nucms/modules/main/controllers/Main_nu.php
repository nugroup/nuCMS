<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class Main_nu
 */
class Main_nu extends Frontend_Controller
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
        if ($this->uri->segment(2) == 'homepage') {
            redirect(site_url(), 'location  ', 301);
        }

        $this->render('homepage', $this->data);
    }
}

/* End of file Main.php */
/* Location: ./application/modules/main/controllers/Main.php */
