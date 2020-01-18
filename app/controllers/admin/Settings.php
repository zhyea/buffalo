<?php


class Settings extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Settings_Model');
        $this->load->service('Settings_Service');
    }

    /**
     * 网站配置管理页
     */
    public function site()
    {
        $data['site_keywords'] = $this->settings_model->get('site_keywords');
        $data['site_description'] = $this->settings_model->get('site_description');

        if (get_cookie('update_site')) {
            $data['msg'] = '更新网站设置成功！';
            delete_cookie('update_site');
        }

        self::admin_page_view('settings-site', '网站管理', $data);
    }


    /**
     * 加载信息维护页
     */
    public function info()
    {
        $this->load->helper('form');

        if (get_cookie('update_info')) {
            $data['msg'] = '更新网站设置成功！';
        } else {
            $data['msg'] = get_cookie('update_info_msg');
        }
        delete_cookie('update_info');

        $data['logo'] = $this->settings_model->get('logo');
        $data['bg_img'] = $this->settings_model->get('bg_img');
        $data['notice'] = $this->settings_model->get('notice');
        self::admin_page_view('settings-info', '信息维护', $data);
    }


    /**
     * 更新网站配置
     */
    public function update_site()
    {
        $this->settings_model->replace('site_name', $_POST['site_name']);
        $this->settings_model->replace('site_keywords', $_POST['site_keywords']);
        $this->settings_model->replace('site_description', $_POST['site_description']);

        set_cookie('update_site', true, 60);

        redirect('admin/settings/site');
    }


    /**
     * 更新信息维护数据
     */
    public function update_info()
    {
        $this->settings_model->replace('notice', $_POST['notice']);

        set_cookie('update_info', true, 60);

        if ($_FILES['logo']) {
            $this->settings_service->update_img_setting('logo');
            echo 1;
        }
        if ($_FILES['bg_img']) {
            $this->settings_service->update_img_setting('bg_img');
            echo 2;
        }
        redirect('admin/settings/info');
    }


    /**
     * 删除指定的配置项
     * @param string $key 配置项名称
     */
    public function delete_setting($key)
    {
        $this->settings_model->delete_by(array('name' => $key));

        redirect('admin/settings/info');
    }
}