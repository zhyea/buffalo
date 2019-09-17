<?php


class MY_Model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }


    public function select_where($columns = '*', $where = NULL, $limit = NULL, $offset = NULL)
    {
        $this->db->select($columns);
        $query = $this->db->get_where(strtolower(get_called_class()), $where, $limit, $offset);
        return $query->result_array();
    }


    public function get_where($column, $where = NULL)
    {
        $this->db->select($column);
        $query = $this->db->get_where(strtolower(get_called_class()), $where);
        $row = $query->row_array(0);
        return $row[$column];
    }

}