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
$config['images_url'] = base_url() . 'assets/themes/' . $config['theme'] . '/img/';
$config['default_admin_per_page'] = 10;                                         // Default number of elements

/**
 * Twig
 */
$config['twig_config'] = [
    'paths' => [VIEWPATH.'themes/'.$config['theme'], VIEWPATH],
];
$config['twig_user_functions'] = ['asset', 'generate_menu', 'admin_url', 'flashdata'];

/**
 * Users
 */
$config['users_types'] = array(
    0 => lang('admin')
);

/**
 * Metatags
 */
$config['metatags'] = [
    'title'   => 'nuCMS',
    'version' => 'v.0.1 alfa',
];

/**
 * Users
 */
$config['users_types'] = [
    0 => lang('admin')
];