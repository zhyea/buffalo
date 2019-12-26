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
        if (empty($cat_name)) {
            show_404();
        }
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


    /**
     * 进入作品信息页
     *
     * @param int $work_id 作品ID
     */
    public function work($work_id)
    {
        $work = $this->work_service->get_by_id($work_id);
        if (empty($work)) {
            show_404();
        }
        $cat_id = $work['category_id'];
        $cat_name = $this->meta_service->get_name($cat_id);
        $author_id = $work['author_id'];
        $data = array(
            'cat_id' => $cat_id,
            'cat_name' => $cat_name,
            'work' => $work,
            'relate' => $this->work_service->find_by_author_id($author_id, $work_id),
            'chapters' => $this->work_service->chapters($work_id)
        );
        $this->page_view('work', $work['name'], $data);
    }

}