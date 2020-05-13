<?php
defined('_APP_PATH_') or exit('You shall not pass!');

$routes['default_controller'] = 'welcome';
$routes['404_override'] = '';
$routes['translate_uri_dashes'] = FALSE;


// 登录页
$routes['/login'] = 'admin/admin/login';
// 后台首页
$routes['/admin'] = 'admin/admin/index';
// 配置页
$routes['/admin/settings'] = 'admin/settings/index';
// 配置提交接口
$routes['/admin/settings/maintain'] = 'admin/settings/maintain';
// 配置删除Logo
$routes['/admin/settings/delete/logo'] = 'admin/settings/delete_logo';
// 配置删除背景
$routes['/admin/settings/delete/background'] = 'admin/settings/delete_bg';
// 打开远程交互
$routes['/admin/remote/gen'] = 'admin/remote/gen';
