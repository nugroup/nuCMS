<?php
/*
|--------------------------------------------------------------------------
| My configurations
|--------------------------------------------------------------------------
|
| Description
|
*/
$config['theme'] = 'default';
$config['images_url'] = base_url() . 'assets/themes/' . $config['theme'] . '/img/';

/* twig
============================================================================= */
$config['twig_config'] = [
    'paths' => [VIEWPATH.'themes/'.$config['theme'], VIEWPATH],
];
$config['twig_user_functions'] = ['asset', 'generate_menu'];