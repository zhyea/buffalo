<?php
defined('_APP_PATH_') or exit('You shall not pass!');

include_once 'common/header.php';
include_once 'common/navigator.php';
?>

<div class="container notice">
	<ol class="breadcrumb">
		<li><a href="<?= $ctx ?>/"><i class="glyphicon glyphicon-folder-open">&nbsp;首页</i></a></li>
		<li><a href="<?= $ctx ?>/c/<?= $w['cat_slug'] ?>.html"><?= $w['cat'] ?></a></li>
		<li><a href="<?= $ctx ?>/work/<?= $w['id'] ?>.html#vol_$<?= $chp['volume_id'] ?>"><?= $w['name'] ?></a></li>
        <?php if (!empty($chp['volume_id']) && $chp['volume_id'] > 0) { ?>
			<li><a href="<?= $ctx ?>/work/<?= $w['id'] ?>.html#vol_<?= $chp['volume_id'] ?>"><?= $chp['volume_name'] ?></a>
			</li>
        <?php } ?>
		<li class="active"><?= $chp['name'] ?></li>
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

		<div class="row chapter-name"><?= $chp['name'] ?></div>

		<div class="row chapter-nav">
            <?php if (!empty($last)) { ?>
				<a href="<?= $ctx ?>/chapter/<?= $last ?>.html">上一章</a>
            <?php } else { ?>
				<a>无</a>
            <?php } ?>
			←
			<a href="<?= $ctx ?>/work/<?= $w['id'] ?>" .html#vol_<?= $chp['volume_id'] ?>">返回目录</a>
			→

            <?php if (!empty($next)) { ?>
				<a href="<?= $ctx ?>/chapter/<?= $next ?>.html">下一章</a>
            <?php } else { ?>
				<a>没有了</a>
            <?php } ?>

			<span class="chapter-author">作者：<a
						href="<?= $ctx ?>/author/<?= $w['author_id'] ?>.html"><?= $w['author'] ?></a></span>
		</div>

		<div class="row chapter-content" id="contentText" style=""><?= $chp['content'] ?></div>

		<div class="row chapter-nav">
            <?php if (!empty($last)) { ?>
				<a href="<?= $ctx ?>/chapter/<?= $last ?>.html">上一章</a>
            <?php } else { ?>
				<a>无</a>
            <?php } ?>
			←
			<a href="<?= $ctx ?>/work/<?= $w['id'] ?>" .html#vol_<?= $chp['volume_id'] ?>">返回目录</a>
			→

            <?php if (!empty($next)) { ?>
				<a href="<?= $ctx ?>/chapter/<?= $next ?>.html">下一章</a>
            <?php } else { ?>
				<a>没有了</a>
            <?php } ?>
		</div>
        <?php if (!empty($chapter_bottom_ad)) { ?>
			<div><?= $chapter_bottom_ad ?></div>
        <?php } ?>
	</div>

</div>


<?php include_once 'common/footer.php'; ?>


<script type="text/javascript">
    window.addEventListener('load', LoadReadSet, false);

    let last_page = "<?=$ctx?>/chapter/<?=$last?>.html";
    let next_page = "<?=$ctx?>/chapter/<?=$next?>.html";
    document.onkeydown = function (evt) {
        let e = window.event || evt;
        if (e.keyCode == 37) location.href = last_page;
        if (e.keyCode == 39) location.href = next_page;
    };

    backToTop();
</script>