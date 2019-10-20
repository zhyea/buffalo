<?php

class Admin extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

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
        self::admin_page_view('home', 'Buffalo Console');
    }


    /**
     * 网站配置管理页
     */
    public function settings_site()
    {
        $data['site_keywords'] = $this->settings_model->get('site_keywords');
        $data['site_description'] = $this->settings_model->get('site_description');

        if (get_cookie('update_site')) {
            $data['msg'] = '更新网站设置成功！';
            delete_cookie('update_site');
        }

        self::admin_page_view('settings-site', '网站管理 - Buffalo', $data);
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

        $data['logo'] = $this->settings_model->get('logo');
        $data['bg_img'] = $this->settings_model->get('bg_img');
        $data['notice'] = $this->settings_model->get('notice');
        self::admin_page_view('settings-info', '信息维护 - Buffalo', $data);
    }


    /**
     * 加载用户信息列表页
     */
    public function user_list()
    {
        $this->admin_page_view('user-list', '用户信息 - Buffalo');
    }

    /**
     * 加载用户信息维护页
     * @param int $id 用户ID
     */
    public function user_settings($id = 0)
    {
        $user = $this->user_model->get_by_id($id);

        $title = ($id === 0 ? '新增用户' : '编辑用户') . ' - Buffalo';

        $data['id'] = $id;
        $data['username'] = is_null($user) ? '' : $user['username'];
        $data['nickname'] = is_null($user) ? '' : $user['nickname'];
        $data['email'] = is_null($user) ? '' : $user['email'];
        $this->admin_page_view('user-settings', $title, $data);
    }


    /**
     * 加载分类列表页
     * @param int $parent 分类父ID
     */
    public function category_list($parent = 0)
    {
        $p = $this->meta_model->get_by_id($parent);
        $data['parent'] = is_null($p) ? 0 : $p['id'];
        $data['parent_name'] = is_null($p) ? '' : $p['name'];
        $this->admin_page_view('category-list', '分类信息', $data);
    }


    /**
     * 加载内容页
     *
     * @param string $page_name 内容页
     * @param array $data 页面数据
     * @param string $title 页面title
     */
    private function admin_page_view($page_name, $title = '', $data = array())
    {
        $data['title'] = $title;
        $data['site_name'] = $this->settings_model->get('site_name');

        self::adminViewOf('common/header', $data);
        self::adminViewOf($page_name, $data);
        self::adminViewOf('common/footer', $data);
    }
}