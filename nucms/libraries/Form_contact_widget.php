<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Widget class for contact form
 *
 * @author nugato
 */
class Form_contact_widget
{
    /**
     * Codeigniter instance
     * 
     * @var Controller
     */
    private $CI;

    /**
     * Validation rules array
     *
     * @var array
     */
    private $validationRules = [
        'formContact[name]' => [
            'field' => 'formContact[name]',
            'label' => 'lang:form.contact.name',
            'rules' => 'required|trim|xss_clean'
        ],
    ];

    /**
     * Validation errors message
     *
     * @var string
     */
    private $validationErrors;

    /**
     * Validation success message
     *
     * @var string
     */
    private $validationSuccess;

    public function __construct()
    {
        $this->CI = & get_instance();
    }

    /**
     * Main public method to display form using widget system
     */
    public function display()
    {
        if ($this->CI->input->post()) {
            $this->validate();
        }

        $data = [
            'validation_success' => $this->CI->session->flashdata('formContactSuccess'),
            'validation_errors' => $this->validationErrors,
        ];

        echo render_twig('form/form_contact', $data, true);
    }

    /**
     * Form validation
     */
    private function validate()
    {
        $this->CI->form_validation->set_rules($this->validationRules);

        if ($this->CI->form_validation->run() == true) {
            // @todo Add swiftmailer, mail class and form send
            $this->CI->session->set_flashdata('formContactSuccess', lang('form.contact.success_msg'));
            redirect(current_full_url().'#send');
        } else {
            $this->validationErrors = validation_errors();
        }
    }
}