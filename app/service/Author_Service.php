<?php


class Author_Service extends MY_Service
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('Author_Model');
    }

    public function get_author($id)
    {
        return $this->author_model->get_by_id($id);
    }

}