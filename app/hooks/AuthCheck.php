<?php


class AuthCheck extends MY_Hooks
{

    public function __construct()
    {
        parent::__construct();

        $this->CI =& get_instance();

        $this->load->helper('url');
        $this->load->library('session');

    }


    protected function load()
    {

    }


    public function check()
    {
        $this->CI->session->userdata('USER');
        if (preg_match("/.*admin.*/i", uri_string())) {
            if (!$this->CI->session->userdata('username')) {
                echo 1;
                // 用户未登陆
                redirect('console/login');
                return;
            }
        }
    }

}