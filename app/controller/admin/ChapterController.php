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
        $this->admin_view('chapters', array('work' => $work, 'vols' => $chapters), empty($work['name'] ? '' : $work['name'] . '-') . '章节列表');
    }


    /**
     * 进入作品章节编辑页
     * @param $chapter_id int 章节ID
     */
    public function edit($chapter_id)
    {
        $data = $this->chapterService->chapter($chapter_id);
        if (empty($data)) {
            $this->redirect('admin/work/list');
        } else {
            $this->admin_view('chapter-edit', $data, $data['name'] . '-编辑');
        }
    }

}