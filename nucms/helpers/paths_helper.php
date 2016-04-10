<?php

if (!function_exists('admin_url')) {

    /**
     * Generate admin panel url
     *
     * @param string $url
     * @return string
     */
    function admin_url($url = '')
    {
        $CI = & get_instance();

        return $CI->config->item('admin_url').$url;
    }
}

if (!function_exists('uploads_url')) {

    /**
     * Generate uploads files url
     *
     * @param string $url
     * @return string
     */
    function uploads_url($url = '')
    {
        $CI = & get_instance();

        return base_url().$CI->config->item('upload_folder').'/'.$url;
    }
}