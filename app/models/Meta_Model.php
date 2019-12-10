<?php


class Meta_Model extends MY_Model
{

    /**
     * 查询分类信息
     *
     * @return array 分类信息
     */
    public function query_category()
    {
        return $this->select_where('id, parent, name, slug, sn',
            array('type' => 'category'),
            NULL,
            NULL,
            'sn desc, id asc');
    }


    /**
     * 根据父ID查询
     *
     * @param int $parent 父ID
     * @return array 分类信息结果集
     */
    public function query_category_by_parent($parent = 0)
    {
        return $this->select_where('id, parent, name, slug, sn',
            array('type' => 'category', 'parent' => $parent),
            NULL,
            NULL,
            'sn desc, id asc');
    }


    /**
     * 根据父ID统计子项的数量
     *
     * @param int $parent 父ID
     * @return int 统计结果
     */
    public function count_by_parent($parent = 0)
    {
        return $this->count_where(array('parent' => $parent));
    }


    /**
     * 根据ID查找记录
     *
     * @param int $id 记录ID
     * @return array 记录信息
     */
    public function get_by_id($id = 0)
    {
        return $this->get_by_id0($id, 'id, parent, name, slug, remark');
    }


    /**
     * 按ID或parent删除记录
     * @param int $id 记录ID
     * @return int 删除操作影响的行数
     */
    public function delete_by_id_or_parent($id = 0)
    {
        if ($id <= 0) {
            return 0;
        }
        return $this->db
            ->or_where('id', $id)
            ->or_where('parent', $id)
            ->delete($this->table);
    }


    /**
     * 根据ID集合批量删除记录
     *
     * @param array $ids ID集合
     * @return int 删除操作影响的记录数量
     */
    public function delete_in_batch($ids = array())
    {
        if (0 === sizeof($ids)) {
            return 0;
        }
        return $this->db
            ->where_in('id', $ids)
            ->or_where_in('parent', $ids)
            ->delete($this->table);
    }


    /**
     * 调整排序
     *
     * @param int $id 记录ID
     * @param int $sn 记录顺序号
     * @param int $direct 调整方向，1 递增， 2 递减
     * @return int 操作影响的行数
     */
    public function change_sn($id, $sn, $direct = 1)
    {
        $sn = $direct * 1 === 1 ? $sn + 1 : $sn - 1;
        return $this->update0(array('sn' => $sn), $id);
    }


    /** 获取名称
     *
     * @param int $id 记录ID
     * @return string 名称
     */
    public function get_name($id = 0)
    {
        $r = parent::get_by_id0($id, 'name');
        return is_null($r) ? '' : $r['name'];
    }


    /**
     * 新增分类信息
     *
     * @param string $name 分类名称
     * @return int 分类ID
     */
    public function insert_category($name)
    {
        $data = array(
            'parent' => 0,
            'name' => $name,
            'slug' => $name,
            'type' => 'category'
        );
        return $this->insert_or_update($data);
    }


    /**
     * 根据别名获取分类信息
     *
     * @param string $slug 分类别名
     * @return array 分类信息
     */
    public function get_by_slug($slug)
    {
        return $this->get_where('id, name', array('slug' => $slug));
    }
}