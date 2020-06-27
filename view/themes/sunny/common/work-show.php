<?php
defined('_APP_PATH_') or exit('You shall not pass!');
?>

<?php if (!empty($works)) { ?>
	<div class="row work-show">
        <?php foreach ($works as $w) { ?>
			<div class="col-md-6 col-xs-12 work">
				<div class="cover">
					<a href="<?= $ctx ?>/work/<?= $w['id'] ?>.html">
						<img src="<?= ($uri_upload . '/' . $w['cover']) ?>" width="118px" height="172px"/>
					</a>
				</div>
				<div class="brief">
					<div>
						<span class="title"><a href="<?= $ctx ?>/work/<?= $w['id'] ?>.html"><?= $w['name'] ?></a></span>
						<span class="author">
                        <a href="<?= $ctx ?>/author/<?= $w['author_id'] ?>.html"><?= $w['author'] ?></a>
                    </span>
					</div>
					<div class="intro">
                        <?php
                        if (!empty($w['brief'])) {
                            $txt = $w['brief'];
                            if (strlen($txt) > 240) {
                                $txt = substr($txt, 0, 240);
                            }
                            echo $txt . '...';
                        }
                        ?>
					</div>
				</div>
			</div>
        <?php } ?>
	</div>
<?php } ?>