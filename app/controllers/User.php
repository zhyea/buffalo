<?php


class User extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }

    /**
     * 返回所有用户数据
     */
    public function all()
    {
        $data = $this->user_model->all_users();
        echo json_encode($data);
    }


    /**
     * 更新用户信息
     */
    public function update(){

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