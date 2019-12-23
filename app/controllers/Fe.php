<?php


class Fe extends MY_Controller
{


    public function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->service('feature_service');
        $this->load->service('work_service');
        $this->load->service('meta_service');
    }


    public function cat($cat_id, $page_num = 0)
    {
        $cat_name = $this->meta_service->get_name($cat_id);
        $data = array();
        $data['recommend'] = $this->feature_service->find_all_recommend();;
        $data['works'] = $this->work_service->find_cat_page($cat_id, $page_num);
        $data['cat_name'] = $cat_name;
        $this->page_view('category', $cat_name, $data);
    }

}