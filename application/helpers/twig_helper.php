<?php

if (!function_exists('asset')) {

    /**
     * Generate asset path
     *
     * @param string $pathName
     * @return string
     */
    function asset($pathName)
    {
        return site_url('assets/themes/'.config_item('theme').'/'.$pathName);
    }
}

if (!function_exists('flashdata')) {

    /**
     * Get flashdata from codeigniter
     *
     * @param string $key
     * @return string
     */
    function flashdata($key)
    {
        $CI =& get_instance();

        return $CI->session->flashdata($key);
    }
}

if ( ! function_exists('obj_to_options_array')) 
{
    /**
     * Prepare options for form select from object
     *
     * @param object $stdObj
     * @param string $primary_key
     * @param string $value_key
     * @return array
     */
    function obj_to_options_array($stdObj, $primary_key, $value_key)
    {
        $result = array('' => lang('select'));

        if($stdObj) {
            foreach($stdObj as $obj) {
                $result[$obj->{$primary_key}] = $obj->{$value_key};
            }
        }

        return $result;
    }
}