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
     * @param $name string 文件表单名称
     * @return array 上传结果和图片名称(错误信息)
     */
    protected function upload_img($name = NULL)
    {
        $date = date("Y/m/d");
        $upload_path = VIEWPATH . 'uploads/' . $date;
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0755, true);
        }
        $upload_cfg = array(
            'upload_path' => $upload_path,
            'allowed_types' => 'jpg|png',
            'max_size' => 1024,
            'file_name' => uniqid()
        );

        $this->load->library('upload', $upload_cfg);

        if ($this->upload->do_upload($name)) {
            $result = $this->upload->data();
            return array(true, $date . '/' . $result['file_name']);
        } else {
            return array(false, $this->upload->display_errors());
        }
    }
}
