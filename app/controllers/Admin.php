<?php

class Admin extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('array');
        $this->load->helper('cookie');
        $this->load->model('meta_model');
        $this->load->model('settings_model');
        $this->load->service('admin_service');
    }


    public function login()
    {
        self::adminViewOf('login');
    }


    public function login_check()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        echo $username;
        echo $password;

        redirect('admin');
    }

    public function index()
    {
        $data['title'] = 'Buffalo Console';
        $data['site_name'] = $this->settings_model->get('site_name');

        self::content_view('home', $data);
    }


    /**
     * 网站管理
     */
    public function site_settings()
    {
        $data['title'] = '网站管理 - Buffalo';

        $data['site_keywords'] = $this->settings_model->get('site_keywords');
        $data['site_description'] = $this->settings_model->get('site_description');

        if (get_cookie('update_site')) {
            $data['msg'] = '更新网站设置成功！';
            delete_cookie('update');
        }

        self::content_view('site-settings', $data);
    }

    /**
     * 更新网站配置
     */
    public function update_site_settings()
    {
        $this->settings_model->replace('site_name', $_POST['site_name']);
        $this->settings_model->replace('site_keywords', $_POST['site_keywords']);
        $this->settings_model->replace('site_description', $_POST['site_description']);

        set_cookie('update_site', true, 60);

        redirect('admin/info_settings');
    }


    public function info_settings()
    {
        $this->load->helper('form');

        $data['title'] = '信息维护 - Buffalo';
        $data['logo'] = 'logo';
        $data['bg_img'] = 'bg_img';
        $data['notice'] = 'notice';
        self::content_view('info-settings', $data);
    }
    public function update_info_settings()
    {
        $this->admin_service->update_info_settings();

        set_cookie('update_info', true, 60);

        //redirect('admin/info_settings');
    }


    private function content_view($content_name, $data = array())
    {
        $data['site_name'] = $this->settings_model->get('site_name');

        self::adminViewOf('common/header', $data);
        self::adminViewOf($content_name, $data);
        self::adminViewOf('common/footer', $data);
    }
}