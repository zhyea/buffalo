<?php
defined('_APP_PATH_') or exit('You shall not pass!');


class ChapterModel extends Z_Model
{

    /**
     * 根据作品ID查找章节
     * @param $work_id int 作品ID
     * @return array 章节集合
     */
    public function find_by_work_id($work_id)
    {
        if ($work_id <= 0) {
            return array();
        }
        return $this->_find_by(array('work_id' => $work_id), 'id', 'asc');
    }


    /**
     * @param $work_id int 作品ID
     * @param $vol_id int 分卷ID
     * @param $chapter_name string 章节名称
     * @param $content string 章节内容
     */
    public function add($work_id, $vol_id, $chapter_name, $content)
    {
        $this->insert(array('work_id' => $work_id,
            'volume_id' => $vol_id,
            'name' => $chapter_name,
            'content' => $content));
    }

}