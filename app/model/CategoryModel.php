<?php
defined('_APP_PATH_') or exit('You shall not pass!');


class CategoryModel extends Z_Model
{


    /**
     * 根据父ID获取数据
     * @param $parent int 父分类ID
     * @return array 分类数据
     */
    public function find_by_parent($parent)
    {
        return $this->_find_by(array('parent' => $parent), 'sn');
    }


    /**
     * 根据父ID执行统计
     * @param $parent int 父ID
     * @return int 统计结果
     */
    public function count_by_parent($parent)
    {
        return $this->_count_by(array('parent' => $parent));
    }


    /**
     * 调整分类排序
     * @param $id int 记录ID
     * @param $step int 排序步长
     * @return bool 是否修改成功
     */
    public function change_order($id, $step)
    {
        $sql = 'update ' . $this->table . ' set sn=(sn+?) where id=?';
        return $this->_execute($sql, array($step, $id));
    }


    /**
     * 查询推荐的分类信息
     * @param $keywords string 分类关键字
     * @return array 查询结果
     */
    public function suggest($keywords)
    {
        $keywords = '%' . $keywords . '%';
        $sql = 'select id, name, slug from category where name like ? or slug like ? order by id desc limit 9';
        return $this->_find($sql, array($keywords, $keywords));
    }

}