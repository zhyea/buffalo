<?php


class Volume_Model extends MY_Model
{

    /**
     * 查找作品分卷信息
     *
     * @param int $work_id 作品ID
     * @return array 作品分卷信息
     */
    public function find_by_work_id($work_id)
    {
        return $this->select_where1('id, name', array('work_id' => $work_id));
    }
}