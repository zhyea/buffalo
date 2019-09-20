<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller
{
    public function index()
    {
        self::adminViewOf('header');
        self::adminViewOf('login');
        self::adminViewOf('footer');
    }


    public function home()
    {

    }


    public function login_check()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        echo $username;
        echo $password;
    }
}