<?php


class Author extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("author_model");
        $this->load->model('user_model');
    }


    /**
     * 根据作者姓名执行模糊查询
     *
     * @param null $name 姓名字符串
     *
     */
    public function find_by_name($name = NULL)
    {
        $result = $this->author_model->find_by_name(urldecode($name));
        echo json_encode(array('value' => $result));
    }
}