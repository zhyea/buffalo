<?php

class Console extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->library('session');
    }


    /**
     * 加载登录页面
     */
    public function login()
    {
        self::admin_view_of('login');
    }


    /**
     * 登录信息校验
     */
    public function login_check()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $ip = $this->input->ip_address();

        echo $username;
        echo $password;

        echo
        exit();
        //redirect('admin');
    }


}