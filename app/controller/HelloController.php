<?php
defined('_APP_PATH_') OR exit('You shall not pass!');


require_model('HelloModel');


class HelloController extends AbstractController
{


    private $model;


    /**
     * constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->model = new HelloModel();
    }


    public function index()
    {
        $this->admin_view('index', array('hi' => 'Hello World'), "北京欢迎你");
    }


    public function user()
    {
        $r = $this->model->get(1);
        $this->render_json($r);
    }


    public function login()
    {

    }

}