<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class MY_Loader extends CI_Loader
{

    public function view($view, $vars = array(), $return = FALSE)
    {
        $theme = 'default';
        $vars['base_url'] = self::base_url($theme);
        $view = $theme . '/' . $view;
        return $this->_ci_load(array('_ci_view' => $view, '_ci_vars' => $this->_ci_prepare_view_vars($vars), '_ci_return' => $return));
    }

    private function base_url($theme)
    {
        $base_url = get_instance()->config->base_url() ;
        $view_path = rtrim(VIEWPATH, DIRECTORY_SEPARATOR);
        $idx = strrpos($view_path, DIRECTORY_SEPARATOR);
        $view_folder = substr($view_path, $idx + 1);
        return $base_url . '/' . $view_folder .  '/' . $theme;
    }

}