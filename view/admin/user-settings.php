<?php
defined('_APP_PATH_') or exit('You shall not pass!');

include_once 'common/header.php';
include_once 'common/navigator.php';
?>

	<div class="container main">

		<div class="page-header">
			<h3><i class="glyphicon glyphicon-user"></i> [[${user.id>0 ? '编辑用户':'新增用户'}]]</h3>
		</div>

        <?php include_once 'common/alert.php'; ?>

		<form method="post" action="<?= $ctx ?>admin/user/settings" th:object="${user}">
			<div class="row">
				<div class="form-label col-md-2 col-xs-12">用户名</div>
				<div class="form-input col-md-10 col-xs-12">
					<input type="hidden" name="id" th:value="*{id}"/>
					<input type="text" class="form-control" name="username" th:value="*{username}" required
					       autofocus autocomplete="off"/>
				</div>
			</div>
			<div class="row">
				<div class="form-label col-md-2 col-xs-12">邮箱</div>
				<div class="form-input col-md-10 col-xs-12">
					<input type="text" class="form-control" name="email" th:value="*{email}" required/>
				</div>
			</div>

			<div class="row">
				<div class="form-label col-md-2 col-xs-12">昵称</div>
				<div class="form-input col-md-10 col-xs-12">
					<input type="text" class="form-control" name="nickname" th:value="*{nickname}" required/>
				</div>
			</div>

			<div class="row">
				<div class="form-label col-md-2 col-xs-12">密码</div>
				<div class="form-input col-md-10 col-xs-12">
					<input type="password" class="form-control" name="password" autocomplete="off" required/>
				</div>
			</div>


			<div class="row">
				<div class="btn-left col-md-6 col-xs-12">
					<a href="/admin/user/list" class="btn btn-info">返回列表</a>
				</div>
				<div class="btn-right col-md-6 col-xs-12">
					<button type="submit" class="btn btn-success">保存用户</button>
				</div>
			</div>
		</form>
	</div>

<?php include_once 'common/footer.php'; ?>