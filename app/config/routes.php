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
// 打开用户信息编辑页
$routes['/admin/user/settings'] = 'admin/user/settings';
// 删除用户信息
$routes['/admin/user/delete'] = 'admin/user/delete';
// 用户信息维护
$routes['/admin/user/maintain'] = 'admin/user/maintain';
// 打开用户列表
$routes['/admin/user/list'] = 'admin/user/list';
// 获取用户数据
$routes['/admin/user/data'] = 'admin/user/data';
// 打开分类列表
$routes['/admin/category/list'] = 'admin/category/list';
// 获取分类数据
$routes['/admin/category/data'] = 'admin/category/data';
