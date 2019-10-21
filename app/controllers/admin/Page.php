<?php

class Page extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('meta_model');
        $this->load->model('settings_model');
        $this->load->model('user_model');

    }


    /**
     * 加载登录页面
     */
    public function login()
    {
        self::admin_view_of('login');
    }

    /**
     * 后台首页
     */
    public function index()
    {
        self::admin_page_view('home', 'Buffalo Console');
    }





    /**
     * 登录信息校验
     */
    public function login_check()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        echo $username;
        echo $password;

        redirect('admin');
    }






}