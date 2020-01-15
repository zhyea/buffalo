<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container main">
	
	<div class="page-header">
		<h3><?= $id > 0 ? '编辑作者信息' : '新增作者信息' ?></h3>
	</div>


    <?php if (isset($msg)): ?>
		<div class="alert alert-success alert-dismissible fade in" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>
			<strong>提示!</strong> <?= $msg ?>
		</div>
    <?php endif; ?>

	<form method="post" action="<?= $ctx_site ?>/admin/author/insert">
		<div class="row">
			<div class="form-label col-md-3 col-xs-12">姓名</div>
			<div class="form-input col-md-9 col-xs-12">
				<input type="hidden" name="id" value="<?= $id ?>"/>
				<input type="text" class="form-control" name="name" value="<?= $name ?>" required autofocus/>
			</div>
		</div>
		<div class="row">
			<div class="form-label col-md-3 col-xs-12">国家</div>
			<div class="form-input col-md-9 col-xs-12">
				<input type="text" class="form-control" name="country" value="<?= $country ?>" required/>
			</div>
		</div>
		
		<div class="row">
			<div class="form-label col-md-3 col-xs-12">简介</div>
			<div class="form-input col-md-9 col-xs-12">
				<textarea class="form-control" name="bio" rows="6"><?= $bio ?></textarea>
			</div>
		</div>
		
		
		<div class="row">
			<div class="col-md-3 col-xs-12">&nbsp;</div>
			<div class="form-input col-md-9 col-xs-12">
				<button type="submit" class="btn btn-default">保存作者信息</button>
				&nbsp;&nbsp;&nbsp;
				<a class="btn btn-success" href="<?= $ctx_site ?>/admin/author/list_page/<?= $id ?>">返回列表</a>
			</div>
		</div>
	</form>
</div>