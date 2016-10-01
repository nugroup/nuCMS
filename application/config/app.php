<?php
/**
 * Frontend configuration
 *
 * @author              nugato
 * @copyright           Copyright (c) 2015-2016
 */
$config['theme'] = 'bootstrap';
$config['assets_path'] = 'themes/' . $config['theme'] . '/assets';
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
        APPPATH.'../themes/'.$config['theme'].'/views',
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