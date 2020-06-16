<?php
defined('_APP_PATH_') or exit('You shall not pass!');


require_model('SettingModel');

class SettingsController extends AbstractController
{

    private $model;

    /**
     * constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->model = new SettingModel();
    }


    public function index()
    {
        $name = $this->model->get_by_key('site_name');
        $desc = $this->model->get_by_key('description');
        $notice = $this->model->get_by_key('notice');
        $keywords = $this->model->get_by_key('keywords');
        $bg_repeat = $this->model->get_by_key('bg_repeat', 1);
        $logo = $this->model->get_by_key('logo', '');
        $background = $this->model->get_by_key('background', '');

        $this->admin_view('settings',
            array('site_name' => $name,
                'notice' => $notice,
                'description' => $desc,
                'keywords' => $keywords,
                'bg_repeat' => $bg_repeat,
                'logo' => $logo,
                'background' => $background), "网站配置");
    }


    public function maintain()
    {
        $name = $_POST['site_name'];
        $desc = $_POST['description'];
        $keywords = $_POST['keywords'];
        $notice = $_POST['notice'];
        $logo = $this->_upload('logo');
        $background = $this->_upload('background');
        $bg_repeat = $_POST['bg_repeat'];

        $this->model->change('site_name', $name);
        $this->model->change('description', $desc);
        $this->model->change('keywords', $keywords);
        $this->model->change('notice', $notice);
        if ($logo[0]) {
            $this->_delete('logo', '');
            $this->model->change('logo', $logo[1]);
        }
        if ($background[0]) {
            $this->_delete('background', '');
            $this->model->change('background', $background[1]);
        }
        $this->model->change('bg_repeat', $bg_repeat);

        $this->alert_success('更新网站设置成功');

        $this->redirect('admin/settings');
    }


    /**
     * 删除Logo
     */
    public function delete_logo()
    {
        $this->_delete('logo', 'LOGO');
    }

    /**
     * 删除背景图
     */
    public function delete_bg()
    {
        $this->_delete('background', '背景图');
    }

    /**
     * 执行删除及跳转操作
     *
     * @param $key string 文件配置项
     * @param $name string 配置项名称
     */
    private function _delete($key, $name)
    {
        $v = $this->model->get_by_key($key);
        del_upload_file($v);
        $this->model->delete_by_key($key);
        $this->alert_success('删除' . $name . '成功');
        $this->redirect('admin/settings');
    }


}