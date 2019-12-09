<?php


class Feature extends MY_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('feature_model');
        $this->load->service('feature_service');
        $this->load->model('feature_record_model');
    }


    /**
     * 进入专题信息页
     */
    public function list_page()
    {
        $this->admin_page_view('feature-list', '专题信息 - Buffalo');
    }


    /**
     * 输出全部专题数据
     */
    public function data()
    {
        $data = $this->feature_model->all();
        echo json_encode($data);
    }


    /**
     * 进入专题信息维护页
     *
     * @param int $id 专题ID
     */
    public function settings_page($id = 0)
    {
        $f = $id <= 0 ? null : $this->feature_model->get_by_id($id);

        $title = ($id > 0 ? '编辑专题' : '新增专题') . ' - Buffalo';

        if (get_cookie('update_feature')) {
            $data['msg'] = '更新专题信息成功！';
            delete_cookie('update_feature');
        }

        $data['id'] = $id;
        $data['cover'] = is_null($f) ? '' : $f['cover'];
        $data['name'] = is_null($f) ? '' : $f['name'];
        $data['alias'] = is_null($f) ? '' : $f['brief'];
        $data['key_words'] = is_null($f) ? '' : $f['key_words'];
        $data['brief'] = is_null($f) ? '' : $f['brief'];

        $this->load->helper('form');
        $this->admin_page_view('feature-settings', $title, $data);
    }


    /**
     * 更新专题信息
     */
    public function update()
    {
        $id = $_POST['id'];
        $data = array(
            'name' => $_POST['name'],
            'alias' => $_POST['alias'],
            'key_words' => $_POST['key_words'],
            'brief' => $_POST['brief']
        );

        $tmp = $this->feature_service->update($data, $id);
        if ($id > 0) {
            set_cookie('update_feature', true, 60);
        } else {
            $id = $tmp;
        }

        redirect('admin/feature/settings_page/' . $id);
    }


    /**
     * 进入专题记录页
     *
     * @param int $id 专题ID
     */
    public function record_page($id = 0)
    {
        $f = $this->feature_model->get_by_id($id);
        if (is_null($f)) {
            redirect('admin/feature/list_page');
        }

        $title = $f['name'] . ' - Buffalo';

        $data['id'] = $id;
        $data['name'] = $f['name'];

        $this->admin_page_view('feature-records', $title, $data);
    }


    /**
     * 获取专题记录数据
     *
     * @param int $feature_id 专题ID
     */
    public function feature_works($feature_id)
    {
        $data = $this->feature_record_model->find_feature_works($feature_id);
        echo json_encode($data);
    }


    /**
     * 添加专题记录
     */
    public function add_work()
    {
        $feature_id = $_POST['id'];
        $work_id = $_POST['work_id'];
        echo $this->feature_record_model->add_feature_work($feature_id, $work_id);
    }



    /**
     * 删除数据
     */
    public function delete_records()
    {
        $ids = $_POST['ids'];
        echo $this->feature_record_model->delete_batch(explode(',', $ids));
    }

}