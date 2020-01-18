<?php


class Category extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Meta_Model');
    }


    /**
     * 加载分类列表页
     *
     * @param int $parent 分类父ID
     */
    public function list_page($parent = 0)
    {
        $p = $this->Meta_Model->get_by_id($parent);
        $data['parent'] = is_null($p) ? 0 : $p['id'];
        $data['senior'] = is_null($p) ? -1 : $p['parent'];
        $data['parent_name'] = is_null($p) ? '' : $p['name'];
        $this->admin_page_view('category-list', '分类信息', $data);
    }


    /**
     * 分类信息维护页
     *
     * @param int $parent 父分类ID
     * @param int $id 当前分类ID
     */
    public function settings_page($id = 0, $parent = 0)
    {
        $cat = $this->Meta_Model->get_by_id($id);

        $title = ($id > 0 ? '编辑分类' : '新增分类');

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
        $this->Meta_Model->insert_or_update($data, $id);

        redirect('admin/category/list_page/' . $parent);
    }


    /**
     * 分类页数据
     *
     * @param int $parent 分类父ID
     */
    public function data($parent = 0)
    {
        $arr = $this->Meta_Model->query_category_by_parent($parent);
        foreach ($arr as $key => &$v) {
            $child_num = $this->Meta_Model->count_by_parent($v['id']);
            $v['child_num'] = $child_num;
        }

        echo json_encode($arr);
    }

    /**
     * 查询获取全部分类数据
     */
    public function data_all()
    {
        $arr = $this->Meta_Model->query_category();
        echo json_encode(array('value' => $arr));
    }

    /**
     * 删除数据
     */
    public function delete()
    {
        $ids = $_POST['ids'];
        echo $this->Meta_Model->delete_in_batch(explode(',', $ids));
    }

    /**
     * 调整排序
     *
     * @param int $id 记录ID
     * @param int $sn 顺序号
     * @param int $direct 调整方向，1 递增， 2 递减
     */
    public function change_order($id, $sn, $direct = 1)
    {
        echo $this->Meta_Model->change_sn($id, $sn, $direct);
    }

}