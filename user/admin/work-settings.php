<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container main">

	<div class="page-header">
		<h3><?= $id === 0 ? '新增作品' : '编辑作品 - ' . $name ?></h3>
	</div>


    <?php if (isset($msg)): ?>
		<div class="alert alert-success alert-dismissible fade in" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>
			<strong>提示!</strong> <?= $msg ?>
		</div>
    <?php endif; ?>

	<form method="post" action="<?= $ctx_site ?>/admin/work/update">
		<div class="row">
			<div class="form-label col-md-3 col-xs-12">作品名称</div>
			<div class="form-input col-md-9 col-xs-12">
				<input type="hidden" name="id" value="<?= $id ?>"/>
				<input type="text" class="form-control" name="name" value="<?= '' ?>" required autofocus/>
			</div>
		</div>
		<div class="row">
			<div class="form-label col-md-3 col-xs-12">作者</div>
			<div class="form-input col-md-9 col-xs-12">
				<div class="input-group">
					<i class="clearable fa fa-remove"></i>
					<input type="text" class="form-control" id="authorSelector" required/>
					<div class="input-group-btn">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu dropdown-menu-right" role="menu">
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="form-label col-md-3 col-xs-12">分类</div>
			<div class="form-input col-md-9 col-xs-12">
				<input type="text" class="form-control" name="nickname" value="<?= '' ?>" required/>
			</div>
		</div>


		<div class="row">
			<div class="col-md-3 col-xs-12">&nbsp;</div>
			<div class="form-input col-md-9 col-xs-12">
				<button type="submit" class="btn btn-success">保存用户</button>
			</div>
		</div>
	</form>
</div>

<script charset="utf-8" src="<?= $ctx_admin ?>/static/js/jquery.min.js"></script>
<script charset="utf-8" src="<?= $ctx_admin ?>/static/js/bootstrap.min.js"></script>
<script charset="utf-8" src="<?= $ctx_admin ?>/static/js/bootstrap-suggest.js"></script>
<script>
    $("#authorSelector").bsSuggest({
        allowNoKeyword: false,
        clearable: true,
        url: "<?= $ctx_site ?>/admin/author/find_by_name/",
        getDataMethod: "url",
        showBtn: true,
        idField: "id",
        keyField: "name"
    }).on('onDataRequestSuccess', function (e, result) {
        console.log('onDataRequestSuccess: ', result);
    }).on('onSetSelectValue', function (e, keyword, data) {
        console.log('onSetSelectValue: ', keyword, data);
    }).on('onUnsetSelectValue', function () {
        console.log('onUnsetSelectValue');
    }).on('onShowDropdown', function (e, data) {
        console.log('onShowDropdown', e.target.value, data);
    }).on('onHideDropdown', function (e, data) {
        console.log('onHideDropdown', e.target.value, data);
    });
</script>