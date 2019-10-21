<?php


class Settings extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('settings_model');
    }


    /**
     * 更新网站配置
     */
    public function update_settings_site()
    {
        $this->settings_model->replace('site_name', $_POST['site_name']);
        $this->settings_model->replace('site_keywords', $_POST['site_keywords']);
        $this->settings_model->replace('site_description', $_POST['site_description']);

        set_cookie('update_site', true, 60);

        redirect('admin/settings_site');
    }



    /**
     * 更新信息维护数据
     */
    public function update_settings_info()
    {
        $this->settings_model->replace('notice', $_POST['notice']);

        set_cookie('update_info', true, 60);

        if ($_POST['logo']) {
            $r = $this->settings_service->update_img_setting('logo');
            if ($r && $_POST['bg_img']) {
                $this->settings_service->update_img_setting('bg_img');
            }
        }
        redirect('admin/settings_info');
    }
}