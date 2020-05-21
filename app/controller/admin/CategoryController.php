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
     * 分类信息列表
     * @param $id int 分类ID
     * @param $parent int 父分类ID
     */
    public function list($id = 0, $parent = 0)
    {
        $p = $this->model->get_by_id($parent);
        $title = '分类列表';
        if (!empty($p)) {
            $title = $title . '-' . $p['name'];
        }
        $this->admin_view('cat-list', array('id' => $id, 'parent' => $parent, 'header_title' => $title), $title);
    }


    /**
     * 获取父分类数据
     * @param $parent int 分父类ID
     */
    public function data($parent = 0)
    {
        $data = $this->model->find_by_parent($parent);
        $this->render_json($data);
    }
}