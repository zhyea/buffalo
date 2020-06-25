<?php
defined('_APP_PATH_') or exit('You shall not pass!');


class FeatureRecordModel extends Z_Model
{

    /**
     * 根据专题ID统计作品数量
     * @param $feature_id int 专题ID
     * @return int 专题作品数量
     */
    public function count_with_feature($feature_id)
    {
        return $this->_count_by(array('feature_id' => $feature_id));
    }

    /**
     * 根据专题别名统计作品数量
     * @param $feature_alias string 专题别名
     * @return int 专题作品数量
     */
    public function count_with_alias($feature_alias)
    {
        $sql = "select count(r.id) from feature_record r left join feature f on r.feature_id ";
        $sql = $sql . "where f.alias=?";
        return $this->_count($sql, array($feature_alias));
    }

}