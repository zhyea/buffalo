<?php


class Category extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('meta_model');
    }


    /**
     * 加载分类列表页
     *
     * @param int $parent 分类父ID
     */
    public function list_page($parent = 0)
    {
        $p = $this->meta_model->get_by_id($parent);
        $data['parent'] = is_null($p) ? 0 : $p['id'];
        $data['parent_name'] = is_null($p) ? '' : $p['name'];
        $this->admin_page_view('category-list', '分类信息', $data);
    }


    /**
     * 分类页数据
     *
     * @param int $parent 分类父ID
     */
    public function data($parent = 0)
    {
        $arr = $this->meta_model->query_category_by_parent($parent);
        foreach ($arr as $key => &$v) {
            $child_num = $this->meta_model->count_by_parent($v['id']);
            $v['child_num'] = $child_num;
        }

        echo json_encode($arr);
    }

}