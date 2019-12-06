<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <title><?= $title ?></title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="icon" href="<?= $ctx_admin ?>static/img/favicon.ico" type="image/vnd.microsoft.icon">

    <!-- Bootstrap core CSS -->
    <link href="<?= $ctx_admin ?>static/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Table CSS -->
	<link href="<?= $ctx_admin ?>static/css/bootstrap-table.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?= $ctx_admin ?>static/css/style.css" rel="stylesheet">
</head>

<body>

<div class="wrapper">
    <div class="container navigator">
        <nav class="navbar navbar-inverse">
            <button type="button"
                    class="navbar-toggle collapsed"
                    data-toggle="collapse"
                    data-target="#main-nav-items"
                    aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <div class="navbar-header">
                <a class="navbar-brand" href="<?= $ctx_site ?>/admin">
                    <img alt="Buffalo Console" src="<?= $ctx_admin ?>static/img/logo-white.png" height="100%">
                </a>
            </div>

            <ul class="nav navbar-nav navbar-left" id="main-nav-items">
                <li class="dropdown">
                    <a href="#"
                       class="dropdown-toggle"
                       data-toggle="dropdown"
                       role="button"
                       aria-haspopup="true"
                       aria-expanded="false"><span class="glyphicon glyphicon-dashboard"></span> 控制台<span
                                class="caret"></span></a>
                    <ul class="dropdown-menu navbar-child">
                        <li class="navbar-child-item"><a href="<?= $ctx_site ?>/admin/settings/info">信息维护</a></li>
                        <li class="navbar-child-item"><a href="<?= $ctx_site ?>/admin/settings/site">网站设置</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#"
                       class="dropdown-toggle"
                       data-toggle="dropdown"
                       role="button"
                       aria-haspopup="true"
                       aria-expanded="false"><span class="glyphicon glyphicon-th-large"></span> 管理<span
                                class="caret"></span></a>
                    <ul class="dropdown-menu navbar-child">
	                    <li class="navbar-child-item"><a href="<?= $ctx_site ?>/admin/feature/list_page">专题管理</a></li>
	                    <li class="navbar-child-item"><a href="<?= $ctx_site ?>/admin/feature/list_page">作者管理</a></li>
	                    <li class="navbar-child-item"><a href="<?= $ctx_site ?>/admin/work/list_page">作品管理</a></li>
                        <li class="navbar-child-item"><a href="<?= $ctx_site ?>/admin/category/list_page">分类管理</a></li>
                        <li class="navbar-child-item"><a href="<?= $ctx_site ?>/admin/user/list_page">用户管理</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#"
                       class="dropdown-toggle"
                       data-toggle="dropdown"
                       role="button"
                       aria-haspopup="true"
                       aria-expanded="false"><span class="glyphicon glyphicon-pencil"></span> 撰写<span
                                class="caret"></span></a>
                    <ul class="dropdown-menu navbar-child">
                        <li class="navbar-child-item"><a href="<?= $ctx_site ?>/admin/content/edit">新增文章</a></li>
                    </ul>
                </li>
            </ul>


            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?= $ctx_site ?>"><span class="glyphicon glyphicon-home"></span> <?= $site_name ?></a></li>
                <li class="active"><a href="#"><span class="glyphicon glyphicon-off"></span> 登出</a></li>
            </ul>
        </nav>
    </div>
