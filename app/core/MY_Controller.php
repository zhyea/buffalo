<?php


class MY_Controller extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->helper('array');
        $this->load->helper('cookie');
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
    protected function viewOf($view, $vars = array(), $return = FALSE)
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
    protected function adminViewOf($view, $vars = array(), $return = FALSE)
    {
        $this->load->admin_view($view, $vars, $return);
    }

}