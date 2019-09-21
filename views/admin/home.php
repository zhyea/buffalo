<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="wrapper">
    <div class="container navigator">
        <nav class="navbar navbar-inverse navbar-static-top">
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
                <a class="navbar-brand" href="#">
                    <img alt="Buffalo Console" src="<?= $admin_url ?>static/img/logo-white.png" height="100%">
                </a>
            </div>

            <ul class="nav navbar-nav" id="main-nav-items">
                <li class="active"><a href="#"><span class="glyphicon glyphicon-home"></span> 首页</a></li>
                <li><a href="#">用户</a></li>
                <li><a href="#">分类</a></li>
            </ul>
        </nav>
    </div>
	<div class="main navigator"></div>
	<div class="footer navigator"></div>
</div>
