<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script charset="utf-8" src="<?= $ctx_admin ?>/static/ckeditor/ckeditor.js"></script>

<div class="container main">
	
	<div class="page-header">
		<h3>文章编辑</h3>
	</div>

	<form method="post" action="<?= $ctx_site ?>/admin/content/update">
		<div class="row">
			<input type="text" class="form-control" placeholder="标题" name="name" value="" required autofocus/>
		</div>
		<div class="row">
			<textarea name="content" id="buffalo_editor" rows="10" cols="80">内容</textarea>
			<script> CKEDITOR.replace('buffalo_editor');</script>
		</div>
		<div class="row">
			<button type="submit" class="btn btn-default">保存</button>
			&nbsp;&nbsp;&nbsp;
			<a class="btn btn-success" href="<?= $ctx_site ?>/admin/ ">返回</a>
		</div>
	</form>
</div>