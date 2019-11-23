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
            $file = $r[1];
            echo $r[1];
            $this->read($file);
        } else {
            echo $r[1];
        }
    }


    /**
     * 读取文件
     *
     * @param string $file 文件地址
     */
    private function read($file)
    {
        $all = file($file);
        foreach ($all as $line => $content) {
            echo 'line ' . ($line + 1) . ':' . $content . '<br>';
        }
    }

}