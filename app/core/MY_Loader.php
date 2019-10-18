<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class MY_Loader extends CI_Loader
{

    /**
     * 视图页信息增强
     *
     * @param  $view string 要加载的视图页
     * @param  $vars array 视图页参数
     * @param  $return bool 是否有返回值
     * @return object|string 加载的视图页内容
     */
    public function view($view, $vars = array(), $return = FALSE)
    {
        if (!defined('VIEW_CONTEXT')) {
            define('VIEW_CONTEXT', self::view_context());
        }
        $theme = 'default';
        $vars['ctx_theme'] = VIEW_CONTEXT . 'themes/' . $theme;
        $vars['ctx_upload'] = VIEW_CONTEXT . 'uploads/';
        $vars['site_url'] = self::site_url();
        $view = 'themes/' . $theme . '/' . $view;
        return $this->_ci_load(array('_ci_view' => $view, '_ci_vars' => $this->_ci_prepare_view_vars($vars), '_ci_return' => $return));
    }


    /**
     * 管理后台视图页信息增强
     *
     * @param  $view string 要加载的视图页
     * @param  $vars array 视图页参数
     * @param  $return bool 是否有返回值
     * @return object|string 加载的视图页内容
     */
    public function admin_view($view, $vars = array(), $return = FALSE)
    {
        if (!defined('VIEW_CONTEXT')) {
            define('VIEW_CONTEXT', self::view_context());
        }
        $vars['ctx_admin'] = VIEW_CONTEXT . 'admin/';
        $vars['ctx_upload'] = VIEW_CONTEXT . 'uploads/';
        $vars['site_url'] = self::site_url();
        $view = 'admin/' . $view;
        return $this->_ci_load(array('_ci_view' => $view, '_ci_vars' => $this->_ci_prepare_view_vars($vars), '_ci_return' => $return));
    }


    /**
     * 获取网站根路径（含视图路径）
     */
    private static function view_context()
    {
        $base_url = get_instance()->config->base_url();
        $arr = parse_url($base_url);
        $view_path = rtrim(VIEWPATH, DIRECTORY_SEPARATOR);
        $idx = strrpos($view_path, DIRECTORY_SEPARATOR);
        $view_folder = substr($view_path, $idx + 1);
        return $arr['path'] . $view_folder . '/';
    }

    /**
     * 获取网站根路径
     */
    private static function site_url()
    {
        return get_instance()->config->site_url();
    }

    /**
     * 加载的 services 列表
     */
    protected $_ci_services = array();

    /**
     * 加载的 services 路径列表
     */
    protected $_ci_service_paths = array();


    /**
     * 构造器
     */
    public function __construct()
    {
        parent::__construct();
        load_class('Service', 'core');
        $this->_ci_service_paths = array(APPPATH);
    }

    /**
     * Service Loader
     *
     * This function lets users load and instantiate classes.
     * It is designed to be called from a user's app controllers.
     *
     * @param string the name of the class
     * @param mixed the optional parameters
     * @param string an optional object name
     * @return void
     */
    public function service($service = '', $params = NULL, $object_name = NULL)
    {
        if (is_array($service)) {
            foreach ($service as $class) {
                $this->service($class, $params);
            }
            return;
        }
        if ($service == '' or isset($this->_ci_services[$service])) {
            return;
        }
        if (!is_null($params) && !is_array($params)) {
            $params = NULL;
        }
        $sub_dir = '';

        // Is the service in a sub-folder? If so, parse out the filename and path.
        if (($last_slash = strrpos($service, '/')) !== FALSE) {
            // The path is in front of the last slash
            $sub_dir = substr($service, 0, $last_slash + 1);

            // And the service name behind it
            $service = substr($service, $last_slash + 1);
        }
        foreach ($this->_ci_service_paths as $path) {
            $filepath = $path . 'service/' . $sub_dir . $service . '.php';
            if (!file_exists($filepath)) {
                continue;
            }
            include_once($filepath);
            $service = strtolower($service);

            if (empty($object_name)) {
                $object_name = $service;
            }
            $service = ucfirst($service);
            $CI = &get_instance();
            if ($params !== NULL) {
                $CI->$object_name = new $service($params);
            } else {
                $CI->$object_name = new $service();
            }
            $this->_ci_services[] = $object_name;
            return;
        }
    }

}