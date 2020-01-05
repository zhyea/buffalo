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


    public function check()
    {
        if (preg_match("/.*admin.*/i", uri_string())) {
            if (!$this->CI->session->userdata('username')) {
                // 用户未登陆
                redirect('console/login');
            }
        }
    }

}