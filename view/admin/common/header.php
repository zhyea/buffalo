<?php
defined('_APP_PATH_') OR exit('You shall not pass!');
?>
<!DOCTYPE HTML>
<html>
<body>
<header>

	<title><?= empty($title) ? 'Buffalo' : $title ?></title>
	
	<meta content="text/html; charset=UTF-8" http-equiv="Content-Type"/>
	<meta content="width=device-width, initial-scale=1" name="viewport"/>

	<link rel="icon" href="<?= $uri_admin ?>/static/img/favicon.ico">
	
	<link rel="stylesheet" type="text/css" href="<?= $uri_admin ?>/static/css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?= $uri_admin ?>/static/css/font-awesome.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?= $uri_admin ?>/static/css/bootstrap-table.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?= $uri_admin ?>/static/css/style.css"/>
	
	<script src="<?= $uri_admin ?>/static/js/jquery.min.js"></script>
	<script src="<?= $uri_admin ?>/static/js/custom-script.js"></script>
	
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</header>

<div class="wrapper">