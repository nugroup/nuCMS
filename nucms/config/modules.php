<?php

/**
 * nuCMS - Modules configuration
 *
 * @author		nuGroup
 * @copyright          Copyright (c) 2015-2016
 */
// name of module loaded at '/admin'
$config['main_module'] = [
    'route' => 'main',
    'controller' => 'main/main_nu/homepage',
    'controller_name' => 'main/main_nu/',
];
$config['admin_main_module'] = [
    'route' => 'main',
    'controller' => 'main/admin/main_nu/index',
    'controller_name' => 'main/admin/main_nu/',
];

// other modules
$config['modules'] = [
    'main' => [
        'routes' => [
            'main' => [
                'route' => 'main',
                'controller' => 'main_nu',
                'admin' => false
            ],
            'admin_main' => [
                'route' => 'main',
                'controller' => 'admin/main_nu',
                'admin' => true
            ]
        ],
    ],
    'auth' => [
        'routes' => [
            'admin_auth' => [
                'route' => 'auth',
                'controller' => 'admin/auth_nu',
                'admin' => true
            ],
        ],
    ],
    'user' => [
        'routes' => [
            'admin_user' => [
                'route' => 'user',
                'controller' => 'admin/user_nu',
                'admin' => true
            ],
        ],
    ],
    'language' => [
        'routes' => [
            'admin_language' => [
                'route' => 'language',
                'controller' => 'admin/language_nu',
                'admin' => true
            ],
        ],
    ],
    'page' => [
        'routes' => [
            'admin_page' => [
                'route' => 'page',
                'controller' => 'admin/page_nu',
                'admin' => true
            ],
        ],
    ],
    'news' => [
        'routes' => [
            'admin_news' => [
                'route' => 'news',
                'controller' => 'admin/news_nu',
                'admin' => true
            ],
        ],
    ],
    'menu' => [
        'routes' => [
            'admin_menu' => [
                'route' => 'menu',
                'controller' => 'admin/menu_nu',
                'admin' => true
            ],
        ],
    ],
    'file' => [
        'routes' => [
            'admin_file' => [
                'route' => 'file',
                'controller' => 'admin/file_nu',
                'admin' => true
            ],
        ],
    ],
    'setting' => [
        'routes' => [
            'admin_setting' => [
                'route' => 'setting',
                'controller' => 'admin/setting_nu',
                'admin' => true
            ],
        ],
    ],
    'block' => [
        'routes' => [
            'admin_block' => [
                'route' => 'block',
                'controller' => 'admin/block_nu',
                'admin' => true
            ],
        ],
    ],
];