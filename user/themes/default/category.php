<?php
defined('BASEPATH') OR exit('No direct script access allowed');
isset($ctx_theme) OR exit('No base url exists')
?>


<div class="container notice">
	<ol class="breadcrumb">
		<li><a href="#">首页</a></li>
		<li><a href="#">语文</a></li>
		<li class="active">语文吃饭</li>
	</ol>
</div>

<div class="container main">
	<div class="page-header">
		<h3><span class="glyphicon glyphicon-book"></span> 推荐内容</h3>
	</div>
	<div class="row recommend">
        <?php
        $count = 0;
        while ($count++ < 6) {
            ?>
			<div class="item col-md-2 col-xs-2">
				<div class="cover">
					<img src="<?php echo $ctx_theme ?>/static/imgs/tuijian.jpg"/>
				</div>
				<div class="remark">知否知否，应是绿肥红瘦</div>
			</div>
        <?php } ?>
	</div>


	<div class="page-header">
		<h3><span class="glyphicon glyphicon-bookmark"></span> 分类名称</h3>
	</div>
	<div class="row category">

		<div class="col-md-6 col-xs-12">
			<div class="cover">
				<img src="<?php echo $ctx_theme ?>/static/imgs/tuijian.jpg"/>
			</div>
			<div class="brief">
				日照香炉生紫烟，遥看瀑布挂前川，飞流直下三千只，疑是银河落九天。大江东去，浪淘尽，千古风流人物，遥想公瑾当年，小乔初嫁了，羽扇纶巾，雄姿英发，谈笑间樯橹灰飞烟灭
			</div>
		</div>
	</div>

</div>
