<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container main">

	<div class="page-header">
		<h3>信息维护</h3>
	</div>


	<form method="post" action="<?= site_url() ?>/admin/update_info_settings">
		<div class="row">
			<div class="form-label col-md-3 col-xs-12">LOGO</div>
			<div class="form-input col-md-9 col-xs-12">
				<input type="file" class="form-control"/>
			</div>
		</div>

		<div class="row">
			<div class="form-label col-md-3 col-xs-12">背景图片</div>
			<div class="form-input col-md-9 col-xs-12">
				<input type="file" class="form-control"/>
			</div>
		</div>

		<div class="row">
			<div class="form-label col-md-3 col-xs-12">通知信息</div>
			<div class="form-input col-md-9 col-xs-12">
				<textarea class="form-control" name="notice"><?= $notice ?></textarea>
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