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
        $this->load->service('author_service');
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
     * 进入作者作品页
     *
     * @param int $author_id 作者ID
     * @param int $page_num 页码
     */
    public function author($author_id, $page_num = 0)
    {
        $author = $this->author_service->get_author($author_id);
        $author_name = is_null($author) ? '' : $author['name'];
        $bio = is_null($author) ? '' : $author['bio'];
        if (empty($author_name)) {
            show_404();
        }
        $total = $this->work_service->count_author($author_id);
        $page_size = 12;
        $page_num = 0 >= $page_num ? 1 : $page_num;
        $data = array();
        $data['works'] = $this->work_service->find_author_page($author_id, $page_num, $page_size);
        $data['name'] = $author_name;
        $data['author_id'] = $author_id;
        $data['bio'] = $bio;
        $data['total'] = $total / $page_size;
        $data['curr'] = $page_num;
        $this->page_view('author', $author_name, $data);

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
        $author_id = $work['author_id'];
        $data = array(
            'cat_id' => $work['cat_id'],
            'cat_name' => $work['cat_name'],
            'author_id' => $author_id,
            'work' => $work,
            'relate' => $this->work_service->find_by_author_id($author_id, $work_id),
            'chapters' => $this->work_service->chapter_list($work_id)
        );
        $this->page_view('work', $work['name'], $data);
    }


    /**
     * 进入作品章节页
     *
     * @param int $work_id 作品ID
     * @param int $chapter_id 章节ID
     */
    public function chapter($work_id, $chapter_id)
    {
        $work = $this->work_service->get_by_id($work_id);
        if (empty($work)) {
            show_404();
        }
        $arr = $this->work_service->chapter($work_id, $chapter_id);
        $chapter = $arr['curr'];
        if (empty($arr) || empty($chapter)) {
            show_404();
        }
        $title = $work['name'] . ' - ' . $chapter['name'];
        $data = array(
            'work_id' => $work_id,
            'id' => $chapter_id,
            'last' => empty($arr['last']) ? 0 : $arr['last']['id'],
            'next' => empty($arr['next']) ? 0 : $arr['next']['id'],
            'cat_id' => $work['cat_id'],
            'cat_name' => $work['cat_name'],
            'work_name' => $work['name'],
            'name' => $chapter['name'],
            'content' => $chapter['content']
        );
        $this->page_view('chapter', $title, $data);
    }

}