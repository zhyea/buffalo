<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>首页模板</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="<?php echo $base_url ?>/static/layui/css/layui.css" rel="stylesheet" type="text/css" media="all">
    <link href="<?php echo $base_url ?>/static/css/style.css" rel="stylesheet" type="text/css" media="all">
</head>


<body>

<?php
	print_r($categories);
?>

<div class="layui-container wrapper">
	<div class="layui-row header">
		&nbsp;
	</div>

	<div class="layui-row navigator">
		<ul class="layui-nav">
			<li class="layui-nav-item"><a href="">最新活动</a></li>
			<li class="layui-nav-item layui-this"><a href="">产品</a></li>
			<li class="layui-nav-item"><a href="">大数据</a></li>
			<li class="layui-nav-item"><a href="">社区</a></li>
		</ul>
	</div>

	<div class="layui-row notice">
		<div class="icon-speaker">
			<em class="layui-icon layui-icon-speaker" style="font-size: 20px; font-weight: bold;"></em>
		</div>
		这里是通知内容
	</div>