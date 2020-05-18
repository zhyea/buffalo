<?php
defined('_ZERO_PATH_') or exit('You shall not pass!');


class Router
{

    /**
     * Controller信息
     *
     * @var array controller config info
     */
    private $controller_config;

    /**
     * Router constructor.
     */
    public function __construct()
    {
        $path = array_key_exists('PATH_INFO', $_SERVER) ? $_SERVER['PATH_INFO'] : '/';
        if (_CFG_['suffix'] && str_end_with($path, _CFG_['suffix'])) {
            $path = substr($path, 0, strpos($path, _CFG_['suffix']));
        }
        if (empty($this->controller_config)) {
            $this->controller_config = $this->_parse_controller($path);
        }
    }


    public function dispatch()
    {
        session_start();

        if (null == $this->controller_config) {
            $this->error_404();
        } else {
            $class = $this->controller_config[1];
            $method = $this->controller_config[2];
            $args = $this->controller_config[3];

            try {
                $c = new ReflectionClass($class);
                if (!$c->hasMethod($method)) {
                    $this->error_404();
                }

                $i = $c->newInstanceArgs();
                $m = $c->getmethod($method);
                $m->invokeArgs($i, $args);
            } catch (ReflectionException $e) {
                $this->error_500();
            }
        }
    }


    private function _parse_controller($path)
    {
        foreach (_R_ as $key => $value) {
            if (str_start_with($path, $key)) {
                $cfg = $this->_parse_controller0($value);
                if (null != $cfg) {
                    $sub = ltrim($path, $key);
                    if (!empty($sub)) {
                        $params = explode('/', $sub);
                        $cfg[3] = array_merge($cfg[3], $params);
                    }
                    return $cfg;
                }
                break;
            }
        }
        return $this->_parse_controller0($path);
    }


    private function _parse_controller0($path)
    {
        $arr = explode('/', $path);
        $tmp = '';
        $size = count($arr);
        for ($i = 0; $i < $size; $i++) {
            $str = $arr[$i];
            $class = ucwords(strtolower($str)) . 'Controller';
            if (file_exists(_CONTROLLER_PATH_ . $tmp . $class . '.php')) {
                $m = ($i + 1) < $size ? $arr[$i + 1] : 'index';
                $param = ($i + 2) < $size ? array_slice($arr, $i + 2) : array();
                return array(
                    1 => $class,
                    2 => $m,
                    3 => $param
                );
            }
            $tmp = $tmp . '/' . $str . '/';
        }
        return null;
    }


    private function error_404()
    {
        println('404 Error');
        exit();
    }


    private function error_500()
    {
        println('500 Error');
        exit();
    }

}