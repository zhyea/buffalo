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
        $work = $this->workModel->get_by_id($chapter['work_id']);
        $vol = $this->volumeModel->get_by_id($chapter['volume_id']);
        $chapter['work'] = $work;
        $chapter['volume'] = empty($vol) ? '' : $vol['name'];
        return $chapter;
    }

}