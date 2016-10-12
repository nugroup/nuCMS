<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Mail helper class using swiftmailer
 *
 * @author nugato
 */
class Mailer_nu
{
    /**
     * Codeigniter instance
     *
     * @var Controller
     */
    private $CI;

    /**
     * Mailer object
     *
     * @var Swift_Mailer
     */
    private $mailer;

    /**
     * Config array (host, port, username, password)
     *
     * @var array
     */
    private $config;

    public function __construct()
    {
        $this->CI = & get_instance();

        $this->get_config();

        $transport = Swift_SmtpTransport::newInstance(
                $this->config['host'],
                $this->config['port'],
                $this->config['security']
            )
            ->setUsername($this->config['username'])
            ->setPassword($this->config['password']);

        $this->mailer = Swift_Mailer::newInstance($transport);
    }

    /**
     * Send message by mailer
     *
     * @param Swift_Message $message
     *
     * @return type
     */
    public function send(Swift_Message $message)
    {
        $error = $result = '';

        try {
            $result = $this->mailer->send($message);
        } catch (Swift_TransportException $STe) {
            $error = date("Y-m-d H:i:s").' - '.$STe->getMessage();
        } catch (Exception $e) {
            $error = date("Y-m-d H:i:s").' - GENERAL ERROR - '.$e->getMessage();
        }

        return [
            'result' => $result,
            'error' => $error
        ];
    }

    /**
     * Get configuration for mailer (host, port, username, password, security)
     */
    private function get_config()
    {
        $this->config = config_item('mailer');
    }
}