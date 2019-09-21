<?php

class Admin extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('array');
        $this->load->model('meta');
        $this->load->library('session');
    }

    public function login()
    {
        self::adminViewOf('header');
        self::adminViewOf('login');
        self::adminViewOf('footer');
    }


    public function index()
    {
        self::adminViewOf('header');
        self::adminViewOf('home');
        self::adminViewOf('footer');
    }


    public function login_check()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        echo $username;
        echo $password;
    }
}