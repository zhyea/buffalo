<?php
defined('_APP_PATH_') or exit('You shall not pass!');

require_model('WorkModel');
require_model('CategoryModel');
require_model('AuthorModel');
require_model('FeatureRecordModel');

class WorkService
{

    private $workModel;

    private $authorModel;

    private $catModel;

    private $recordModel;

    /**
     * 构造器
     */
    public function __construct()
    {
        $this->workModel = new WorkModel();
        $this->authorModel = new AuthorModel();
        $this->catModel = new CategoryModel();
        $this->recordModel = new FeatureRecordModel();
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


    /**
     * 分页获取作者作品信息
     * @param $author_id int 作者ID
     * @param $con array 条件集合
     * @return array 作者作品信息
     */
    public function find_with_author($author_id, $con)
    {
        $sort = $con['sort'];
        $order = $con['order'];
        $offset = $con['offset'];
        $limit = $con['limit'];
        $rows = $this->workModel->find_with_author($author_id, $sort, $order, $offset, $limit);
        $total = $this->workModel->count_works($author_id);
        return array('total' => $total, 'rows' => $rows);
    }


    /**
     * 分页获取专题作品信息
     * @param $feature_alias string 专题别名
     * @param $con array 条件集合
     * @return array 作者作品信息
     */
    public function find_with_feature($feature_alias, $con)
    {
        $sort = $con['sort'];
        $order = $con['order'];
        $offset = $con['offset'];
        $limit = $con['limit'];
        $rows = $this->workModel->find_with_feature($feature_alias, $sort, $order, $offset, $limit);
        $total = $this->recordModel->count_with_alias($feature_alias);
        return array('total' => $total, 'rows' => $rows);
    }



    public function find_with_keywords($keywords){
        $keywords = empty($keywords) ? '' : $keywords;
        return $this->workModel->find_with_keywords($keywords);
    }

}