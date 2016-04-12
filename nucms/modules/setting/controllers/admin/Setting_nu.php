<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class Setting_nu
 */
class Setting_nu extends Backend_Controller
{
    private $sessionName = 'setting';

    public function __construct()
    {
        parent::__construct();

        // Load classes
        $this->load->model('setting/setting_model', 'setting');
        $this->lang->load('setting', config_item('selected_lang'));
    }

    /**
     * Default setting for website
     */
    public function index()
    {
        $locale = ($this->input->get('locale')) ? $this->input->get('locale') : config_item('selected_locale');
        $settings = $this->setting_translations
            ->where('locale', $locale)
            ->with_root()
            ->get();

        if ($this->input->post()) {
            $where = [
                'setting_id' => 1,
                'locale' => $locale
            ];

            // Check if setting exist
            $this->setting_translations->check_exists_locale(1, $locale);

            // Update setting translation
            $result = $this->setting_translations
                ->from_form(null, [], $where)
                ->update();

            if ($result) {
                // Set informations
                $this->session->set_flashdata('success', lang('alert.success.saved_changes'));
            }

            // Redirect
            redirect(current_full_url());
        }

        // Set view data
        $this->data['setting'] = prepare_join_data($settings, 'root');
        $this->data['subnav_active'] = 'index';
        $this->data['selected_language'] = $this->config->item($locale, 'system_languages_by_locale')->name;

        // Load the view
        $this->render('setting/index', $this->data);
    }
}

/* End of file Setting_nu.php */
/* Location: ./application/modules/setting/controllers/admin/Setting_nu.php */