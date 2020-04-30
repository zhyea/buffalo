<?php
defined('_APP_PATH_') OR exit('You shall not pass!');
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<title>Please Login</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" type="text/css" href="<?= $ctx_admin ?>/static/css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?= $ctx_admin ?>/static/css/style.css"/>
</head>

<body>

<div class="container login">
	<form class="form-login" method="post" action="/login/check">
		<div class="logo"><img src="<?= $ctx_admin ?>/static/img/logo.png" width="36%"/></div>
		<div class="form-item">
			<span class="form-label">用户名</span>
			<input name="username" type="text" class="form-control" placeholder="Email" required autofocus/>
		</div>
		<div class="form-item">
			<span class="form-label">密码</span>
			<input name="password" type="password" class="form-control" placeholder="Password" required/>
		</div>
		<button class="btn btn-lg btn-primary btn-block" type="submit">登录</button>

        <?php if (isset($alert)) { ?>
			<div role="alert" class="alert <?= $alert['type'] ?>">
                <?= $alert['msg'] ?>
			</div>
        <?php } ?>
	</form>
</div>

<script charset="utf-8" src="<?= $ctx_admin ?>/admin/static/js/jquery.min.js"></script>
<script charset="utf-8" src="<?= $ctx_admin ?>/admin/static/js/bootstrap.min.js"></script>
</body>
</html>
