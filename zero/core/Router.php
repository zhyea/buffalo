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
        $cfg = NULL;
        // 1. 用户配置路径优先级最高，执行严格匹配
        if (array_key_exists($path, _R_)) {
            $p = _R_[$path];
            $cfg = $this->_parse_controller0($p);
        }
        if (NULL != $cfg) {
            return $cfg;
        }
        // 2. 默认路径次优先级
        $cfg = $this->_parse_controller0($path);

        // 3. 模糊匹配用户配置路径
        if (NULL == $cfg) {
            foreach (_R_ as $key => $value) {
                if (str_start_with($path, $key)) {
                    $p = $value;
                    $sub = substr($path, strlen($key));
                    if (!empty($sub)) {
                        if (str_start_with($sub, '/') && strlen($sub) > 1) {
                            $sub = substr($sub, 1);
                            $p = (str_end_with($value, '/') ? $value : $value . '/') . $sub;
                        }
                    }
                    $cfg = $this->_parse_controller0($p);
                    return $cfg;
                }
            }
        }
        return $cfg;
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
                $m = ($i + 1) < $size && !empty($arr[$i + 1]) ? $arr[$i + 1] : 'index';
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