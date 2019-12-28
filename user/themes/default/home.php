<?php
defined('BASEPATH') OR exit('No direct script access allowed');
isset($ctx_theme) OR exit('No base url exists')
?>


<div class="container notice">
	<span class="glyphicon glyphicon-bullhorn" aria-hidden="true"></span> ： <?= $notice ?>
</div>

<div class="container main">
	<div class="page-header">
		<h3><span class="glyphicon glyphicon-book"></span> 推荐内容</h3>
	</div>
	<div class="row recommend">
        <?php foreach ($recommend as $r): ?>
			<div class="item col-md-2 col-xs-2">
				<div class="cover">
					<a href="<?= $ctx_site . '/fe/work/' . $r['id'] ?>">
						<img src="<?php echo $ctx_upload . '/' . $r['cover'] ?>"/>
					</a>
				</div>
				<div class="remark"><a href="<?= $ctx_site . '/fe/work/' . $r['id'] ?>"><?= $r['name'] ?></a></div>
			</div>
        <?php endforeach; ?>
	</div>

    <?php foreach ($cats as $c): ?>
		<div class="page-header">
			<h3><a href="<?= $ctx_site . '/fe/cat/' . $c['id'] ?>">
					<i class="glyphicon glyphicon-th-list"></i> <?= $c['name'] ?>
				</a></h3>
		</div>
		<div class="row popular">
            <?php foreach ($c['works'] as $w): ?>
				<div class="item col-md-4 col-xs-4">
					■ <a href="<?= $ctx_site . '/fe/work/' . $w['id'] ?>"><?= $w['name'] ?></a>
					<span class="author">
						<a href="<?= $ctx_site . '/fe/author/' . $w['author_id'] ?>"><?= '[' . $w['author'] . ']' ?></a>
					</span>
				</div>
            <?php endforeach; ?>
		</div>
    <?php endforeach; ?>


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
