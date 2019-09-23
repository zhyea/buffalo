<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container main">

	<div class="page-header">
		<h3>网站设置</h3>
	</div>


	<form method="post" action="<?= site_url() ?>/admin/update_user_settings">
		<div class="row">
			<div class="form-label col-md-3 col-xs-12">站点名称</div>
			<div class="form-input col-md-9 col-xs-12">
				<input type="text" class="form-control" name="site_name" value="<?= $site_name ?>" required autofocus/>
			</div>
		</div>

		<div class="row">
			<div class="form-label col-md-3 col-xs-12">站点描述</div>
			<div class="form-input col-md-9 col-xs-12">
				<textarea class="form-control" name="site_description"><?= $site_description ?></textarea>
			</div>
		</div>

		<div class="row">
			<div class="form-label col-md-3 col-xs-12">关键词</div>
			<div class="form-input col-md-9 col-xs-12">
				<input type="textarea" class="form-control" name="site_keywords" value="<?= $site_keywords ?>"/>
			</div>
		</div>


		<div class="row">
			<div class="col-md-3 col-xs-12">&nbsp;</div>
			<div class="form-input col-md-9 col-xs-12">
				<button type="submit" class="btn btn-success">保存设置</button>
			</div>
		</div>
	</form>
</div>