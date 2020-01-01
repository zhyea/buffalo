<?php
defined('BASEPATH') OR exit('No direct script access allowed');
isset($ctx_theme) OR exit('No base url exists')
?>

<div class="container footer">
	<div class="col-md-12 col-xs-12 copyright">
		2019 © <a href="#">Buffalo</a>
	</div>
</div>
</div>


<script charset="utf-8" src="<?= $ctx_theme ?>/static/js/jquery.min.js"></script>
<script charset="utf-8" src="<?= $ctx_theme ?>/static/js/bootstrap.min.js"></script>
<script type="javascript">
    $(document).ready(function () {
        $(document).off('click.bs.dropdown.data-api');
    });

    $(document).ready(function () {
        dropdownOpen();//调用
    });

    /**
     * 鼠标划过就展开子菜单，免得需要点击才能展开
     */
    function dropdownOpen() {
        let $dropdownLi = $('li.dropdown');
        $dropdownLi.mouseover(function () {
            $(this).addClass('open');
        }).mouseout(function () {
            $(this).removeClass('open');
        });
    }
</script>
</body>
</html>

