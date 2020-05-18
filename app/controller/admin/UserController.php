<?php
defined('_APP_PATH_') or exit('You shall not pass!');

require_model('UserModel');

class UserController extends AbstractController
{

    private $model;

    /**
     * constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->model = new UserModel();
    }


    /**
     * 进入用户信息编辑页
     *
     * @param $id int 用户ID
     */
    public function settings($id = 0)
    {
        $user = $this->model->get_by_id($id);
        $this->admin_view('user-settings', $user, $id > 0 ? '编辑用户信息' : '新增用户');
    }


    /**
     * 用户信息维护
     */
    public function maintain()
    {
        $id = $_POST['id'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $nickname = $_POST['nickname'];
        $password = $_POST['password'];

        $this->model->insert(array('id' => $id, 'username' => $username, 'email' => $email, 'nickname' => $nickname, 'password' => $password));

        $this->redirect('admin/user/list');
    }


    /**
     * 用户信息列表
     */
    public function list()
    {
        $this->admin_view('user-list', array(), '用户列表');
    }

    /**
     * 获取用户数据
     */
    public function data()
    {
        $r = $this->model->find_all();
        $this->render_json($r);
    }
}