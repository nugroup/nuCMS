<?php

if ( ! function_exists('extension')) 
{
    /**
     * Get extension from string
     *
     * @param string $file_name
     * @return string
     */
    function extension($file_name)
    {
        $ex = explode(".", $file_name);
        $i = (count($ex) - 1);

        return strtolower($ex[$i]);
    }
}

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