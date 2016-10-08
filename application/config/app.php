<?php
/**
 * Frontend configuration
 *
 * @author              nugato
 * @copyright           Copyright (c) 2015-2016
 */
$config['app_theme'] = 'bootstrap';
$config['app_theme_path'] = 'themes/';
$config['assets_path'] = 'themes/' . $config['app_theme'] . '/assets';
$config['home_url'] = base_url();
$config['selected_locale'] = 'pl';                                              // Selected locale (can be change on begin in Frontend_Controller)
$config['profiler'] = false;                                                    // Enable/Disable CodeIgniter profiler

/* meta
============================================================================= */
$config['meta_robots'] = 'none';
$config['meta_googlebot'] = 'none';

/* twig
============================================================================= */
$config['twig_config'] = [
    'paths' => array(
        APPPATH.'../themes/'.$config['app_theme'].'/views',
        VIEWPATH,
    ),
    'cache' => (ENVIRONMENT == 'production') ? APPPATH . 'cache/twig/' : false,
];
$config['twig_user_functions'] = [
    'asset',
    'generate_menu',
    'admin_url',
    'flashdata',
    'obj_to_options_array',
    'current_full_url',
    'widget',
];

/* =languages
============================================================================= */
$config['languages'] = [];
$config['languages_by_locale'] = [];