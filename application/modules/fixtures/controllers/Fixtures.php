<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class Fixtures
 */
class Fixtures extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Only run this through terminal
        if ($this->input->is_cli_request() == FALSE) {
            show_404();
        }

        if (ENVIRONMENT != 'development') {
            echo "\nYou can only use Fixtures in DEVELOPMENT environment.\n\n";
            die();
        }

        $this->load->helper('directory');
    }

    /**
     * Run all fixtures from fixtures folder
     */
    public function load()
    {
        echo "\n";

        $files = directory_map(APPPATH.'/fixtures');

        if ($files) {

            sort($files);

            foreach ($files as $file) {
                include(APPPATH.'/fixtures/'.$file);

                $exFileName = explode('_', $file);
                $className = str_replace('.php', '', $exFileName[1]);
                $fixturesClass = new $className();
                $fixturesClass->load();

                echo $className." was loaded.\n";
            }

        }

        echo "\n";
    }
}

/* End of file Fixtures.php */
/* Location: ./application/modules/fixtures/controllers/Fixtures.php */