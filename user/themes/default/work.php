<?php
defined('BASEPATH') OR exit('No direct script access allowed');
isset($ctx_theme) OR exit('No base url exists')
?>


<div class="container notice">
	<ol class="breadcrumb">
		<li><a href="<?= $ctx_site ?>"><span class="glyphicon glyphicon-home"></span> 首页</a></li>
		<li><a href="#">语文</a></li>
		<li class="active"><?= $work['name'] ?></li>
	</ol>
</div>

<div class="main">
	<div class="work-header">
		<span class="title"><?= $work['name'] ?></span>
		<span class="author">作者：<a href="#"><?= $work['author'] ?></a></span>
	</div>

	<div class="work-neck row">
		<div class="col-md-2 cover">
			<img src="<?php echo $ctx_upload . '/' . $work['cover'] ?>" width="120px" height="172px"/>
		</div>

		<div class="col-md-10 col-xs-12 brief">
			<div class="intro"><?= $work['brief'] ?></div>
			<div class="relate"><i class="glyphicon glyphicon-tags"></i> 相关作品： <a href="#">以待天倾</a><a
						href="#">赋得古原草送别</a><a href="#">念奴娇·赤壁怀古</a></div>
		</div>
	</div>

	<div class="work-body">
		<div class="row">
			<div class="col-md-12 col-xs-12 volume"><i class="glyphicon glyphicon-bookmark"></i> 第一卷</div>
			<div class="col-md-4 col-xs-12 chapter">翡冷翠</div>
			<div class="col-md-4 col-xs-12 chapter">佛罗伦萨之夜</div>
			<div class="col-md-4 col-xs-12 chapter">若马大道何其多</div>
			<div class="col-md-4 col-xs-12 chapter">翡冷翠</div>
			<div class="col-md-4 col-xs-12 chapter">佛罗伦萨之夜</div>
			<div class="col-md-4 col-xs-12 chapter">若马大道何其多</div>
			<div class="col-md-4 col-xs-12 chapter">翡冷翠</div>
			<div class="col-md-4 col-xs-12 chapter">佛罗伦萨之夜</div>
			<div class="col-md-4 col-xs-12 chapter">若马大道何其多</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-xs-12 volume"><i class="glyphicon glyphicon-bookmark"></i> 第一卷</div>
			<div class="col-md-4 col-xs-12 chapter">翡冷翠</div>
			<div class="col-md-4 col-xs-12 chapter">佛罗伦萨之夜</div>
			<div class="col-md-4 col-xs-12 chapter">若马大道何其多</div>
			<div class="col-md-4 col-xs-12 chapter">翡冷翠</div>
			<div class="col-md-4 col-xs-12 chapter">佛罗伦萨之夜</div>
			<div class="col-md-4 col-xs-12 chapter">若马大道何其多</div>
			<div class="col-md-4 col-xs-12 chapter">翡冷翠</div>
			<div class="col-md-4 col-xs-12 chapter">佛罗伦萨之夜</div>
			<div class="col-md-4 col-xs-12 chapter">若马大道何其多</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-xs-12 volume"><i class="glyphicon glyphicon-bookmark"></i> 第一卷</div>
			<div class="col-md-4 col-xs-12 chapter">翡冷翠</div>
			<div class="col-md-4 col-xs-12 chapter">佛罗伦萨之夜</div>
			<div class="col-md-4 col-xs-12 chapter">若马大道何其多</div>
			<div class="col-md-4 col-xs-12 chapter">翡冷翠</div>
			<div class="col-md-4 col-xs-12 chapter">佛罗伦萨之夜</div>
			<div class="col-md-4 col-xs-12 chapter">若马大道何其多</div>
			<div class="col-md-4 col-xs-12 chapter">翡冷翠</div>
			<div class="col-md-4 col-xs-12 chapter">佛罗伦萨之夜</div>
			<div class="col-md-4 col-xs-12 chapter">若马大道何其多</div>
		</div>
	</div>
</div>
