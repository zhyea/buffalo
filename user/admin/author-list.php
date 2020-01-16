<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container main">

	<div class="page-header">
		<h3>作者列表</h3>
	</div>


	<div id="authorTableToolbar">
		<div class="btn-group">
			<a class="btn btn-default" href="<?= $ctx_site ?>/admin/author/settings">
				<i class="glyphicon glyphicon-plus"></i>新增
			</a>
		</div>
	</div>
	<table id="authorTable"
	       data-toggle="table"
	       data-search="true"
	       data-classes="table table-hover table-borderless"
	       data-click-to-select="true"
	       data-toolbar="#authorTableToolbar"
	       data-url="<?= $ctx_site ?>/admin/author/data"
	       data-single-select="true"
	       data-id-field="id"
	       data-sort-name="id"
	       data-sort-order="asc"
	       data-pagination=true
	       data-page-size=30
	       data-page-list=[15,30,50,All]>
		<thead>
		<tr>
			<th data-align="left" data-sortable="true" data-field="name" data-formatter="nameFormatter">姓名</th>
			<th data-align="left" data-sortable="true" data-field="country">国家</th>
			<th data-align="center" data-formatter="worksFormatter">作品</th>
			<th data-align="center" data-formatter="operateFormatter">操作</th>
		</tr>
		</thead>
	</table>
</div>


<script charset="utf-8" src="<?= $ctx_admin ?>/static/js/jquery.min.js"></script>
<script>

    function nameFormatter(value, row, index) {
        return '<a href="<?= $ctx_site ?>/admin/author/settings/' + row.id + '" target="_self">' + value + '</a>';
    }

    function worksFormatter(value, row, index) {
        return '<a href="<?= $ctx_site ?>/admin/author/works_page/' + row.id + '" target="_self"><span class="badge">查看</span></a>';
    }

    function operateFormatter(value, row, index) {
        return '<a href="<?= $ctx_site ?>/admin/author/delete/' + row.id + '" target="_self">删除</a>';
    }

</script>