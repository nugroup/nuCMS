<?php
/**
 * Frontend configuration
 *
 * @author		Jacek Bednarek & Szymon Kulczynski
 * @copyright          Copyright (c) 2015-2016
 */
$config['theme'] = 'nu';
$config['selected_lang'] = 'polish';                                            // Selected lang (can be change on begin in Frontend_Controller)
$config['selected_locale'] = 'pl';                                              // Selected locale (can be change on begin in Frontend_Controller)
$config['profiler'] = false;                                                    // Enable/Disable CodeIgniter profiler

/* twig
============================================================================= */
$config['twig_config'] = [
    'paths' => [VIEWPATH.'themes/'.$config['theme'], VIEWPATH],
//    'cache' => false,
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