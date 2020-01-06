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
        $user = $this->user_model->get_by_username($username, $password);
        if (!is_null($user)) {
            $this->session->set_userdata('user', $username.'@'.$ip);
            redirect("admin");
            return;
        }


        $count = $this->session->userdata($ip);
        $count = is_null($count) ? 0 : $count;
        if ($count < 3) {
            $count = $count + 1;
        } else {
            show_404();
        }

        $this->session->set_userdata($ip, $count);

        echo $username . '<br>';
        echo $password . '<br>';
        echo $count . '<br>';

        echo
        exit();
        //redirect('admin');
    }


}