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
        $this->load->model('user_model');

        $this->load->service('settings_service');
    }


    /**
     * 加载登录页面
     */
    public function login()
    {
        self::adminViewOf('login');
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
    public function settings_site()
    {
        $data['title'] = '网站管理 - Buffalo';

        $data['site_keywords'] = $this->settings_model->get('site_keywords');
        $data['site_description'] = $this->settings_model->get('site_description');

        if (get_cookie('update_site')) {
            $data['msg'] = '更新网站设置成功！';
            delete_cookie('update_site');
        }

        self::content_view('settings-site', $data);
    }


    /**
     * 加载信息维护页
     */
    public function settings_info()
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
        self::content_view('settings-info', $data);
    }


    /**
     * 加载用户信息列表页
     */
    public function user_list()
    {
        $data['title'] = '用户信息 - Buffalo';
        $this->content_view('user-list', $data);
    }

    /**
     * 加载用户信息维护页
     */
    public function user_settings()
    {
        $data['title'] = '新增用户 - Buffalo';
        $user = $this->user_model->get_by_id($this->get_param_or_default('id', 0));

        $data['username'] = is_null($user) ? $user['username'] : '';
        $data['nickname'] = is_null($user) ? $user['nickname'] : '';
        $this->content_view('user-settings', $data);
    }


    private function get_param_or_default($name = NULL, $default = NULL)
    {
        return isset($_GET[$name]) ? $_GET[$name] : $default;
    }

    private function content_view($content_name, $data = array())
    {
        $data['site_name'] = $this->settings_model->get('site_name');

        self::adminViewOf('common/header', $data);
        self::adminViewOf($content_name, $data);
        self::adminViewOf('common/footer', $data);
    }
}