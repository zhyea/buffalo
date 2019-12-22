<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends MY_Controller
{


    public function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->service('feature_service');
        $this->load->service('work_service');
    }


    public function index()
    {
        $data = array();
        $data['recommend'] = $this->feature_service->find_all_recommend();;
        $data['cats'] = $this->work_service->find_cat_works();
        //print_r($data);
        $this->page_view('home', '首页', $data);
    }


    public function category()
    {
        $this->page_view('category');
    }


    public function work()
    {
        $this->page_view('work');
    }


    public function chapter()
    {
        $this->page_view('chapter');
    }


    public function a()
    {
        echo '--------------';
    }


    public function test()
    {

        $regex = "/^(　)*第?[\s　]*[一二三四五六七八九十零〇百千万]{1,5}[\s　]*[章回节卷篇]?.{0,32}$/i";
        echo preg_match("/^\d{3}$/i", "123") . '<br>';
        echo preg_match("/^\d{0,6}$/i", "1234567") . '<br>';
        echo preg_match($regex, "第 一 卷 月落乌啼霜满天") . '<br>';
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