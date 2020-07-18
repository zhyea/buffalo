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

    private $featureModel;

    /**
     * 构造器
     */
    public function __construct()
    {
        $this->workModel = new WorkModel();
        $this->authorModel = new AuthorModel();
        $this->catModel = new CategoryModel();
        $this->recordModel = new FeatureRecordModel();
        $this->featureModel = new FeatureModel();
    }


    /**
     * 首页作品列表
     */
    public function home_works()
    {
        $all = array();
        $cats = $this->catModel->all();
        foreach ($cats as $c) {
            $works = $this->workModel->find_with_cat($c['id'], 'id', 'desc', 0, 18);
            if (!empty($works)) {
                $c['works'] = $works;
                array_push($all, $c);
            }
        }
        $recommend = $this->workModel->find_with_feature('recommend');
        return array('all' => $all, 'recommend' => $recommend);
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
     * 根据ID获取作品信息
     * @param $id int 作品ID
     * @return array 作品信息
     */
    public function get_work($id)
    {
        return $this->workModel->get_work($id);
    }


    /**
     * 获取分类作品信息
     * @param $cat_slug string 分类缩略名
     * @param $page int 页码
     * @return array 结果
     */
    public function find_with_cat($cat_slug, $page)
    {
        $cat = $this->catModel->get_by_slug($cat_slug);
        if (empty($cat)) {
            return array();
        }
        $sort = 'id';
        $order = 'desc';
        $length = 18;
        $offset = $length * ($page - 1);
        $works = $this->workModel->find_with_cat($cat['id'], $sort, $order, $offset, $length);
        $total = $this->workModel->count_with_cat($cat['id']);
        $total = ceil($total / $length);
        $recommend = $this->workModel->find_with_feature('recommend');
        return array('cat' => $cat,
            'keywords' => $cat['name'],
            'description' => $cat['remark'],
            'works' => $works,
            'recommend' => $recommend,
            'page' => $page,
            'total' => $total,
            '_title' => $cat['name']);
    }


    /**
     * 分页获取专题作品信息
     * @param $feature_alias string 专题别名
     * @param $page int 页数
     * @return array 作者作品信息
     */
    public function find_with_feature($feature_alias, $page)
    {
        $f = $this->featureModel->get_by_alias($feature_alias);
        if (empty($f)) {
            return array();
        }
        $sort = 'id';
        $order = 'desc';
        $length = 18;
        $offset = $length * ($page - 1);
        $rows = $this->workModel->find_with_feature($feature_alias, $sort, $order, $offset, $length);
        $total = $this->recordModel->count_with_alias($feature_alias);
        $total = ceil($total / $length);
        $data = array('feature' => $f,
            'keywords' => $f['name'],
            'description' => $f['brief'],
            'works' => $rows,
            'page' => $page,
            'total' => $total,
            '_title' => $f['name']);
        if (!empty($f['background'])) {
            $data['background'] = $f['background'];
        }
        if (!empty($f['bg_repeat'])) {
            $data['bg_repeat'] = $f['bg_repeat'];
        }
        if (!empty($f['cover'])) {
            $data['logo'] = $f['cover'];
        }
        return $data;
    }


    /**
     * 分页获取作者作品信息
     * @param $author_id int 作者ID
     * @param $page int 页数
     * @return array 作者作品信息
     */
    public function find_with_author($author_id, $page)
    {
        $author = $this->authorModel->get_by_id($author_id);
        if (empty($author)) {
            return array();
        }
        $sort = 'id';
        $order = 'desc';
        $length = 18;
        $offset = $length * ($page - 1);
        $rows = $this->workModel->find_with_author($author_id, $sort, $order, $offset, $length);
        $total = $this->workModel->count_with_author($author_id);
        $total = ceil($total / $length);
        return array('author' => $author,
            'keywords' => $author['name'],
            'description' => $author['bio'],
            'works' => $rows,
            'page' => $page,
            'total' => $total,
            '_title' => $author['name']);
    }


    /**
     * 分页获取作者作品信息
     * @param $author_id int 作者ID
     * @param $con array 条件集合
     * @return array 作者作品信息
     */
    public function find_with_author_con($author_id, $con)
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
    public function find_with_feature_con($feature_alias, $con)
    {
        $sort = $con['sort'];
        $order = $con['order'];
        $offset = $con['offset'];
        $limit = $con['limit'];
        $rows = $this->workModel->find_with_feature($feature_alias, $sort, $order, $offset, $limit);
        $total = $this->recordModel->count_with_alias($feature_alias);
        return array('total' => $total, 'rows' => $rows);
    }

    /**
     * 根据关键字查询作品信息
     * @param $keywords string 关键字
     * @return array 作品集合
     */
    public function find_with_keywords($keywords)
    {
        $keywords = empty($keywords) ? '' : $keywords;
        return $this->workModel->find_with_keywords($keywords);
    }


    /**
     * 获取相关作品
     * @param $work_id int 作品ID
     * @param $author_id int 作者ID
     * @return array 相关作品
     */
    public function relate($work_id, $author_id)
    {
        $works = $this->workModel->find_with_author($author_id);
        $result = array();
        foreach ($works as $w) {
            if ($work_id == $w['id']) {
                continue;
            }
            array_push($result, $w);
        }
        return $result;
    }


    /**
     * 根据作品名称获取作品信息
     * @param $name string 作品名称
     * @return array|null 作品信息
     */
    public function get_by_name($name)
    {
        if (empty($name)) {
            return null;
        }
        return $this->workModel->get_by_name($name);
    }


    /**
     * 增加作品排序
     * @param $work_id int 作品ID
     */
    public function add_sn($work_id)
    {
        $this->workModel->add_sn($work_id);
    }
}