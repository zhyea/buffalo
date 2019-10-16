<?php


class Settings_Model extends MY_Model
{

    /**
     * 获取配置信息
     *
     * @param string $key 配置项
     * @return string 配置信息
     */
    public function get($key)
    {
        return self::get_column_where('value', array('name' => $key));
    }

    /**
     * 新增或更新配置信息
     *
     * @param string $key 配置项
     * @param string $value 配置信息
     * @return int 影响的记录数量
     */
    public function replace($key, $value)
    {
        $data = array(
            'name' => $key,
            'value' => $value
        );
        return parent::replace0($data);
    }


}