<?php
defined('_ZERO_PATH_') OR exit('You shall not pass!');


class Z_Controller
{

    /**
     * 展示页面
     *
     * @param $page string 页面地址
     * @param $params array 页面变量
     */
    protected function render_view($page, $params = array())
    {
        if (!file_exists(_VIEW_PATH_ . $page . '.php')) {
            $this->error_404();
        } else {
            extract($params);
            include_once _VIEW_PATH_ . $page . '.php';
        }
    }


    /**
     * 展示json
     *
     * @param $obj mixed 对象
     */
    protected function render_json($obj)
    {
        echo json_encode($obj);
    }


    /**
     * 跳转404
     */
    private function error_404()
    {
        println('404 Error');
    }

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
    protected function redirect($uri = '', $method = 'auto', $code = NULL)
    {
        if (!preg_match('#^(\w+:)?//#i', $uri)) {
            $uri = site_url($uri);
        }

        // IIS environment likely? Use 'refresh' for better compatibility
        if ($method === 'auto' && isset($_SERVER['SERVER_SOFTWARE']) && strpos($_SERVER['SERVER_SOFTWARE'], 'Microsoft-IIS') !== FALSE) {
            $method = 'refresh';
        } elseif ($method !== 'refresh' && (empty($code) OR !is_numeric($code))) {
            if (isset($_SERVER['SERVER_PROTOCOL'], $_SERVER['REQUEST_METHOD']) && $_SERVER['SERVER_PROTOCOL'] === 'HTTP/1.1') {
                $code = ($_SERVER['REQUEST_METHOD'] !== 'GET')
                    ? 303
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


    /**
     * 完成文件上传
     *
     * @param $name string 表单名
     * @param $file_name string 文件保存名称
     * @param array $allowed_ext 允许的扩展名
     * @return array
     */
    protected function upload($name, $file_name, $allowed_ext = array())
    {
        $ext = end(explode('.', $_FILES[$name]['name']));
        if (!empty($allowed_ext) && !in_array($ext, $allowed_ext)) {
            return array(false, 'The ext of file is not allowed.');
        }
        $size = $_FILES[$name]['size'];
        if (!empty(_CFG_['max_file_zie']) && $size > _CFG_['max_file_zie']) {
            return array(false, 'The size of file is too large.');
        }
        $file_name = str_end_with($file_name, $ext) ? $file_name : $file_name . '.' . $ext;
        move_uploaded_file($_FILES[$name]['tmp_name'], _UPLOAD_PATH_ . $file_name);
        return array(true, 'upload succeed');
    }


    protected function post(){

    }

}