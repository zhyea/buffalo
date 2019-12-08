<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container main">

	<div class="page-header">
		<h3>专题 《<?= $name ?>》 - 列表</h3>
	</div>


	<div class="modal fade" id="featureRecordSelect">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">选择作品</h4>
				</div>
				<div class="modal-body">
					<ul>
						<li>输入关键字后执行选择</li>
					</ul>
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
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-primary-outline" data-dismiss="modal">关闭</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
	
	<div id="featureRecordTableToolbar">
		<div class="btn-group">

			<a class="btn btn-default" data-toggle="modal" data-target="#featureRecordSelect">
				<i class="glyphicon glyphicon-plus"></i> 新增
			</a>
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
	       data-url="<?= $ctx_site ?>/admin/feature/records_data/<?= $id ?>"
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
        url: "<?= $ctx_site ?>/admin/category/data_all",
        showHeader: false,
        showBtn: true,     //不显示下拉按钮
        idField: "id",
        keyField: "name",
        effectiveFields: ["id", "name", "slug"]
    }).on('onSetSelectValue', function (e, keyword, data) {
        $("#categoryId").val(data.id)
    });
</script>
