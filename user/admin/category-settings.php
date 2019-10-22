<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container main">
	
	<div class="page-header">
		<h3><?= $id > 0 ? '编辑分类' : '新增分类' ?></h3>
	</div>


    <?php if (isset($msg)): ?>
		<div class="alert alert-success alert-dismissible fade in" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>
			<strong>提示!</strong> <?= $msg ?>
		</div>
    <?php endif; ?>

	<form method="post" action="<?= $ctx_site ?>/admin/category/update">
		<div class="row">
			<div class="form-label col-md-3 col-xs-12">名称</div>
			<div class="form-input col-md-9 col-xs-12">
                <input type="hidden" name="id" value="<?= $id ?>"/>
                <input type="hidden" name="parent" value="<?= $parent ?>"/>
				<input type="text" class="form-control" name="name" value="<?= $name ?>" required autofocus/>
			</div>
		</div>
		<div class="row">
			<div class="form-label col-md-3 col-xs-12">缩略名</div>
			<div class="form-input col-md-9 col-xs-12">
				<input type="text" class="form-control" name="slug" value="<?= $slug ?>" required />
			</div>
		</div>
		
		<div class="row">
			<div class="form-label col-md-3 col-xs-12">备注</div>
			<div class="form-input col-md-9 col-xs-12">
                <textarea class="form-control" name="remark"><?= $remark ?></textarea>
			</div>
		</div>
		
		
		<div class="row">
			<div class="col-md-3 col-xs-12">&nbsp;</div>
			<div class="form-input col-md-9 col-xs-12">
				<button type="submit" class="btn btn-success">保存分类</button>
			</div>
		</div>
	</form>
</div>