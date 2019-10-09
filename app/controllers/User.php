<?php


class User extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }

    public function all()
    {
        $data = $this->user_model->all_users();
        echo json_encode($data);
    }

}