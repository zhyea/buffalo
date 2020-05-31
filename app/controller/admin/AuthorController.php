<?php
defined('_APP_PATH_') or exit('You shall not pass!');

require_model('AuthorModel');


class AuthorController extends AbstractController
{


    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new AuthorModel();
    }


    /**
     * 进入列表页
     */
    public function list()
    {
        $this->admin_view('author-list', array(), '作者列表');
    }


    /**
     * 列表页数据
     */
    public function data()
    {
        $all = $this->model->find_all();
        $this->render_json($all);
    }


    /**
     * 执行删除操作
     * @param $id int 记录ID
     */
    public function delete($id)
    {
        if ($id > 1) {
            $this->model->delete_by_id($id);
        }
        $this->redirect('admin/author/list');
    }


    /**
     * 进入编辑页
     * @param $id int 记录ID
     */
    public function settings($id = 0)
    {
        $s = array('id' => $id);
        if ($id > 0) {
            $s = $this->model->get_by_id($id);
        }
        $this->admin_view('author-settings', $s, empty($s) ? '新增作者' : '编辑作者信息');
    }


    /**
     * 维护脚本信息
     */
    public function maintain()
    {
        $data = $this->_post();
        $this->model->insert_or_update($data);
        $this->redirect('admin/author/list');
    }


    /**
     * 查询推荐的作者信息
     */
    public function suggest()
    {
        $keywords = $_GET['key'];
        $keywords = empty($keywords) ? '' : $keywords;
        $data = $this->model->suggest($keywords);
        $this->render_json(array('key' => $keywords, 'value' => $data));
    }

}