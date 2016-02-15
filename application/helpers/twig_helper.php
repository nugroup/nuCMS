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