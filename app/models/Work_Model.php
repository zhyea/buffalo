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
        return $this->db->select('w.id, w.name, a.name as author, w.category_id as cat_id, w.author_id, w.cover, w.brief, c.name as cat_name')
            ->from('work w')
            ->join('author a', 'w.author_id=a.id', 'left')
            ->join('meta c', 'w.category_id=c.id', 'left')
            ->where(array('w.id' => $id))
            ->limit(1)
            ->get()->row_array(0);
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
        return $this->db->select('w.id, w.name, a.name as author, w.author_id')
            ->from('work w')
            ->join('author a', 'w.author_id=a.id', 'left')
            ->where(array('category_id' => $cat_id))
            ->limit($limit)
            ->get()->result_array();
    }


    /**
     * 按分类分页获取作品信息
     * @param array $where 查询条件
     * @param int $offset 偏移量
     * @param int $limit 数量
     * @return array 作品信息
     */
    public function find_in_page1($where, $offset, $limit)
    {
        return $this->db->select('w.id, w.name, w.brief, w.cover, a.name as author')
            ->from('work w')
            ->join('author a', 'w.author_id=a.id', 'left')
            ->where($where)
            ->limit($limit, $offset)
            ->get()->result_array();
    }


    /**
     * 按分类统计作品总数
     *
     * @param int $cat_id 分类ID
     * @return int 分类下的作品总数
     */
    public function count_by_cat($cat_id)
    {
        return $this->count_where(array('category_id' => $cat_id));
    }

    /**
     * 按作者统计作品总数
     *
     * @param int $author_id 分类ID
     * @return int 分类下的作品总数
     */
    public function count_by_author($author_id)
    {
        return $this->count_where(array('category_id' => $author_id));
    }


    /**
     * 根据作者ID查询作品信息
     *
     * @param int $author_id 作者ID
     * @return array 作品信息
     */
    public function find_by_author_id($author_id)
    {
        return $this->select_where("id, name", array('author_id' => $author_id), 5);
    }
}