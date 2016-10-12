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
            $this->process();
        }

        if ($this->CI->session->flashdata('formContactError')) {
            $this->validationErrors = $this->CI->session->flashdata('formContactError');
        }

        $data = [
            'validation_success' => $this->CI->session->flashdata('formContactSuccess'),
            'validation_errors' => $this->validationErrors,
        ];

        echo render_twig('form/form_contact', $data, true);
    }

    /**
     * Form process
     * 
     * 1. validation
     * 2. send
     * 3. set message
     * 4. redirect
     */
    private function process()
    {
        $this->CI->form_validation->set_rules($this->validationRules);

        if ($this->CI->form_validation->run() == true) {
            $sendResult = $this->send($this->prepare_message());

            if ($sendResult['result'] == 1) {
                $this->CI->session->set_flashdata('formContactSuccess', lang('form.contact.success_msg'));
            } else {
                $this->CI->session->set_flashdata('formContactError', lang('form.contact.error_msg'));
                log_message('error', $sendResult['error']);
            }

            redirect(current_full_url().'#send');
        } else {
            $this->validationErrors = validation_errors();
        }
    }

    /**
     * Create swiftmailer message object and send e-mail
     *
     * @param string $message_body
     *
     * @return array
     */
    private function send($message_body)
    {
        $this->CI->load->library('mailer_nu');

        $message = Swift_Message::newInstance(lang('form.contact.email.subject'))
            ->setFrom($this->CI->config->item('from', 'mailer'))
            ->setTo($this->CI->config->item('to', 'mailer'))
            ->setBody($message_body, 'text/html');

        return $this->CI->mailer_nu->send($message);
    }

    /**
     * Preare message body
     *
     * @return string
     */
    private function prepare_message()
    {
        return render_twig('email/contact_form', [
            'form_contact' => $this->CI->input->post('formContact')
        ], true);
    }
}