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
        return $this->db->select("id, name, country")
            ->from('author')
            ->limit(9)
            ->like('name', $name, 'both')
            ->get()
            ->result_array();
    }


    /**
     * 根据姓名和国家查找作者信息
     *
     * @param string $name 姓名
     * @param string $country 国籍
     * @return array|null 作者信息
     */
    public function find_by_name_country($name, $country)
    {
        if (empty($name)) {
            return null;
        }
        if (empty($country)) {
            return null;
        }
        return $this->get_where("id, name, country", array('name' => $name, 'country' => $country));
    }


    /** 获取作者名称
     *
     * @param int $id 记录ID
     * @return string 作者姓名
     */
    public function get_name($id = 0)
    {
        $r = $this->get_by_id0($id, 'name');
        return is_null($r) ? '' : $r['name'];
    }


    /**
     * 根据ID获取作者信息
     *
     * @param int $id 记录ID
     * @return array 作者信息
     */
    public function get_by_id($id)
    {
        return $this->get_by_id0($id);
    }

    /**
     * 新增作者信息
     * @param string $name 作者名称
     * @param string $country 作者国家
     * @param int $id 作品ID
     * @param string $bio 作者简介
     * @return int 记录ID
     */
    public function insert($name, $country = '未知', $id = 0, $bio = NULL)
    {
        $author = $this->find_by_name_country($name, $country);
        if (!is_null($author)) {
            $id = $author['id'];
        }
        $tmp = $this->insert_or_update(array('name' => $name, 'country' => $country, 'bio' => $bio), $id);
        if ($id === 0) {
            $id = $tmp;
        }
        return $id;
    }


    /**
     * 查询全部作者信息
     *
     * @return array 全部专题信息
     */
    public function all()
    {
        return $this->select_where('id, name, country');
    }

}