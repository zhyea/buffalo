<?php
defined('_APP_PATH_') or exit('You shall not pass!');


class NavigatorModel extends Z_Model
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
     * 执行递归删除
     * @param $root_id int 根ID
     * @return bool 是否删除成功
     */
    public function delete_recursively($root_id)
    {
        $ids = $this->offspring_ids($root_id);
        return $this->delete_by_ids($ids);
    }


    public function all()
    {
        $sql = 'select * from navigator order by sn desc, id asc';
        return $this->_find($sql);
    }
}