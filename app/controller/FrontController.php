<?php
defined('_APP_PATH_') or exit('You shall not pass!');


require_service('WorkService');

class FrontController extends AbstractController
{


    private $workService;


    /**
     * constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->workService = new WorkService();
    }


    public function index()
    {
        $data = $this->workService->home_works();
        $this->theme_view('index', $data, "首页");
    }


    public function login()
    {

    }

}