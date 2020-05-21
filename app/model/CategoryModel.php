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
        return $this->_find_by(array('parent' => $parent));
    }

}