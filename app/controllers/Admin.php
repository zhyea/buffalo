<?php

class Admin extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('array');
        $this->load->model('meta');
        $this->load->model('settings');
        $this->load->library('session');
    }

    public function login()
    {
        self::adminViewOf('login');
    }


    public function index()
    {
        $data['title'] = 'Buffalo Console';
        $data['site_name'] = $this->settings->get('site_name');

        self::content_view('home', $data);
    }


    /**
     * 网站管理
     */
    public function site_settings()
    {
        $data['title'] = '网站管理 - Buffalo';

        $data['site_name'] = $this->settings->get('site_name');
        $data['site_keywords'] = $this->settings->get('site_keywords');
        $data['site_description'] = $this->settings->get('site_description');

        self::content_view('site-settings', $data);
    }

    public function update_site_settings()
    {
        $site_name = $this->input->post('site_name');
        $site_keywords = $this->input->post('site_keywords');
        $site_description = $this->input->post('site_description');

        redirect('/site_settings');
    }


    public function login_check()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        echo $username;
        echo $password;
    }


    private function content_view($content_name, $data = array())
    {
        self::adminViewOf('common/header', $data);
        self::adminViewOf($content_name, $data);
        self::adminViewOf('common/footer', $data);
    }
}