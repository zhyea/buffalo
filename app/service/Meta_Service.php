<?php


class Meta_Service extends MY_Service
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Meta_Model');
    }


    /**
     * 按ID获取名称
     * @param int $id 记录ID
     * @return string 名称
     */
    public function get_name($id)
    {
        return $this->meta_model->get_name($id);
    }

}