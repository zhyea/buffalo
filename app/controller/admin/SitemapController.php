<?php
defined('_APP_PATH_') or exit('You shall not pass!');

require_service("SitemapService");


class SitemapController extends AbstractController
{


    private $sitemapService;

    /**
     * SitemapController constructor.
     * @param $sitemapService
     */
    public function __construct($sitemapService)
    {
        parent::__construct();
        $this->sitemapService = $sitemapService;
    }


}