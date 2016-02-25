<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Bootstrap loader for nuCMS
 *
 * @author nuGroup
 */
class NU_AutoLoader
{
    private $include_paths = array();

    /**
     * Register the autoloader function.
     *
     * @access public
     * @param array include paths
     * @return void
     */
    public function register(array $paths = array())
    {
        $this->include_paths = $paths;

        spl_autoload_register(array($this, 'autoloader'));
    }

    /**
     * Autoload base classes.
     *
     * @access public
     * @param string class to load
     * @return void
     */
    public function autoloader($class)
    {
        foreach ($this->include_paths as $path) {
            $filepath = $path.$class.EXT;

            if (!class_exists($class, FALSE) AND is_file($filepath)) {
                include_once($filepath);

                break;
            }
        }
    }
}
