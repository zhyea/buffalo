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
        return self::select_where('id, parent, name, slug', array('type' => 'category'));
    }


}