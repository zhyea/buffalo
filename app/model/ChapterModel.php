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
     * 根据ID获取章节记录
     * @param $id int 章节ID
     * @return array 章节信息
     */
    public function get($id)
    {
        $sql = 'select c.*, v.name as volume_name from chapter c left join volume v on c.volume_id=v.id where c.id=?';
        return $this->_get($sql, array($id));
    }

    /**
     * 根据作品ID执行删除
     * @param $work_id int 作品ID
     */
    public function delete_by_work($work_id)
    {
        $this->_delete(array('work_id' => $work_id));
    }


    /**
     * 获取上一节
     * @param $work_id int 作品ID
     * @param $chapter_id int 章节ID
     * @return array 章节信息
     */
    public function get_last($work_id, $chapter_id)
    {
        $sql = 'select id from chapter where work_id=? and id<? order by id desc limit 1';
        return $this->_get($sql, array($work_id, $chapter_id));
    }


    /**
     * 获取下一节
     * @param $work_id int 作品ID
     * @param $chapter_id int 章节ID
     * @return array 章节信息
     */
    public function get_next($work_id, $chapter_id)
    {
        $sql = 'select id from chapter where work_id=? and id>? order by id asc limit 1';
        return $this->_get($sql, array($work_id, $chapter_id));
    }


}