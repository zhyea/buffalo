<?php

defined('_ZERO_PATH_') or exit('You shall not pass!');


if (!function_exists('is_https')) {
    /**
     * Is HTTPS?
     *
     * Determines if the application is accessed via an encrypted (HTTPS) connection.
     *
     * @return    bool
     */
    function is_https()
    {
        if (!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off') {
            return TRUE;
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && strtolower($_SERVER['HTTP_X_FORWARDED_PROTO']) === 'https') {
            return TRUE;
        } elseif (!empty($_SERVER['HTTP_FRONT_END_HTTPS']) && strtolower($_SERVER['HTTP_FRONT_END_HTTPS']) !== 'off') {
            return TRUE;
        }

        return FALSE;
    }
}


if (!function_exists('site_url')) {
    /**
     * Get site url
     *
     * @param string $context the context or namespace of the site
     * @return string
     */
    function site_url($context = '')
    {
        $base_url = 'localhost';

        if (isset($_SERVER['HTTP_HOST'])) {
            $base_url = $_SERVER['HTTP_HOST'];
        } elseif (isset($_SERVER['SERVER_ADDR'])) {
            if (strpos($_SERVER['SERVER_ADDR'], ':') !== FALSE) {
                $base_url = '[' . $_SERVER['SERVER_ADDR'] . ']';
            } else {
                $base_url = $_SERVER['SERVER_ADDR'];
            }
        }

        $server_port = 80;
        if (isset($_SERVER['SERVER_PORT'])) {
            $server_port = $_SERVER['SERVER_PORT'];
        }

        if (empty($context)) {
            $script_name = $_SERVER['SCRIPT_NAME'];
            $context = substr($script_name, 0, strpos($script_name, basename($script_name)));
        } else {
            $context = '/' . $context . '/';
        }

        if (str_end_with($context, '/')) {
            $context = substr($context, 0, strlen($context) - 1);
        }

        if (is_https() && $server_port == 443) {
            $server_port = '';
        }

        if (!is_https() && $server_port == 80) {
            $server_port = '';
        }


        $base_url = (is_https() ? 'https' : 'http') . '://' . $base_url
            . (empty($server_port) ? '' : ':' . $server_port)
            . $context;

        return $base_url;
    }
}


if (!function_exists('redirect')) {
    /**
     * Header Redirect
     *
     * Header redirect in two flavors
     * For very fine grained control over headers, you could use the Output
     * Library's set_header() function.
     *
     * @param string $uri URL
     * @param string $method Redirect method
     *            'auto', 'location' or 'refresh'
     * @param int $code HTTP Response status code
     * @return    void
     */
    function redirect($uri = '', $method = 'auto', $code = NULL)
    {
        if (!preg_match('#^(\w+:)?//#i', $uri)) {
            $uri = site_url($uri);
        }

        // IIS environment likely? Use 'refresh' for better compatibility
        if ($method === 'auto' && isset($_SERVER['SERVER_SOFTWARE']) && strpos($_SERVER['SERVER_SOFTWARE'], 'Microsoft-IIS') !== FALSE) {
            $method = 'refresh';
        } elseif ($method !== 'refresh' && (empty($code) or !is_numeric($code))) {
            if (isset($_SERVER['SERVER_PROTOCOL'], $_SERVER['REQUEST_METHOD']) && $_SERVER['SERVER_PROTOCOL'] === 'HTTP/1.1') {
                $code = ($_SERVER['REQUEST_METHOD'] !== 'GET')
                    ? 303    // reference: http://en.wikipedia.org/wiki/Post/Redirect/Get
                    : 307;
            } else {
                $code = 302;
            }
        }

        switch ($method) {
            case 'refresh':
                header('Refresh:0;url=' . $uri);
                break;
            default:
                header('Location: ' . $uri, TRUE, $code);
                break;
        }
        exit;
    }
}


if (!function_exists('from_session')) {

    /**
     * obtain value from session
     * @param $key string key of session
     * @param $default mixed default value
     * @return mixed|null value
     */
    function from_session($key, $default = NULL)
    {
        if (empty($_SESSION)) {
            return $default;
        }
        $v = array_key_exists($key, $_SESSION) ? $_SESSION[$key] : $default;
        return empty($v) ? $default : $v;
    }
}


if (!function_exists('from_header')) {

    /**
     * obtain value from header
     * @param $key string key of header
     * @param $default mixed default value
     * @return mixed|null value
     */
    function from_header($key, $default = NULL)
    {
        $v = null;
        $headers = getallheaders();

        if (!empty($headers) && array_key_exists($key, $headers)) {
            $v = $headers[$key];
        }
        return empty($v) ? $default : $v;
    }
}


if (!function_exists('error_404_page')) {

    /**
     * 404 错误处理
     */
    function error_404_page()
    {
        if (array_key_exists('404', _R_) && !empty(_R_['404'])) {
            redirect(_R_['404']);
        } else {
            echo('<h1>Error 404</h1>');
            header('HTTP/1.1 404 Not Found');
        }
        http_response_code(404);
        exit();
    }
}


if (!function_exists('error_500_page')) {
    /**
     * 500 错误处理
     */
    function error_500_page()
    {
        if (array_key_exists('500', _R_) && !empty(_R_['500'])) {
            redirect(_R_['500']);
        } else {
            echo('<h1>Error 500</h1>');
            header('HTTP/1.1 500 Internal Error');
        }
        http_response_code(500);
        exit();
    }
}


if (!function_exists('error_code')) {

    /**
     * 输出错误信息和状态码
     * @param $code int 状态码
     * @param string $msg 错误信息
     */
    function error_code($code, $msg = 'error')
    {
        echo $msg;
        http_response_code($code);
        die();
    }
}


if (!function_exists('getallheaders')) {
    /**
     * Fetches all HTTP headers from the current request.
     */
    function getallheaders()
    {
        $headers = array();
        foreach ($_SERVER as $name => $value) {
            if (substr($name, 0, 5) == 'HTTP_') {
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }
        return $headers;
    }
}