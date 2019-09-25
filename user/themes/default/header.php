<?php
defined('BASEPATH') OR exit('No direct script access allowed');
isset($theme_url) OR exit('No base url exists')
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title><?= $site_name ?></title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="<?= $theme_url ?>/static/imgs/favicon.ico" rel="icon">
	<link href="<?= $theme_url ?>/static/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">
	<link href="<?= $theme_url ?>/static/css/style.css" rel="stylesheet" type="text/css" media="all">
</head>

<body>
<div class="wrapper">