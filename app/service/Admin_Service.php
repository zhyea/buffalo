<?php


class Admin_Service extends MY_Service
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('settings_model');
    }


    public function update_img_setting($name = NULL)
    {
        $r = parent::upload_img($name);
        if ($r[0]) {
            $old = $this->settings_model->get($name);
            $file_path = VIEWPATH . 'uploads/' . $old;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $this->settings_model->replace($name, $r[1]);
            set_cookie('update_info', true, 60);
            return TRUE;
        } else {
            set_cookie('update_info', false, 60);
            set_cookie('update_info_msg', $r[1], 60);
            return FALSE;
        }
    }

}