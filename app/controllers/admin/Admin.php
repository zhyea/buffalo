<?php


class Admin extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('session');
    }

    /**
     * 后台首页
     */
    public function index()
    {
        $this->admin_page_view('home', 'Buffalo Console');
    }

    /**
     * 退出登录
     */
    public function logout()
    {
        $this->session->unset_userdata('user');
        redirect("/");
    }

}