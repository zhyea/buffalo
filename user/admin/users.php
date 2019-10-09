<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container main">

	<div class="page-header">
		<h3>用户列表</h3>
	</div>


    <table id="userTable"
           data-toggle="table"
           data-search="true"
           data-classes="table table-hover"
           data-url="<?= $site_url ?>/user/all">
        <thead>
        <tr>
            <th data-align="center" data-field="id" data-width="40px">ID</th>
            <th data-align="left" data-field="username">用户名</th>
            <th data-align="left" data-field="nickname">昵称</th>
        </tr>
        </thead>
    </table>
</div>