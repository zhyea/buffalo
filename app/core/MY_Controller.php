<?php


class MY_Controller extends CI_Controller
{


    /**
     * 加载视图页
     *
     * @param $view string 视图页名称
     * @param array $vars 视图页变量
     * @param bool $return 是否有返回值
     */
    protected function viewOf($view, $vars = array(), $return = FALSE)
    {
        $this->load->view($view, $vars, $return);
    }

    protected function adminViewOf($view, $vars = array(), $return = FALSE)
    {
        $this->load->admin_view($view, $vars, $return);
    }


    protected function modelOf($model, $name = '', $db_conn = FALSE)
    {
        $this->load->model($model, $name, $db_conn);
    }


    protected function helperOf($helpers = array())
    {
        $this->load->helper($helpers);
    }


}