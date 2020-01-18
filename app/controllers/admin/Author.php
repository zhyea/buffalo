<?php


class Author extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Author_Model");
        $this->load->model('Work_Model');
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

    /**
     * 进入专题信息页
     */
    public function list_page()
    {
        $this->admin_page_view('author-list', '作者信息');
    }


    /**
     * 输出全部专题数据
     */
    public function data()
    {
        $data = $this->author_model->all();
        echo json_encode($data);
    }


    /**
     * 进入作者信息维护页
     *
     * @param int $id 作者ID
     */
    public function settings($id = 0)
    {
        $a = $id <= 0 ? null : $this->author_model->get_by_id($id);

        $title = ($id > 0 ? '编辑作者信息' : '新增作者信息');

        if (get_cookie('update_author')) {
            $data['msg'] = '更新作者信息成功！';
            delete_cookie('update_author');
        }

        $data['id'] = $id;
        $data['name'] = is_null($a) ? '' : $a['name'];
        $data['country'] = is_null($a) ? '' : $a['country'];
        $data['bio'] = is_null($a) ? '' : $a['bio'];

        $this->load->helper('form');
        $this->admin_page_view('author-settings', $title, $data);
    }


    /**
     * 更新专题信息
     */
    public function insert()
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $country = $_POST['country'];
        $bio = $_POST['bio'];

        $tmp = $this->author_model->insert($name, $country, $id, $bio);
        if ($id > 0) {
            set_cookie('update_author', true, 60);
        } else {
            $id = $tmp;
        }

        redirect('admin/author/settings/' . $id);
    }


    /**
     * 进入作者作品记录页
     *
     * @param int $id 作者ID
     */
    public function works_page($id = 0)
    {
        $f = $this->author_model->get_by_id($id);
        if (is_null($f)) {
            redirect('admin/author/list_page');
        }

        $data['id'] = $id;
        $data['name'] = $f['name'];

        $this->admin_page_view('author-works', $f['name'], $data);
    }


    /**
     * 删除作者信息
     *
     * @param int $id 作者ID
     */
    public function delete($id)
    {
        if (!empty($id) && $id > 1) {
            $this->author_model->delete($id);
            $this->work_model->set_default_author($id);
        }
        redirect('admin/author/list_page');
    }

}