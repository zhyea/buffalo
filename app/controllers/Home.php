<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('array');
        $this->load->model('meta_model');
    }


    public function index()
    {
        $cats = $this->meta_model->query_category();
        $data['categories'] = list_to_tree($cats);

        $this->load->view('header', $data);
        $this->load->view('content');
        $this->load->view('footer');
    }


}