<?php
defined('_APP_PATH_') OR exit('You shall not pass!');


require_model('SettingsModel');

class SettingsController extends AbstractController
{

    private $model;

    /**
     * constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->model = new SettingsModel();
    }


    public function index()
    {
        $name = $this->model->get_by_key('name');
        $notice = $this->model->get_by_key('notice');
        $site_name = $this->model->get_by_key('site_name');
        $desc = $this->model->get_by_key('description');
        $keywords = $this->model->get_by_key('keywords');
        $bg_repeat = $this->model->get_by_key('bgRepeat', 1);
        $logo = $this->model->get_by_key('logo', '');
        $background_img = $this->model->get_by_key('background_img', '');

        $this->admin_view('settings',
            array('name' => $name,
                'notice' => $notice,
                'site_name' => $site_name,
                'description' => $desc,
                'keywords' => $keywords,
                'bg_repeat' => $bg_repeat,
                'logo' => $logo,
                'background_img' => $background_img), "网站配置");
    }


    public function maintain()
    {
        $this->upload_file('logo');
    }


}