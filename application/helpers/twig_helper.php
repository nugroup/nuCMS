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

if (!function_exists('generate_menu')) {

    /**
     * Generate menu from pages
     * 
     * @param object $pages
     * @return type
     */
    function generate_menu($pages)
    {
        $CI =& get_instance();

        $uri = $CI->uri->uri_string();

        $classActiveHome = ($uri == '') ? 'class="active"' : '';
        echo '<li><a href="'.base_url().'" '.$classActiveHome.'>'.lang('homepage').'</a></li>';

        if ($pages) {
            foreach ($pages as $page) {
                $classActive = ($page->slug == $uri) ? 'class="active"' : '';
                echo '<li><a href="'.$page->slug.'" '.$classActive.'>'.$page->title.'</a></li>';
            }
        }
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