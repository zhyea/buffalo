<?php


class Volume extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Volume_Model");
    }


    /**
     * 根据名称执行模糊查询
     *
     * @param int $work_id 作品ID
     * @param string $name 名称字符串
     */
    public function find_by_name($work_id, $name = NULL)
    {
        $result = $this->Volume_Model->find_by_name($work_id, urldecode($name));
        echo json_encode(array('value' => $result));
    }


}