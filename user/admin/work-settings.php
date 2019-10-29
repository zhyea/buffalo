<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container main">

    <div class="page-header">
        <h3><?= $id === 0 ? '新增作品' : '编辑作品 - ' . $name ?></h3>
    </div>


    <?php if (isset($msg)): ?>
        <div class="alert alert-success alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            <strong>提示!</strong> <?= $msg ?>
        </div>
    <?php endif; ?>

    <form method="post" action="<?= $ctx_site ?>/admin/user/update">
        <div class="row">
            <div class="form-label col-md-3 col-xs-12">作品名称</div>
            <div class="form-input col-md-9 col-xs-12">
                <input type="hidden" name="id" value="<?= $id ?>"/>
                <input type="text" class="form-control" name="username" value="<?= $username ?>" required autofocus/>
            </div>
        </div>
        <div class="row">
            <div class="form-label col-md-3 col-xs-12">作者</div>
            <div class="form-input col-md-9 col-xs-12">
                <input type="text" class="form-control" name="email" value="<?= $email ?>" required/>
            </div>
        </div>

        <div class="row">
            <div class="form-label col-md-3 col-xs-12">分类</div>
            <div class="form-input col-md-9 col-xs-12">
                <input type="text" class="form-control" name="nickname" value="<?= $nickname ?>" required/>
            </div>
        </div>
        <select class="form-control customSelect" title="">
            <option value="">--全部--</option>
        </select>


        <div class="row">
            <div class="col-md-3 col-xs-12">&nbsp;</div>
            <div class="form-input col-md-9 col-xs-12">
                <button type="submit" class="btn btn-success">保存用户</button>
            </div>
        </div>
    </form>
</div>