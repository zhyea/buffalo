<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container main">

	<div class="page-header">
		<h3><span class="glyphicon glyphicon-book"></span> <?= $name ?></h3>
	</div>

    <?php if (empty($volumes)): ?>
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

        <?php foreach ($volumes as $v): ?>
			<div class="page-header">
				<h3><span class="glyphicon glyphicon-book"></span> <?= $v['name'] ?></h3>
			</div>
			<div class="row">
                <?php if ($v['_child']): ?>
                    <?php foreach ($v['_child'] as $ch): ?>
						<div class="col-md-4 col-xs-12 chapter-unit">
							<div class="chapter">
								<a target="_self"
								   href="<?= $ctx_site ?>/admin/work/chapter_edit/<?= $id . '/' . $ch['id'] ?>">
                                    <?= $ch['name'] ?>
								</a>
								<a><i class="glyphicon glyphicon-minus operate"></i></a>
							</div>
						</div>
                    <?php endforeach; ?>
                <?php endif; ?>
			</div>
        <?php endforeach; ?>

		<div class="row">
			<div class="col-md-4 col-xs-12 chapter-unit">
				<div class="chapter">
					<a href="<?= $ctx_site ?>/admin/work/chapter_edit/<?= $id ?>/0" target="_self">新增章节...</a>
					<a><i class="glyphicon glyphicon-plus operate"></i></a>
				</div>
			</div>
		</div>
	</div>

</div>