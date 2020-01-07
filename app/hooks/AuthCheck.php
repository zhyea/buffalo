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
        $url = uri_string();
        $code = $this->CI->session->userdata('code');
        if (!is_null($code) && strrpos($url, "work/chapter_upload")) {

        } elseif (preg_match("/.*admin.*/i", uri_string())) {
            if (!$this->CI->session->userdata('user')) {
                // 用户未登陆
                redirect('console/login');
            }
        }
    }

}