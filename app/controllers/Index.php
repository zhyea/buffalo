<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends MY_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->helper('array');
        $this->load->model('meta_model');
        $this->load->model('settings_model');

        $this->load->helper('url');
    }


    public function index()
    {
        $cats = $this->meta_model->query_category();
        $data['categories'] = list_to_tree($cats);

        $data['site_name'] = $this->settings_model->get('site_name');
        $data['notice'] = $this->settings_model->get('notice');

        self::view_of('header', $data);
        self::view_of('navigator', $data);
        self::view_of('content');
        self::view_of('footer');
    }


    public function test()
    {
        echo preg_match("/\d.*/i", "abcddd").'<br>';
        echo preg_match("/\d.*/i", "123456").'<br>';
        echo '<br>--------------------------------------------------';
        echo '<br>--------------------------------------------------';
    }

}