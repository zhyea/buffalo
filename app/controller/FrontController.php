<?php
defined('_APP_PATH_') OR exit('You shall not pass!');


require_model('UserModel');


class FrontController extends AbstractController
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

        $this->theme_view('welcome', array('hi' => 'Hello World'), "北京欢迎你");
    }


    public function user()
    {
        $r = $this->model->get_by_id(1);;
        $this->render_json($r);
    }


    public function login()
    {

    }

}