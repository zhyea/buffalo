<?php


class AbstractController extends Z_Controller
{
    /**
     * constructor.
     */
    public function __construct()
    {
        if (!defined('_ADMIN_CONTEXT_')) {
            define('_ADMIN_CONTEXT_', _VIEW_CONTEXT_ . '/' . _CFG_['admin']);

        }
        if (!defined('_THEME_CONTEXT_')) {
            define('_THEME_CONTEXT_', _VIEW_CONTEXT_ . '/' . _CFG_['theme']);
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
        $params['ctx_admin'] = _ADMIN_CONTEXT_;
        $params['ctx_theme'] = _THEME_CONTEXT_;
        $params['ctx'] = _APP_CONTEXT_ . 'index.php/';
        $this->_render_view(_CFG_['admin'], $page, $params, $title);
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
        $params['ctx_theme'] = _THEME_CONTEXT_;
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
    }


    /**
     * 上传文件，文件将按日期保存，并提供随机ID作为名称
     *
     * @param $name string 文件表单名
     * @return array 文件是否上传成功 / 失败原因 / 保存位置
     */
    protected function upload_file($name)
    {
        $save_name = uniqid();
        $sub_path = date('Y/m/d');
        return parent::upload($name, $save_name, $sub_path);
    }


}