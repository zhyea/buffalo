<?php


class MY_Controller extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->helper('array');
        $this->load->helper('cookie');

        $this->load->model('settings_model');
        $this->load->model('meta_model');
    }


    /**
     * 获取参数值，如不存在则取默认值
     *
     * @param string $name 参数名
     * @param mixed $default 默认值
     * @return mixed 参数值或默认值
     */
    protected function get_param_or_default($name = NULL, $default = NULL)
    {
        return isset($_GET[$name]) ? $_GET[$name] : $default;
    }


    /**
     * 加载视图页
     *
     * @param string $view 视图页名称
     * @param array $vars 视图页变量
     * @param bool $return 是否有返回值
     */
    protected function view_of($view, $vars = array(), $return = FALSE)
    {
        $this->load->view($view, $vars, $return);
    }

    /**
     * 加载管理后台视图
     *
     * @param string $view 视图页名称
     * @param array $vars 视图页变量
     * @param bool $return 是否有返回值
     */
    protected function admin_view_of($view, $vars = array(), $return = FALSE)
    {
        $this->load->admin_view($view, $vars, $return);
    }


    /**
     * 加载管理后台内容页
     *
     * @param string $page_name 内容页
     * @param array $data 页面数据
     * @param string $title 页面title
     */
    protected function admin_page_view($page_name, $title = '', $data = array())
    {
        $data['title'] = $title;
        $data['site_name'] = $this->settings_model->get('site_name');

        self::admin_view_of('common/header', $data);
        self::admin_view_of($page_name, $data);
        self::admin_view_of('common/footer', $data);
    }


    /**
     * 加载内容页
     *
     * @param string $page_name 内容页
     * @param string $title 页面title
     * @param array $data 页面数据
     */
    protected function page_view($page_name, $title = '', $data = array())
    {
        $cats = $this->meta_model->query_category();
        $data['categories'] = list_to_tree($cats);

        $site_name = $this->settings_model->get('site_name');

        $data['site_name'] = $site_name;
        $data['notice'] = $this->settings_model->get('notice');

        $data['title'] = $title . ' - ' . $site_name;

        self::view_of('header', $data);
        self::view_of('navigator', $data);
        self::view_of($page_name);
        self::view_of('footer');
    }

}