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
        $data['senior'] = is_null($p) ? -1 : $p['parent'];
        $data['parent_name'] = is_null($p) ? '' : $p['name'];
        $this->admin_page_view('category-list', '分类信息 - Buffalo', $data);
    }


    /**
     * 分类信息维护页
     *
     * @param int $parent 父分类ID
     * @param int $id 当前分类ID
     */
    public function settings_page($id = 0, $parent = 0)
    {
        $cat = $this->meta_model->get_by_id($id);

        $title = ($id > 0 ? '编辑分类' : '新增分类') . ' - Buffalo';

        $data['id'] = $id;
        $data['parent'] = $parent;
        $data['name'] = is_null($cat) ? '' : $cat['name'];
        $data['slug'] = is_null($cat) ? '' : $cat['slug'];
        $data['remark'] = is_null($cat) ? '' : $cat['remark'];
        $this->admin_page_view('category-settings', $title, $data);

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
        $this->meta_model->insert_or_update($data, $id);

        redirect('admin/category/list_page/' . $parent);
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

    /**
     * 删除数据
     */
    public function delete()
    {
        $ids = $_POST['ids'];
        echo $this->meta_model->delete_in_batch(explode(',', $ids));
    }

}