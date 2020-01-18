<?php


class Work_Service extends MY_Service
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Work_Model');
        $this->load->model('Meta_Model');
        $this->load->model('Media_Model');
        $this->load->model('Volume_Model');
        $this->load->model('Chapter_Model');
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
     * 按作者统计作品总数
     *
     * @param int $author_id 分类ID
     * @return int 作者的作品总数
     */
    public function count_author($author_id)
    {
        return $this->work_model->count_by_author($author_id);
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
        return $this->work_model->find_in_page1(array('category_id' => $cat_id), $offset, $len);
    }

    /**
     * 分页查询指定作者的作品信息
     *
     * @param int $author_id 作者ID
     * @param int $page_num 页号
     * @param int $len 每页记录总数
     * @return array 查询结果
     */
    public function find_author_page($author_id, $page_num = 0, $len = 12)
    {
        $offset = $len * (isset($page_num) && $page_num > 0 ? $page_num - 1 : 0);
        return $this->work_model->find_in_page1(array('author_id' => $author_id), $offset, $len);
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
    public function chapter_list($work_id)
    {
        $volumes = $this->volume_model->find_by_work_id($work_id);
        $chapters = $this->chapter_model->find_by_work_id($work_id);
        if (empty($volumes) || sizeof($volumes) === 0) {
            return array(array('id' => 0, 'name' => '正文', '_child' => $chapters));
        }
        $arr = array();
        foreach ($volumes as &$v) {
            $v['_child'] = array();
            $count = 1;
            $d = 1;
            foreach ($chapters as &$c) {
                if (!empty($c['volume_id']) && $v['id'] == $c['volume_id']) {
                    array_push($v['_child'], $c);
                } else if (empty($c['volume_id'])) {
                    array_push($arr, $c);
                }
            }
        }
        if (sizeof($arr) > 0) {
            array_push($volumes, array('id' => 0, 'name' => '待整理', '_child' => $arr));
        }

        return $volumes;
    }


    /**
     * 获取章节内容
     *
     * @param int $work_id 作品ID
     * @param int $chapter_id 当前章节ID
     * @return array 章节内容
     */
    public function chapter($work_id, $chapter_id)
    {
        $chapter = $this->chapter_model->get_by_id($chapter_id);
        if (empty($chapter)) {
            return NULL;
        }
        $last = $this->chapter_model->get_last($work_id, $chapter_id);
        $next = $this->chapter_model->get_next($work_id, $chapter_id);
        return array('curr' => $chapter, 'last' => $last, 'next' => $next);
    }


    /**
     * 远程写
     *
     * @param string $work_name 作品名称
     * @param string $volume_name 分卷名称
     * @param string $chapter_name 章节名称
     * @param string $content 章节内容
     * @return bool 是否执行成功
     */
    public function remote_write($work_name, $volume_name, $chapter_name, $content)
    {
        if (empty($work_name) || empty($chapter_name) || empty($content)) {
            echo $work_name . '-' . $chapter_name . '-' . $content;
            return false;
        }

        $work = $this->work_model->get_by_name($work_name);
        if (is_null($work)) {
            echo 'cannot find work.';
            return false;
        }
        $work_id = $work['id'];

        $volume_id = 0;
        if (!empty($volume_name)) {
            $volume = $this->volume_model->get_by_name($volume_name);
            if (!is_null($volume)) {
                $volume_id = $volume['id'];
            } else {
                $volume_id = $this->volume_model->insert($work_id, $volume_name);
            }
        }

        $chapter = $this->chapter_model->get_by_name($chapter_name);

        $chapter_id = is_null($chapter) ? 0 : $chapter['id'];
        $r = $this->chapter_model->update($work_id, $volume_id, $chapter_name, $content, $chapter_id);

        $chapter_id = (0 === $chapter_id ? $r : $chapter_id);

        return $chapter_id > 0;
    }
}