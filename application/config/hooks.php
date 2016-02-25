<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
  | -------------------------------------------------------------------------
  | Hooks
  | -------------------------------------------------------------------------
  | This file lets you define "hooks" to extend CI without hacking the core
  | files.  Please see the user guide for info:
  |
  |	http://codeigniter.com/user_guide/general/hooks.html
  |
 */
$hook['pre_system'] = array(
    'class'    => 'NU_AutoLoader',
    'function' => 'register',
    'filename' => 'NU_AutoLoader.php',
    'filepath' => '../nucms/hooks',
    'params'   => array(
        NUPATH.'/core/',
        NUPATH.'/interfaces/',
        NUPATH.'/libraries/',
    )
);