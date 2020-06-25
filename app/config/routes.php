<?php
defined('_APP_PATH_') or exit('You shall not pass!');

$routes['default_controller'] = 'welcome';
$routes['404_override'] = '';
$routes['translate_uri_dashes'] = FALSE;


// 首页
$routes[''] = 'front/index';
$routes['/'] = 'front/index';
// 分类页
$routes['/c/{slug}'] = 'front/category';
$routes['/c/{slug}/{page}'] = 'front/category';
// 专题页
$routes['/f/{alias}'] = 'front/feature';
$routes['/f/{alias}/{page}'] = 'front/feature';
// 作家页
$routes['/author/{id}'] = 'front/author';
$routes['/author/{id}/{page}'] = 'front/author';
// 作品页
$routes['/work/{id}'] = 'front/work';
// 章节页
$routes['/chapter/{id}'] = 'front/chapter';
// 作家集合页
$routes['/authors'] = 'front/authors';

// 登录页
$routes['/login'] = 'admin/admin/login';
// 登录页
$routes['/logout'] = 'admin/admin/logout';
// 登录页
$routes['/login/check'] = 'admin/admin/login_check';
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
// 删除专题作品
$routes['/admin/feature/records/delete'] = 'admin/feature/delete_records';
// 删除专题作品
$routes['/admin/feature/record/add/{feature_id}/{work_id}'] = 'admin/feature/add_record';
// 删除作品分卷
$routes['/admin/chapter/delete-vol/{work_id}/{vol_id}'] = 'admin/chapter/delete_vol';
// 删除作品全部章节及分卷
$routes['/admin/chapter/delete-all/{work_id}'] = 'admin/chapter/delete_all';

