<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container main">

	<div class="page-header">
		<h3>用户列表</h3>
	</div>


	<div id="userTableToolbar">
		<div class="btn-group">
			<a class="btn btn-default" href="<?= $ctx_site ?>/admin/user/settings_page">
				<i class="glyphicon glyphicon-plus"></i>新增
			</a>
			<a id="btnDelete" class="btn btn-default">
				<i class="glyphicon glyphicon-minus"></i>删除
			</a>
		</div>
	</div>
	<table id="userTable"
	       data-toggle="table"
	       data-search="true"
	       data-classes="table table-hover table-borderless"
	       data-click-to-select="true"
	       data-toolbar="#userTableToolbar"
	       data-url="<?= $ctx_site ?>/admin/user/data">
		<thead>
		<tr>
			<th data-align="center" data-checkbox="true"></th>
			<th data-field="id" data-visible="false"></th>
			<th data-align="left" data-field="username" data-formatter="nameFormatter">用户名</th>
			<th data-align="left" data-field="nickname">昵称</th>
			<th data-align="left" data-field="email">电子邮件</th>
		</tr>
		</thead>
	</table>
</div>


<script charset="utf-8" src="<?= $ctx_admin ?>/static/js/jquery.min.js"></script>
<script>
    // 删除按钮事件
    $("#btnDelete").on("click", function () {

        let rows = $("#userTable").bootstrapTable('getSelections');// 获得要删除的数据
        if (rows.length > 0) {// rows 主要是为了判断是否选中，下面的else内容才是主要
            let ids = [];// 声明一个数组
            $(rows).each(function () {// 通过获得别选中的来进行遍历
                ids.push(this.id);// cid为获得到的整条数据中的一列
            });

            $.ajax({
                url: '<?= $ctx_site ?>/admin/user/delete',
                data: 'ids=' + ids,
                type: 'post',
                dataType: 'json',
                success: function (data) {
                    $('#userTable').bootstrapTable('refresh');
                }
            });
        }
    });

    function nameFormatter(value, row, index) {
        return '<a href="<?= $ctx_site ?>/admin/user/settings_page/' + row.id + '" target="_self">' + value + '</a>';
    }
</script>