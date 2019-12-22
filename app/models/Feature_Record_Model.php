<?php


class Feature_Record_Model extends MY_Model
{


    /**
     * 新增专题文章
     *
     * @param int $feature_id 专题ID
     * @param int $work_id 专题文章ID
     * @return int 记录ID
     */
    public function add_feature_work($feature_id, $work_id)
    {
        $data = array(
            'type' => 'work',
            'feature_id' => $feature_id,
            'record_id' => $work_id
        );
        return $this->insert0($data);
    }


    /**
     * 获取专题文章
     *
     * @param int $feature_id 专题ID
     * @return array 专题文章集合
     */
    public function find_feature_works($feature_id)
    {
        $this->db->select('r.id, r.feature_id, r.record_id, w.name')
            ->from('feature_record r')
            ->join('work w', 'r.record_id=w.id', 'left')
            ->where(array('type' => 'work'));

        return $this->db->get()->result_array();
    }


    /**
     * 根据别名获取专题文章
     *
     * @param string $alias 专题别名
     * @param int $limit 记录数量
     * @return array 专题文章集合
     */
    public function find_works_by_alias($alias, $limit)
    {
        return $this->db->select('r.id, w.id, w.name, w.cover')
            ->from('feature_record r')
            ->join('work w', 'r.record_id=w.id', 'left')
            ->join('feature f', 'r.feature_id=f.id', 'left')
            ->where(array('r.type' => 'work', 'f.alias' => $alias))
            ->limit($limit)
            ->get()->result_array();
    }


}