<?php


class Work_Service extends MY_Service
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('chapter_model');
    }


    /**
     * 上传并解析文本文件
     *
     * @param int $work_id 作品ID
     * @param string $file 文件名称
     */
    public function upload_and_read($work_id, $file)
    {
        $r = parent::upload_txt($file);
        if ($r[0]) {
            $f = $r[1];
            $this->read($work_id, $f);
            echo 'success';
        } else {
            echo $r[1];
        }
    }


    /**
     * 读取文件
     *
     * @param int $work_id 作品ID
     * @param string $file 文件地址
     */
    private function read($work_id, $file)
    {
        $pattern = "/^(　)*第?[\s　]*[一二三四五六七八九十零〇百千万]{1,5}[\s　]*[章回节卷篇]?.{0,32}$/i";

        $title = '';
        $content = '';

        $all = file($file);
        foreach ($all as $num => $line) {
            $line = $this->mb_trim($line);
            $line = str_replace('　', ' ', $line);

            if (empty($line)) {
                continue;
            }

            if (preg_match($pattern, $line)) {
                if (!empty($content)) {
                    if (empty($title)) {
                        $title = '引子';
                    }
                    $this->chapter_model->update($work_id, $title, $content);
                    $content = '';
                }
                $title = $line;
            } else {
                $content = $content . '<p>' . $line . '</p>';
            }
        }

        if (!empty($title) && !empty($content)) {
            $this->chapter_model->update($work_id, $title, $content);
        }
    }

    function mb_trim($str)
    {
        $str = mb_ereg_replace('^(([ \r\n\t])*(　)*)*', '', $str);
        $str = mb_ereg_replace('(([ \r\n\t])*(　)*)*$', '', $str);
        return $str;
    }

}