<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container main">

	<div class="page-header">
		<h3><?= $id === 0 ? '新增专题' : '编辑专题 - ' . $name ?></h3>
	</div>


    <?php if (isset($msg)): ?>
		<div class="alert alert-success alert-dismissible fade in" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>
			<strong>提示!</strong> <?= $msg ?>
		</div>
    <?php endif; ?>


    <?= form_open_multipart('admin/feature/update'); ?>
	<div class="row">
		<div class="form-label col-md-2 col-xs-12">封面</div>
		<div class="form-input col-md-10 col-xs-12">
            <?php if (isset($cover) && !empty($cover)): ?>
				<div class="form-input col-md-12 col-xs-12">
					<p><img src="<?= $ctx_upload . $cover ?>" alt="Cover"/></p>
				</div>
            <?php endif; ?>
			<input type="file" class="form-control" accept="image/png, image/jpeg" name="cover"/>
		</div>
	</div>

	<div class="row">
		<div class="form-label col-md-2 col-xs-12">专题名称</div>
		<div class="form-input col-md-10 col-xs-12">
			<input type="hidden" name="id" value="<?= $id ?>"/>
			<input type="text" class="form-control" name="name" value="<?= $name ?>" required autofocus/>
		</div>
	</div>

	<div class="row">
		<div class="form-label col-md-2 col-xs-12">专题别名</div>
		<div class="form-input col-md-10 col-xs-12">
			<input type="text" class="form-control" name="alias" value="<?= $alias ?>" required autofocus/>
		</div>
	</div>

	<div class="row">
		<div class="form-label col-md-2 col-xs-12">关键字</div>
		<div class="form-input col-md-10 col-xs-12">
			<input type="text" class="form-control" name="key_words" value="<?= $key_words ?>" required autofocus/>
		</div>
	</div>

	<div class="row">
		<div class="form-label col-md-2 col-xs-12">概述</div>
		<div class="form-input col-md-10 col-xs-12">
			<textarea class="form-control" name="brief"><?= $brief ?></textarea>
		</div>
	</div>


	<div class="row">
		<div class="col-md-2 col-xs-12">&nbsp;</div>
		<div class="form-input col-md-5 col-xs-12">
			<button type="submit" class="btn btn-success">保存专题信息</button>
		</div>
		<div class="form-input col-md-5 col-xs-12">
			<a href="<?= $ctx_site ?>/admin/feature/list_page" class="btn btn-success">返回专题列表</a>
		</div>
	</div>
    <?= form_close() ?>
</div>
