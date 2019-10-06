<?php


class Admin_Service extends MY_Service
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('meta_model');
    }

    public function update_info_settings(){
        $config['upload_path'] = './user/uploads';
        $config['allowed_types'] = 'jpg|png';
        $config['max_size'] = 1024;
        $config['file_name'] = uniqid();

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('logo')) {
            print_r($this->upload->data());
        } else {
            print_r($this->upload->display_errors());
        }
    }

}