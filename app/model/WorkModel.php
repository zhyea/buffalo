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
     * 查询作品信息
     * @param $search string 查询值
     * @param $sort string 排序字段
     * @param $order string 排序方向
     * @param $offset int 偏移量
     * @param $limit int 步长
     * @return array 专题作品列表
     */
    public function find_works($search, $sort, $order, $offset, $limit)
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
    public function find_with_author($author_id, $sort, $order, $offset, $limit)
    {

        $sql = 'select w.id, w.name, w.cover, w.brief, a.name as author, a.id as author_id, m.name as cat ';
        $sql = $sql . 'from work w left join author a on w.author_id=a.id left join meta m on w.category_id=m.id';
        $sql = $sql . 'where w.author_id=?';
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
        $sql = "select count(id) from work where author_id=?";
        return $this->_count($sql, array($author_id));
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
    public function find_with_features($alias, $sort, $order, $offset, $limit)
    {
        $sql = 'select w.id, w.name, w.cover, w.brief, a.name as author, a.id as author_id ';
        $sql = $sql . 'from work w left join author a on w.author_id=a.id right join feature_record r on r.work_id=w.id left join feature f on r.feature_id=f.id';
        $sql = $sql . 'where f.alias=?';
        $sql = $sql . 'order by ' . $sort . ' ' . $order . ' limit ' . $offset . ',' . $limit;
        return $this->_find($sql, array($alias));
    }
}