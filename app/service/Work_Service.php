<?php


class Work_Service extends MY_Service
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('work_model');
        $this->load->model('media_model');
        $this->load->model('chapter_model');
    }


    /**
     * 更新封面信息
     *
     * @param int $work_id 作品ID
     * @param string $name 封面字段名称
     * @return int 封面记录ID
     */
    public function update_cover($work_id, $name = NULL)
    {
        $r = $this->upload_img($name);
        if ($r[0]) {
            $w = $this->work_model->get_by_id($work_id);
            $pic_id = 0;
            if (!is_null($w)) {
                $pic_id = empty($w['pic_id']) ? 0 : $w['pic_id'];
                $old = $this->media_model->get_media_path($pic_id);
                $file_path = VIEWPATH . 'uploads/' . $old;
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }
            return $this->media_model->update_img(NULL, $r[1], $pic_id);
        } else {
            return 0;
        }
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