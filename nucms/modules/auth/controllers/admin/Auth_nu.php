<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class Auth_nu
 */
class Auth_nu extends Backend_Controller
{
    public function __construct()
    {
        parent::__construct();
		
        $this->lang->load('auth/auth');
        $this->load->model('auth/auth_model', 'auth');
    }

    /**
     * Login to cms
     */
    public function login()
    {
        // Redirect if logged in
        if ($this->ion_auth->logged_in()) {
            redirect(admin_url('page'));
        }

        // Set up the form
        $rules = array(
            'identity' => array('field' => 'identity', 'label' => lang('auth.login.identity'), 'rules' => 'trim|required|xss_clean'),
            'password' => array('field' => 'password', 'label' => lang('auth.login.password'), 'rules' => 'trim|required')
        );
        $this->form_validation->set_rules($rules);

        // Log in
        if ($this->form_validation->run() == TRUE) {
            if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), false)) {
                redirect(admin_url());
            } else {
                $this->session->set_flashdata('error', $this->ion_auth->errors());
                redirect(admin_url('auth/login'));
            }
        }

        $this->render('auth/login', $this->data);
    }

    /**
     * Logout from admin panel
     */
    public function logout()
    {
        $this->ion_auth->logout();
        redirect(admin_url('auth/login'));
    }
}

/* End of file Admin_auth.php */
/* Location: ./application/modules/auth/controllers/admin/Admin_auth.php */