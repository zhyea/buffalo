<?php


class Feature extends MY_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('work_model');
        $this->load->service('work_service');
    }





}