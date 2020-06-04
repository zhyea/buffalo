<?php
defined('_APP_PATH_') or exit('You shall not pass!');

require_model('AuthorModel');
require_model('WorkModel');

class AuthorController extends AbstractController
{


    private $authorModel;
    private $workModel;

    public function __construct()
    {
        parent::__construct();
        $this->authorModel = new AuthorModel();
        $this->workModel = new WorkModel();
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
        $all = $this->authorModel->find_all();
        foreach ($all as &$a) {
            $id = $a['id'];
            $cnt = $this->workModel->count_with_author($id);
            $a['work_count'] = $cnt;
        }
        $this->render_json($all);
    }


    /**
     * 执行删除操作
     * @param $id int 记录ID
     */
    public function delete($id)
    {
        if ($id > 1) {
            $this->authorModel->delete_by_id($id);
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
            $s = $this->authorModel->get_by_id($id);
        }
        $this->admin_view('author-settings', $s, empty($s) ? '新增作者' : '编辑作者信息');
    }


    /**
     * 维护脚本信息
     */
    public function maintain()
    {
        $data = $this->_post();
        $this->authorModel->insert_or_update($data);
        $this->redirect('admin/author/list');
    }


    /**
     * 查询推荐的作者信息
     */
    public function suggest()
    {
        $keywords = $_GET['key'];
        $keywords = empty($keywords) ? '' : $keywords;
        $data = $this->authorModel->suggest($keywords);
        $this->render_json(array('key' => $keywords, 'value' => $data));
    }


    /**
     * 根据作者ID查询作品信息
     * @param $author_id int 作者ID
     */
    public function works($author_id)
    {
        $author = $this->authorModel->get_by_id($author_id);
        if (empty($author)) {
            $this->redirect('admin/author/list');
        }
        $this->admin_view('author-works', $author, $author['name'] . '作品列表');
    }

}