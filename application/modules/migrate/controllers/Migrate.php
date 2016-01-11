<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Migration class only for CLI
 */
class Migrate extends MX_Controller
{
    function __construct()
    {
        parent::__construct();

        // Only run this through terminal
        if ($this->input->is_cli_request() == FALSE) {
            show_404();
        }

        $this->load->library('migration');
        $this->load->dbforge();
    }

    /**
     * Migrate current version
     */
    public function current()
    {
        if ($this->migration->current() === FALSE) {
            show_error($this->migration->error_string());
        } else {
            echo "Current migration works!\n";
        }
    }

    /**
     * Migrate to version in parameters
     *
     * @param int $targetVersion
     */
    public function byVersion($targetVersion)
    {
        if ($this->migration->version($targetVersion) === FALSE) {
            show_error($this->migration->error_string());
        } else {
            echo "Migrate version: ".$targetVersion." works!\n";
        }
    }

    /**
     * Migrate currect verion in all modules
     */
    public function allModules()
    {
        if ($this->migration->migrate_all_modules() === FALSE) {
            show_error($this->migration->error_string());
        } else {
            echo "All modules migration works!\n";
        }
    }

    /**
     * Migrate modules by name to current version
     *
     * @param string $moduleName
     */
    public function module($moduleName)
    {
        if ($this->migration->init_module($moduleName)) {
            $this->current();
        } else {
            show_error($this->migration->error_string());
        }
    }

    /**
     * Migrate modules by name to version set in parameter
     *
     * @param string $moduleName
     */
    public function moduleByVersion($moduleName, $targetVersion)
    {
        if ($this->migration->init_module($moduleName)) {
            $this->byVersion($targetVersion);
        } else {
            show_error($this->migration->error_string());
        }
    }
}

/* End of file Migrations.php */
/* Location: ./application/modules/migration/controllers/Migrations.php */