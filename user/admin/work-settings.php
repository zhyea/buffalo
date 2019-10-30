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
				<input type="text" class="form-control" name="name" value="<?= '' ?>" required autofocus/>
			</div>
		</div>
		<div class="row">
			<div class="form-label col-md-3 col-xs-12">作者</div>
			<div class="form-input col-md-9 col-xs-12">
				//http://lzw.me/pages/demo/bootstrap-suggest-plugin/demo/
				<select class="selectpicker form-control" name="author" data-live-search="true" id="authorSelector">
					<option value="">请选择作者</option>
				</select>
			</div>
		</div>

		<div class="row">
			<div class="form-label col-md-3 col-xs-12">分类</div>
			<div class="form-input col-md-9 col-xs-12">
				<input type="text" class="form-control" name="nickname" value="<?= '' ?>" required/>
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

<script charset="utf-8" src="<?= $ctx_admin ?>/static/js/jquery.min.js"></script>
<script>

    $("#authorSelector").on('shown.bs.select', function (e) {
        //获取下拉select里的输入框,提示一下搜索下拉
        $(this).prev().find("input").attr('placeholder', "请输入公司名称搜索");
        //绑定一下键盘输入
        $(this).prev().find("input").keyup(function () {
            //为select里的输入框绑定id,方便获取
            $(this).prev().find("input").attr('id', "authorName");
            let authorName = $(this).val();
			alert(0);
            $.ajax({
                type: "GET",
                url: "<?= $ctx_site ?>/admin/author/find_by_name/" + authorName,
                success: function (data) {
                    let html = '';
                    $.each(data, function (index, ele) {
                        html += '<option value="' + ele.id + '">' + ele.name + '</option>';
                    });
                    $(this).html(html);
                    //刷新select
                    $(this).selectpicker('refresh');
                }
            });
        })
    });
</script>