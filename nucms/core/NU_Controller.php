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

        // WWW redirection
        if (!(strstr($_SERVER['HTTP_HOST'], "www")) && ENVIRONMENT != 'development') {
            redirect(config_item('base_url_301').$_SERVER['REQUEST_URI'], 'location', 301);
        }

        // index.php redirection
        if (strstr($_SERVER['REQUEST_URI'], 'index.php')) {
            redirect(config_item('base_url_301').str_replace('/index.php', '', $_SERVER['REQUEST_URI']));
        }

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
        $this->load->library('menu/menu_widget', $this->data);

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