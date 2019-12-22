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


    /**
     * 执行查询，为生成列表数据
     *
     * @param bool $is_count 是否是统计查询
     * @param string $search 查询关键字
     * @param string $sort 排序字段
     * @param string $order 排序方向
     * @param int $offset 位移
     * @param int $limit 记录数量
     * @return mixed 如果是统计查询则返回记录总数，否则返回记录信息
     */
    public function query_in_page($is_count = false, $search = '', $sort = 'id', $order = 'desc', $offset = 0, $limit = 10)
    {
        $this->db->select('work.id, work.name, meta.name as category, author.name as author, work.category_id, work.author_id');
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


    /**
     * 根据名称查询作品数据
     *
     * @param string $name 作品名称
     * @return array 作品数据
     */
    public function find_by_name($name)
    {
        return $this->db->select('id, name')
            ->from('work')
            ->like('name', $name, 'both')
            ->limit(12)
            ->get()->result_array();
    }


    /**根据分类ID获取作品信息
     *
     * @param int $cat_id 分类ID
     * @param int $limit 要获取的记录数量
     * @return array 作品集合
     */
    public function find_by_cat($cat_id, $limit)
    {
        return $this->db->select('w.id, w.name, a.name as author')
            ->from('work w')
            ->join('author a', 'w.author_id=a.id', 'left')
            ->where(array('category_id' => $cat_id))
            ->limit($limit)
            ->get()->result_array();
    }
}