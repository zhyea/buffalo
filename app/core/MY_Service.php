<?php

class MY_Service
{
    public function __construct()
    {
        log_message('debug', "Service Class Initialized");
    }


    function __get($key)
    {
        $CI = &get_instance();
        return $CI->$key;
    }

    /**
     * 上传文件
     *
     * @param string $name 文件表单名称
     * @return array 上传结果和图片名称(如发生错误则是错误信息)
     */
    protected function upload_img($name = NULL)
    {
        $upload_cfg = array(
            'allowed_types' => 'jpg|png',
            'max_size' => 1024
        );

        return $this->do_upload($name, $upload_cfg);
    }

    /**
     * 上传文件
     *
     * @param string $name 文件表单名称
     * @return array 上传结果和文件名称(如发生错误则是错误信息)
     */
    protected function upload_txt($name = NULL)
    {
        $upload_cfg = array(
            'allowed_types' => 'text|txt',
            'max_size' => 1024
        );

        return $this->do_upload($name, $upload_cfg);
    }


    /**
     * 执行文件上传操作
     *
     * @param string $name 上传的文件名称
     * @param array $cfg 上传使用的配置项
     * @return array 上传结果
     */
    private function do_upload($name, $cfg)
    {
        // 准备文件存储目录
        $date = date("Y/m/d");
        $upload_path = VIEWPATH . 'uploads/' . $date;
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0755, true);
        }
        $cfg['upload_path'] = $upload_path;
        $cfg['file_name'] = uniqid();

        // 加载相关的库
        $this->load->library('upload', $cfg);
        // 执行上传
        if (!is_null($name) && $this->upload->do_upload($name)) {
            $result = $this->upload->data();
            return array(true, VIEWPATH . 'uploads/' . $date . '/' . $result['file_name']);
        } else {
            return array(false, $this->upload->display_errors());
        }
    }
}
