<?php
defined('_APP_PATH_') or exit('You shall not pass!');

require_model('WorkModel');
require_model('CategoryModel');
require_model('AuthorModel');

class WorkService
{

    private $workModel;

    private $authorModel;

    private $catModel;

    /**
     * 构造器
     */
    public function __construct()
    {
        $this->workModel = new WorkModel();
        $this->authorModel = new AuthorModel();
        $this->catModel = new CategoryModel();
    }


    /**
     * 分页查询作品信息
     * @param $con array 查询条件
     * @return array 查询结果
     */
    public function find_works($con)
    {
        $search = '%' . $con['search'] . '%';
        $sort = $con['sort'];
        $order = $con['order'];
        $offset = $con['offset'];
        $limit = $con['limit'];
        $rows = $this->workModel->find_works($search, $sort, $order, $offset, $limit);
        $total = $this->workModel->count_works($search);
        return array('total' => $total, 'rows' => $rows);
    }


    /**
     * 根据ID获取作品信息
     * @param $id int 记录ID
     * @return array 记录信息
     */
    public function get($id)
    {
        if ($id <= 0) {
            return array();
        }
        $work = $this->workModel->get_by_id($id);
        if (empty($work)) {
            return array();
        }
        $author = $this->authorModel->get_by_id($work['author_id']);
        if (!empty($author)) {
            $work['author'] = $author['name'];
            $work['country'] = $author['country'];
        }
        $cat = $this->catModel->get_by_id($work['category_id']);
        if (!empty($cat)) {
            $work['cat'] = $cat['name'];
        }
        return $work;
    }

}