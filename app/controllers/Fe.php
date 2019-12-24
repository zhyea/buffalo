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


    /**
     * 进入分类页
     *
     * @param int $cat_id 分类ID
     * @param int $page_num 页码
     */
    public function cat($cat_id, $page_num = 0)
    {
        $cat_name = $this->meta_service->get_name($cat_id);
        $total = $this->work_service->count_cat($cat_id);
        $page_size = 12;
        $page_num = 0 >= $page_num ? 1 : $page_num;
        $data = array();
        $data['recommend'] = $this->feature_service->find_all_recommend();
        $data['works'] = $this->work_service->find_cat_page($cat_id, $page_num, $page_size);
        $data['cat_name'] = $cat_name;
        $data['cat_id'] = $cat_id;
        $data['total'] = $total / $page_size;
        $data['curr'] = $page_num;
        $this->page_view('category', $cat_name, $data);
    }




    public function work($work_id){
        $work = $this->work_service->get_by_id($work_id);
    }

}