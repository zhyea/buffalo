<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container main">

	<div class="page-header">
		<h3>用户列表</h3>
	</div>


	<div id="userTableToolbar">
		<div class="btn-group">
			<button id="btnAdd" class="btn btn-default">
				<i class="glyphicon glyphicon-plus"></i>新增
			</button>
			<button id="btnAdd" class="btn btn-default">
				<i class="glyphicon glyphicon-minus"></i>删除
			</button>
		</div>
	</div>
	<table id="userTable"
	       data-toggle="table"
	       data-search="true"
	       data-classes="table table-hover table-borderless"
	       data-toolbar="#userTableToolbar"
	       data-url="<?= $site_url ?>/user/all">
		<thead>
		<tr>
			<th data-align="center" data-checkbox="true"></th>
			<th data-field="id" data-visible="false"></th>
			<th data-align="left" data-field="username">用户名</th>
			<th data-align="left" data-field="nickname">昵称</th>
		</tr>
		</thead>
	</table>
</div>