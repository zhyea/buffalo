<?php
defined('_APP_PATH_') or exit('You shall not pass!');

require_service("CacheService");

class CacheController extends AbstractController
{

    private $cacheService;


    /**
     * CacheController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->cacheService = new CacheService();
    }


    /**
     * 进入缓存管理页
     */
    public function index()
    {
        $this->admin_view('cache-settings', array(), '缓存设置');
    }


    /**
     * 清理缓存
     */
    public function clean()
    {
        $this->cacheService->clean();
        $this->alert_success("缓存清理成功");
        $this->redirect('/admin/cache');
    }

}