<?php


class Meta_Model extends MY_Model
{

    public function query_category()
    {
        return self::select_where('id, parent, name, slug', array('type' => 'category'));
    }


}