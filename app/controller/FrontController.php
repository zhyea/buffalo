<?php
defined('_APP_PATH_') or exit('You shall not pass!');


require_service('WorkService');
require_service('ChapterService');
require_service('AuthorService');

class FrontController extends AbstractController
{


    private $workService;

    private $chapterService;

    private $authorService;


    /**
     * constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->workService = new WorkService();
        $this->chapterService = new ChapterService();
        $this->authorService = new AuthorService();
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
            error_404_page();
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
            error_404_page();
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
            error_404_page();
        }
        $this->theme_view('author', $data, $data['_title']);
    }


    /**
     * 获取作品信息
     * @param $work_id int 作品ID
     */
    public function work($work_id)
    {
        $work = $this->workService->get_work($work_id);
        if (empty($work)) {
            error_404_page();
        }
        $this->workService->add_sn($work_id);
        $vols = $this->chapterService->volumes($work_id);
        $relates = $this->workService->relate($work_id, $work['author_id']);
        $keywords = $work['name'] . ',' . $work['author'] . ',' . $work['cat'];
        $this->theme_view('work', array('w' => $work,
            'vols' => $vols, 'relates' => $relates,
            'keywords' => $keywords,
            'description' => $work['brief']), $work['name']);
    }


    /**
     * 获取章节信息
     * @param $chapter_id int 章节ID
     */
    public function chapter($chapter_id)
    {
        $chapter = $this->chapterService->get_chapter($chapter_id);
        if (empty($chapter)) {
            error_404_page();
        }
        $this->theme_view('chapter', $chapter, $chapter['_title']);
    }


    /**
     * 获取作家集合页
     */
    public function authors()
    {
        $authors = $this->authorService->all();
        $this->theme_view('authors', array('all' => $authors, 'description' => '作家信息集合'), '作家');
    }


}