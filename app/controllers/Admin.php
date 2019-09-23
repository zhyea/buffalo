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
        $data = array(
            array(
                'name' => 'site_name',
                'value' => $_POST['site_name']
            ),
            array(
                'name' => 'site_keywords',
                'value' => $_POST['site_keywords']
            ),
            array(
                'name' => 'site_description',
                'value' => $_POST['site_description']
            )
        );

        redirect('/site_settings');
    }


    public function login_check()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

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