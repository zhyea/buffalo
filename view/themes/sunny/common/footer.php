<?php
defined('_APP_PATH_') or exit('You shall not pass!');
?>

<div class="container footer">
	<div class="col-md-12 col-xs-12 copyright">
        <?php
        if (!empty($bottom_text)) {
            echo $bottom_text;
        }
        ?>
	</div>
</div>

<script src="<?= $uri_theme ?>/static/js/bootstrap.min.js"></script>
<script src="<?= $uri_theme ?>/static/js/custom.js"></script>

<!--统计代码-->
<?php
if (!empty($statistic)) {
    echo $statistic;
}
?>
</div>
</body>

