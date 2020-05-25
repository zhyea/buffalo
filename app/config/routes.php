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
// 新增或编辑分类
$routes['/admin/category/settings'] = 'admin/category/settings';
// 分类信息维护
$routes['/admin/category/maintain'] = 'admin/category/maintain';
// 分类信息删除
$routes['/admin/category/delete'] = 'admin/category/delete';
// 分类排序调整
$routes['/admin/category/change-order'] = 'admin/category/change_order';
// 打开导航列表
$routes['/admin/nav/list'] = 'admin/navigator/list';
// 获取导航数据
$routes['/admin/nav/data'] = 'admin/navigator/data';
// 新增或编辑导航
$routes['/admin/nav/settings'] = 'admin/navigator/settings';
// 新增或编辑导航
$routes['/admin/nav/candidates'] = 'admin/navigator/candidates';
// 导航信息维护
$routes['/admin/nav/maintain'] = 'admin/navigator/maintain';
// 导航信息删除
$routes['/admin/nav/delete'] = 'admin/navigator/delete';
// 打开脚本列表
$routes['/admin/spt/list'] = 'admin/script/list';
// 获取脚本数据
$routes['/admin/spt/data'] = 'admin/script/data';
// 打开脚本编辑页
$routes['/admin/spt/edit'] = 'admin/script/edit';
// 脚本信息提交
$routes['/admin/spt/maintain'] = 'admin/script/maintain';
// 脚本删除
$routes['/admin/spt/delete'] = 'admin/script/delete';
// 打开作者列表
$routes['/admin/author/list'] = 'admin/author/list';
// 获取作者数据
$routes['/admin/author/data'] = 'admin/author/data';
// 打开作者信息编辑页
$routes['/admin/author/settings'] = 'admin/author/settings';
// 作者信息提交
$routes['/admin/author/maintain'] = 'admin/author/maintain';
// 作者删除
$routes['/admin/author/delete'] = 'admin/author/delete';
// 打开专题列表
$routes['/admin/feature/list'] = 'admin/feature/list';
// 获取专题数据
$routes['/admin/feature/data'] = 'admin/feature/data';
// 打开专题信息编辑页
$routes['/admin/feature/settings'] = 'admin/feature/settings';
// 专题信息提交
$routes['/admin/feature/maintain'] = 'admin/feature/maintain';
// 专题删除
$routes['/admin/feature/delete'] = 'admin/feature/delete';

