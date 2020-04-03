<?php
defined('_ZERO_PATH_') OR exit('You shall not pass!');

$routes['default_controller'] = 'welcome';
$routes['404_override'] = '';
$routes['translate_uri_dashes'] = FALSE;
$routes['/zzz'] = 'chapter';
$routes['/'] = 'chapter';