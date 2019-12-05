<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container main">

	<div class="page-header">
		<h3>专辑列表</h3>
	</div>


	<div id="workTableToolbar">
		<div class="btn-group">
			<a class="btn btn-default" href="<?= $ctx_site ?>/admin/feature/settings_page">
				<i class="glyphicon glyphicon-plus"></i>新增
			</a>
			<a id="btnDelete" class="btn btn-default">
				<i class="glyphicon glyphicon-minus"></i>删除
			</a>
		</div>
	</div>
	<table id="workTable"
	       data-toggle="table"
	       data-search="true"
	       data-classes="table table-hover table-borderless"
	       data-click-to-select="true"
	       data-toolbar="#workTableToolbar"
	       data-url="<?= $ctx_site ?>/admin/feature/data"
	       data-sort-name="id"
	       data-sort-order="asc"
	       data-side-pagination='server'
	       data-pagination=true
	       data-page-size=30
	       data-page-list=[15,30,50,All]>
		<thead>
		<tr>
			<th data-align="center" data-checkbox="true"></th>
			<th data-align="left" data-sortable="true" data-field="name" data-formatter="nameFormatter">专题名称</th>
			<th data-align="left" data-sortable="true" data-field="alias">别名</th>
		</tr>
		</thead>
	</table>
</div>


<script charset="utf-8" src="<?= $ctx_admin ?>/static/js/jquery.min.js"></script>
<script>
    // 删除按钮事件
    $("#btnDelete").on("click", function () {

        let rows = $("#workTable").bootstrapTable('getSelections');// 获得要删除的数据
        if (rows.length > 0) {// rows 主要是为了判断是否选中，下面的else内容才是主要
            let ids = [];// 声明一个数组
            $(rows).each(function () {// 通过获得别选中的来进行遍历
                ids.push(this.id);// cid为获得到的整条数据中的一列
            });

            $.ajax({
                url: '<?= $ctx_site ?>/admin/work/feature',
                data: 'ids=' + ids,
                type: 'post',
                dataType: 'json',
                success: function (data) {
                    $('#workTable').bootstrapTable('refresh');
                }
            });
        }
    });

    function nameFormatter(value, row, index) {
        return '<a href="<?= $ctx_site ?>/admin/work/settings_page/' + row.id + '" target="_self">' + value + '</a>';
    }

</script>