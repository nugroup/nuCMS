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

        // Check profiler status
        if ($this->config->item('profiler') && ENVIRONMENT == 'development') {
            $this->output->enable_profiler();
        }

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
        $this->twig->addGlobal("input", $this->input);

        // Add user function to twig
        if ($this->config->item('twig_user_functions')) {
            foreach ($this->config->item('twig_user_functions') as $function) {
                $this->twig->addFunction($function);
            }
        }

        // Render twig view
        $this->twig->display($view, $data);
    }

    /**
     * Add message to log
     *
     * @param type $message
     * @param type $level
     */
    public function set_log($message, $level = 'error')
    {
        $logMessage = $message.'<br>File: <b>'.__FILE__.'</b><br>Line: <b>'.__LINE__.'</b>'.lang('exc_info');

        log_message($level, $logMessage);
    }

    /**
     * Transfer data from obj->{$fieldName} variable to obj
     *
     * @param array/object $data
     * @return array/object
     */
    public function prepare_join_data($data, $fieldName)
    {
        if (is_array($data)) {
            foreach ($data as $row) {
                if (isset($row->{$fieldName})) {
                    unset($row->{$fieldName}->id);

                    foreach ($row->{$fieldName} as $key => $value) {
                        $row->{$key} = $value;
                    }

                    unset($row->{$fieldName});
                }
            }
        } else {
            if (isset($data->{$fieldName})) {
                unset($data->{$fieldName}->id);

                foreach ($data->{$fieldName} as $key => $value) {
                    $data->{$key} = $value;
                }

                unset($data->{$fieldName});
            }
        }

        return $data;
    }
}

/* End of file Backend_controller.php */
/* Location: ./application/core/MY_Controller.php */