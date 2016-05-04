<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class Fixtures
 */
class Fixtures extends NU_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Only run this through terminal
        if (ENVIRONMENT == 'production' && $this->input->is_cli_request() == FALSE) {
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
        $nuFixtures = directory_map(NUPATH.'/fixtures');
        $appFixtures = directory_map(APPPATH.'/fixtures');

        $this->runFixtures($nuFixtures, NUPATH.'/fixtures');
        $this->runFixtures($appFixtures, APPPATH.'/fixtures');
    }

    /**
     * Run fixtures from all files
     *
     * @param array $files
     */
    public function runFixtures($files, $path)
    {
        echo "\n";

        if ($files) {

            sort($files);

            foreach ($files as $file) {
                include($path.'/'.$file);

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