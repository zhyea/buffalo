<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class MY_Loader extends CI_Loader
{

    /**
     * 视图页信息增强
     */
    public function view($view, $vars = array(), $return = FALSE)
    {
        if (!defined('BASE_URL')) {
            define('BASE_URL', self::base_url());
        }
        $theme = 'default';
        $vars['theme_url'] = BASE_URL . 'themes/' . $theme;
        $vars['upload_url'] = BASE_URL . 'uploads/';
        $vars['site_url'] = self::site_url();
        $view = 'themes/' . $theme . '/' . $view;
        return $this->_ci_load(array('_ci_view' => $view, '_ci_vars' => $this->_ci_prepare_view_vars($vars), '_ci_return' => $return));
    }


    /**
     * 管理后台视图页信息增强
     */
    public function admin_view($view, $vars = array(), $return = FALSE)
    {
        if (!defined('BASE_URL')) {
            define('BASE_URL', self::base_url());
        }
        $vars['admin_url'] = BASE_URL . 'admin/';
        $vars['upload_url'] = BASE_URL . 'uploads/';
        $vars['site_url'] = self::site_url();
        $view = 'admin/' . $view;
        return $this->_ci_load(array('_ci_view' => $view, '_ci_vars' => $this->_ci_prepare_view_vars($vars), '_ci_return' => $return));
    }


    /**
     * 获取网站根路径（含视图路径）
     */
    private static function base_url()
    {
        $base_url = get_instance()->config->base_url();
        $view_path = rtrim(VIEWPATH, DIRECTORY_SEPARATOR);
        $idx = strrpos($view_path, DIRECTORY_SEPARATOR);
        $view_folder = substr($view_path, $idx + 1);
        return $base_url . $view_folder . '/';
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
     *
     * @var array
     * @access protected
     */
    protected $_ci_services = array();

    /**
     * 加载的 services 路径列表
     *
     * @var array
     * @access protected
     */
    protected $_ci_service_paths = array();


    /**
     * 构造器
     *
     * Set the path to the Service files
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