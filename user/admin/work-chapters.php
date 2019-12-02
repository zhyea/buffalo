<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container main">

	<div class="page-header">
		<h3><span class="glyphicon glyphicon-book"></span> <?= $name ?></h3>
	</div>

    <?php if (empty($chapters)): ?>
        <?= form_open_multipart('admin/work/upload'); ?>
		<div class="row">
			<input type="hidden" name="work_id" value="<?= $id ?>">
			<div class="form-input col-md-8 col-xs-12">
				<input type="file" class="form-control" accept="text/plain" name="myTxt"/>
			</div>
			<div class="col-md-2 col-xs-12">
				<button type="submit" class="btn btn-success">上传文件</button>
			</div>
			<div class="col-md-2 col-xs-12">&nbsp;</div>
		</div>
        <?= form_close() ?>
    <?php endif; ?>

	<div class="row chapter-container">
        <?php foreach ($chapters as $c): ?>
			<div class="col-md-4 col-xs-12 chapter-unit">
				<div class="chapter">
					<a href="<?= $ctx_site ?>/admin/work/chapter_edit/<?= $id ?>/<?= $c['id'] ?>"
					   target="_self"><?= $c['name'] ?> </a>
					<a><span class="glyphicon glyphicon-remove remove"></span></a>
				</div>
			</div>
        <?php endforeach; ?>
		<div class="col-md-4 col-xs-12 chapter-unit">
			<div class="chapter">
				<a>新增章节...</a>
				<a><span class="glyphicon glyphicon-plus add"></span></a>
			</div>
		</div>
	</div>

</div>