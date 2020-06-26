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
     * 根据ID删除记录
     */
    public function delete()
    {
        $ids = $this->_post_array();
        echo $this->model->delete_by_ids($ids);
    }


    /**
     * 用户信息维护
     * TODO 新增时需要完成对密码的MD5加密
     */
    public function maintain()
    {
        $data = $this->_post();
        $username = $data['username'];
        $user = $this->model->get_by_username($username);
        if (!empty($data['id']) && !empty($user) && ($data['id'] != $user['id'])) {
            $this->alert_danger('用户名已存在');
            $this->redirect('admin/user/settings');
        } else {
            $data['password'] = md5($data['password'] . '#_淦x7');
            $this->model->insert_or_update($data);
            $this->alert_success('新增用户成功');
            $this->redirect('admin/user/list');
        }
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