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

    /**
     * Change number of elements per page
     *
     * @param type $number
     */
    public function change_per_page($number, $redirect = 1)
    {
        // Set admin_per_page session
        $this->session->set_userdata('admin_per_page', $number);

        if ((int) $redirect == 1) {
            // Redirect to http_referrer
            $this->load->library('user_agent');
            $referrerUrl = $this->agent->referrer();
            $exUrl = explode('?', $referrerUrl);

            redirect($exUrl[0]);
        }
    }
}

/* End of file Admin.php */
/* Location: ./application/modules/main/controllers/admin/Admin_main.php */