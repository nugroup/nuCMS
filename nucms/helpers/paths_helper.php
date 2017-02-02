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

if (!function_exists('asset')) {

    /**
     * Generate asset path
     *
     * @param string $pathName
     * @return string
     */
    function asset($pathName)
    {
        return site_url(config_item('assets_path').'/'.$pathName);
    }
}

if (!function_exists('route')) {

    /**
     * Generate route
     * 
     * @param int $primaryKey
     * @param string $module
     * @param string $locale
     * 
     * @return string
     */
    function route($primaryKey, $module, $locale = null)
    {
        $CI = & get_instance();
        $CI->load->model('route/route_model', 'route');
        $locale = (is_null($locale)) ? config_item('selected_locale') : $locale;

        $route = $CI->route->getSingleRoute($primaryKey, $module, $locale);
        
        if ($route) {
            $prefix = '';
            if (in_array($module, config_item('prefix'))) {
                $prefix = $CI->config->item($module, 'prefix');
            }
            
            return $prefix . $route->slug;
        }
        
        return '';
    }
}