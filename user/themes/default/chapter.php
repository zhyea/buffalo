<?php
defined('BASEPATH') OR exit('No direct script access allowed');
isset($ctx_theme) OR exit('No base url exists')
?>


<script charset="utf-8" src="<?= $ctx_theme ?>/static/js/reader.js" type="text/javascript"></script>

<div class="container notice">
	<ol class="breadcrumb">
		<li><a href="#"><span class="glyphicon glyphicon-home"></span> 首页</a></li>
		<li><a href="#">语文</a></li>
		<li class="active">梦游天姥吟留别</li>
	</ol>
</div>

<div class="main">
	<div class="row readerTools">
		<script type="text/javascript">
            if (system.win || system.mac || system.xll) {
                readerSet();
            }
		</script>
	</div>

	<div class="row" id="contentContainer">

		<div class="row chapter-name">
			第一章 把酒问青天
		</div>

		<div class="row chapter-nav">
			<a>上一章</a> ← <a>返回目录</a> → <a>下一章</a>
		</div>

		<div class="row chapter-content" id="contentText" style="">
			zzzzzzzzzzzzzzzzzzz
			zzzzzzzzzzzzzzzzz
			zzzzzzzzzz
		</div>

		<div class="row chapter-nav">
			<a>上一章</a> ← <a>返回目录</a> → <a>没有了</a>
		</div>
	</div>

</div>


<script type="text/javascript">
    window.addEventListener('load', LoadReadSet, false);
</script>
