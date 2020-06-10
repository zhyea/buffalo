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


    /**
     * 根据分卷ID执行删除
     * @param $vol_id int 分卷ID
     */
    public function delete_by_vol($vol_id)
    {
        $this->_delete(array('volume_id' => $vol_id));
    }


    /**
     * 根据分卷统计章节
     * @param $vol_id int 分卷ID
     * @return int 统计结果
     */
    public function count_by_vol($vol_id)
    {
        return $this->_count_by(array('volume_id' => $vol_id));
    }


    /**
     * 根据作品ID执行删除
     * @param $work_id int 作品ID
     */
    public function delete_by_work($work_id)
    {
        $this->_delete(array('work_id' => $work_id));
    }


}