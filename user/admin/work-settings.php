<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container main">

	<div class="page-header">
		<h3><?= $id === 0 ? '新增作品' : '编辑作品 - ' . $name ?></h3>
	</div>


    <?php if (isset($msg)): ?>
		<div class="alert alert-success alert-dismissible fade in" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>
			<strong>提示!</strong> <?= $msg ?>
		</div>
    <?php endif; ?>

	<form method="post" action="<?= $ctx_site ?>/admin/work/update">
		<div class="row">
			<div class="form-label col-md-3 col-xs-12">作品名称</div>
			<div class="form-input col-md-9 col-xs-12">
				<input type="hidden" name="id" value="<?= $id ?>"/>
				<input type="text" class="form-control" name="name" value="<?='' ?>" required autofocus/>
			</div>
		</div>
		<div class="row">
			<div class="form-label col-md-3 col-xs-12">作者</div>
			<div class="form-input col-md-9 col-xs-12">
				//https://blog.csdn.net/m0_37355951/article/details/78292910
				<select class="form-control" name="author" id="authorSelector">
				</select>
			</div>
		</div>

		<div class="row">
			<div class="form-label col-md-3 col-xs-12">分类</div>
			<div class="form-input col-md-9 col-xs-12">
				<input type="text" class="form-control" name="nickname" value="<?='' ?>" required/>
			</div>
		</div>


		<div class="row">
			<div class="col-md-3 col-xs-12">&nbsp;</div>
			<div class="form-input col-md-9 col-xs-12">
				<button type="submit" class="btn btn-success">保存用户</button>
			</div>
		</div>
	</form>
</div>

<script>
    function changeAuthorSelector() {
        let selector = $("#authorSelector");
        selector.remove();//清空select列表数据

        $.ajax({
            type: "GET",
            url: "<?= $ctx_site ?>/admin/author/find_by_name/" + selector.text(),
            success: function (data) {
                for (let i = 0; i < data.length; i++) {
                    selector.append("<option value=" + data.[i].id + ">" + data.[i].name + "</option>");
                }
            }
        });
    }
</script>