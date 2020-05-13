<?php
defined('_APP_PATH_') or exit('You shall not pass!');

$routes['default_controller'] = 'welcome';
$routes['404_override'] = '';
$routes['translate_uri_dashes'] = FALSE;


// Login Page
$routes['/login'] = 'admin/admin/login';
// Admin
$routes['/admin'] = 'admin/admin/index';
// Settings
$routes['/admin/settings'] = 'admin/settings/index';
// Settings
$routes['/admin/settings/maintain'] = 'admin/settings/maintain';
// Settings
$routes['/admin/settings/delete/logo'] = 'admin/settings/delete_logo';
// Settings
$routes['/admin/settings/delete/background'] = 'admin/settings/delete_bg';
