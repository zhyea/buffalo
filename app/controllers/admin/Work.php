<?php


class Work extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('work_model');
        $this->load->model('author_model');
        $this->load->model('meta_model');
        $this->load->service('work_service');
    }


    /**
     * 章节信息
     * @param int $work_id 作品ID
     * @param string $work_name 作品名称
     */
    public function chapters($work_id = 0, $work_name = '')
    {
        $work_name = urldecode($work_name);
        $data['id'] = $work_id;
        $data['name'] = $work_name;
        $this->load->helper('form');
        $this->admin_page_view('work-chapters', $work_name . ' - Buffalo', $data);
    }


    /**
     * 加载作品列表页
     */
    public function list_page()
    {
        $this->admin_page_view('work-list', '作品列表 - Buffalo');
    }


    /**
     * 作品信息维护页
     *
     * @param int $id 当前分类ID
     */
    public function settings_page($id = 0)
    {
        $work = $id <= 0 ? null : $this->work_model->get_by_id($id);

        $title = ($id > 0 ? '编辑作品' : '新增作品') . ' - Buffalo';

        $cat_id = is_null($work) ? 0 : $work['category_id'];
        $author_id = is_null($work) ? 0 : $work['author_id'];
        $author = $this->author_model->get_by_id($author_id);

        $data['id'] = $id;
        $data['name'] = is_null($work) ? '' : $work['name'];
        $data['brief'] = is_null($work) ? '' : $work['brief'];
        $data['author_id'] = $author_id;
        $data['cat_id'] = $cat_id;
        $data['author'] = empty($author) ? '' : $author['name'];
        $data['authorCountry'] = empty($author) ? '' : $author['country'];
        $data['cat'] = empty($cat_id) ? '' : $this->meta_model->get_name($cat_id);;

        $this->admin_page_view('work-settings', $title, $data);

    }


    /**
     * 执行更新
     */
    public function update()
    {
        $id = $_POST['id'];
        $author_id = $_POST['author_id'];
        if (empty($author_id)) {
            $author_id = $this->author_model->insert($_POST['author'], $_POST['authorCountry']);
        }

        $data = array(
            'name' => $_POST['name'],
            'brief' => $_POST['brief'],
            'author_id' => $author_id,
            'category_id' => $_POST['cat_id']
        );
        $this->work_model->insert_or_update($data, $id);

        redirect('admin/work/list_page/');
    }


    /**
     * 作品数据
     */
    public function data()
    {
        $search = $_GET['search'];
        $sort = $_GET['sort'];
        $order = $_GET['order'];
        $offset = $_GET['offset'];
        $limit = $_GET['limit'];
        $arr = $this->work_model->query_in_page(false, $search, $sort, $order, $offset, $limit);
        $total = $this->work_model->query_in_page(true);
        echo json_encode(Array('total' => $total, 'rows' => $arr));
    }


    /**
     * 删除数据
     */
    public function delete()
    {
        $ids = $_POST['ids'];
        echo $this->work_model->delete_in_batch(explode(',', $ids));
    }


    /**
     * 上传并解析文件内容
     */
    public function upload()
    {
        $work_id = $_POST['work_id'];
        $this->work_service->upload_and_read($work_id, 'myTxt');
    }

}