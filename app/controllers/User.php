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
    public function update()
    {
        $id = $_POST['id'];
        $data = array(
            'username' => $_POST['username'],
            'nickname' => $_POST['nickname'],
            'password' => md5('a3D#_%' . $_POST['password']),
            'email' => $_POST['email'],
        );
        $this->user_model->insert_or_update($data, $id);

        redirect('admin/user_list');
    }

    /**
     * 删除数据
     */
    public function delete()
    {
        $ids = $_POST['ids'];
        $this->user_model->delete_batch(explode(',', $ids));
        echo $ids;
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