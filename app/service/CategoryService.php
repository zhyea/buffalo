<?php
defined('_APP_PATH_') or exit('You shall not pass!');

require_model('WorkModel');
require_model('CategoryModel');

class CategoryService
{

    private $catModel;

    private $workModel;


    public function __construct()
    {
        $this->catModel = new CategoryModel();
        $this->workModel = new WorkModel();
    }


    /**
     * 展示列表数据
     * @param $parent int 父ID
     * @return array 子元素数据
     */
    public function list_data($parent)
    {
        $children = $this->catModel->find_by_parent($parent);
        if (empty($children)) {
            return $children;
        }
        foreach ($children as &$c) {
            $id = $c['id'];
            $count = $this->catModel->count_by_parent($id);
            $c['sub_count'] = $count;
        }
        return $children;
    }


    /**
     * 获取备选父分类
     * @param $id int 分类ID
     * @param $parent int 分类父ID
     * @return array 获取备选父分类集合
     */
    public function candidates($id, $parent = 0)
    {
        $all = $this->catModel->find_all();
        $result = array();
        foreach ($all as $c) {
            if ($c['id'] == $id) {
                continue;
            }
            if ($parent > 0 && $parent == $c['parent']) {
                continue;
            }
            array_push($result, $c);
        }
        return $result;
    }


    /**
     * 执行删除操作，会删除当前分类以及子分类
     * @param $root_id int 分类ID
     * @return bool 是否删除成功
     */
    public function delete_recursively($root_id)
    {

        $ids = $this->catModel->offspring_ids($root_id);
        $r = array();
        foreach ($ids as $id) {
            if ($id == 1) {
                continue;
            }
            $this->workModel->change_cat($id, 1);
            array_push($r, $id);
        }
        return $this->catModel->delete_by_ids($r);
    }
}