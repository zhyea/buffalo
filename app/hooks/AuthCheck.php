<?php


class AuthCheck extends MY_Hooks
{

    public function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('session');
    }


    protected function load()
    {

    }


    public function check()
    {
//        echo uri_string();
//        $this->CI->load->helper('url');
//
//        if (preg_match("/manage.*/i", uri_string())) {
//            // 需要进行权限检查的URL
//            this −> CI−>load −> library(′session′);
//            if (!this->CI->session->userdata('username') ) {
//                // 用户未登陆
//                redirect('login');
//                return;
//            }        }
    }

}