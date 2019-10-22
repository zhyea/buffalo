<?php


class Meta_Model extends MY_Model
{

    /**
     * 查询分类信息
     *
     * @return array 分类信息
     */
    public function query_category()
    {
        return $this->select_where('id, parent, name, slug', array('type' => 'category'));
    }


    /**
     * 根据父ID查询
     *
     * @param int $parent 父ID
     * @return array 分类信息结果集
     */
    public function query_category_by_parent($parent = 0)
    {
        return $this->select_where('id, parent, name, slug', array('type' => 'category', 'parent' => $parent));
    }


    /**
     * 根据父ID统计子项的数量
     *
     * @param int $parent 父ID
     * @return int 统计结果
     */
    public function count_by_parent($parent = 0)
    {
        return $this->count_where(array('parent' => $parent));
    }


    /**
     * 根据ID查找记录
     *
     * @param int $id 记录ID
     * @return array 记录信息
     */
    public function get_by_id($id = 0)
    {
        return $this->get_by_id0('id, parent, name, slug, remark', $id);
    }
}