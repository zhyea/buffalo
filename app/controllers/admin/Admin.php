<?php


class Admin extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

    }

    /**
     * 后台首页
     */
    public function index()
    {
        self::admin_page_view('home', 'Buffalo Console');
    }

}