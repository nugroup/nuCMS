<?php
/**
 * Class NU_Controller
 *
 * @author nuGroup
 */
class NU_Controller extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->add_package_path(NUPATH.'/');

        // Config
        $this->load->config('app');
        $this->load->config('modules');

        // Helpers
        $this->load->helper('language');
        $this->load->helper('security');
        $this->load->helper('url');
        $this->load->helper('functions');
        $this->load->helper('widget');
        $this->load->helper('paths');

        // libraires
        $this->load->library('form_validation');

        $this->db->query("SET NAMES 'utf8'");

        $this->form_validation->CI = & $this;

    }

    /**
     * Render twig view
     *
     * @param string $view
     * @param array $data
     */
    public function render($view, $data, $return = false)
    {
        // Enable twig library and set config
        $this->load->library('twig', $this->config->item('twig_config'));
        $this->load->helper('twig');

        // Add global variables to twig
        $this->twig->addGlobal("session", $this->session->userdata);
        $this->twig->addGlobal("config", $this->config->config);
        $this->twig->addGlobal("input", $this->input);

        // Add user function to twig
        if ($this->config->item('twig_user_functions')) {
            foreach ($this->config->item('twig_user_functions') as $function) {
                $this->twig->addFunction($function);
            }
        }

        // Render twig view
        if ($return) {
            return $this->twig->render($view, $data);
        } else {
            $this->twig->display($view, $data);
        }
    }

    /**
     * Add message to log
     *
     * @param type $message
     * @param type $level
     */
    public function set_log($message, $level = 'error')
    {
        $logMessage = $message.'<br>File: <b>'.__FILE__.'</b><br>Line: <b>'.__LINE__.'</b>';

        log_message($level, $logMessage);
    }
}