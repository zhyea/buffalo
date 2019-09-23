<?php


class Settings extends MY_Model
{

    public function get($key)
    {
        return self::get_where('value', array('name' => $key));
    }

    public function replace($name, $value)
    {
        $data = array(
            'name' => $name,
            'value' => $value
        );
        return parent::replace0($data);
    }


}