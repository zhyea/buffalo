<?php


class Work extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('work_model');
        $this->load->model('author_model');
        $this->load->model('meta_model');
        $this->load->model('chapter_model');
        $this->load->service('work_service');
    }


    /**
     * 章节信息
     *
     * @param int $work_id 作品ID
     */
    public function chapters($work_id = 0)
    {
        $w = $this->work_model->get_by_id($work_id);
        $work_name = $w['name'];

        $data['id'] = $work_id;
        $data['name'] = $work_name;
        $data['chapters'] = $this->chapter_model->chapters($work_id);

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
     * @param int $id 当前作品ID
     */
    public function settings_page($id = 0)
    {
        $work = $id <= 0 ? null : $this->work_model->get_by_id($id);

        $title = ($id > 0 ? $work['name'] : '新增作品') . ' - Buffalo';

        $cat_id = is_null($work) ? 0 : $work['cat_id'];
        $author_id = is_null($work) ? 0 : $work['author_id'];
        $author = $this->author_model->get_by_id($author_id);

        if (get_cookie('update_work')) {
            $data['msg'] = '更新作品信息成功！';
            delete_cookie('update_work');
        }

        $data['id'] = $id;
        $data['name'] = is_null($work) ? '' : $work['name'];
        $data['brief'] = is_null($work) ? '' : $work['brief'];
        $data['cover'] = is_null($work) ? '' : $work['cover'];
        $data['author_id'] = $author_id;
        $data['cat_id'] = $cat_id;
        $data['author'] = empty($author) ? '' : $author['name'];
        $data['authorCountry'] = empty($author) ? '' : $author['country'];
        $data['cat'] = empty($cat_id) ? '' : $this->meta_model->get_name($cat_id);;

        $this->load->helper('form');
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
        $cat_id = $_POST['cat_id'];
        if (empty($cat_id)) {
            $cat_id = $this->meta_model->insert_category($_POST['cat']);
        }
        $data = array(
            'name' => $_POST['name'],
            'brief' => $_POST['brief'],
            'author_id' => $author_id,
            'category_id' => $cat_id
        );
        $tmp = $this->work_service->update($data, $id);

        if ($id > 0) {
            set_cookie('update_work', true, 60);
        } else {
            $id = $tmp;
        }

        redirect('admin/work/settings_page/' . $id);
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


    /**
     * 编辑章节
     *
     * @param int $work_id 作品ID
     * @param int $chapter_id 章节ID
     */
    public function chapter_edit($work_id, $chapter_id)
    {
        $work = $this->work_model->get_by_id($work_id);
        $chapter = $this->chapter_model->get_by_id($chapter_id);

        $data['work_name'] = $work['name'];
        $data['chapter_name'] = $chapter['name'];
        $data['content'] = $chapter['content'];
        $data['work_id'] = $work['id'];
        $data['chapter_id'] = $chapter['id'];

        $title = $work['name'] . ':' . $chapter['name'] . ' - Buffalo';
        $this->admin_page_view('chapter-edit', $title, $data);
    }


    /**
     * 根据名称查询作品信息
     *
     * @param string $name 作品名称
     */
    public function find_by_name($name)
    {
        $arr = $this->work_model->find_by_name(urldecode($name));
        echo json_encode(array('value' => $arr));
    }


}