<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class MY_Loader extends CI_Loader
{

    public function view($view, $vars = array(), $return = FALSE)
    {
        if (!defined('BASE_URL')) {
            define('BASE_URL', self::base_url());
        }
        $theme = 'default';
        $vars['theme_url'] = BASE_URL . 'themes/' . $theme;
        $view = 'themes/' . $theme . '/' . $view;
        return $this->_ci_load(array('_ci_view' => $view, '_ci_vars' => $this->_ci_prepare_view_vars($vars), '_ci_return' => $return));
    }


    public function admin_view($view, $vars = array(), $return = FALSE)
    {
        if (!defined('BASE_URL')) {
            define('BASE_URL', self::base_url());
        }
        $vars['admin_url'] = BASE_URL . 'admin/';
        $view = 'admin/' . $view;
        return $this->_ci_load(array('_ci_view' => $view, '_ci_vars' => $this->_ci_prepare_view_vars($vars), '_ci_return' => $return));
    }


    private static function base_url()
    {
        $base_url = get_instance()->config->base_url();
        $view_path = rtrim(VIEWPATH, DIRECTORY_SEPARATOR);
        $idx = strrpos($view_path, DIRECTORY_SEPARATOR);
        $view_folder = substr($view_path, $idx + 1);
        return $base_url . $view_folder . '/';
    }

}