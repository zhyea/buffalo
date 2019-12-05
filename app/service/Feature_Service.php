<?php


class Feature_Service extends MY_Service
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('feature_model');
    }
}