<?php

// Module routing
include_once NUPATH . '/config/modules.php';
include_once APPPATH . '/config/modules.php';

// main admin route
$route['admin'] = $config['admin_main_module']['controller'];

$config['modules_ok'] = array_merge($config['modules'], $config['override_modules']);
foreach ($config['modules_ok'] as $moduleName => $module) {

    foreach ($module['routes'] as $name => $controller) {

        // Check prefix
        $prefix = ($controller['admin']) ? 'admin/' : '';

        $route[$prefix.$controller['route']] = $moduleName.'/'.$controller['controller'].'/index';
        $route[$prefix.$controller['route'].'/(.+)'] = $moduleName.'/'.$controller['controller'].'/$1';

    }

}
//
//echo '<pre>';
//print_r($route);
//echo '</pre>';
//die();

// dynamic routes genereted by routes_model
if (file_exists(APPPATH.'/cache/dynamic_routes.php')) {
    include_once APPPATH . 'cache/dynamic_routes.php';
}

$route['default_controller'] = $config['main_module']['controller'];