<?php


class Work_Service extends MY_Service
{

    public function __construct()
    {
        parent::__construct();
    }


    /**
     * 上传并解析文本文件
     *
     * @param string $name 文件名称
     */
    public function upload_and_read($name)
    {
        $r = parent::upload_txt($name);
        if ($r[0]) {
            echo $r[1];
        } else {
            echo $r[1];
        }
    }

}