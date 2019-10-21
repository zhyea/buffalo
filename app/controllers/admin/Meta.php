<?php


class Meta extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('meta_model');
    }


    public function child_category($parent = 0)
    {
        $arr = $this->meta_model->query_category_by_parent($parent);
        foreach ($arr as $key => &$v) {
            $child_num = $this->meta_model->count_by_parent($v['id']);
            $v['child_num'] = $child_num;
        }

        echo json_encode($arr);
    }

}