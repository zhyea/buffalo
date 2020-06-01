<?php
defined('_APP_PATH_') or exit('You shall not pass!');


class VolumeModel extends Z_Model
{


    /**
     * 根据作品ID查找分卷
     * @param $work_id int 作品ID
     * @return array 分卷集合
     */
    public function find_by_work_id($work_id)
    {
        if ($work_id <= 0) {
            return array();
        }
        return $this->_find_by(array('work_id' => $work_id), 'id', 'asc');
    }


    /**
     * 查询推荐的分卷信息
     * @param $work_id int 作品ID
     * @param $keywords string 分类关键字
     * @return array 查询结果
     */
    public function suggest($work_id, $keywords)
    {
        $keywords = '%' . $keywords . '%';
        $sql = 'select id, name from volume where work_id=? and name like ? order by id desc limit 9';
        return $this->_find($sql, array($work_id, $keywords));
    }

}