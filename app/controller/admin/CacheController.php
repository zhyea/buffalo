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


    public function index()
    {

    }

}