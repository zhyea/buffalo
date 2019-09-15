<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends MY_Controller
{


    public function __construct()
    {
        parent::__construct();
        self::helperOf('array');
        self::modelOf('meta');
    }


    public function index()
    {
        $cats = $this->meta->query_category();
        $data['categories'] = list_to_tree($cats);

        $data['page_header'] = self::viewOf('header');
        $data['page_navigator'] = self::viewOf('navigator', $data);


        self::viewOf('content');
        self::viewOf('footer');
    }

}