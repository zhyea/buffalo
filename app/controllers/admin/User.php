<?php


class User extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }



    /**
     * 加载用户信息列表页
     */
    public function list_page()
    {
        $this->admin_page_view('user-list', '用户信息');
    }

    /**
     * 加载用户信息维护页
     *
     * @param int $id 用户ID
     */
    public function settings_page($id = 0)
    {
        $user = $this->user_model->get_by_id($id);

        $title = ($id === 0 ? '新增用户' : '编辑用户') . ' - Buffalo';

        $data['id'] = $id;
        $data['username'] = is_null($user) ? '' : $user['username'];
        $data['nickname'] = is_null($user) ? '' : $user['nickname'];
        $data['email'] = is_null($user) ? '' : $user['email'];
        $this->admin_page_view('user-settings', $title, $data);
    }


    /**
     * 返回所有用户数据
     */
    public function data()
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

        redirect('admin/user/list_page');
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


}