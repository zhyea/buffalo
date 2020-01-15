<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container main">

	<div class="page-header">
		<h3>专题 《<?= $name ?>》 - 列表</h3>
	</div>

	<form>
		<div class="row">
			<div class="form-input col-md-5 col-xs-12">
				<div class="input-group">
					<input type="text" class="form-control" id="featureRecordSelectInput" autocomplete="off">
					<div class="input-group-btn">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="">
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu dropdown-menu-right" role="menu"></ul>
					</div>
					<!-- /btn-group -->
				</div>
			</div>
		</div>
	</form>


	<div id="featureRecordTableToolbar">
		<div class="btn-group">
			<a id="btnDelete" class="btn btn-default">
				<i class="glyphicon glyphicon-minus"></i> 删除
			</a>
		</div>
	</div>
	<table id="featureRecordTable"
	       data-toggle="table"
	       data-search="true"
	       data-classes="table table-hover table-borderless"
	       data-click-to-select="true"
	       data-toolbar="#featureRecordTableToolbar"
	       data-url="<?= $ctx_site ?>/admin/feature/feature_works/<?= $id ?>"
	       data-sort-name="id"
	       data-sort-order="asc"
	       data-pagination=true
	       data-page-size=30
	       data-page-list=[15,30,50,All]>
		<thead>
		<tr>
			<th data-align="center" data-checkbox="true"></th>
			<th data-align="left" data-sortable="true" data-field="name">作品</th>
		</tr>
		</thead>
	</table>
</div>


<script charset="utf-8" src="<?= $ctx_admin ?>/static/js/jquery.min.js"></script>
<script charset="utf-8" src="<?= $ctx_admin ?>/static/js/bootstrap-suggest.js"></script>
<script>
    $("#featureRecordSelectInput").bsSuggest({
        clearable: true,
        url: "<?= $ctx_site ?>/admin/work/find_by_name/",
        showHeader: false,
        showBtn: true,     //不显示下拉按钮
        idField: "id",
        keyField: "name",
        effectiveFields: ["id", "name"],
        allowNoKeyword: false,
        getDataMethod: 'url'
    }).on('onSetSelectValue', function (e, keyword, data) {
        $.post('<?= $ctx_site ?>/admin/feature/add_work',
            {
                id: '<?=$id?>',
                work_id: data.id
            }, function (data, status) {
                if ('success' === status) {
                    $('#featureRecordTable').bootstrapTable('refresh')
                }
            });
    });


    // 删除按钮事件
    $("#btnDelete").on("click", function () {
        let rows = $("#featureRecordTable").bootstrapTable('getSelections');// 获得要删除的数据
        if (rows.length > 0) {// rows 主要是为了判断是否选中，下面的else内容才是主要
            let ids = [];// 声明一个数组
            $(rows).each(function () {// 通过获得别选中的来进行遍历
                ids.push(this.id);// cid为获得到的整条数据中的一列
            });

            $.ajax({
                url: '<?= $ctx_site ?>/admin/feature/delete_records',
                data: 'ids=' + ids,
                type: 'post',
                dataType: 'json',
                success: function (data, status) {
                    if ('success' === status) {
                        $('#featureRecordTable').bootstrapTable('refresh');
                    }
                }
            });
        }
    });
</script>
