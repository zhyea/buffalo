<?php
defined('_APP_PATH_') or exit('You shall not pass!');


require_service('WorkService');

class FrontController extends AbstractController
{


    private $workService;


    /**
     * constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->workService = new WorkService();
    }


    /**
     * 进入首页
     */
    public function index()
    {
        $data = $this->workService->home_works();
        $this->theme_view('index', $data, "首页");
    }


    /**
     * 进入分类页
     * @param $alias string 分类别名
     * @param $page int 页码数
     */
    public function category($alias, $page = 1)
    {
        $data = $this->workService->find_with_cat($alias, $page);
        if (empty($data)) {
            $this->error_404();
        }
        $this->theme_view('category', $data, $data['_title']);
    }


    /**
     * 进入专题页
     * @param $alias string 专题别名
     * @param $page int 页码数
     */
    public function feature($alias, $page = 1)
    {
        $data = $this->workService->find_with_feature($alias, $page);
        if (empty($data)) {
            $this->error_404();
        }
        $this->theme_view('feature', $data, $data['_title']);
    }


    /**
     * 进入作家专题页
     * @param $id int 作家id
     * @param $page int 页码数
     */
    public function author($id, $page = 1)
    {
        $data = $this->workService->find_with_author($id, $page);
        if (empty($data)) {
            $this->error_404();
        }
        $this->theme_view('author', $data, $data['_title']);
    }

}