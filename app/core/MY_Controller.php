<?php


class MY_Controller extends CI_Controller
{


    /**
     * 加载视图页
     *
     * @param string $view 视图页名称
     * @param array $vars 视图页变量
     * @param bool $return 是否有返回值
     */
    protected function viewOf($view, $vars = array(), $return = FALSE)
    {
        $this->load->view($view, $vars, $return);
    }

    /**
     * 加载管理后台视图
     * @param string $view 视图页名称
     * @param array $vars 视图页变量
     * @param bool $return 是否有返回值
     */
    protected function adminViewOf($view, $vars = array(), $return = FALSE)
    {
        $this->load->admin_view($view, $vars, $return);
    }

}