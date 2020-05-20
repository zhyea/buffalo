<?php
defined('_APP_PATH_') or exit('You shall not pass!');

require_model('CategoryModel');

class CategoryController extends AbstractController
{


    private $model;

    /**
     * constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->model = new CategoryModel();
    }


    /**
     * 用户信息列表
     * @param $id int 分类ID
     * @param $parent int 父分类ID
     */
    public function list($id = 0, $parent = 0)
    {
        $cat = $this->model->get_by_id($id);
        $parent = $this->model->get_by_id($parent);
        $this->admin_view('cat-list', array(), '分类列表');
    }
}