<?php

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