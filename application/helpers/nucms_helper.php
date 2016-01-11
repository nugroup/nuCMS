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
        $CI =& get_instance();

        return $CI->config->item('admin_url').$url;
    }
}
