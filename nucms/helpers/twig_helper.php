<?php

if (!function_exists('render_twig')) {

    /**
     * Render twig view
     *
     * @param string $view
     * @param array $data
     */
    function render_twig($view, $data, $return = false)
    {
        $CI = & get_instance();

        // Enable twig library and set config
        $CI->load->library('twig', $CI->config->item('twig_config'));
        $CI->load->helper('twig');

        // Add global variables to twig
        $CI->twig->addGlobal("session", $CI->session->userdata);
        $CI->twig->addGlobal("config", $CI->config->config);
        $CI->twig->addGlobal("input", $CI->input);

        // Add user function to twig
        if ($CI->config->item('twig_user_functions')) {
            foreach ($CI->config->item('twig_user_functions') as $function) {
                $CI->twig->addFunction($function);
            }
        }

        // Render twig view
        if ($return) {
            return $CI->twig->render($view, $data);
        } else {
            $CI->twig->display($view, $data);
        }
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
        $CI = & get_instance();

        return $CI->session->flashdata($key);
    }
}