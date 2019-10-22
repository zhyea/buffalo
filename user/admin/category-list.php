<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container main">

    <div class="page-header">
        <h3>分类列表<?= is_null($parent_name) || empty($parent_name) ? '' : ' - ' . $parent_name ?></h3>
    </div>


    <div id="categoryTableToolbar">
        <div class="btn-group">
            <a class="btn btn-default" href="<?= $ctx_site ?>/admin/category/settings">
                <i class="glyphicon glyphicon-plus"></i>新增
            </a>
            <a id="btnDelete" class="btn btn-default">
                <i class="glyphicon glyphicon-minus"></i>删除
            </a>
        </div>
    </div>
    <table id="categoryTable"
           data-toggle="table"
           data-search="true"
           data-classes="table table-hover table-borderless"
           data-click-to-select="true"
           data-toolbar="#categoryTableToolbar"
           data-url="<?= $ctx_site ?>/admin/category/data/<?= $parent ?>">
        <thead>
        <tr>
            <th data-align="center" data-checkbox="true"></th>
            <th data-field="id" data-visible="false"></th>
            <th data-align="left" data-field="child_num" data-formatter="<span class='badge'>%s </span>">子分类</th>
            <th data-align="left" data-field="name" data-formatter="nameFormatter">分类名</th>
            <th data-align="left" data-field="slug">缩写名</th>
            <th data-align="center" data-field="slug" data-formatter="operateFormatter">操作</th>
        </tr>
        </thead>
    </table>
</div>


<script charset="utf-8" src="<?= $ctx_admin ?>/static/js/jquery.min.js"></script>
<script>
    // 删除按钮事件
    $("#btnDelete").on("click", function () {

        let rows = $("#categoryTable").bootstrapTable('getSelections');// 获得要删除的数据
        if (rows.length > 0) {// rows 主要是为了判断是否选中，下面的else内容才是主要
            let ids = [];// 声明一个数组
            $(rows).each(function () {// 通过获得别选中的来进行遍历
                ids.push(this.id);// cid为获得到的整条数据中的一列
            });

            $.ajax({
                url: '<?= $ctx_site ?>/category/delete',
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
        return '<a href="<?= $ctx_site ?>/admin/category/list_page/' + row.id + '" target="_self">' + value + '</a>';
    }

    function operateFormatter(value, row, index) {
        return [
            '<a href="<?= $ctx_site ?>/admin/category/list_page/' + row.id + '" target="_self">编辑</a>',
            '<a href="<?= $ctx_site ?>/admin/category/list_page/' + row.id + '" target="_self">删除</a>',
            '<a href="<?= $ctx_site ?>/admin/category/list_page/' + row.id + '" target="_self">默认</a>',
            '<a href="<?= $ctx_site ?>/admin/category/list_page/' + row.id + '" target="_self">子分类</a>']
            .join('&nbsp;&nbsp;&nbsp;');
    }
</script>