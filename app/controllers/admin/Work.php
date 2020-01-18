<?php


class Work extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Work_Model');
        $this->load->model('Author_Model');
        $this->load->model('Meta_Model');
        $this->load->model('Chapter_Model');
        $this->load->model('Volume_Model');
        $this->load->model('Remote_Code_Model');
        $this->load->service('Work_Service');

        $this->load->library('session');
    }


    /**
     * 章节信息
     *
     * @param int $work_id 作品ID
     */
    public function chapters($work_id = 0)
    {
        $w = $this->Work_Model->get_by_id($work_id);
        $work_name = $w['name'];

        $data['id'] = $work_id;
        $data['name'] = $work_name;
        $data['volumes'] = $this->Work_Service->chapter_list($work_id);

        $this->load->helper('form');
        $this->admin_page_view('work-chapters', $work_name, $data);
    }


    /**
     * 加载作品列表页
     */
    public function list_page()
    {
        $this->admin_page_view('work-list', '作品列表');
    }


    /**
     * 作品信息维护页
     *
     * @param int $id 当前作品ID
     */
    public function settings_page($id = 0)
    {
        $work = $id <= 0 ? null : $this->Work_Model->get_by_id($id);

        $title = ($id > 0 ? $work['name'] : '新增作品');

        $cat_id = is_null($work) ? 0 : $work['cat_id'];
        $author_id = is_null($work) ? 0 : $work['author_id'];
        $author = $this->Author_Model->get_by_id($author_id);

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
        $data['cat'] = empty($cat_id) ? '' : $this->Meta_Model->get_name($cat_id);;

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
            $author_id = $this->Author_Model->insert($_POST['author'], $_POST['authorCountry']);
        }
        $cat_id = $_POST['cat_id'];
        if (empty($cat_id)) {
            $cat_id = $this->Meta_Model->insert_category($_POST['cat']);
        }
        $data = array(
            'name' => $_POST['name'],
            'brief' => $_POST['brief'],
            'author_id' => $author_id,
            'category_id' => $cat_id
        );
        $tmp = $this->Work_Service->update($data, $id);

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
        $arr = $this->Work_Model->query_in_page(false, $search, $sort, $order, $offset, $limit);
        $total = $this->Work_Model->query_in_page(true);
        echo json_encode(Array('total' => $total, 'rows' => $arr));
    }


    /**
     * 删除数据
     */
    public function delete()
    {
        $ids = explode(',', $_POST['ids']);
        $this->Work_Model->delete_batch($ids);
        $this->Volume_Model->delete_by_work_id($ids);
        $this->Chapter_Model->delete_by_work_id($ids);
        echo 1;
    }


    /**
     * 上传并解析文件内容
     */
    public function upload()
    {
        $work_id = $_POST['work_id'];
        $this->Work_Service->upload_and_read($work_id, 'myTxt');
    }


    /**
     * 编辑章节
     *
     * @param int $work_id 作品ID
     * @param int $chapter_id 章节ID
     */
    public function chapter_edit($work_id, $chapter_id = 0)
    {
        $work = $this->Work_Model->get_by_id($work_id);
        $chapter = $this->Chapter_Model->get_by_id($chapter_id);
        $volume_name = $this->Volume_Model->get_name($chapter['volume_id']);

        $chapter_name = is_null($chapter) ? '' : $chapter['name'];

        $data['work_name'] = $work['name'];
        $data['chapter_name'] = $chapter_name;
        $data['content'] = is_null($chapter) ? '' : $chapter['content'];
        $data['work_id'] = $work['id'];
        $data['chapter_id'] = $chapter_id;
        $data['volume_id'] = is_null($chapter) ? 0 : $chapter['volume_id'];
        $data['volume'] = empty($volume_name) ? '' : $volume_name;

        $title = $work['name'] . ':' . $chapter_name;
        $this->admin_page_view('chapter-edit', $title, $data);
    }

    /**
     * 更新章节
     */
    public function chapter_update()
    {
        $id = $_POST['id'];
        $work_id = $_POST['work_id'];
        $name = $_POST['name'];
        $volume_id = $_POST['volume_id'];
        $volume = $_POST['volume'];
        $content = $_POST['content'];

        if (!empty($volume)) {
            $volume_id = empty($volume_id) ? 0 : $volume_id;
            $volume_id = $this->Volume_Model->insert($work_id, $volume, $volume_id);
        }
        $this->Chapter_Model->update($work_id, $volume_id, $name, $content, $id);

        redirect('admin/work/chapters/' . $work_id);
    }


    /**
     * 删除章节
     *
     * @param int $work_id 作品ID
     * @param int $chapter_id 章节ID
     */
    public function chapter_delete($work_id, $chapter_id = 0)
    {
        $this->Chapter_Model->delete($chapter_id);
        redirect('admin/work/chapters/' . $work_id);
    }

    /**
     * 根据名称查询作品信息
     *
     * @param string $name 作品名称
     */
    public function find_by_name($name)
    {
        $arr = $this->Work_Model->find_by_name(urldecode($name));
        echo json_encode(array('value' => $arr));
    }


    /**
     * 远程交互代码
     */
    public function remote_code()
    {
        echo $this->Remote_Code_Model->add(1);
    }


    /**
     * 远程写
     *
     * @param string $code 交互code
     */
    public function remote_edit($code)
    {
        if (empty($code)) {
            return;
        }

        $user_id = $this->Remote_Code_Model->check($code);
        if ($user_id <= 0) {
            return;
        }
        print_r($_POST);
        $work_name = isset($_POST['work']) ? $_POST['work'] : '';
        $volume_name = isset($_POST['volume']) ? $_POST['volume'] : '';
        $chapter_name = isset($_POST['chapter']) ? $_POST['chapter'] : '';
        $content = isset($_POST['content']) ? $_POST['content'] : '';

        echo $this->Work_Service->remote_write($work_name, $volume_name, $chapter_name, $content);
    }


    /**
     * 作者作品集合
     *
     * @param int $author_id 作者ID
     */
    public function author_works($author_id)
    {
        $data = $this->Work_Service->find_by_author_id($author_id);
        echo json_encode($data);
    }


    /**
     * 调整作品作者
     */
    public function alter_author()
    {
        $author_id = $_POST['id'];
        $work_id = $_POST['work_id'];
        echo $this->Work_Model->alter_author($work_id, $author_id);
    }

}