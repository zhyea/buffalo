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


    /**
     * 加载登录页面
     */
    public function login()
    {
        self::adminViewOf('login');
    }

    /**
     * 登录信息校验
     */
    public function login_check()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        echo $username;
        echo $password;

        redirect('admin');
    }

    /**
     * 后台首页
     */
    public function index()
    {
        $data['title'] = 'Buffalo Console';
        $data['site_name'] = $this->settings_model->get('site_name');

        self::content_view('home', $data);
    }


    /**
     * 网站配置管理页
     */
    public function site_settings()
    {
        $data['title'] = '网站管理 - Buffalo';

        $data['site_keywords'] = $this->settings_model->get('site_keywords');
        $data['site_description'] = $this->settings_model->get('site_description');

        if (get_cookie('update_site')) {
            $data['msg'] = '更新网站设置成功！';
            delete_cookie('update_site');
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

        if (get_cookie('update_info')) {
            $data['msg'] = '更新网站设置成功！';
        } else {
            $data['msg'] = get_cookie('update_info_msg');
        }
        delete_cookie('update_info');

        $data['title'] = '信息维护 - Buffalo';
        $data['logo'] = $this->settings_model->get('logo');
        $data['bg_img'] = $this->settings_model->get('bg_img');
        $data['notice'] = $this->settings_model->get('notice');
        self::content_view('info-settings', $data);
    }

    public function update_info_settings()
    {
        $this->settings_model->replace('notice', $_POST['notice']);
        if ($_POST['logo']) {
            $r = $this->admin_service->update_img_setting('logo');
            if ($r && $_POST['bg_img']) {
                $this->admin_service->update_img_setting('bg_img');
            }
        }
        redirect('admin/info_settings');
    }


    private function content_view($content_name, $data = array())
    {
        $data['site_name'] = $this->settings_model->get('site_name');

        self::adminViewOf('common/header', $data);
        self::adminViewOf($content_name, $data);
        self::adminViewOf('common/footer', $data);
    }
}