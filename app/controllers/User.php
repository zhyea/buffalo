<?php


class User extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }

    /**
     * 返回搜有用户数据
     */
    public function all()
    {
        $data = $this->user_model->all_users();
        echo json_encode($data);
    }

}