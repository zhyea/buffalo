<?php
defined('_APP_PATH_') or exit('You shall not pass!');


class FeatureModel extends Z_Model
{

    /**
     * 通过别名获取专题
     * @param $alias string 专题别名
     * @return array 专题记录
     */
    public function get_by_alias($alias)
    {
        return $this->_get_by(array('alias' => $alias));
    }

}