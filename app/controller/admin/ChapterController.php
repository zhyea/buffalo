<?php
defined('_APP_PATH_') or exit('You shall not pass!');


require_service('ChapterService');

class ChapterController extends AbstractController
{

    private $chapterService;

    private $workService;


    public function __construct()
    {
        parent::__construct();
        $this->chapterService = new ChapterService();
        $this->workService = new WorkService();
    }


    /**
     * 进入作品章节列表页
     * @param $work_id int 作品ID
     */
    public function all($work_id)
    {
        $work = $this->workService->get($work_id);
        $chapters = $this->chapterService->volumes($work_id);
        $title = (empty($work['name']) ? '' : $work['name'] . '-') . '章节列表';
        $this->admin_view('chapters', array('work' => $work, 'vols' => $chapters), $title);
    }


    /**
     * 进入作品章节编辑页
     * @param $work_id int 作品ID
     * @param $chapter_id int 章节ID
     */
    public function edit($work_id, $chapter_id = 0)
    {
        if (empty($work_id)) {
            $this->redirect('admin/work/list');
        }
        $work = $this->workService->get($work_id);
        if (empty($work)) {
            $this->redirect('admin/work/list');
        }
        $chapter = array();
        if ($chapter_id > 0) {
            $chapter = $this->chapterService->chapter($chapter_id);
            $chapter = empty($chapter) ? array() : $chapter;
        }
        $chapter['work'] = $work;
        $title = (array_key_exists('name', $chapter) ? $chapter['name'] . '-' : '') . '编辑';
        $this->admin_view('chapter-edit', $chapter, $title);
    }

    /**
     * 维护章节数据
     */
    public function maintain()
    {
        $data = $this->_post();

        $work_id = $data['work_id'];
        $id = $data['id'];

        $this->chapterService->maintain($data);
        $this->alert_success('保存章节信息成功');

        if (empty($id)) {
            $this->redirect('admin/chapter/all/' . $work_id);
        } else {
            $this->redirect('admin/chapter/all/' . $work_id . '/' . $id);
        }
    }


}