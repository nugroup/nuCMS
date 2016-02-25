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
];
$config['admin_main_module'] = [
    'route' => 'main',
    'controller' => 'main/admin/main_nu/index',
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
    'menu' => [
        'routes' => [
            'admin_menu' => [
                'route' => 'menu',
                'controller' => 'admin/menu_nu',
                'admin' => true
            ],
        ],
    ],
];