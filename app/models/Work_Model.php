<?php


class Work_Model extends MY_Model
{




    /**
     * 根据ID查询获取作品信息
     *
     * @param int $id 用户记录ID
     * @return array 用户信息
     */
    public function get_by_id($id = 0)
    {
        return $this->get_by_id0('id, name', $id);
    }

}