<?php


class AbstractController extends Z_Controller
{
    /**
     * constructor.
     */
    public function __construct()
    {
        if (!defined('_ADMIN_URI_')) {
            define('_ADMIN_URI_', _VIEW_CONTEXT_ . '/admin');

        }
        if (!defined('_THEME_URI_')) {
            define('_THEME_URI_', _VIEW_CONTEXT_ . '/themes/' . _CFG_['theme']);
        }
        if (!defined('_UPLOAD_URI_')) {
            define('_UPLOAD_URI_', _VIEW_CONTEXT_ . '/upload');
        }
    }


    /**
     * 展示后台页面
     *
     * @param $page string 页面地址
     * @param $params array 页面变量
     * @param $title string 页面title
     */
    protected function admin_view($page, $params, $title)
    {
        $params['uri_admin'] = _ADMIN_URI_;
        $params['uri_theme'] = _THEME_URI_;
        $params['uri_upload'] = _UPLOAD_URI_;
        $params['ctx'] = _APP_CONTEXT_ . 'index.php/';

        if (isset($_SESSION['alert'])) {
            $params['alert'] = $_SESSION['alert'];
            unset($_SESSION['alert']);
        }

        $this->_render_view('/admin', $page, $params, $title);
    }


    /**
     * 展示前端页面
     *
     * @param $page string 页面地址
     * @param $params array 页面变量
     * @param $title string 页面title
     */
    protected function theme_view($page, $params, $title)
    {
        $params['uri_theme'] = _THEME_URI_;
        $this->_render_view(_CFG_['theme'], $page, $params, $title);
    }


    /**
     * 渲染视图
     *
     * @param $dir string 主题目录
     * @param $page string 页面地址
     * @param $params array 页面变量
     * @param $title string 页面title
     */
    private function _render_view($dir, $page, $params, $title)
    {
        if (NULL == $params) {
            $params = array();
        }
        if (!array_key_exists('title', $params)) {
            $params['title'] = $title;
        }
        $page = $dir . DIRECTORY_SEPARATOR . $page;
        parent::render_view($page, $params);
        exit();
    }


    /**
     * 上传文件，文件将按日期保存，并提供随机ID作为名称
     *
     * @param $name string 文件表单名
     * @return array 文件是否上传成功 / 失败原因 / 保存位置
     */
    protected function upload($name)
    {
        $save_name = uniqid();
        $sub_path = date('Y/m/d');
        return parent::_upload($name, $save_name, $sub_path);
    }


    /**
     * 执行跳转
     *
     * @param $uri string 跳转目标路径
     */
    protected function redirect($uri)
    {
        $uri = _APP_CONTEXT_ . (str_start_with($uri, '/') ? 'index.php' : 'index.php/') . $uri;
        parent::_redirect($uri);
    }


    /**
     * 添加提示信息
     *
     * @param $msg string 提示内容
     * @param $type string 提示类型，对应bootstrap alert类
     */
    protected function add_alert($msg, $type)
    {
        $_SESSION['alert'] = array('type' => $type, 'msg' => $msg);
    }

}