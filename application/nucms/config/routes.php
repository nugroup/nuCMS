<?php
// admin panel routes
$route['admin/([a-zA-Z_-]+)-([a-zA-Z_-]+)/(.+)'] = '$1/admin/admin_$1_$2/$3';
$route['admin/([a-zA-Z_-]+)-([a-zA-Z_-]+)'] = '$1/admin/admin_$1_$2/index';
$route['admin/([a-zA-Z_-]+)/(.+)'] = '$1/admin/admin_$1/$2';
$route['admin/([a-zA-Z_-]+)'] = '$1/admin/admin_$1/index';
$route['admin'] = "main/admin/admin_main";

// dynamic routes genereted by routes_model
if (file_exists(APPPATH.'/cache/dynamic_routes.php')) {
    include_once APPPATH . 'cache/dynamic_routes.php';
}