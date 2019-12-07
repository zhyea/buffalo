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
        $this->db->select('r.id, r.feature_id, r.record_id, w.name');
        $this->db->from('feature_record r');
        $this->db->join('work w', 'r.record_id=w.id', 'left');

        $this->db->where(array('type' => 'work'));

        return $this->db->get()->result_array();
    }

}