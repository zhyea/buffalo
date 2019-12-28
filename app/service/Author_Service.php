<?php


class Author_Service extends MY_Service
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('author_model');
    }

    public function get_name($id)
    {
        $a = $this->author_model->get_by_id($id);
        return empty($a) ? NULL : $a['name'];
    }

}