<?php


class Feature_Model extends MY_Model
{


    /**
     * 根据ID查询获取专题信息
     *
     * @param int $id 用户记录ID
     * @return array 用户信息
     */
    public function get_by_id($id = 0)
    {
        return $this->get_by_id0($id, '*');
    }


    /**
     * 查询全部专题
     *
     * @return array 全部专题信息
     */
    public function all()
    {
        return $this->select_where('id, name, alias');
    }


    /**
     * 根据专题别名获取专题数据
     *
     * @param string $alias 专题别名
     * @return array 专题数据
     */
    public function get_by_alias($alias)
    {
        return $this->get_where('*', array('alias' => $alias));
    }

}