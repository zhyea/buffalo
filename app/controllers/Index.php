<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends MY_Controller
{


    public function __construct()
    {
        parent::__construct();
        self::helperOf('array');
        self::modelOf('meta_model');
        self::modelOf('settings_model');
    }


    public function index()
    {
        $cats = $this->meta_model->query_category();
        $data['categories'] = list_to_tree($cats);

        $data['site_name'] =  $this->settings_model->get('site_name');
        $data['notice'] =  $this->settings_model->get('notice');

        self::viewOf('header', $data);
        self::viewOf('navigator', $data);
        self::viewOf('content');
        self::viewOf('footer');
    }

}