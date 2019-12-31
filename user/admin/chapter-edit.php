<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script charset="utf-8" src="<?= $ctx_admin ?>/static/ckeditor/ckeditor.js"></script>

<div class="container main">

	<div class="page-header">
		<h3>
            <?= $work_name ?>
			<span class="tag"><a href="<?= $ctx_site ?>/admin/work/list_page">返回列表</a></span>
		</h3>
	</div>

	<form method="post" action="<?= $ctx_site ?>/admin/work/chapter_update">
		<input type="hidden" name="id" value="<?= $chapter_id ?>">
		<input type="hidden" name="work_id" value="<?= $work_id ?>">
		<div class="row">
			<input type="text"
			       class="form-control"
			       placeholder="标题"
			       name="name"
			       value="<?= $chapter_name ?>" required autofocus/>
		</div>

		<div class="row">
			<div class="form-input col-md-12 col-xs-12">
				<div class="input-group">
					<input type="hidden" name="cat_id" id="volume_id" value="<?= $volume_id ?>"/>
					<input type="text" class="form-control" name="volume" value="<?= $volume ?>" id="volumeSelector"/>
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
			<textarea name="content" id="buffalo_editor"><?= $content ?></textarea>
			<script> CKEDITOR.replace('buffalo_editor');</script>
		</div>

		<div class="row">
			<button type="submit" class="btn btn-default">保存</button>
			&nbsp;&nbsp;&nbsp;
			<a class="btn btn-success" href="<?= $ctx_site ?>/admin/work/chapters/<?= $work_id ?>">返回</a>
		</div>
	</form>
</div>

<script charset="utf-8" src="<?= $ctx_admin ?>/static/js/jquery.min.js"></script>
<script charset="utf-8" src="<?= $ctx_admin ?>/static/js/bootstrap-suggest.js"></script>
<script>
    $("#volumeSelector").bsSuggest({
        clearable: true,
        url: "<?= $ctx_site ?>/admin/volume/find_by_name/<?=$work_id?>/",
        showHeader: false,
        showBtn: true,     //不显示下拉按钮
        idField: "id",
        keyField: "name",
        effectiveFields: ["id", "name"]
    }).on('onSetSelectValue', function (e, keyword, data) {
        $("#volumeId").val(data.id)
    });
</script>