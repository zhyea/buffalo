<?php


class Meta extends MY_Model
{

    public function query_category()
    {
        return self::select_where('id, parent, name, slug', array('type' => 'category'));
    }


}