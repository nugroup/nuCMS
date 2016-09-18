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
     * Set metatada
     *
     * @param array $metatags
     */
    public function set_metatags($metatags)
    {
        if ($metatags->meta_title != '') {
            $this->data['metatags']['title'] = $this->data['metatags']['title'] . ' | ' . $metatags->meta_title;
        }
        if ($metatags->meta_keywords != '') {
            $this->data['metatags']['keywords'] = $metatags->meta_keywords;
        }
        if ($metatags->meta_description != '') {
            $this->data['metatags']['description'] = $metatags->meta_description;
        }
    }

    /**
     * Set default setting from db
     */
    public function set_setting()
    {
        $this->load->model('setting/setting_model', 'setting');

        $this->data = [
            'metatags' => [
                'robots' => '',
                'googlebot' => '',
                'title' => '',
                'keywords' => '',
                'description' => '',
            ]
        ];

        $settings = $this->setting->get_settings_for_front(config_item('selected_locale'));

        if ($settings) {
            $this->data['metatags'] = [
                'title' => (isset($settings['meta_title'])) ? $settings['meta_title']->value : '',
                'keywords' => (isset($settings['meta_keywords'])) ? $settings['meta_keywords']->value : '',
                'description' => (isset($settings['meta_description'])) ? $settings['meta_description']->value : '',
            ];

            $this->data['socials'] = [
                'facebook' => (isset($settings['social_facebook'])) ? $settings['social_facebook']->value : '',
                'twitter'  => (isset($settings['social_twitter'])) ? $settings['social_twitter']->value : '',
                'youtube'  => (isset($settings['social_youtube'])) ? $settings['social_youtube']->value : '',
                'google'   => (isset($settings['social_google'])) ? $settings['social_google']->value : '',
            ];
        }
    }
}