<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class Frontend_Controller
 */
class Frontend_Controller extends NU_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();

        // Load needed config
        $this->load->config('app');

        // Load language file
        $this->lang->load('www', config_item('selected_lang'));

        // Set default setting data
        $this->set_setting();

        // Check profiler status
        if ($this->config->item('profiler') && ENVIRONMENT == 'development') {
            $this->output->enable_profiler();
        }

        $this->config->set_item('first_run', false);
    }

    /**
     * Set default setting from db
     */
    public function set_setting()
    {
        $this->load->model('setting/setting_model', 'setting');

        $this->data['settings'] = $this->setting->get_settings_for_front(config_item('selected_locale'));
    }
}
