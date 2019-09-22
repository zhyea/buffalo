<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container main">

	<div class="page-header">
		<h3>站点管理</h3>
	</div>


	<form method="post" action="<?= site_url() ?>/admin/update_site_settings">
		<div class="row">
			<div class="form-label col-md-3 col-xs-3">站点名称</div>
			<div class="form-input col-md-9 col-xs-9">
				<input type="text" class="form-control" name="site_name" value="<?= $site_name ?>" required autofocus/>
			</div>
		</div>

		<div class="row">
			<div class="form-label col-md-3 col-xs-3">站点描述</div>
			<div class="form-input col-md-9 col-xs-9">
				<textarea class="form-control" name="site_description"><?= $site_description ?></textarea>
			</div>
		</div>

		<div class="row">
			<div class="form-label col-md-3 col-xs-3">关键词</div>
			<div class="form-input col-md-9 col-xs-9">
				<input type="textarea" class="form-control" name="site_keywords" value="<?= $site_keywords ?>"/>
			</div>
		</div>


		<div class="row">
			<div class="col-md-2 col-xs-2">&nbsp;</div>
			<div class="form-input col-md-10 col-xs-10">
				<button type="submit" class="btn btn-success">保存设置</button>
			</div>
		</div>
	</form>
</div>