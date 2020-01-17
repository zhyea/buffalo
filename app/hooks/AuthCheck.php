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

        if (strpos($url, 'admin/work/remote_edit') !== false) {
            return;
        }

        if (strpos($url, 'admin') !== false) {
            if (!$this->CI->session->userdata('user')) {
                redirect('console/login');
            }
        }
    }

}