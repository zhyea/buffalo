<?php
defined('_APP_PATH_') or exit('You shall not pass!');

require_model('CategoryModel');

class CategoryService
{

    private $model;


    public function __construct()
    {
        $this->model = new CategoryModel();
    }


    /**
     * 展示列表数据
     * @param $parent int 父ID
     * @return array 子元素数据
     */
    public function list_data($parent)
    {
        $children = $this->model->find_by_parent($parent);
        if (empty($children)) {
            return $children;
        }
        foreach ($children as &$c) {
            $id = $c['id'];
            $count = $this->model->count_by_parent($id);
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
        $all = $this->model->find_all();
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

}