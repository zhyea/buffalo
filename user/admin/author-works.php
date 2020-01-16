<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container main">

	<div class="page-header">
		<h3>作者 《<?= $name ?>》 - 作品列表</h3>
	</div>

	<form>
		<div class="row">
			<div class="form-input col-md-5 col-xs-12">
				<div class="input-group">
					<input type="text" class="form-control" id="authorWorkSelectInput" autocomplete="off">
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


	<table id="authorWorkTable"
	       data-toggle="table"
	       data-search="true"
	       data-show-search-clear-button="true"
	       data-search-align="left"
	       data-classes="table table-hover table-borderless"
	       data-click-to-select="true"
	       data-url="<?= $ctx_site ?>/admin/work/author_works/<?= $id ?>"
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
    $("#authorWorkSelectInput").bsSuggest({
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
        $.post('<?= $ctx_site ?>/admin/work/alter_author',
            {
                id: '<?=$id?>',
                work_id: data.id
            }, function (data, status) {
                if ('success' === status) {
                    $('#authorWorkTable').bootstrapTable('refresh')
                }
            });
    });
</script>
