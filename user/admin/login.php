<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<title>Buffalo Login</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<link rel="icon" href="<?= $ctx_admin ?>static/img/favicon.ico" type="image/vnd.microsoft.icon">

	<!-- Bootstrap core CSS -->
	<link href="<?= $ctx_admin ?>static/css/bootstrap.min.css" rel="stylesheet">
	<!-- Custom styles for this template -->
	<link href="<?= $ctx_admin ?>static/css/style.css" rel="stylesheet">
</head>

<body>

<div class="container login">

	<form class="form-login" method="post" action="./login_check">
		<div class="logo"><img src="<?= $ctx_admin ?>static/img/logo.png" width="36%"/></div>
		<div class="form-item">
			<span class="form-label">用户名</span>
			<input name="username" type="text" class="form-control" placeholder="Email" required autofocus/>
		</div>
		<div class="form-item">
			<span class="form-label">密码</span>
			<input name="password" type="password" class="form-control" placeholder="Password" required/>
		</div>
		<button class="btn btn-lg btn-primary btn-block" type="submit">登录</button>
	</form>

</div> <!-- /container -->

<script charset="utf-8" src="<?= $ctx_admin ?>/static/js/jquery.min.js"></script>
<script charset="utf-8" src="<?= $ctx_admin ?>/static/js/bootstrap.min.js"></script>
</body>
</html>


