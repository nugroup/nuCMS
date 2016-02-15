<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class Frontend_Controller
 */
class Frontend_Controller extends MY_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();

        // Load needed config
        $this->load->config('my_config');

        // Load language file
        $this->lang->load('www', config_item('selected_lang'));

        // Set default data
        $this->data = [
            'metatags' => [
                'robots' => '',
                'googlebot' => '',
                'title' => '',
                'keywords' => '',
                'description' => '',
            ]
        ];
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
}

/* End of file Frontend_Controller.php */
/* Location: ./application/libraries/Frontend_Controller.php */