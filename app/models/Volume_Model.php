<?php


class Volume_Model extends MY_Model
{

    /**
     * 查找作品分卷信息
     *
     * @param int $work_id 作品ID
     * @return array 作品分卷信息
     */
    public function find_by_work_id($work_id)
    {
        return $this->select_where1('id, name', array('work_id' => $work_id));
    }

    /**
     * 根据名称进行模糊查询
     *
     * @param int $work_id 作品ID
     * @param string $name 名称
     * @return array 查询结果
     */
    public function find_by_name($work_id, $name)
    {
        return $this->db->select("id, name")
            ->from('volume')
            ->where(array('work_id' => $work_id))
            ->limit(6)
            ->like('name', $name, 'both')
            ->order_by('id', 'desc')
            ->get()
            ->result_array();
    }


    /** 获取名称
     *
     * @param int $id 记录ID
     * @return string 名称
     */
    public function get_name($id = 0)
    {
        if (is_null($id) || 0 === $id) {
            return '';
        }
        $r = $this->get_by_id0($id, 'name');
        return is_null($r) ? '' : $r['name'];
    }


    /**
     * 新增分卷信息
     *
     * @param int $work_id 作品ID
     * @param string $name 分卷名称
     * @param int $volume_id 分卷ID
     * @return int 记录ID
     */
    public function insert($work_id, $name, $volume_id = 0)
    {
        if (empty($name)) {
            return 0;
        }
        $v = $this->get_where("*", array('work_id' => $work_id, 'name' => $name));
        if (!is_null($v)) {
            return $v['id'];
        }
        return $this->insert_or_update(array('name' => $name, 'work_id' => $work_id), $volume_id);
    }


    /**
     * 根据ID集合批量删除记录
     *
     * @param array $ids ID集合
     * @return int 删除操作影响的记录数量
     */
    public function delete_by_work_id($ids = array())
    {
        if (0 === sizeof($ids)) {
            return 0;
        }
        return $this->db->where_in('work_id', $ids)->delete($this->table);
    }


    /**
     * 名称获取记录
     *
     * @param string $name 名称
     * @return array 记录
     */
    public function get_by_name($name)
    {
        return $this->get_where("id, name", array('name' => $name));
    }
}