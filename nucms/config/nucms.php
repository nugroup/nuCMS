<?php
/**
 * nuCMS - Admin configuration
 *
 * @author              nugato
 * @copyright           Copyright (c) 2015
 */
$config['admin_folder'] = 'admin';                                              // Admin folder and prefix name
$config['theme'] = 'admin';                                                     // Admin view theme name
$config['assets_path'] = 'nucms/themes/' . $config['theme'] . '/assets';
$config['admin_url'] = base_url() . $config['admin_folder'] . '/';              // Admin url
$config['modules_path'] = APPPATH . 'modules/';                                 // Path to modules folder
$config['selected_locale'] = 'pl';                                              // Selected locale (can be change on begin in Backend_Controller)
$config['images_url'] = base_url() . 'assets/themes/' . $config['theme'] . '/img/';
$config['default_admin_per_page'] = 10;                                         // Default number of elements
$config['profiler'] = false;                                                    // Enable/Disable CodeIgniter profiler

/* copyright
============================================================================= */
$config['copyright'] = [
    'date'             => '2015 - ' . date('Y'),
    'company_name'     => 'nugato',
    'company_website'  => 'http://www.nugato.pl',
];

/* twig
============================================================================= */
$config['twig_config'] = [
    'paths' => array(
        NUPATH.'/themes/'.$config['theme'].'/views/',
        VIEWPATH
    ),
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
    'extension',
    'is_image',
    'display_setting_hiddens',
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
    'nu_page',
    'nu_setting',
    'nu_news'
];

/* pages
============================================================================= */
$config['pages_route_controller'] = 'page/page_nu/show/';

/* files
============================================================================= */
$config['upload_action'] = $config['admin_url'].'file/upload';

/* menu
============================================================================= */
$config['admin_menu'] = [
    10 => [
        'slug' => 'page',
        'name' => lang('menu.pages'),
        'icon' => 'fa-file',
    ],
    20 => [
        'slug' => 'news',
        'name' => lang('menu.news'),
        'icon' => 'fa-newspaper-o',
        'submenu' => [
            [
                'slug' => 'news-category',
                'name' => lang('menu.news_category'),
            ]
        ]
    ],
    30 => [
        'slug' => 'block',
        'name' => lang('menu.block'),
        'icon' => 'fa-puzzle-piece',
    ],
    40 => [
        'slug' => 'file',
        'name' => lang('menu.files'),
        'icon' => 'fa-picture-o',
    ],
    50 => [
        'slug' => 'setting',
        'name' => lang('menu.settings'),
        'icon' => 'fa-wrench',
        'submenu' => [
            [
                'slug' => 'menu',
                'name' => lang('menu.menu'),
            ],
            [
                'slug' => 'user',
                'name' => lang('menu.users'),
            ],
            [
                'slug' => 'language',
                'name' => lang('menu.languages'),
            ]
        ]
    ],
];

// Load user configuration
include(APPPATH . 'config/admin.php');