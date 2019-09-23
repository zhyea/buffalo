<?php


class MY_Model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
        $this->table = strtolower(get_called_class());
    }


    public function select_where($columns = '*', $where = NULL, $limit = NULL, $offset = NULL)
    {
        $this->db->select($columns);
        $query = $this->db->get_where($this->table, $where, $limit, $offset);
        return $query->result_array();
    }


    public function get_where($column, $where = NULL)
    {
        $this->db->select($column);
        $query = $this->db->get_where($this->table, $where);
        $row = $query->row_array(0);
        return $row[$column];
    }


    public function replace($set = NULL)
    {
        return $this->db->replace($this->table, $set);
    }


}