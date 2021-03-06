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


    /**
     * 根据作品ID和分卷名查询记录
     * @param $work_id int 作品ID
     * @param $name string 分卷名称
     * @return array 查询记录
     */
    public function get_by_work_and_name($work_id, $name)
    {
        return $this->_get_by(array('work_id' => $work_id, 'name' => $name));
    }


    /**
     * 根据作品ID获取最新分卷名称
     * @param $work_id int 作品id
     * @return array 查询结果
     */
    public function get_latest_by_work_id($work_id)
    {
        return $this->_get_by(array('work_id' => $work_id));
    }


    /**
     * 新增分卷
     * @param $work_id int 作品ID
     * @param $name string 分卷名称
     */
    public function add($work_id, $name)
    {
        $this->insert(array('work_id' => $work_id, 'name' => $name));
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