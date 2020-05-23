<?php
defined('_ZERO_PATH_') or exit('You shall not pass!');


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
    protected function _redirect($uri = '', $method = 'auto', $code = NULL)
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
        //exit;
    }


    /**
     * 完成文件上传
     *
     * @param $name string 表单名
     * @param $save_name string 文件保存名称
     * @param $sub_path string 文件保存子目录
     * @param array $allowed_ext 允许的扩展名
     * @return array
     */
    protected function _upload($name, $save_name, $sub_path = '', $allowed_ext = array())
    {
        $file_name = $_FILES[$name]['name'];
        if (empty($file_name)) {
            return array(false, 'No file is uploaded.');
        }
        $arr = explode('.', $_FILES[$name]['name']);
        $ext = end($arr);
        if (!empty($allowed_ext) && !in_array($ext, $allowed_ext)) {
            return array(false, 'The ext of file is not allowed.');
        }
        $size = $_FILES[$name]['size'];
        if ($size <= 0) {
            return array(false, 'The size of file is zero.');
        }
        if (!empty(_CFG_['max_file_zie']) && $size > _CFG_['max_file_zie']) {
            return array(false, 'The size of file is too large.');
        }

        $sub_path = empty($sub_path) || str_end_with($sub_path, '/') ? $sub_path : $sub_path . '/';
        $save_name = str_end_with($save_name, $ext) ? $save_name : $save_name . '.' . $ext;

        $save_path = _UPLOAD_PATH_ . '/' . (empty($sub_path) ? '' : $sub_path);

        if (!is_dir($save_path)) {
            mkdir($save_path, 0777, true);
        }

        move_uploaded_file($_FILES[$name]['tmp_name'], $save_path . $save_name);

        return array(true, $sub_path . $save_name);
    }


    /**
     * 获取POST请求中的全部内容
     * @return mixed 请求中的全部内容
     */
    protected function _post()
    {
        return array_copy($_POST);
    }


    /**
     * 获取GET请求中的全部元素
     * @return mixed 请求中的全部内容
     */
    protected function _get()
    {
        return array_copy($_GET);
    }

    /**
     * 获取请求体
     * @return mixed 请求体
     */
    protected function _post_body()
    {
        return file_get_contents("php://input");
    }

    /**
     * 获取请求体,将请求体以数组形式返回
     *
     * @return array 请求体反序列化后的数组
     */
    protected function _post_array()
    {
        $json = $this->_post_body();
        return json_decode($json, true);
    }


}