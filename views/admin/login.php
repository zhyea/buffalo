<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<div class="container login">

	<form class="form-login">
		<div class="logo"><img src="<?= $admin_url ?>static/img/logo.png" width="36%"/></div>
		<div class="form-item">
			<span class="form-label">用户名</span>
			<input type="text" class="form-control" placeholder="Email" required autofocus/>
		</div>
		<div class="form-item">
			<span class="form-label">密码</span>
			<input type="password" class="form-control" placeholder="Password" required/>
		</div>
		<button class="btn btn-lg btn-primary btn-block" type="submit">登录</button>
	</form>

</div> <!-- /container -->




