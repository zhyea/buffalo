<?php
defined('_APP_PATH_') or exit('You shall not pass!');


class WorkModel extends Z_Model
{

    /**
     * 修改分类
     * @param $old_cat int 原分类ID
     * @param $new_cat int 新分类ID
     * @return bool 是否修改成功
     */
    public function change_cat($old_cat, $new_cat)
    {
        $sql = 'update work set category_id=? where category_id=?';
        return $this->_execute($sql, array($new_cat, $old_cat));
    }


    /**
     * 获取作品信息
     * @param $id int 作品ID
     * @return array 作品信息
     */
    public function get_work($id)
    {
        $sql = 'select w.id, w.name, w.cover, w.brief, a.name as author, a.id as author_id, m.name as cat, m.slug as cat_slug ';
        $sql = $sql . 'from work w left join author a on w.author_id=a.id left join category m on w.category_id=m.id ';
        $sql = $sql . 'where w.id=? ';
        return $this->_get($sql, array($id));
    }


    /**
     * 查询作品信息
     * @param $search string 查询值
     * @param $sort string 排序字段
     * @param $order string 排序方向
     * @param $offset int 偏移量
     * @param $limit int 步长
     * @return array 专题作品列表
     */
    public function find_works($search, $sort = 'w.id', $order = 'desc', $offset = 0, $limit = 18)
    {
        $arr = array($search, $search, $search, $search);
        $sql = 'select w.id, w.name, a.name as author, a.id as author_id, m.name as cat ';
        $sql = $sql . 'from work w left join author a on w.author_id=a.id left join category m on w.category_id=m.id ';
        $sql = $sql . 'where w.name like ? or brief like ? or a.name like ? or m.name like ? ';
        $sql = $sql . 'order by ' . $sort . ' ' . $order . ' limit ' . $offset . ',' . $limit;
        return $this->_find($sql, $arr);
    }


    /**
     * 统计作品
     * @param $search string 查询条件
     * @return int 统计结果
     */
    public function count_works($search)
    {
        $search = '%' . (empty($search) ? '' : $search) . '%';
        $arr = array($search, $search, $search, $search);
        $sql = 'select count(w.id) ';
        $sql = $sql . 'from work w left join author a on w.author_id=a.id left join category m on w.category_id=m.id ';
        $sql = $sql . 'where w.name like ? or brief like ? or a.name like ? or m.name like ? ';
        return $this->_count($sql, $arr);
    }


    /**
     * 查询作者作品信息
     * @param $author_id int 作者ID
     * @param $sort string 排序字段
     * @param $order string 排序方向
     * @param $offset int 偏移量
     * @param $limit int 步长
     * @return array 专题作品列表
     */
    public function find_with_author($author_id, $sort = 'w.id', $order = 'desc', $offset = 0, $limit = 18)
    {

        $sql = 'select w.id, w.name, w.cover, w.brief, a.name as author, a.id as author_id, m.name as cat ';
        $sql = $sql . 'from work w left join author a on w.author_id=a.id left join category m on w.category_id=m.id ';
        $sql = $sql . 'where w.author_id=? ';
        $sql = $sql . 'order by ' . $sort . ' ' . $order . ' limit ' . $offset . ',' . $limit;
        return $this->_find($sql, array($author_id));
    }


    /**
     * 根据作者ID执行统计
     * @param $author_id int 作者ID
     * @return int 统计结果
     */
    public function count_with_author($author_id)
    {
        return $this->_count_by(array('author_id' => $author_id));
    }


    /**
     * 查询专题信息
     * @param $alias string 专题别名
     * @param $sort string 排序字段
     * @param $order string 排序方向
     * @param $offset int 偏移量
     * @param $limit int 步长
     * @return array 专题作品列表
     * @return array 专题作品列表
     */
    public function find_with_feature($alias, $sort = 'w.id', $order = 'desc', $offset = 0, $limit = 18)
    {
        $sql = 'select w.id, w.name, w.cover, w.brief, a.name as author, a.id as author_id, r.id as record_id ';
        $sql = $sql . 'from work w left join author a on w.author_id=a.id right join feature_record r on r.work_id=w.id left join feature f on r.feature_id=f.id ';
        $sql = $sql . 'where f.alias=? ';
        $sql = $sql . 'order by r.sn desc, ' . $sort . ' ' . $order . ' limit ' . $offset . ',' . $limit;
        return $this->_find($sql, array($alias));
    }

    /**
     * 查询作品分类信息
     * @param $cat_id int 分类ID
     * @param $sort string 排序字段
     * @param $order string 排序方向
     * @param $offset int 偏移量
     * @param $limit int 步长
     * @return array 专题作品列表
     */
    public function find_with_cat($cat_id, $sort = 'w.id', $order = 'desc', $offset = 0, $limit = 18)
    {
        $sql = 'select w.id, w.name, w.cover, w.brief, a.name as author, a.id as author_id, m.name as cat ';
        $sql = $sql . 'from work w left join author a on w.author_id=a.id left join category m on w.category_id=m.id ';
        $sql = $sql . 'where w.category_id=? ';
        $sql = $sql . 'order by w.sn desc, ' . $sort . ' ' . $order . ' limit ' . $offset . ', ' . $limit;
        return $this->_find($sql, array($cat_id));
    }


    /**
     * 根据分类ID执行统计
     * @param $cat_id int 分类ID
     * @return int 统计结果
     */
    public function count_with_cat($cat_id)
    {
        return $this->_count_by(array('category_id' => $cat_id));
    }


    /**
     * 根据关键字执行搜索
     * @param $keywords string 关键字
     * @return array 查询结果
     */
    public function find_with_keywords($keywords)
    {
        $keywords = '%' . $keywords . '%';
        $sql = 'select w.id, w.name, a.name as author, m.name as cat  ';
        $sql = $sql . 'from work w left join author a on w.author_id=a.id left join category m on w.category_id=m.id ';
        $sql = $sql . 'where w.name like ? or brief like ? or a.name like ? or m.name like ? order by w.id desc limit 9 ';
        return $this->_find($sql, array($keywords, $keywords, $keywords, $keywords));
    }


    /**
     * 根据作品名称获取作品信息
     * @param $name string 作品名称
     * @return array 作品记录
     */
    public function get_by_name($name)
    {
        return $this->_get_by(array('name' => $name));
    }


    /**
     * 增加作品排序
     * @param $work_id int 作品ID
     */
    public function add_sn($work_id)
    {
        $sql = 'update work set sn=sn+1 where id=?';
        $this->_execute($sql, array($work_id));
    }
}