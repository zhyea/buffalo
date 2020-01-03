<?php


class AuthCheck extends MY_Hooks
{

    public function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
    }


    protected function load()
    {

    }


    public function check()
    {
        $this->load->library('session');
        if (preg_match("/.*admin.*/i", uri_string())) {
            if (!$this->session->userdata('username') ) {
                echo 1;
                // 用户未登陆
                redirect('admin/console/login');
                return;
            }
        }
    }

}