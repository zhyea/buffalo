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
        $name = $this->model->get_by_key('name');
        $desc = $this->model->get_by_key('description');
        $notice = $this->model->get_by_key('notice');
        $keywords = $this->model->get_by_key('keywords');
        $bg_repeat = $this->model->get_by_key('bg_repeat', 1);
        $logo = $this->model->get_by_key('logo', '');
        $background = $this->model->get_by_key('background', '');

        $this->admin_view('settings',
            array('name' => $name,
                'notice' => $notice,
                'description' => $desc,
                'keywords' => $keywords,
                'bg_repeat' => $bg_repeat,
                'logo' => $logo,
                'background' => $background), "网站配置");
    }


    public function maintain()
    {
        $name = $_POST['name'];
        $desc = $_POST['description'];
        $keywords = $_POST['keywords'];
        $notice = $_POST['notice'];
        $logo = $this->upload('logo');
        $background = $this->upload('background');
        $bg_repeat = $_POST['bg_repeat'];

        $this->model->change('name', $name);
        $this->model->change('description', $desc);
        $this->model->change('keywords', $keywords);
        $this->model->change('notice', $notice);
        if ($logo[0]) {
            $this->model->change('logo', $logo[1]);
        }
        if ($background[0]) {
            $this->model->change('background', $background[1]);
        }
        $this->model->change('bg_repeat', $bg_repeat);

        $this->add_alert('更新网站设置成功', 'success');

        $this->redirect('admin/settings');
    }


    /**
     * 删除Logo
     */
    public function delete_logo()
    {
        $logo = $this->model->get_by_key('logo');
        del_upload_file($logo);
        $this->model->delete_by_key('logo');
        $this->add_alert('删除LOGO成功', 'success');
        $this->redirect('admin/settings');
    }

    /**
     * 删除背景图
     */
    public function delete_bg()
    {
        $background = $this->model->get_by_key('background');
        del_upload_file($background);
        $this->add_alert('删除背景图成功', 'success');
        $this->redirect('admin/settings');
    }


}