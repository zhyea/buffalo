<?php

class Console extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('user_model');
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
        $password = md5('a3D#_%' . $_POST['password']);

        $ip = $this->input->ip_address();
        $count = $this->session->userdata($ip);
        if (!is_null($count) && $count > 3) {
            redirect('/');
        }

        $user = $this->user_model->get_by_username($username, $password);
        if (!is_null($user)) {
            $this->session->set_userdata('user', $username . '@' . $ip);
            redirect("admin");
            return;
        }

        $count = is_null($count) ? 1 : $count + 1;

        $this->session->set_userdata($ip, $count);

        redirect('console/login');
    }


}