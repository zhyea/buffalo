<?php


class Work_Model extends MY_Model
{


    /**
     * 根据ID查询获取作品信息
     *
     * @param int $id 用户记录ID
     * @return array 用户信息
     */
    public function get_by_id($id = 0)
    {
        return $this->get_by_id0($id, '*');
    }



    public function query_in_page($is_count = false, $search = '', $sort = 'id', $order = 'desc', $offset = 0, $limit = 10)
    {
        $this->db->select('work.id, work.name, meta.name as category, author.name as author');
        $this->db->from('work');
        $this->db->join('meta', 'work.category_id = meta.id', 'left');
        $this->db->join('author', 'work.author_id = author.id', 'left');

        if (!empty($search)) {
            $this->db->like('work.name', $search, 'both');
            $this->db->or_like('meta.name', $search, 'both');
            $this->db->or_like('author.name', $search, 'both');
        }

        if ($is_count) {
            return $this->db->count_all_results();
        } else {
            $this->db->order_by($sort, $order);
            $this->db->limit($limit, $offset);
            return $this->db->get()->result_array();
        }
    }
}