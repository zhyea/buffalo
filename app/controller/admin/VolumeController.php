<?php
defined('_APP_PATH_') or exit('You shall not pass!');


require_model('VolumeModel');

class VolumeController extends AbstractController
{

    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new VolumeModel();
    }


    /**
     * 查询推荐的分类信息
     * @param $work_id int 作品ID
     */
    public function suggest($work_id)
    {
        $keywords = $_GET['key'];
        $keywords = empty($keywords) ? '' : $keywords;
        $data = $this->model->suggest($work_id, $keywords);
        $this->render_json(array('key' => $keywords, 'value' => $data));
    }


}