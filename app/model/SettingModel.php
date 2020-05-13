<?php
defined('_APP_PATH_') or exit('You shall not pass!');


class SettingModel extends Z_Model
{


    /**
     * 根据Key获取配置信息
     *
     * @param $key string the name of config
     * @param $defaultValue string default value
     * @return string the value
     */
    public function get_by_key($key, $defaultValue = '')
    {
        $sql = "select * from " . $this->table . " where name=?";
        $r = parent::_get($sql, array($key));
        return empty($r) || empty($r['value']) ? $defaultValue : $r['value'];
    }


    /**
     * 根据Key删除配置信息
     *
     * @param $key string the name of config
     */
    public function delete_by_key($key)
    {
        parent::delete(array('name' => $key));
    }


    /**
     * 更新配置信息
     *
     * @param $name string 配置项名称
     * @param $value string 配置项值
     * @return bool 是否更新成功
     */
    public function change($name, $value)
    {
        return parent::replace(array('name' => $name, 'value' => $value));
    }


    /**
     * 删除配置项
     *
     * @param $setting_name string 配置项名称
     * @return bool 是否删除成功
     */
    public function delete_setting($setting_name)
    {
        return parent::delete(array('name' => $setting_name));
    }
}