<?php
defined('_APP_PATH_') OR exit('You shall not pass!');


class SettingsModel extends Z_Model
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
        return empty($r) || empty($r['name']) ? $defaultValue : $r['name'];
    }


}