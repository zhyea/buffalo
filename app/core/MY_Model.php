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
     * 封装多行查询语句
     *
     * @param string $columns 查询的字段
     * @param string $where 查询条件
     * @param int $limit 查询数量
     * @param int $offset 查询起始位置
     * @return array 查询结果
     */
    protected function select_where($columns = '*', $where = NULL, $limit = NULL, $offset = NULL)
    {
        $this->db->select($columns);
        $query = $this->db->get_where($this->table, $where, $limit, $offset);
        return $query->result_array();
    }


    /**
     * 封装单行记录查询语句
     *
     * @param $column string 要查询的字段
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
     * @param $data array 源数据
     * @return int 影响的记录数
     */
    protected function insert($data = array())
    {
        if (0 === sizeof($data)) {
            return 0;
        }
        return $this->db->insert($this->table, $data);
    }


    /**
     * 更新记录
     *
     * @param $data array 要更新的内容
     * @param $id int 要更新的记录ID
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
     * @param $data array 要更新的内容
     * @param $id int 要更新的记录ID
     * @return int 操作影响的行数
     */
    public function insertOrUpdate($data = array(), $id = 0)
    {
        if (0 === sizeof($data)) {
            return 0;
        }
        if ($id <= 0) {
            return $this->insert($data);
        } else {
            return $this->update($data, $id);
        }
    }

    /**
     * 删除记录
     *
     * @param $id int 要更新的记录ID
     * @return int 操作影响的行数
     */
    public function delete($id = 0)
    {
        if ($id <= 0) {
            return 0;
        }
        return $this->db->delete($this->table, array('id' => $id));
    }


    public function deleteBatch($ids = array())
    {
        if (0 === sizeof($ids)) {
            return 0;
        }
        $this->db->where_in('id',$ids);
        return $this->db->delete($this->table);
    }
}