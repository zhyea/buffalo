<?php


class Router
{

    /**
     * 当前路由名称
     *
     * @var string
     */
    public static $current;

    /**
     * 已经解析完毕的路由表配置
     *
     * @var mixed
     */
    private static $_routingTable = array();

    /**
     * 全路径
     *
     * @var string
     */
    private static $_pathInfo = NULL;


    /**
     * 设置全路径
     *
     * @param string 相对路径信息
     */
    public static function setPathInfo($pathInfo = '/')
    {
        self::$_pathInfo = $pathInfo;
    }

    /**
     * 获取全路径
     *
     * @return string
     */
    public static function getPathInfo()
    {
        if (NULL === self::$_pathInfo) {
            self::setPathInfo();
        }

        return self::$_pathInfo;
    }


    public static function dispatch()
    {
        /** 获取PATHINFO */
        $pathInfo = self::getPathInfo();

        foreach (self::$_routingTable as $key => $route) {
            if (preg_match($route['regx'], $pathInfo, $matches)) {
                self::$current = $key;

                try {
                    /** 载入参数 */
                    $params = NULL;

                    if (!empty($route['params'])) {
                        unset($matches[0]);
                        $params = array_combine($route['params'], $matches);
                    }

                    $widget = Typecho_Widget::widget($route['widget'], NULL, $params);

                    if (isset($route['action'])) {
                        $widget->{$route['action']}();
                    }

                    return;

                } catch (Exception $e) {
                    if (404 == $e->getCode()) {
                        Typecho_Widget::destory($route['widget']);
                        continue;
                    }

                    throw $e;
                }
            }
        }

        /** 载入路由异常支持 */
        throw new Typecho_Router_Exception("Path '{$pathInfo}' not found", 404);
    }

}