<?php
/**
 * nuCMS
 *
 * @author		Jacek Bednarek & Szymon Kulczynski
 * @copyright          Copyright (c) 2015-2016
 */
$config['admin_folder'] = 'admin';                                              // Admin folder and prefix name
$config['theme'] = 'admin';                                                     // Admin view theme name
$config['admin_url'] = base_url() . $config['admin_folder'] . '/';              // Admin url
$config['modules_path'] = APPPATH . 'modules/';                                 // Path to modules folder
$config['selected_lang'] = 'polish';                                            // Selected lang (can be change on begin in Backend_Controller)
$config['selected_locale'] = 'pl';                                              // Selected locale (can be change on begin in Backend_Controller)
$config['images_url'] = base_url() . 'assets/themes/' . $config['theme'] . '/img/';
$config['default_admin_per_page'] = 10;                                         // Default number of elements
$config['profiler'] = false;                                                    // Enable/Disable CodeIgniter profiler

/* twig
============================================================================= */
$config['twig_config'] = [
    'paths' => [VIEWPATH.'themes/'.$config['theme'], VIEWPATH],
];
$config['twig_user_functions'] = ['asset', 'generate_menu', 'admin_url', 'flashdata', 'obj_to_options_array', 'current_full_url'];

/* users
============================================================================= */
$config['users_types'] = array(
    0 => lang('config.user_types.admin')
);

/* metatags
============================================================================= */
$config['metatags'] = [
    'title'   => 'nuCMS',
    'version' => 'v.0.1 alfa',
];

/* languages
============================================================================= */
$config['system_languages'] = [];
$config['system_languages_by_locale'] = [];

/* pages
============================================================================= */
$config['pages_route_controller'] = 'page/show/';

