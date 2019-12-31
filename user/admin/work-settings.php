<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container main">

	<div class="page-header">
		<h3>
            <?= $id === 0 ? '新增作品' : '编辑作品 - ' . $name ?>
			<span class="tag"><a href="<?= $ctx_site ?>/admin/work/list_page">返回列表</a></span>
		</h3>
	</div>


    <?php if (isset($msg)): ?>
		<div class="alert alert-success alert-dismissible fade in" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>
			<strong>提示!</strong> <?= $msg ?>
		</div>
    <?php endif; ?>

    <?= form_open_multipart('admin/work/update'); ?>
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
		<div class="form-label col-md-2 col-xs-12">作品名称</div>
		<div class="form-input col-md-10 col-xs-12">
			<input type="hidden" name="id" value="<?= $id ?>"/>
			<input type="text" class="form-control" name="name" value="<?= $name ?>" required autofocus/>
		</div>
	</div>

	<div class="row">
		<div class="form-label col-md-2 col-xs-12">作者</div>
		<div class="form-input col-md-7 col-xs-8">
			<div class="input-group">
				<input type="hidden" name="author_id" id="authorId" value="<?= $author_id ?>"/>
				<input type="text" class="form-control" name="author" value="<?= $author ?>" id="authorSelector"
				       required/>
				<div class="input-group-btn">
					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu dropdown-menu-right" role="menu">
					</ul>
				</div>
			</div>
		</div>
		<div class="form-input col-md-3 col-xs-4">
			<input type="text" class="form-control" name="authorCountry" id="authorCountry"
			       value="<?= $authorCountry ?>"
			       placeholder="作者国籍" required/>
		</div>
	</div>

	<div class="row">
		<div class="form-label col-md-2 col-xs-12">分类</div>
		<div class="form-input col-md-10 col-xs-12">
			<div class="input-group">
				<input type="hidden" name="cat_id" id="categoryId" value="<?= $cat_id ?>"/>
				<input type="text" class="form-control" name="cat" value="<?= $cat ?>" id="categorySelector" required/>
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
		<div class="form-label col-md-2 col-xs-12">概述</div>
		<div class="form-input col-md-10 col-xs-12">
			<textarea class="form-control" name="brief"><?= $brief ?></textarea>
		</div>
	</div>


	<div class="row">
		<div class="col-md-2 col-xs-12">&nbsp;</div>
		<div class="form-input col-md-10 col-xs-12">
			<button type="submit" class="btn btn-success">保存作品信息</button>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="<?= $ctx_site ?>/admin/work/list_page" class="btn btn-success">返回作品列表</a>
		</div>
	</div>
    <?= form_close() ?>
</div>

<script charset="utf-8" src="<?= $ctx_admin ?>/static/js/jquery.min.js"></script>
<script charset="utf-8" src="<?= $ctx_admin ?>/static/js/bootstrap-suggest.js"></script>
<script>
    $("#authorSelector").bsSuggest({
        allowNoKeyword: true,
        clearable: true,
        url: "<?= $ctx_site ?>/admin/author/find_by_name/",
        getDataMethod: "url",
        showBtn: true,
        showHeader: false,
        idField: "id",
        keyField: "name",
        effectiveFields: ["name", "country"]
    }).on('onSetSelectValue', function (e, keyword, data) {
        $("#authorId").val(data.id);
        $("#authorCountry").val(data.country)
    });


    $("#categorySelector").bsSuggest({
        clearable: true,
        url: "<?= $ctx_site ?>/admin/category/data_all",
        showHeader: false,
        showBtn: true,     //不显示下拉按钮
        idField: "id",
        keyField: "name",
        effectiveFields: ["id", "name", "slug"]
    }).on('onSetSelectValue', function (e, keyword, data) {
        $("#categoryId").val(data.id)
    });
</script>