<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends MY_Controller
{


    public function __construct()
    {
        parent::__construct();
        self::helperOf('array');
        self::modelOf('meta');
        self::modelOf('settings');
    }


    public function index()
    {
        $cats = $this->meta->query_category();
        $data['categories'] = list_to_tree($cats);

        $data['site_name'] =  $this->settings->get('site_name');
        $data['notice'] =  $this->settings->get('notice');

        self::viewOf('header', $data);
        self::viewOf('navigator', $data);
        self::viewOf('content');
        self::viewOf('footer');
    }

}