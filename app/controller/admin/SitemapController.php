<?php
defined('_APP_PATH_') or exit('You shall not pass!');

require_service("SitemapService");


class SitemapController extends AbstractController
{


    private $sitemapService;

    public function __construct()
    {
        parent::__construct();
        $this->sitemapService = new SitemapService();
    }

    /**
     * 进入缓存管理页
     */
    public function index()
    {
        $this->admin_view('sitemap', array(), '网站地图');
    }


    /**
     * 清理缓存
     */
    public function gen()
    {
        $this->sitemapService->genSitemap();
        $this->alert_success("生成网站地图成功");
        $this->redirect('/admin/sitemap');
    }

}