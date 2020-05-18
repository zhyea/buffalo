<?php
defined('_APP_PATH_') OR exit('You shall not pass!');


require_model('UserModel');


class HelloController extends AbstractController
{


    private $model;


    /**
     * constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->model = new UserModel();
    }


    public function index()
    {
        $this->admin_view('index', array('hi' => 'Hello World'), "北京欢迎你");
    }


    public function user()
    {
        $r = $this->model->get(0);
        $this->render_json($r);
    }


    public function login()
    {

    }

}