<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container main">

	<div class="page-header">
		<h3><span class="glyphicon glyphicon-book"></span> 天策府</h3>
	</div>

    <?= form_open_multipart('admin/work/upload'); ?>
	<div class="row">
		<div class="form-label col-md-2 col-xs-12">选择文本</div>
		<div class="form-input col-md-8 col-xs-12">
			<input type="file" class="form-control" accept="text/plain" name="myTxt"/>
		</div>
		<div class="col-md-2 col-xs-12">
			<button type="submit" class="btn btn-success">上传文件</button>
		</div>
	</div>
    <?= form_close()?>

	<div class="row chapter-container">
		<div class="col-md-4 col-xs-12 chapter-unit"><div class="chapter"><a>章节一 </a><a><span class="glyphicon glyphicon-remove del"></span></a></div></div>
		<div class="col-md-4 col-xs-12 chapter-unit"><div class="chapter"><a>章节一 </a><a><span class="glyphicon glyphicon-remove del"></span></a></div></div>
		<div class="col-md-4 col-xs-12 chapter-unit"><div class="chapter"><a>章节一 </a><a><span class="glyphicon glyphicon-remove del"></span></a></div></div>
		<div class="col-md-4 col-xs-12 chapter-unit"><div class="chapter"><a>章节一 </a><a><span class="glyphicon glyphicon-remove del"></span></a></div></div>
		<div class="col-md-4 col-xs-12 chapter-unit"><div class="chapter"><a>章节一 </a><a><span class="glyphicon glyphicon-remove del"></span></a></div></div>
		<div class="col-md-4 col-xs-12 chapter-unit"><div class="chapter"><a>章节一 </a><a><span class="glyphicon glyphicon-remove del"></span></a></div></div>
		<div class="col-md-4 col-xs-12 chapter-unit"><div class="chapter"><a>章节一 </a><a><span class="glyphicon glyphicon-remove del"></span></a></div></div>
		<div class="col-md-4 col-xs-12 chapter-unit"><div class="chapter"><a>章节一 </a><a><span class="glyphicon glyphicon-remove del"></span></a></div></div>
		<div class="col-md-4 col-xs-12 chapter-unit"><div class="chapter"><a>章节一 </a><a><span class="glyphicon glyphicon-remove del"></span></a></div></div>
	</div>


	<div class="row">
		<div class="col-md-4 col-xs-12">
			<button type="submit" class="btn btn-success">新增章节</button>
		</div>
		<div class="col-md-8 col-xs-12">
		</div>
	</div>
</div>