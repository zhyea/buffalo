<?php


class Author_Model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 根据作者姓名进行模糊查询
     *
     * @param string $name 作者姓名
     * @return array
     */
    public function find_by_name($name)
    {
        if (empty($name)) {
            return array();
        }
        return $this->db->select("id, name, country")
            ->from('author')
            ->limit(9)
            ->like('name', $name, 'both')
            ->get()
            ->result_array();
    }


}