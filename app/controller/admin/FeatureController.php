<?php
defined('_APP_PATH_') or exit('You shall not pass!');

require_model('FeatureModel');


class FeatureController extends AbstractController
{

    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new FeatureModel();
    }


    /**
     * 进入列表页
     */
    public function list()
    {
        $this->admin_view('feature-list', array(), '专题列表');
    }


    /**
     * 列表页数据
     */
    public function data()
    {
        $all = $this->model->find_all();
        $this->render_json($all);
    }


    /**
     * 执行删除操作
     * @param $id int 记录ID
     */
    public function delete($id)
    {
        if ($id > 1) {
            $this->model->delete_by_id($id);
        }
        $this->redirect('admin/feature/list');
    }


    /**
     * 进入编辑页
     * @param $id int 记录ID
     */
    public function settings($id = 0)
    {
        $s = array('id' => $id);
        if ($id > 0) {
            $s = $this->model->get_by_id($id);
        }
        $this->admin_view('feature-settings', $s, empty($s) ? '新增专题' : '编辑专题');
    }


    /**
     * 维护脚本信息
     */
    public function maintain()
    {
        $data = $this->_post();

        $cover = $this->upload('cover');
        if ($cover[0]) {
            if (!empty($data['former_cover'])) {
                del_upload_file($data['former_cover']);
            }
            $data['cover'] = $cover[1];
        }
        $data = array_key_rm('former_cover', $data);

        $background = $this->upload('background');
        if ($background[0]) {
            if (!empty($data['former_background'])) {
                del_upload_file($data['former_background']);
            }
            $data['background'] = $background[1];
        }
        $data = array_key_rm('former_background', $data);

        $this->model->insert_or_update($data);
        $this->alert_success('维护专题信息成功');
        if (empty($data['id'])) {
            $this->redirect('admin/feature/list');
        } else {
            $this->redirect('admin/feature/settings/' . $data['id']);
        }
    }


    /**
     * 删除封面
     * @param $id int 专题ID
     */
    public function delete_cover($id)
    {
        $f = $this->model->get_by_id($id);
        $this->_delete($f, 'cover');
        $this->model->update($f);
        $this->alert_success('删除封面成功');
        $this->redirect('admin/feature/settings/' . $id);
    }


    /**
     * 删除背景图
     * @param $id int 专题ID
     */
    public function delete_bg($id)
    {
        $f = $this->model->get_by_id($id);
        $this->_delete($f, 'background');
        $this->model->update($f);
        $this->alert_success('删除背景图成功');
        $this->redirect('admin/feature/settings/' . $id);
    }


    /**
     * 执行删除上传文件操作
     * @param $f array 记录数组
     * @param $target string 上传文件字段
     */
    private function _delete(&$f, $target)
    {
        if (!empty($f) && !empty($f[$target])) {
            $path = $f[$target];
            del_upload_file($path);
            $f[$target] = '';
        }
    }

}