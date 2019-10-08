<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container main">

	<div class="page-header">
		<h3>用户列表</h3>
	</div>

    <div id="userTableToolbar">
        <div class="btn-group">
            <button id="btnAdd" class="btn btn-default" data-toggle="modal" data-target="#appModal">
                <i class="glyphicon glyphicon-plus"></i>新增
            </button>
        </div>
    </div>
    <table id="userTable"
           data-toggle="table"
           data-search="true"
           data-classes="table table-hover"
           data-toolbar="#userTableToolbar"
           data-url="/api/app/all">
        <thead>
        <tr>
            <th data-align="center" data-field="id" data-width="40px">ID</th>
            <th data-align="left" data-field="username">用户名</th>
            <th data-align="left" data-field="nickname">昵称</th>
            <th data-align="center" data-formatter="operateFormatter" data-events="operateEvents">操作</th>
        </tr>
        </thead>
    </table>
</div>