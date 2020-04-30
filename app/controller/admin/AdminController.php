<?php
defined('_APP_PATH_') OR exit('You shall not pass!');


class AdminController extends AbstractController
{


    public function login()
    {
        $this->admin_view('login', array(), '请登录');
    }


    public function index()
    {
        $this->admin_view('index', array(), '后台首页');
    }


}