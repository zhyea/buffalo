<?php
defined('BASEPATH') OR exit('No direct script access allowed');
isset($ctx_theme) OR exit('No base url exists')
?>

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
	<div class="row popular">
		<div class="item col-md-4 col-xs-4">■ 小说名称<span class="author">[作者名称]</span></div>
		<div class="item col-md-4 col-xs-4">■ 小说名称<span class="author">[作者名称]</span></div>
		<div class="item col-md-4 col-xs-4">■ 小说名称<span class="author">[作者名称]</span></div>
		<div class="item col-md-4 col-xs-4">■ 小说名称<span class="author">[作者名称]</span></div>
		<div class="item col-md-4 col-xs-4">■ 小说名称<span class="author">[作者名称]</span></div>
		<div class="item col-md-4 col-xs-4">■ 小说名称<span class="author">[作者名称]</span></div>
		<div class="item col-md-4 col-xs-4">■ 小说名称<span class="author">[作者名称]</span></div>
		<div class="item col-md-4 col-xs-4">■ 小说名称<span class="author">[作者名称]</span></div>
		<div class="item col-md-4 col-xs-4">■ 小说名称<span class="author">[作者名称]</span></div>
		<div class="item col-md-4 col-xs-4">■ 小说名称<span class="author">[作者名称]</span></div>
		<div class="item col-md-4 col-xs-4">■ 小说名称<span class="author">[作者名称]</span></div>
		<div class="item col-md-4 col-xs-4">■ 小说名称<span class="author">[作者名称]</span></div>
	</div>


	<div class="page-header">
		<h3><span class="glyphicon glyphicon-bookmark"></span> 分类名称</h3>
	</div>
	<div class="row popular">
		<div class="item col-md-4 col-xs-4">■ 小说名称<span class="author">[作者名称]</span></div>
		<div class="item col-md-4 col-xs-4">■ 小说名称<span class="author">[作者名称]</span></div>
		<div class="item col-md-4 col-xs-4">■ 小说名称<span class="author">[作者名称]</span></div>
		<div class="item col-md-4 col-xs-4">■ 小说名称<span class="author">[作者名称]</span></div>
		<div class="item col-md-4 col-xs-4">■ 小说名称<span class="author">[作者名称]</span></div>
		<div class="item col-md-4 col-xs-4">■ 小说名称<span class="author">[作者名称]</span></div>
		<div class="item col-md-4 col-xs-4">■ 小说名称<span class="author">[作者名称]</span></div>
		<div class="item col-md-4 col-xs-4">■ 小说名称<span class="author">[作者名称]</span></div>
		<div class="item col-md-4 col-xs-4">■ 小说名称<span class="author">[作者名称]</span></div>
		<div class="item col-md-4 col-xs-4">■ 小说名称<span class="author">[作者名称]</span></div>
		<div class="item col-md-4 col-xs-4">■ 小说名称<span class="author">[作者名称]</span></div>
		<div class="item col-md-4 col-xs-4">■ 小说名称<span class="author">[作者名称]</span></div>
	</div>
</div>
