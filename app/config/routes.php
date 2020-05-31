<?php
defined('_APP_PATH_') or exit('You shall not pass!');

$routes['default_controller'] = 'welcome';
$routes['404_override'] = '';
$routes['translate_uri_dashes'] = FALSE;


// 登录页
$routes['/login'] = 'admin/admin/login';
// 后台首页
$routes['/admin'] = 'admin/admin/index';
// 配置删除Logo
$routes['/admin/settings/delete/logo'] = 'admin/settings/delete_logo';
// 配置删除背景
$routes['/admin/settings/delete/background'] = 'admin/settings/delete_bg';
// 分类排序调整
$routes['/admin/category/change-order/{id}'] = 'admin/category/change_order';
// 打开导航列表
$routes['/admin/nav'] = 'admin/navigator';
// 打开脚本列表
$routes['/admin/spt'] = 'admin/script';
// 删除专题封面
$routes['/admin/feature/delete/cover/{id}'] = 'admin/feature/delete_cover';
// 删除专题背景图
$routes['/admin/feature/delete/bg/{id}'] = 'admin/feature/delete_bg';
// 删除作品封面图
$routes['/admin/work/delete/cover/{id}'] = 'admin/work/delete_cover';

