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

        $regex = "/^(　)*第?[\s　]*[一二三四五六七八九十零〇百千万]{1,5}[\s　]*[章回节卷篇]?.{0,32}$/i";
        echo preg_match("/^\d{3}$/i", "123") . '<br>';
        echo preg_match("/^\d{0,6}$/i", "1234567") . '<br>';
        echo preg_match($regex, "第 一 卷 月落乌啼霜满天") . '<br>';
        echo preg_match($regex, "　　第 一 章　仙女庙中邪") . '<br>';
        echo $this->mb_trim("　　第 一 章　仙女庙中邪");
        echo '<br>--------------------------------------------------';
        echo '<br>--------------------------------------------------';
    }

    function mb_trim($str)
    {
        $str = mb_ereg_replace('^(([ \r\n\t])*(　)*)*', '', $str);
        $str = mb_ereg_replace('(([ \r\n\t])*(　)*)*$', '', $str);
        return $str;
    }

}