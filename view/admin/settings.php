<?php
defined('_APP_PATH_') OR exit('You shall not pass!');

include_once 'common/header.php';
include_once 'common/navigator.php';
?>


<div class="container main">
	<div class="page-header">
		<h3><i class="glyphicon glyphicon-cog"></i> 信息维护</h3>
	</div>

    <?php include_once 'common/alert.php'; ?>

	<form method="post" action="<?= $ctx ?>admin/settings/maintain" enctype="multipart/form-data">
		<div class="row">
			<div class="form-label col-md-2 col-xs-12">站点名称</div>
			<div class="form-input col-md-10 col-xs-12">
				<input type="text" class="form-control" name="name" value="<?= $name ?>" required autofocus/>
			</div>
		</div>

		<div class="row">
			<div class="form-label col-md-2 col-xs-12">站点描述</div>
			<div class="form-input col-md-10 col-xs-12">
				<textarea class="form-control" name="description"><?= $description ?></textarea>
			</div>
		</div>

		<div class="row">
			<div class="form-label col-md-2 col-xs-12">关键词</div>
			<div class="form-input col-md-10 col-xs-12">
				<input type="text" class="form-control" name="keywords" value="<?= $keywords ?>"/>
			</div>
		</div>

		<div class="row">
			<div class="form-label col-md-2 col-xs-12">通知信息</div>
			<div class="form-input col-md-10 col-xs-12">
				<textarea class="form-control" name="notice"><?= $notice ?></textarea>
			</div>
		</div>

		<div class="row">
			<div class="form-label col-md-2 col-xs-12">LOGO</div>
			<div class="form-input col-md-10 col-xs-12">
				<input type="file" class="form-control" accept="image/png, image/jpeg" name="logo"/>
				<input type="hidden" name="currLogo" value="<?= $logo ?>"/>
                <?php if (!empty($logo)) { ?>
				<div class="form-input col-md-12 col-xs-12">
					<br/>
					<p class="lmt"><img src="<?= $logo ?>" alt="LOGO"/></p>
					<a href="<?= $ctx ?>/settings/delete/logo" target="_self">移除LOGO</a>
					<br/>
				</div>
                <?php } ?>
			</div>
		</div>

		<div class="row">
			<div class="form-label col-md-2 col-xs-12">背景图片</div>
			<div class="form-input col-md-10 col-xs-12">
				<input type="file" class="form-control" accept="image/png, image/jpeg" name="backgroundImg"/>
				<input type="hidden" name="currBgImg" value="<?= $background_img ?>"/>
                <?php if (!empty($background_img)) { ?>
				<div class="form-input col-md-12 col-xs-12">
					<br/>
					<p class="lmt"><img src="<?= $background_img ?>" alt="BG_IMG"/></p>
					<a href="<?= $ctx ?>/settings/delete/backgroundImg" target="_self">移除背景图</a>
					<br/>
				</div>
                <?php } ?>
			</div>
		</div>

		<div class="row">
			<div class="form-label col-md-2 col-xs-12">背景重复</div>
			<div class="form-input col-md-10 col-xs-12" style="padding-top:6px;">
				<label class="radio-inline">
					<input type="radio" name="bgRepeat" value="1" checked="<?= ($bg_repeat==1) ?>"> 重复
				</label>
				<label class="radio-inline">
					<input type="radio" name="bgRepeat" value="2" checked="<?= ($bg_repeat==2) ?>"> 不重复
				</label>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6 col-xs-12">&nbsp;</div>
			<div class="form-input col-md-6 col-xs-12">
				<button type="submit" class="btn btn-success">保存设置</button>
			</div>
		</div>
	</form>
</div>


<?php include_once 'common/footer.php'; ?>
