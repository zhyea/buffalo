<?php


class Settings extends MY_Model
{

    public function get($key)
    {
        return self::get_where('value', array('name' => $key));
    }

}