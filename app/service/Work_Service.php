<?php


class Work_Service extends MY_Service
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('work_model');
        $this->load->model('meta_model');
        $this->load->model('media_model');
        $this->load->model('chapter_model');
    }


    /**
     * 更新封面信息
     *
     * @param array $data 作品信息
     * @param int $work_id 作品ID
     * @return int 封面记录ID
     */
    public function update($data, $work_id)
    {
        $r = $this->upload_img('cover');
        $path = '';
        if ($r[0]) {
            $w = $this->work_model->get_by_id($work_id);
            if (!is_null($w)) {
                $old = $w['cover'];
                $file_path = VIEWPATH . 'uploads/' . $old;
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }
            $path = $r[1];
        }
        if (!empty($path)) {
            $data['cover'] = $path;
        }
        return $this->work_model->insert_or_update($data, $work_id);
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
            $this->work_model->insert_or_update(array('file' => $f), $work_id);
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

        $all = file(VIEWPATH . 'uploads/' . $file);
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

    private function mb_trim($str)
    {
        $str = mb_ereg_replace('^(([ \r\n\t])*(　)*)*', '', $str);
        $str = mb_ereg_replace('(([ \r\n\t])*(　)*)*$', '', $str);
        return $str;
    }


    /**
     * 获取分类及文章信息
     */
    public function find_cat_works()
    {
        $cats = $this->meta_model->find_top_cats();

        foreach ($cats as &$c) {
            $works = $this->work_model->find_by_cat($c['id'], 18);
            $c['works'] = $works;
        }

        return $cats;
    }


    /**
     * 按分类统计作品总数
     *
     * @param int $cat_id 分类ID
     * @return int 分类下的作品总数
     */
    public function count_cat($cat_id)
    {
        return $this->work_model->count_by_cat($cat_id);
    }

    /**
     * 分页查询指定分类的作品信息
     *
     * @param int $cat_id 分类ID
     * @param int $page_num 页号
     * @param int $len 每页记录总数
     * @return array 查询结果
     */
    public function find_cat_page($cat_id, $page_num = 0, $len = 12)
    {
        $offset = $len * (isset($page_num) && $page_num > 0 ? $page_num - 1 : 0);
        return $this->work_model->find_by_cat_in_page($cat_id, $offset, $len);
    }


    /**
     * 根据作品ID查询作品信息
     * @param int $work_id 作品ID
     * @return array 作品信息
     */
    public function get_by_id($work_id)
    {
        return $this->work_model->get_by_id($work_id);
    }


    /**
     * 根据作者ID查询作品信息
     *
     * @param int $author_id 作者ID
     * @param int $exclude 要排除的作品ID
     * @return array 作品信息
     */
    public function find_by_author_id($author_id, $exclude = 0)
    {
        $works = $this->work_model->find_by_author_id($author_id);
        foreach ($works as $k => $w) {
            if ($w['id'] === $exclude) {
                unset($works[$k]);
            }
        }
        return $works;
    }


    /**
     * 获取章节信息
     *
     * @param int $work_id 作品ID
     * @return array 章节列表
     */
    public function chapters($work_id)
    {
        $chapters = $this->chapter_model->chapters($work_id);
        $depth = 1;
        foreach ($chapters as $c) {
            if (!is_null($c['parent']) && $c['parent'] > 0) {
                $depth++;
                break;
            }
        }
        if ($depth > 1) {
            return list_to_tree($chapters);
        } else {
            return array(array('id' => 0, 'name' => '正文', '_child' => $chapters));
        }
    }


    /**
     * 获取章节内容
     *
     * @param int $chapter_id 当前章节ID
     * @return array 章节内容
     */
    public function chapter($chapter_id)
    {

        $chapter = $this->work_service->chapter($chapter_id);
        if (empty($chapter)) {
            return NULL;
        }
        return $chapter;
    }

    public function last_chapter

}