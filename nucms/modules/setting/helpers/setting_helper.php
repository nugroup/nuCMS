<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


if (!function_exists('display_setting_hiddens')) {

    /**
     * Display needed inputs hidden to create/save a setting
     * 
     * @param string $key
     * @param string $name
     * @param string $type
     * @param int $global 0/1
     */
    function display_setting_hiddens($key, $name, $type, $global)
    {
        echo form_hidden('settings[' . $key . '][name]', $name);
        echo form_hidden('settings[' . $key . '][type]', $type);
        echo form_hidden('settings[' . $key . '][global]', $global);
    }
}