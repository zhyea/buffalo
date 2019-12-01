<?php


class MY_Model extends CI_Model
{

    /**
     * 构造器
     *
     * 在这里默认取model名称为表名
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->table = strtolower(str_ireplace('_model', '', get_called_class()));
    }


    /**
     * 按条件进行统计
     *
     * @param array $where 查询条件
     * @return int 统计结果
     */
    protected function count_where($where = NULL)
    {
        $this->db->select('count(id) as count');
        $query = $this->db->get_where($this->table, $where);
        $row = $query->row_array(0);
        return $row['count'];
    }


    /**
     * 封装多行查询语句
     *
     * @param string $columns 查询的字段
     * @param array $where 查询条件
     * @param int $limit 查询数量
     * @param int $offset 查询起始位置
     * @param string $orderby 排序字段
     * @param string $direction 排序方向
     * @return array 查询结果
     */
    protected function select_where($columns = '*', $where = array(), $limit = NULL, $offset = NULL, $orderby = NULL, $direction = '')
    {
        $query = $this->db->select($columns)
            ->from($this->table);
        if ($where !== NULL) {
            $query->where($where);
        }
        if (!empty($limit)) {
            $query->limit($limit, $offset);
        }
        return $query->order_by($orderby, $direction)
            ->get()
            ->result_array();
    }


    /**
     * 封装多行查询语句
     *
     * @param string $columns 查询的字段
     * @param array $where 查询条件
     * @param string $orderby 排序字段
     * @param string $direction 排序方向
     * @return array 查询结果
     */
    protected function select_where1($columns = '*', $where = array(), $orderby = 'id', $direction = 'asc')
    {
        $query = $this->db->select($columns)
            ->from($this->table);
        if ($where !== NULL) {
            $query->where($where);
        }
        return $query->order_by($orderby, $direction)
            ->get()
            ->result_array();
    }



    /**
     * 封装单行记录查询语句
     *
     * @param string $column 要查询的字段
     * @param string $where 查询条件
     * @return string 查询结果
     */
    protected function get_column_where($column, $where = NULL)
    {
        $this->db->select($column);
        $query = $this->db->get_where($this->table, $where, 1);
        $row = $query->row_array(0);
        return $row[$column];
    }


    /**
     * 封装单行记录查询语句
     *
     * @param string $column 要查询的字段
     * @param string $where 查询条件
     * @return array 查询结果
     */
    protected function get_where($column, $where = NULL)
    {
        $this->db->select($column);
        $query = $this->db->get_where($this->table, $where, 1);
        return $query->row_array(0);
    }


    /**
     * 根据ID查询获取记录
     *
     * @param string $columns 要查询的字段
     * @param int $id 记录的ID
     * @return array 记录值
     */
    protected function get_by_id0($id = 0, $columns = '*')
    {
        if ($id === 0) {
            return NULL;
        }
        $this->db->select($columns);
        $query = $this->db->get_where($this->table, array('id' => $id), 1);
        return $query->row_array(0);
    }


    /**
     * 封装replace语句
     *
     * @param array $set 要更新/新增的数据
     * @return int 影响的记录数量
     */
    protected function replace0($set = NULL)
    {
        return $this->db->replace($this->table, $set);
    }


    /**
     * 新增数据
     *
     * @param array $data 源数据
     * @return int 记录ID
     */
    protected function insert0($data = array())
    {
        if (0 === sizeof($data)) {
            return 0;
        }
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }


    /**
     * 更新记录
     *
     * @param array $data 要更新的内容
     * @param int $id 要更新的记录ID
     * @return int 操作影响的行数
     */
    protected function update($data = array(), $id = 0)
    {
        if (0 >= $id || 0 === sizeof($data)) {
            return 0;
        }
        return $this->db->update($this->table, $data, array('id' => $id));
    }


    /**
     * 新增或更新记录
     *
     * @param array $data 要更新的内容
     * @param int $id 要更新的记录ID
     * @return int 操作影响的行数；如是写入语句，则是新写入的记录ID
     */
    public function insert_or_update($data = array(), $id = 0)
    {
        if (0 === sizeof($data)) {
            return 0;
        }
        if ($id <= 0) {
            return $this->insert0($data);
        } else {
            return $this->update($data, $id);
        }
    }

    /**
     * 删除记录
     *
     * @param int $id 要更新的记录ID
     * @return int 操作影响的行数
     */
    public function delete($id = 0)
    {
        if ($id <= 0) {
            return 0;
        }
        return $this->db->delete($this->table, array('id' => $id));
    }


    /**
     * 根据ID集合批量删除记录
     * @param array $ids ID集合
     * @return int 删除操作影响的记录数量
     */
    public function delete_batch($ids = array())
    {
        if (0 === sizeof($ids)) {
            return 0;
        }
        $this->db->where_in('id', $ids);
        return $this->db->delete($this->table);
    }
}