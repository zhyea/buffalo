<?php
defined('_APP_PATH_') or exit('You shall not pass!');

include_once 'common/header.php';
include_once 'common/navigator.php';
?>

<div class="container notice">
	<ol class="breadcrumb">
		<li><a href="/"><i class="glyphicon glyphicon-folder-open">&nbsp;首页</i></a></li>
		<li><a href="/c/<?= $w['cat_slug'] ?>.html"><?= $w['cat'] ?></a></li>
		<li class="active"><?= $w['name'] ?></li>
	</ol>
</div>

<div class="main">
	<div class="work-header">
		<span class="title"><?= $w['name'] ?></span>
		<span class="author">作者：<a href="/author/<?= $w['author_id'] ?>.html"><?= $w['author'] ?></a></span>
	</div>

	<div class="work-neck row">
		<div class="cover">
			<img src="<?= $uri_upload . '/' . $w['upload'] ?>" width="80px" height="100px"/>
		</div>

		<div class="brief">
			<div class="intro"><?= $w['brief'] ?></div>
			<div class="relate">
				<i class="glyphicon glyphicon-tags"></i> <?= $w['author'] ?>作品：
                <?php foreach ($relate as $r) { ?>
					<a href="/work/<?= $r['id'] ?>.html"><?= $r['name'] ?></a>
                <?php } ?>
			</div>
		</div>
	</div>

	<div class="work-body">
        <?php foreach ($vols as $vol) { ?>
			<div class="row">
				<div class="col-md-12 col-xs-12 volume" id="vol_<?= $vol['id'] ?>">
					<i class="glyphicon glyphicon-bookmark"></i> <?= $vol['name'] ?>
				</div>
                <?php foreach ($vol['chapters'] as $chp) { ?>
					<div class="col-md-4 col-xs-12 chapter">
						<a href="/chapter/<?= $chp['id'] ?>.html"><?= $chp['name'] ?></a>
					</div>
                <?php } ?>
			</div>
        <?php } ?>
	</div>
</div>


<?php include_once 'common/footer.php'; ?>

<script type="text/javascript">
    backToTop();
</script>