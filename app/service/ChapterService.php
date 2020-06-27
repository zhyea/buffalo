<?php
defined('_APP_PATH_') or exit('You shall not pass!');

require_model('WorkModel');
require_model('VolumeModel');
require_model('ChapterModel');


class ChapterService
{

    private $workModel;

    private $volumeModel;

    private $chapterModel;

    /**
     * ChapterService constructor.
     */
    public function __construct()
    {
        $this->workModel = new WorkModel();
        $this->volumeModel = new VolumeModel();
        $this->chapterModel = new ChapterModel();
    }


    /**
     * 获取作品章节信息
     * @param $work_id int 作品ID
     * @return array 作品章节信息
     */
    public function volumes($work_id)
    {
        $chapters = $this->chapterModel->find_by_work_id($work_id);
        if (empty($chapters)) {
            return array();
        }
        $volumes = $this->volumeModel->find_by_work_id($work_id);
        if (empty($volumes)) {
            array_push($volumes, array('id' => 0, 'name' => '正文'));
        }
        $map = array();
        foreach ($volumes as $v) {
            $map[$v['id']] = $v;
        }

        foreach ($chapters as $c) {
            $vol_id = $c['volume_id'];
            if (empty($vol_id)) {
                $vol_id = 0;
            }
            if (!array_key_exists($vol_id, $map)) {
                $map[$vol_id] = array('id' => $vol_id, 'name' => '待定');
            }
            $vol = &$map[$vol_id];
            if (!array_key_exists('chapters', $vol)) {
                $vol['chapters'] = array();
            }
            array_push($vol['chapters'], $c);
        }

        ksort($map);

        return array_values($map);
    }


    /**
     * 章节信息
     * @param $chapter_id int 章节ID
     * @return array 章节信息
     */
    public function chapter($chapter_id)
    {
        $chapter = $this->chapterModel->get_by_id($chapter_id);
        if (empty($chapter)) {
            return array();
        }
        $vol = $this->volumeModel->get_by_id($chapter['volume_id']);
        $chapter['volume'] = empty($vol) ? '' : $vol['name'];
        return $chapter;
    }


    /**
     * 获取章节信息
     * @param $chapter_id int 章节信息
     * @return array 章节信息
     */
    public function get_chapter($chapter_id)
    {
        $chapter = $this->chapterModel->get($chapter_id);
        if (empty($chapter)) {
            return array();
        }
        $work_id = $chapter['work_id'];
        $work = $this->workModel->get_work($work_id);

        $last = $this->chapterModel->get_last($work_id, $chapter_id);
        $last = empty($last) ? null : $last['id'];
        $next = $this->chapterModel->get_next($work_id, $chapter_id);
        $next = empty($next) ? null : $next['id'];

        $title = $work['name'] . '-' . $chapter['name'];
        return array('w' => $work, 'chp' => $chapter, 'last' => $last, 'next' => $next, '_title' => $title);
    }


    /**
     * 获取分卷ID
     * @param $work_id int 作品ID
     * @param $vol_name string 分卷名称
     * @return int 分卷ID
     */
    public function get_volume_id($work_id, $vol_name)
    {
        $vol = $this->volumeModel->get_by_work_and_name($work_id, $vol_name);
        if (!empty($vol)) {
            return $vol['id'];
        }
        $vol = array('work_id' => $work_id, 'name' => $vol_name);
        $this->volumeModel->insert($vol);
        $vol = $this->volumeModel->get_by_work_and_name($work_id, $vol_name);
        return $vol['id'];
    }


    /**
     * 维护章节信息
     * @param $data array 章节信息
     */
    public function maintain($data)
    {
        $work_id = $data['work_id'];
        $vol_id = empty($data['volume_id']) ? 0 : $data['volume_id'];
        if (!empty($data['new_volume'])) {
            $vol_id = $this->get_volume_id($work_id, $data['new_volume']);
            $data['volume_id'] = $vol_id;
        }
        if (0 == $vol_id && !empty($data['volume'])) {
            $vol_id = $this->get_volume_id($work_id, $data['volume']);
            $data['volume_id'] = $vol_id;
        }

        $data = array_key_rm('volume', $data);
        $data = array_key_rm('new_volume', $data);
        $this->chapterModel->insert_or_update($data);
    }


    /**
     * 新增章节
     * @param $work_id int 作品ID
     * @param $vol_name string 分卷名称
     * @param $chapter_name string 章节名称
     * @param $content string 章节内容
     */
    public function add_chapter($work_id, $vol_name, $chapter_name, $content)
    {
        $vol = array();
        if (empty($vol_name) || $vol_name == $chapter_name) {
            $vol = $this->volumeModel->get_latest_by_work_id($work_id);
            if (empty($vol)) {
                $vol_name = '正文';
            }
        }

        if (empty($chapter_name)) {
            $chapter_name = '引子';
            $vol_name = '引子';
        }
        if (empty($vol)) {
            $vol = $this->volumeModel->get_by_work_and_name($work_id, $vol_name);
        }
        if (empty($vol)) {
            $this->volumeModel->add($work_id, $vol_name);
            $vol = $this->volumeModel->get_by_work_and_name($work_id, $vol_name);
        }
        $this->chapterModel->add($work_id, $vol['id'], $chapter_name, $content);

    }


    /**
     * 上传作品
     * @param $work_id int 作品ID
     * @param $file string 上传的文件地址
     */
    public function upload($work_id, $file)
    {
        $pattern = '/^第?[\s]{0,9}[\d〇零一二三四五六七八九十百千万上中下０１２３４５６７８９ⅠⅡⅢⅣⅤⅥⅦⅧⅨⅩⅪⅫ　\s]{1,6}[\s]{0,9}[、，．\.]?[章回节卷部篇讲集分]{0,2}([\s]{1,9}.{0,32})?$/iu';
        $arr = array("楔子", "引子", "引言", "前言", "序章", "序言", "序曲", "尾声", "终章", "后记", "序", "序幕", "跋", "附", "附言");
        $f = file(_UPLOAD_PATH_ . '/' . $file);
        $chapter_name = '';
        $vol_name = '';
        $content = '';
        foreach ($f as $num => $line) {
            $line = mb_trim($line);
            $line = str_replace('　', ' ', $line);

            if (empty($line)) {
                continue;
            }

            if (in_array($line, $arr) || preg_match($pattern, $line)) {
                if (empty($content) && !empty($chapter_name)) {
                    //处理存在两级章节的情形
                    $chapter_name = $line;
                } elseif (!empty($content)) {
                    $this->add_chapter($work_id, $vol_name, $chapter_name, $content);
                    $content = '';
                    $vol_name = $line;
                    $chapter_name = $line;
                } else {
                    $vol_name = $line;
                    $chapter_name = $line;
                }
            } else {
                $line = str_replace(' ', '', $line);
                $content = $content . '<p>' . $line . '</p>';
            }
        }
        $this->add_chapter($work_id, $vol_name, $chapter_name, $content);
    }


    /**
     * 删除分卷信息
     * @param $vol_id int 分卷ID
     */
    public function delete_vol($vol_id)
    {
        $this->volumeModel->delete_by_id($vol_id);
        $this->chapterModel->delete_by_vol($vol_id);
    }


    /**
     * 删除章节
     * @param $vol_id int 分卷ID
     * @param $chapter_id int 章节ID
     */
    public function delete_chapter($vol_id, $chapter_id)
    {
        $this->chapterModel->delete_by_id($chapter_id);
        $count = $this->chapterModel->count_by_vol($vol_id);
        if ($count <= 0) {
            $this->volumeModel->delete_by_id($vol_id);
        }
    }


    /**
     * 删除作品下的全部分卷及章节信息
     * @param $work_id int 作品ID
     */
    public function delete_all($work_id)
    {
        $this->volumeModel->delete_by_work($work_id);
        $this->chapterModel->delete_by_work($work_id);
    }
}