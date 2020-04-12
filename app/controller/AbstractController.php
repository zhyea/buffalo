<?php


class AbstractController extends Z_Controller
{

    /**
     * 展示后台页面
     *
     * @param $page string 页面地址
     * @param $params array 页面变量
     * @param $title string 页面title
     */
    protected function admin_view($page, $params, $title)
    {
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
        $this->_render_view(_CFG_['theme'], $page, $params, $title);
    }



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


}