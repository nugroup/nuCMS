<?php
/**
 * nuCMS - Admin configuration
 *
 * @author		nugato
 * @copyright          Copyright (c) 2015
 */
$config['admin_folder'] = 'admin';                                              // Admin folder and prefix name
$config['theme'] = 'admin_final';                                               // Admin view theme name
$config['admin_url'] = base_url() . $config['admin_folder'] . '/';              // Admin url
$config['modules_path'] = APPPATH . 'modules/';                                 // Path to modules folder
$config['selected_lang'] = 'polish';                                            // Selected lang (can be change on begin in Backend_Controller)
$config['selected_locale'] = 'pl';                                              // Selected locale (can be change on begin in Backend_Controller)
$config['images_url'] = base_url() . 'assets/themes/' . $config['theme'] . '/img/';
$config['default_admin_per_page'] = 10;                                         // Default number of elements
$config['profiler'] = false;                                                    // Enable/Disable CodeIgniter profiler

/* copyright
============================================================================= */
$config['copyright'] = [
    'date'             => '2016',
    'company_name'     => 'nugato',
    'company_website'  => 'http://www.nugato.pl',
];

/* twig
============================================================================= */
$config['twig_config'] = [
    'paths' => [NUPATH.'/views/themes/'.$config['theme'], VIEWPATH],
    'cache' => false,
];
$config['twig_user_functions'] = [
    'asset',
    'admin_url',
    'flashdata',
    'obj_to_options_array',
    'current_full_url',
    'form_nu_dropdown',
    'widget',
    'generate_thumbnail',
    'sort_header',
];

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
$config['default_locale'] = 'pl';
$config['system_languages'] = [];
$config['system_languages_by_locale'] = [];
$config['languages_tables'] = [                                                 // Tables with translations
    'nu_page'
];

/* pages
============================================================================= */
$config['pages_route_controller'] = 'page/page_nu/show/';

/* files
============================================================================= */
$config['upload_action'] = $config['admin_url'].'file/upload';
$config['upload_folder'] = 'uploads';
$config['upload_max_file_size'] = 50; // MB