<?php
defined('BASEPATH') OR exit('No direct script access allowed');
isset($ctx_theme) OR exit('No base url exists')
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title><?= $title ?></title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="<?= $ctx_theme ?>/static/imgs/favicon.ico" rel="icon">
	<link href="<?= $ctx_theme ?>/static/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">
	<link href="<?= $ctx_theme ?>/static/css/style.css" rel="stylesheet" type="text/css" media="all">
</head>

<body <?php if (!empty($bg_img)): ?> style="background: url('<?= $ctx_upload . '/' . $bg_img ?>') no-repeat fixed top; background-size: 100% 100%;" <?php endif; ?>>
<div class="wrapper">