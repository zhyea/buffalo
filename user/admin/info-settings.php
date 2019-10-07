<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container main">

	<div class="page-header">
		<h3>信息维护</h3>
	</div>

    <?php if (isset($msg)): ?>
		<div class="alert alert-success alert-dismissible fade in" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>
			<strong>提示!</strong> <?= $msg ?>
		</div>
    <?php endif; ?>

    <?= form_open_multipart('admin/update_info_settings'); ?>
	<div class="row">
		<div class="form-label col-md-2 col-xs-12">LOGO</div>
		<div class="form-input col-md-10 col-xs-12">
            <?php if (isset($logo)): ?>
				<div class="form-input col-md-12 col-xs-12">
					<p><img src="<?= $upload_url . $logo ?>" alt="LOGO"/></p>
				</div>
            <?php endif; ?>
			<input type="file" class="form-control" accept="image/png, image/jpeg" name="logo"/>
		</div>
	</div>

	<div class="row">
		<div class="form-label col-md-2 col-xs-12">背景图片</div>
		<div class="form-input col-md-10 col-xs-12">
            <?php if (isset($bg_img)): ?>
				<div class="form-input col-md-12 col-xs-12">
					<p><img src="<?= $upload_url . $bg_img ?>" alt="BG_IMG"/></p>
				</div>
            <?php endif; ?>
			<input type="file" class="form-control" accept="image/png, image/jpeg" name="bg_img"/>
		</div>
	</div>

	<div class="row">
		<div class="form-label col-md-2 col-xs-12">通知信息</div>
		<div class="form-input col-md-10 col-xs-12">
			<textarea class="form-control" name="notice"><?= $notice ?></textarea>
		</div>
	</div>


	<div class="row">
		<div class="col-md-3 col-xs-12">&nbsp;</div>
		<div class="form-input col-md-9 col-xs-12">
			<button type="submit" class="btn btn-success">保存设置</button>
		</div>
	</div>
    <?= form_close() ?>
</div>