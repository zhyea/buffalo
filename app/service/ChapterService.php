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
}