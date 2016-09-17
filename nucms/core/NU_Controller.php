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

        // Add new package folder
        $this->load->add_package_path(NUPATH.'/', TRUE);
        $this->load->add_package_path(NUPATH.'/modules/auth/', TRUE);

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
        $this->load->helper('twig');

        // libraires
        $this->load->library('form_validation');
        $this->load->library('auth/ion_auth');
        $this->load->library('block/block_lib');

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
        return render_twig($view, $data, $return);
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