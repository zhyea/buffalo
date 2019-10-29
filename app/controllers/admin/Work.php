<?php


class Work extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('work_model');
    }


    /**
     * 加载作品列表页
     */
    public function list_page()
    {
        $this->admin_page_view('work-list', '分类信息 - Buffalo');
    }


    /**
     * 作品信息维护页
     *
     * @param int $id 当前分类ID
     */
    public function settings_page($id = 0)
    {
        $work = $this->work_model->get_by_id($id);

        $title = ($id > 0 ? '编辑作品' : '新增作品') . ' - Buffalo';

        $data['id'] = $id;
        $this->admin_page_view('work-settings', $title, $data);

    }


    /**
     * 执行更新
     */
    public function update()
    {
        $id = $_POST['id'];
        $parent = $_POST['parent'];
        $data = array(
            'parent' => $parent,
            'name' => $_POST['name'],
            'slug' => $_POST['slug'],
            'remark' => $_POST['remark'],
            'type' => 'category'
        );
        $this->work_model->insert_or_update($data, $id);

        redirect('admin/category/list_page/' . $parent);
    }


    /**
     * 作品数据
     */
    public function data()
    {
        $arr = $this->work_model->query_category_by_parent();
        foreach ($arr as $key => &$v) {
            $child_num = $this->work_model->count_by_parent($v['id']);
            $v['child_num'] = $child_num;
        }

        echo json_encode($arr);
    }

    /**
     * 删除数据
     */
    public function delete()
    {
        $ids = $_POST['ids'];
        echo $this->work_model->delete_in_batch(explode(',', $ids));
    }



}