<?php

/**
 * Class MY_Controller
 */
class MY_Controller extends MX_Controller
{
    public function __construct()
    {
        $this->db->query("SET NAMES 'utf8'");

        // Load needed library
        $this->load->library('form_validation');
        $this->form_validation->CI = & $this;

        parent::__construct();
    }

    /**
     * Render twig view
     *
     * @param string $view
     * @param array $data
     */
    public function render($view, $data)
    {
        // Enable twig library and set config
        $this->load->library('twig', $this->config->item('twig_config'));
        $this->load->helper('twig');

        // Add global variables to twig
        $this->twig->addGlobal("session", $this->session->userdata);
        $this->twig->addGlobal("config", $this->config->config);

        // Add user function to twig
        if ($this->config->item('twig_user_functions')) {
            foreach ($this->config->item('twig_user_functions') as $function) {
                $this->twig->addFunction($function);
            }
        }

        // Render twig view
        $this->twig->display($view, $data);
    }
}

/* End of file Backend_controller.php */
/* Location: ./application/core/MY_Controller.php */